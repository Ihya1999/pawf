<?php if (!isset($post)): ?>
    <h3>Data tidak ditemukan</h3>
    <?php exit; ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBlog</title>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url() ?>">MyBlog</a>
        <div class="collapse navbar-collapse justify-content-between">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('admin/post') ?>">Blog</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container py-5">
        <h1 class="display-5 fw-bold">Edit Post</h1>
    </div>
</div>

<div class="container">
    <form action="" method="post">
        
        <input type="hidden" name="id" value="<?= $post['id'] ?? '' ?>" />

        <div class="form-group mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control"
                value="<?= $post['title'] ?? '' ?>" required>
        </div>

        <div class="form-group mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control" rows="10"><?= $post['content'] ?? '' ?></textarea>
        </div>

        <div class="form-group mb-3">
            <button type="submit" name="status" value="published"
                class="btn btn-primary">Publish</button>

            <button type="submit" name="status" value="draft"
                class="btn btn-secondary">Save Draft</button>
        </div>

    </form>
</div>

<div class="container py-4">
    <footer class="pt-3 mt-4 text-muted border-top">
        &copy; <?= date('Y') ?>
    </footer>
</div>

<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>

</body>
</html>