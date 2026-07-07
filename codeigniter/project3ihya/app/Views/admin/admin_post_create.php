<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Post - MyBlog</title>

    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.css">

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
            border-radius: 16px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .form-control {
            border-radius: 10px;
        }

        .btn {
            border-radius: 10px;
        }

        .btn-lg {
            font-weight: 600;
            border-radius: 12px;
        }

        .form-label {
            font-weight: 600;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark shadow">
    <div class="container d-flex justify-content-between">
        <span class="navbar-brand fw-bold">MyBlog Admin</span>
        <div>
            <a href="<?= base_url('admin/post') ?>" class="btn btn-light btn-sm">← Back</a>
        </div>
    </div>
</nav>

<!-- HERO -->
<div class="hero p-4 mb-4">
    <div class="container">
        <h2 class="fw-bold">Create New Post</h2>
        <p>Tulis dan publish artikel untuk blog kamu</p>
    </div>
</div>

<!-- CONTENT -->
<div class="container">

    <div class="card p-4">

        <form action="" method="post" id="text-editor">

            <!-- TITLE -->
            <div class="mb-4">
                <label class="form-label">Title</label>

                <input type="text"
                       name="title"
                       id="titleInput"
                       class="form-control form-control-lg"
                       placeholder="Masukkan judul artikel..."
                       required maxlength="100">

                <div class="d-flex justify-content-between mt-2">
                    <small class="text-muted">Judul akan ditampilkan di halaman publik</small>
                    <small id="charCount" class="text-muted">0 / 100</small>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="mb-4">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control" cols="30" rows="10"
                    placeholder="Detail Artikel"></textarea>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="card p-3 shadow-sm border-0 mb-2">
                <div class="row g-2">

                    <div class="col-md-6">
                        <button type="submit"
                                name="status"
                                value="published"
                                class="btn btn-success btn-lg w-100">
                            🚀 Publish Post
                        </button>
                    </div>

                    <div class="col-md-6">
                        <button type="submit"
                                name="status"
                                value="draft"
                                class="btn btn-outline-secondary btn-lg w-100">
                            💾 Save Draft
                        </button>
                    </div>

                </div>
            </div>

            <!-- INFO -->
            <div class="alert alert-info">
                💡 Tips: Publish untuk menampilkan artikel ke publik, Draft untuk simpan sementara.
            </div>

        </form>

    </div>

</div>

<!-- FOOTER -->
<footer class="text-center mt-5 mb-3">
    <small>&copy; <?= date('Y') ?> MyBlog</small>
</footer>

<script src="<?= base_url('js/jquery.min.js') ?>"></script>
<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>

<script>
$('#summernote').summernote({
    height: 300
});

// character counter
const titleInput = document.getElementById('titleInput');
const charCount = document.getElementById('charCount');

titleInput.addEventListener('input', function () {
    charCount.textContent = this.value.length + ' / 100';
});
</script>

</body>
</html>