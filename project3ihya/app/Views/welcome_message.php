<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MyBlog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= base_url() ?>">MyBlog</a>

        <div>
            <a href="<?= base_url('post') ?>" class="btn btn-outline-light btn-sm">Blog</a>
            <a href="<?= base_url('admin/post') ?>" class="btn btn-primary btn-sm">Admin</a>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="bg-light text-center py-5">
    <div class="container">
        <h1 class="display-4 fw-bold">Selamat Datang di MyBlog</h1>
        <p class="lead text-muted">
            Tempat berbagi cerita, ilmu, dan pengalaman
        </p>

        <a href="<?= base_url('post') ?>" class="btn btn-primary btn-lg mt-3">
            Lihat Blog
        </a>
    </div>
</section>

<!-- CONTENT -->
<div class="container mt-5">

    <div class="row text-center">
        <div class="col-md-4">
            <h4>✍️ Menulis</h4>
            <p class="text-muted">Buat dan kelola artikel dengan mudah</p>
        </div>

        <div class="col-md-4">
            <h4>📚 Berbagi</h4>
            <p class="text-muted">Bagikan pengetahuan ke banyak orang</p>
        </div>

        <div class="col-md-4">
            <h4>🚀 Berkembang</h4>
            <p class="text-muted">Bangun personal branding kamu</p>
        </div>
    </div>

</div>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-3 mt-5">
    <small>&copy; <?= date('Y') ?> MyBlog</small>
</footer>

<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>