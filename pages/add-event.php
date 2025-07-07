<?php
    include __DIR__ . '/../db.php';
    $alert = null;

    function generateUuidV4() {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // version 4
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // variant
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    function compressImage($source, $quality = 70) {
        $info = getimagesize($source);

        if ($info['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($source);
        } elseif ($info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
            ob_start();
            imagejpeg($image, null, $quality);
            $compressed = ob_get_clean();
            return $compressed;
        } else {
            return file_get_contents($source); // format lain, tidak diproses
        }

        ob_start();
        imagejpeg($image, null, $quality); // simpan hasil ke buffer
        $compressed = ob_get_clean();
        return $compressed;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = generateUuidV4();
        $event_name = $_POST['event_name'];
        $description = $_POST['description'];
        $imageTmp = $_FILES['image']['tmp_name'];
        $owner = $_SESSION['owner'];
        $createdDateTime = date('Y-m-d H:i:s');
        $createdBy = $_SESSION['user_id'];

        if (!empty($event_name) && !empty($description) && is_uploaded_file($imageTmp)) {
            // Buat folder berdasarkan tahun/bulan
            $year = date('Y');
            $month = date('m');
            $uploadDir = __DIR__ . "/../uploads/$year/$month";
            $relativePath = "uploads/$year/$month";

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Nama unik
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $filename = uniqid('img_', true) . '.' . $ext;
            $savePath = "$uploadDir/$filename"; // path di server
            $dbImagePath = "$relativePath/$filename"; // path disimpan di DB

            // Simpan hasil kompres
            $compressed = compressImage($imageTmp);
            file_put_contents($savePath, $compressed);

            // Simpan ke DB (hanya path-nya)
            $query = "INSERT INTO events (id, event_name, owner, image, description, created_date_time, created_by) 
                    VALUES ('$id', '$event_name', '$owner', '$dbImagePath', '$description', '$createdDateTime', '$createdBy')";
            $bool_event = mysqli_query($conn, $query);

            $query = "INSERT INTO galeries (id, image_name, owner, image, created_date_time, created_by) 
                    VALUES ('$id', '$event_name', '$owner', '$dbImagePath', '$createdDateTime', '$createdBy')";

            $bool_image = mysqli_query($conn, $query);

            if ($bool_event && $bool_image) {
                $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                Acara berhasil ditambahkan.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">Gagal menyimpan: ' . mysqli_error($conn) . '</div>';
            }
        } else {
            $alert = '<div class="alert alert-warning" role="alert">Semua field wajib diisi.</div>';
        }
    }

    include __DIR__ . '/../components/navbar.php';
?>

<html>
    <head>
        <style>
            html, body {
                padding-top: 20px;
            }
            .main-content {
                padding-top: 90px;
                padding-bottom: 70px; 
                min-height: 100%;
            }
            footer.footer {
                height: 60px;
                background-color: #f8f9fa;
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                padding: 15px 0;
                text-align: center;
                border-top: 1px solid #ddd;
            }
            
        </style>
    </head>
    <body>
        <div class="main-content">
            <div class="container">
                <a href="/home">
                    <button class="btn mb-4 text-light bg-success" type="submit">← Kembali</button>
                </a>
                <h2 class="mb-4 text-success"><i class="bi bi-plus-circle"></i> Tambah Event</h2>

                <?= $alert ?>

                <form method="post" enctype="multipart/form-data" class="bg-light p-4 rounded shadow-sm">
                    <div class="mb-3">
                        <label class="form-label">Nama Acara</label>
                        <input type="text" name="event_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="5" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Gambar</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                    </div>

                    <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Simpan Acara</button>
                </form>
            </div>
        </div>
        <?php include __DIR__ . '/../components/footer.php'; ?>
    </body>
</html>
