<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - MyBlog</title>

    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">

    <style>
        body {
            background: #f4f6f9;
        }

        .navbar {
            background: linear-gradient(90deg, #0d6efd, #6610f2);
        }

        .hero {
            background: linear-gradient(120deg, #0d6efd, #6610f2);
            color: white;
            border-radius: 0 0 20px 20px;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: 0.2s;
        }

        .card:hover {
            transform: translateY(-3px);
        }

        .table th {
            background: #f1f3f5;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .btn {
            border-radius: 8px;
        }

        .badge-publish {
            background: #198754;
            color: white;
            padding: 5px 10px;
            border-radius: 10px;
        }

        .badge-draft {
            background: #6c757d;
            color: white;
            padding: 5px 10px;
            border-radius: 10px;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark shadow">
    <div class="container d-flex justify-content-between">
        <span class="navbar-brand fw-bold">MyBlog Admin</span>

        <div class="d-flex gap-2">
            <a href="<?= base_url('admin/post/new') ?>" class="btn btn-light btn-sm">
                + New Post
            </a>

            <!-- FIXED LOGOUT -->
            <a href="<?= base_url('/logout') ?>" class="btn btn-danger btn-sm">
                Logout
            </a>
        </div>
    </div>
</nav>

<!-- HERO -->
<div class="hero p-5 mb-4">
    <div class="container">
        <h1 class="fw-bold">Dashboard</h1>
        <p>Kelola semua postingan blog kamu dengan mudah</p>
    </div>
</div>

<!-- CONTENT -->
<div class="container">

    <!-- STATS -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card p-3 text-center">
                <h6>Total Post</h6>
                <h3><?= count($posts) ?></h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 text-center">
                <h6>Published</h6>
                <h3><?= count(array_filter($posts, fn($p) => $p['status'] === 'published')) ?></h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 text-center">
                <h6>Draft</h6>
                <h3><?= count(array_filter($posts, fn($p) => $p['status'] !== 'published')) ?></h3>
            </div>
        </div>
    </div>

    <!-- SEARCH -->
    <div class="card p-3 mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Cari judul post...">
    </div>

    <!-- TABLE -->
    <div class="card p-4">
        <h5 class="mb-3">Daftar Post</h5>

        <table class="table align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Post</th>
                    <th>Status</th>
                    <th width="200">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($posts as $post): ?>
                <tr>
                    <td><?= $post['id'] ?></td>

                    <td>
                        <strong><?= $post['title'] ?></strong><br>
                        <small class="text-muted"><?= $post['created_at'] ?></small>
                    </td>

                    <td>
                        <?php if($post['status'] === 'published'): ?>
                            <span class="badge-publish">Published</span>
                        <?php else: ?>
                            <span class="badge-draft">Draft</span>
                        <?php endif ?>
                    </td>

                    <td>
                        <a href="<?= base_url('admin/post/'.$post['id'].'/preview') ?>" class="btn btn-sm btn-primary">👁</a>
                        <a href="<?= base_url('admin/post/'.$post['id'].'/edit') ?>" class="btn btn-sm btn-warning text-white">✏️</a>
                        <a href="<?= base_url('admin/post/'.$post['id'].'/delete') ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Yakin mau hapus?')">
                           🗑
                        </a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

</div>

<!-- FOOTER -->
<footer class="text-center mt-5 mb-3">
    <small>&copy; <?= date('Y') ?> MyBlog</small>
</footer>

<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>

<script>
// SEARCH
document.getElementById("searchInput").addEventListener("keyup", function() {
    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll("tbody tr");

    rows.forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(value) ? "" : "none";
    });
});
</script>

</body>
</html>