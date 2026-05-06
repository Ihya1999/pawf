<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Straw Hat Blog</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #0b0f19;
    color: #fff;
    font-family: 'Segoe UI', sans-serif;
}

/* NAVBAR */
.navbar {
    background: linear-gradient(90deg, #ff2d55, #ff9500);
}

/* HERO */
.hero {
    background: url('https://images3.alphacoders.com/134/thumb-1920-1342304.jpeg') center/cover;
    height: 60vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.hero::after {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.6);
}

.hero-content {
    position: relative;
    text-align: center;
}

/* CARD */
.blog-card {
    background: #111827;
    border: none;
    border-radius: 15px;
    overflow: hidden;
    transition: 0.3s;
}

.blog-card:hover {
    transform: translateY(-5px);
}

.blog-card img {
    height: 180px;
    object-fit: cover;
}

/* BUTTON */
.btn-anime {
    background: linear-gradient(90deg, #ff2d55, #ff9500);
    border: none;
    color: white;
}

.btn-anime:hover {
    opacity: 0.9;
}
</style>

</head>

<body>
<?= $this->include('layouts/navbar'); ?>

<!-- HERO -->
<section class="hero">
    <div class="hero-content">
        <h1 class="display-4 fw-bold">One Piece & Anime Blog</h1>
        <p class="lead">Cerita Dunia Bajak Laut Terbaik</p>
        <a href="#posts" class="btn btn-anime btn-lg">Mulai Baca</a>
    </div>
</section>

<!-- POSTS -->
<div class="container py-5" id="posts">

    <h2 class="mb-4">🔥 Latest Posts</h2>

    <div class="row g-4">

        <!-- CARD 1 -->
        <div class="col-md-4">
            <div class="card blog-card">
                <img src="https://images4.alphacoders.com/134/thumb-1920-1348641.jpeg" class="w-100">
                <div class="card-body">
                    <h5>One Piece Latest Arc</h5>
                    <p class="text-secondary">Review cerita terbaru Luffy & kru.</p>
                    <a href="#" class="btn btn-anime btn-sm">Read More</a>
                </div>
            </div>
        </div>

        <!-- CARD 2 -->
        <div class="col-md-4">
            <div class="card blog-card">
                <img src="https://images.alphacoders.com/135/thumb-1920-1350257.jpeg" class="w-100">
                <div class="card-body">
                    <h5>Top Anime 2026</h5>
                    <p class="text-secondary">Anime paling hype tahun ini.</p>
                    <a href="#" class="btn btn-anime btn-sm">Read More</a>
                </div>
            </div>
        </div>

        <!-- CARD 3 -->
        <div class="col-md-4">
            <div class="card blog-card">
                <img src="https://images8.alphacoders.com/137/thumb-1920-1370478.jpeg" class="w-100">
                <div class="card-body">
                    <h5>Straw Hat Pirates</h5>
                    <p class="text-secondary">Profil lengkap kru Luffy.</p>
                    <a href="#" class="btn btn-anime btn-sm">Read More</a>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- FOOTER -->
<footer class="text-center py-4 text-secondary">
    © <?= date('Y') ?> AnimeBlog
</footer>

</body>
</html>