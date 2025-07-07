<?php
    include __DIR__ . '/../db.php';
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();

    if (!$event) {
        echo "<div class='container py-5 text-center'><h3 class='text-danger'>404 Not Found</h3></div>";
        exit;
    }
    
?>
<head>
  <style>
    body {
        padding-top: 70px;
        background-color: #ffffff;
    }
  </style>
</head>
<body class="bg-white">

<?php include __DIR__ . '/../components/navbar.php' ?>

  <!-- Event Detail Section -->
  <section class="py-5">
        <div class="container">
            <a href="/home">
                <button class="btn mb-4 text-light bg-success" type="submit">← Kembali</button>
            </a>

            <!-- Judul Section -->
            <div class="mb-4 ps-3 border-start border-5 border-success">
                <h2 class="text-success fw-bold"><i class="bi bi-calendar-event"></i> Detail Produk</h2>
            </div>

            <div class="row g-4">
                <!-- Kolom Gambar -->
                <div class="col-md-6">
                    <img src="<?php echo $event["image"] ?>" alt="Nama Produk" class="img-fluid rounded shadow-sm w-100">
                </div>

                <!-- Kolom Konten -->
                <div class="col-md-6">
                    <h3 class="fw-bold">Nama Produk: <?php echo $event["product_name"] ?></h3>
                    <p class="text-success fw-semibold mb-2">Harga: Rp<?php echo number_format($event["price"], 0, ',', '.'); ?></p>
                    <p class="text-muted"><?php echo nl2br(htmlspecialchars($event["description"])); ?></p>

                    <!-- Tombol WhatsApp -->
                    <a href="https://wa.me/<?php echo $event["phone_number"]; ?>?text=Halo,%20saya%20tertarik%20dengan%20produk%20<?php echo urlencode($event["product_name"]); ?>"
                    target="_blank"
                    class="btn bg-success d-inline-flex align-items-center gap-2 text-light">
                        <i class="bi bi-whatsapp"></i> Chat Penjual
                    </a>

                    <br>

                    <a href="/all-products" class="btn btn-outline-secondary mt-3">
                        <i class="bi bi-arrow-left-circle"></i> Kembali ke Daftar Produk
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php include __DIR__ . '/../components/footer.php'; ?>

</body>
</html>