<!DOCTYPE html>
<html lang="id">
<head>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .image-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .img-fluid {
            max-width: 100%;
            height: auto;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            border-radius: 12px;
        }
        .back-button {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
            background-color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: bold;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
            cursor: pointer;
        }
        .back-button:hover {
            background-color: #e9e9e9;
        }
    </style>
</head>
<body>
    <div class="container image-container">
        <a href="/home">
            <button class="back-button mb-3">← Kembali</button>
        </a>
        <img src="../static_images/Struktur Dusun Tegalsari.jpg" alt="Struktur Kepengurusan Dusun Tegalsari" class="img-fluid">
    </div>

    <?php include __DIR__ . '/../components/footer.php'; ?>
</body>
</html>