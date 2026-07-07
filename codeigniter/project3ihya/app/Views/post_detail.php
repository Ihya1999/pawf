<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Blog Detail - MyBlog</title>

	<link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>" />

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

		.badge {
			border-radius: 10px;
			padding: 6px 10px;
		}

		.btn {
			border-radius: 8px;
		}

		.content {
			line-height: 1.8;
			font-size: 16px;
		}
	</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark shadow">
	<div class="container d-flex justify-content-between">
		<span class="navbar-brand fw-bold">MyBlog</span>

		<div class="d-flex gap-2">
			<a href="<?= base_url('/admin/post') ?>" class="btn btn-light btn-sm">Home</a>
			<a href="<?= base_url('/admin/post') ?>" class="btn btn-light btn-sm">Posts</a>
		</div>
	</div>
</nav>

<!-- HERO -->
<div class="hero p-5 mb-4">
	<div class="container">
		<h1 class="fw-bold"><?= $post['title'] ?></h1>
		<p>
			<?= $post['author'] ?> |
			<?= date('d M Y', strtotime($post['created_at'])) ?>
		</p>
	</div>
</div>

<!-- CONTENT -->
<div class="container mb-5">

	<div class="card p-4">

		<div class="content">
			<?= $post['content'] ?>
		</div>

	</div>

</div>

<!-- FOOTER -->
<footer class="text-center mt-5 mb-3">
	<small>&copy; <?= date('Y') ?> MyBlog</small>
</footer>

<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>

</body>

</html>