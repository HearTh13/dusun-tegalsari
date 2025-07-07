<nav class="navbar fixed-top shadow rounded-5 p-3 mt-3 mx-3 bg-white">
    <div class="container-fluid">
        <a class="navbar-brand ms-2" href="/">
            <img src="https://www.logodee.com/wp-content/uploads/2022/01/15-1.jpg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
            Dusun Tegalsari
        </a>

        <ul class="navbar-nav flex-row align-items-center me-auto">
            <li class="nav-item me-3">
                <a class="nav-link" href="/home">Beranda</a>
            </li>
            <li class="nav-item me-3">
                <a class="nav-link" href="/all-events">Acara</a>
            </li>
            <li class="nav-item me-3">
                <a class="nav-link" href="/all-products">Produk Lokal</a>
            </li>
            <li class="nav-item me-3">
                <a class="nav-link" href="/all-images">Galeri</a>
            </li>
            <li class="nav-item me-3">
                <a class="nav-link" href="/maps">Denah Dusun</a>
            </li>
            <li class="nav-item me-3">
                <a class="nav-link" href="/structure">Struktur Dusun</a>
            </li>
        </ul>

        <ul class="navbar-nav flex-row align-items-center">
            <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item me-2">
                    <span class="nav-link">Hello, <?php echo $_SESSION['username']; ?>!</span>
                </li>
                <li class="nav-item">
                    <a class="btn btn-danger btn-sm" href="/logout">Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="btn btn-success btn-sm" href="/login">Login</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>