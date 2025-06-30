<!DOCTYPE html>
<html lang="en">
<?php
include __DIR__ . '/../db.php';

$query = "SELECT * FROM events ORDER BY created_date_time DESC LIMIT 3";
$events = mysqli_query($conn, $query);

$query = "SELECT * FROM galeries ORDER BY created_date_time DESC LIMIT 3";
$galery = mysqli_query($conn, $query);

$query = "SELECT * FROM products ORDER BY created_date_time DESC LIMIT 3";
$products = mysqli_query($conn, $query);
?>
<head>
    <style>
        body {
            padding-top: 100px;
        }
        .text-truncate-multiline {
            display: -webkit-box;
            -webkit-line-clamp: 6; /* Ubah sesuai jumlah baris yang kamu mau */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body>
    
    <?php include __DIR__ . '/../components/navbar.php' ?>

    <section class="bg-light text-center py-5 mt-5">
        <div class="container">
        <h1 class="display-5 fw-bold">Selamat Datang di Dusun Tegalsari</h1>
        <p class="lead text-muted">Kelurahan Jatiayu, Kecamatan Karangmojo, Kabupaten Gunung Kidul, Provinsi DIY</p>
        </div>
    </section>

    <!-- Profil -->
    <section id="profil" class="py-5 bg-success">
        <div class="container">
            <h2 class="text-light mb-4"><i class="bi bi-info-circle-fill"></i> Profil Dusun</h2>
            <p class="text-light">Dusun Tegalsari dihuni oleh sekitar 164 jiwa. Mayoritas penduduk bekerja sebagai petani dan penjual. Suasana alam yang sejuk serta kerukunan dan kerja sama masyarakat menjadi ciri khas utama dusun ini.</p>
        </div>
    </section>

    <!-- Acara -->
    <section id="potensi" class="py-5 bg-light">
        <div class="container">
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="row align-items-center mb-4">
                    <div class="col-auto">
                        <h2 class="text-success"><i class="bi bi-calendar-event"></i> Acara</h2>
                    </div>
                    <div class="col-auto">
                        <a href="/add-event"><button class="btn btn-success">Tambah Acara +</button></a>
                    </div>
                </div>
            <?php else: ?>
                <h2 class="text-success mb-4"><i class="bi bi-calendar-event"></i> Acara</h2>
            <?php endif; ?>
            <div class="row g-4">
                <?php while ($row = mysqli_fetch_assoc($events)) { ?>
                    <!-- <a href="detail.php?id=<?php echo $row['id']; ?>" class="text-decoration-none text-dark"> -->
                    <div class="col-md-4">
                        <div class="card border-0 shadow h-100" style="max-height: 500px; min-height: 400px; overflow: hidden;">
                            <!-- Gambar Card -->
                            <img src="<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row["event_name"] ?>" style="object-fit: cover; height: 200px;">

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php echo $row["event_name"] ?></h5>
                                <p class="card-text text-truncate-multiline">
                                <?php echo $row["description"] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- </a> -->
                <?php } ?>
            </div>
            <div class="row mt-4">
                <div class="col text-center">
                    <a href="/all-events?page=1" class="btn btn-outline-success">
                        <i class="bi bi-arrow-down-circle"></i> Lihat Lebih Banyak
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Produk Lokal -->
    <section id="potensi" class="py-5 bg-light">
    <div class="container">
        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="row align-items-center mb-4">
                <div class="col-auto">
                    <h2 class="text-success"><i class="bi bi-box-seam"></i> Produk Lokal</h2>
                </div>
                <div class="col-auto">
                    <a href="/add-product"><button class="btn btn-success">Tambah Produk +</button></a>
                </div>
            </div>
        <?php else: ?>
            <h2 class="text-success mb-4"><i class="bi bi-box-seam"></i> Produk Lokal</h2>
        <?php endif; ?>
            <div class="row g-4">
                <?php while ($row = mysqli_fetch_assoc($products)) { ?>
                    <div class="col-md-4">
                        <div class="card border-0 shadow h-100">
                            <!-- Gambar Card -->
                            <img src="<?php echo $row['image']; ?>" 
                                class="card-img-top" 
                                alt="<?php echo $row["product_name"]; ?>" 
                                style="object-fit: cover; height: 200px;">

                            <!-- Isi Card -->
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title"><?php echo $row["product_name"]; ?></h5>
                                    <p class="text-success fw-semibold mb-2">
                                        Rp<?php echo number_format($row["price"], 0, ',', '.'); ?>
                                    </p>
                                    <p class="card-text text-truncate-multiline mb-3">
                                        <?php echo $row["description"]; ?>
                                    </p>
                                </div>

                                <!-- Tombol WhatsApp -->
                                <a href="https://wa.me/<?php echo $row["phone_number"] ?>?text=Halo,%20saya%20tertarik%20dengan%20produk%20<?php echo urlencode($row['product_name']); ?>"
                                    class="btn btn-outline-success mt-auto d-flex align-items-center justify-content-center gap-2"
                                    target="_blank">
                                    <i class="bi bi-whatsapp"></i> Chat Penjual
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="row mt-4">
                <div class="col text-center">
                    <a href="/all-products?page=1" class="btn btn-outline-success">
                        <i class="bi bi-arrow-down-circle"></i> Lihat Lebih Banyak
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri -->
    <section id="galeri" class="py-5">
        <div class="container">
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="row align-items-center mb-4">
                    <div class="col-auto">
                        <h2 class="text-success"><i class="bi bi-images"></i> Galeri</h2>
                    </div>
                    <div class="col-auto">
                        <a href="/add-image">
                            <button class="btn btn-success">Tambah Foto +</button>
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <h2 class="text-success mb-4"><i class="bi bi-images"></i> Galeri</h2>
            <?php endif; ?>
            <div class="row g-3">
                <?php while ($row = mysqli_fetch_assoc($galery)) { ?>
                    <div class="col-sm-4">
                        <div class="ratio ratio-4x3 rounded shadow-sm overflow-hidden">
                            <img 
                                src="<?php echo $row['image']; ?>" 
                                class="w-100 h-100 object-fit-cover" 
                                alt="<?php echo $row["image_name"] ?>">
                        </div>
                    </div>
                <?php } ?> 
            </div>
            <div class="row mt-4">
                <div class="col text-center">
                    <a href="/all-images?page=1" class="btn btn-outline-success">
                        <i class="bi bi-arrow-down-circle"></i> Lihat Lebih Banyak
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>