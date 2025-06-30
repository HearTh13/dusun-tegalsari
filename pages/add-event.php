<?php
    include __DIR__ . '/../db.php';
    $alert = null;

    function generateUuidV4() {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // version 4
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // variant
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = generateUuidV4();
        $event_name = $_POST['event_name'];
        $description = $_POST['description'];
        $image = $_FILES['image']['tmp_name'];
        $owner = $_SESSION['owner'];
        $createdDateTime = date('Y-m-d H:i:s');
        $createdBy = $_SESSION['user_id'];


        if (!empty($event_name) && !empty($description) && is_uploaded_file($image)) {
            $imageData = addslashes(file_get_contents($image)); // untuk simpan ke BLOB
            $query = "INSERT INTO events (id, event_name, owner, image, description, created_date_time, created_by) VALUES ('$id', '$event_name', '$owner', '$imageData', '$description', '$createdDateTime', '$createdBy')";

            if (mysqli_query($conn, $query)) {
                $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Gambar berhasil ditambahkan.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">Gagal menyimpan gambar: ' . mysqli_error($conn) . '</div>';
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
                padding-top: 40px;
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
                <h2 class="mb-4 text-success"><i class="bi bi-plus-circle"></i>Tambah Event</h2>

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
