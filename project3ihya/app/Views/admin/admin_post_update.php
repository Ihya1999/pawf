kalo ini file admin_post_updatenya
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post - MyBlog</title>

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
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .btn {
            border-radius: 8px;
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
            <a href="<?= base_url('logout') ?>" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
</nav>

<!-- HERO -->
<div class="hero p-4 mb-4">
    <div class="container">
        <h2 class="fw-bold">Edit Post</h2>
        <p>Update artikel yang sudah dibuat</p>
    </div>
</div>

<!-- CONTENT -->
<div class="container">

    <div class="card p-4">

        <form action="" method="post">

            <input type="hidden" name="id" value="<?= esc($post['id'] ?? '') ?>">

            <!-- TITLE -->
            <div class="mb-3">
                <label class="form-label fw-bold">Title</label>
                <input type="text"
                       name="title"
                       class="form-control"
                       value="<?= esc($post['title'] ?? '') ?>"
                       required>
            </div>

            <!-- CONTENT (SUMMERNOTE) -->
            <div class="mb-3">
                <label class="form-label fw-bold">Content</label>
              <textarea name="content" class="form-control" cols="30" rows="10"
                        placeholder="Detail Artikel"></textarea>
            </div>

            <!-- BUTTON -->
            <div class="d-flex gap-2">
                <button type="submit" name="status" value="published"
                        class="btn btn-primary">
                    🚀 Publish
                </button>

                <button type="submit" name="status" value="draft"
                        class="btn btn-secondary">
                    💾 Save Draft
                </button>
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