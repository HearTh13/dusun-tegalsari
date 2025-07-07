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
            /* padding-top: 100px; */
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
<div class="modal fade" id="modalGambar" tabindex="-1" aria-labelledby="modalGambarLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0">
        <img src="../static_images/Denah Dusun Tegalsari.jpg" class="img-fluid w-100 rounded" alt="Balai Dusun Tegalsari">
        <p class="text-white bg-dark p-2 m-0">Denah Dusun Tegalsari</p>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalGaleri" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0">
        <img id="modalImage" src="" class="img-fluid w-100 rounded" alt="">
        <p id="modalCaption" class="text-white bg-dark p-2 m-0"></p>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="strukturModal" tabindex="-1" aria-labelledby="strukturModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body text-center p-0">
        <img src="../static_images/Struktur Dusun Tegalsari.jpg"
             alt="Struktur Kepengurusan"
             class="img-fluid rounded shadow">
      </div>
    </div>
  </div>
</div>
<body>
    
    <?php include __DIR__ . '/../components/navbar.php' ?>

    <section class="bg-light text-center text-white fade-slide-up"
            style="background: url('../static_images/Tegalsari View.jpg') no-repeat center center/cover;">
        <div class="container" style="padding-top: 10rem; padding-bottom: 3rem; background-color: rgba(0,0,0,0.5); border-radius: 12px;">
            <h1 class="display-5 fw-bold">Selamat Datang di Dusun Tegalsari</h1>
            <p class="lead">Kelurahan Jatiayu, Kecamatan Karangmojo, Kabupaten Gunung Kidul, Provinsi DIY</p>
        </div>
    </section>

    <!-- Profil -->
    <section id="profil" class="py-5 bg-success fade-slide-up">
        <div class="container">
            <h2 class="text-light mb-4"><i class="bi bi-info-circle-fill"></i> Profil Dusun</h2>
            <p class="text-light">Dusun Tegalsari dihuni oleh sekitar 164 Kartu Keluarga yang hidup dalam lingkungan yang harmonis dan penuh kebersamaan. Mayoritas penduduknya bekerja sebagai petani dan penjual, mencerminkan karakter masyarakat yang gigih dan mandiri dalam memenuhi kebutuhan sehari-hari. Dengan suasana alam yang sejuk dan asri, Dusun Tegalsari menawarkan ketenangan yang jarang ditemukan di perkotaan. Kerukunan antarwarga serta semangat gotong royong yang tinggi menjadi ciri khas utama kehidupan sosial di dusun ini, menjadikannya tempat tinggal yang tidak hanya nyaman, tetapi juga kaya akan nilai-nilai kebersamaan dan kearifan lokal.</p>
        </div>
    </section>

    <!-- Acara -->
    <section id="potensi" class="py-5 bg-light fade-slide-up">
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
                    <div class="col-md-4">
                        <a href="event-details?id=<?php echo $row['id']; ?>" class="text-decoration-none text-dark">
                            <div class="card border-0 shadow h-100 img-hover-zoom" style="max-height: 500px; min-height: 400px; overflow: hidden;">
                                <!-- Gambar Card -->
                                <img src="<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row["event_name"] ?>" style="object-fit: cover; height: 200px;">

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title"><?php echo $row["event_name"] ?></h5>
                                    <p class="card-text text-truncate-multiline">
                                    <?php echo $row["description"] ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
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
    <section id="potensi" class="py-5 bg-success text-light fade-slide-up">
        <div class="container">
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="row align-items-center mb-4">
                    <div class="col-auto">
                        <h2 class="text-light"><i class="bi bi-box-seam"></i> Produk Lokal</h2>
                    </div>
                    <div class="col-auto">
                        <a href="/add-product"><button class="btn btn-light">Tambah Produk +</button></a>
                    </div>
                </div>
            <?php else: ?>
                <h2 class="text-light mb-4"><i class="bi bi-box-seam"></i> Produk Lokal</h2>
            <?php endif; ?>

            <div class="row g-4">
                <?php while ($row = mysqli_fetch_assoc($products)) { ?>
                    <div class="col-md-4">
                        <a href="product-details?id=<?php echo $row['id']; ?>" class="text-decoration-none text-dark">
                            <div class="card border-0 shadow h-100 img-hover-zoom">
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
                        </a>
                    </div>
                <?php } ?>
            </div>

            <div class="row mt-4">
                <div class="col text-center">
                    <a href="/all-products?page=1" class="btn btn-outline-light">
                        <i class="bi bi-arrow-down-circle"></i> Lihat Lebih Banyak
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri -->
    <section id="galeri" class="py-5 fade-slide-up">
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
                        <div class="ratio ratio-4x3 rounded shadow-sm overflow-hidden img-hover-zoom">
                            <a href="#" 
                                data-bs-toggle="modal" 
                                data-bs-target="#modalGaleri" 
                                onclick="passvar('<?php echo $row['image']; ?>', '<?php echo $row['image_name']; ?>')">
                                <img src="<?php echo $row['image']; ?>" class="w-100 h-100 object-fit-cover" alt="<?php echo $row['image_name']; ?>">
                            </a>
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
        <script>
            function passvar(imageUrl, imageAlt) {
                document.getElementById('modalImage').src = imageUrl;
                document.getElementById('modalImage').alt = imageAlt;
                document.getElementById('modalCaption').textContent = imageAlt;
            }
        </script>
    </section>

    <!-- section maps -->
    <section id="lokasi" class="py-5 bg-success text-light fade-slide-up">
        <div class="container">
            <h2 class="mb-4"><i class="bi bi-geo-alt-fill"></i> Lokasi Balai Dusun Tegalsari</h2>
            <div class="row g-4">
                <!-- Kolom Peta -->
                <div class="col-md-6">
                    <div id="map" style="height: 500px;"></div>
                </div>

                <!-- Kolom Gambar -->
                <div class="col-md-6">
                    <div class="h-100 rounded overflow-hidden shadow-sm border img-hover-zoom bg-white">
                        <!-- Gambar bisa diklik untuk membuka modal -->
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalGambar">
                            <img src="../static_images/Denah Dusun Tegalsari.jpg"
                                class="w-100 h-100 object-fit-cover"
                                alt="Balai Dusun Tegalsari">
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col text-center">
                    <a href="/maps" class="btn btn-outline-light">
                        <i class="bi bi-arrow-down-circle"></i> Lihat Lebih Jelas
                    </a>
                </div>
            </div>
        </div>

        <!-- Modal Gambar -->
        <div class="modal fade" id="modalGambar" tabindex="-1" aria-labelledby="modalGambarLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content bg-transparent border-0">
                    <div class="modal-body text-center p-0">
                        <img src="../static_images/Denah Dusun Tegalsari.jpg" class="img-fluid rounded shadow" alt="Denah Dusun Tegalsari">
                    </div>
                </div>
            </div>
        </div>

        <!-- Leaflet & Routing Scripts -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

        <script>
            var tujuan = L.latLng(-7.8882644, 110.6854162);
            var map = L.map('map').setView(tujuan, 17);
            map.panBy([300, 0]);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            var pinIcon = L.icon({
                iconUrl: 'https://cdn-icons-png.flaticon.com/512/684/684908.png',
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            });

            L.marker(tujuan, { icon: pinIcon }).addTo(map).bindPopup("Balai Dusun Tegalsari");
        </script>
    </section>

    <!-- Struktur Kepengurusan -->
    <section id="struktur" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-success mb-4"><i class="bi bi-diagram-3"></i> Struktur Kepengurusan Dusun Tegalsari</h2>
            <p class="mb-3">Berikut adalah susunan struktur organisasi kepengurusan Dusun Tegalsari:</p>
            
            <!-- Gambar Struktur Organisasi -->
            <div class="text-center">
                <img src="../static_images/Struktur Dusun Tegalsari.jpg"
                    alt="Struktur Kepengurusan Dusun Tegalsari"
                    class="img-fluid rounded shadow"
                    style="cursor: zoom-in;"
                    data-bs-toggle="modal" data-bs-target="#strukturModal">
            </div>
        </div>

        <div class="row mt-4">
            <div class="col text-center">
                <a href="/structure" class="btn btn-outline-success">
                    <i class="bi bi-arrow-down-circle"></i> Lihat Lebih Jelas
                </a>
            </div>
        </div>
    </section>

    <?php include __DIR__ . '/../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>