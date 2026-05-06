<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Post</h5>
            <a href="<?= base_url('admin/post/new') ?>" class="btn btn-primary btn-sm">
                + New Post
            </a>
        </div>

        <div class="card-body">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th width="220">Action</th>
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
                                <span class="badge bg-success">Published</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Draft</span>
                            <?php endif ?>
                        </td>

                        <td>
                            <a href="<?= base_url('admin/post/'.$post['id'].'/preview') ?>"
                               class="btn btn-sm btn-outline-primary" target="_blank">Preview</a>

                            <a href="<?= base_url('admin/post/'.$post['id'].'/edit') ?>"
                               class="btn btn-sm btn-outline-warning">Edit</a>

                            <a href="#"
                               data-href="<?= base_url('admin/post/'.$post['id'].'/delete') ?>"
                               onclick="confirmToDelete(this)"
                               class="btn btn-sm btn-outline-danger">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

</div>