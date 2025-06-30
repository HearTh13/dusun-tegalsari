<?php
include __DIR__ . '/../db.php';
include __DIR__ . '/../components/navbar.php';

// Konfigurasi pagination
$eventsPerPage = 6;
$page = isset($_GET['page']) ? max((int)$_GET['page'], 1) : 1;
$offset = ($page - 1) * $eventsPerPage;

// Ambil total data
$totalQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM products");
$totalRow = mysqli_fetch_assoc($totalQuery);
$totalProducts = $totalRow['total'];
$totalPages = ceil($totalProducts / $eventsPerPage);

// Ambil data event berdasarkan offset
$query = "SELECT * FROM products ORDER BY created_date_time DESC LIMIT $offset, $eventsPerPage";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <style>
        body {
            padding-top: 120px;
        }
        .text-truncate-multiline {
            display: -webkit-box;
            -webkit-line-clamp: 6; 
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>
<body>
    <div class="container mb-5">
        <div class="row align-items-center mb-4">
            <div class="col">
                <h2 class="text-success mb-0"><i class="bi bi-box-seam"></i> Semua Produk</h2>
            </div>
            <div class="col-auto">
                <p class="mb-0">Total Produk: <?php echo $totalProducts ?></p>
            </div>
        </div>
        <div class="row g-4">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
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
        
        <nav aria-label="Pagination" class="mt-4 d-flex justify-content-center">
            <ul class="pagination">
                <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                    <a class="page-link text-dark" href="?page=<?php echo $page - 1; ?>">Sebelumnya</a>
                </li>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link <?php echo $i == $page ? 'bg-success border-success text-white' : 'text-dark'; ?>" 
                        href="?page=<?php echo $i; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?php if ($page >= $totalPages) echo 'disabled'; ?>">
                    <a class="page-link text-dark" href="?page=<?php echo $page + 1; ?>">Berikutnya</a>
                </li>
            </ul>
        </nav>
    </div>

    <?php include __DIR__ . '/../components/footer.php'; ?>
</body>
</html>