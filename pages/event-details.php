<?php
    include __DIR__ . '/../db.php';
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();

    if (!$event) {
        echo "<div class='container py-5 text-center'><h3 class='text-danger'>404 Not Found</h3></div>";
        exit;
    }

    $datetime = new DateTime($event["created_date_time"]);

    // Daftar nama hari dan bulan dalam bahasa Indonesia
    $days = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    ];
    $months = [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    ];

    // Ambil bagian-bagian tanggal
    $day = $days[$datetime->format('l')];
    $date = $datetime->format('d');
    $month = $months[$datetime->format('m')];
    $year = $datetime->format('Y');

    // Format waktu
    $time = $datetime->format('H.i');
    
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
            <h2 class="text-success fw-bold"><i class="bi bi-calendar-event"></i> Detail Acara</h2>
        </div>

        <div class="row g-4">
            <!-- Kolom Gambar -->
            <div class="col-md-6">
            <img src="<?php echo $event["image"] ?>" alt="Nama Acara" class="img-fluid rounded shadow-sm w-100">
            </div>

            <!-- Kolom Konten -->
            <div class="col-md-6">
            <h3 class="fw-bold">Judul Acara: <?php echo $event["event_name"] ?></h3>
            <p class="mb-1"><i class="bi bi-calendar-date"></i> <strong>Tanggal:</strong> <?php echo "$day, $date $month $year" ?></p>
            <p class="mb-1"><i class="bi bi-clock"></i> <strong>Waktu:</strong> <?php echo $time ?></p>

            <p class="text-muted"> <?php echo $event["description"] ?></p>

            <a href="/all-events" class="btn btn-outline-success mt-3">
                <i class="bi bi-arrow-left-circle"></i> Kembali ke Daftar Acara
            </a>
            </div>
        </div>
        </div>
    </section>

    <?php include __DIR__ . '/../components/footer.php'; ?>

</body>
</html>