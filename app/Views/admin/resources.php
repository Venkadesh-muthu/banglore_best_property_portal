<?php
// resources.php - List View
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Resources</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item active">Resources</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">All Resources</h5>

                <?php if (count($resources) < 5): ?>
                    <div class="mb-3 text-end">
                        <a href="<?= base_url('admin/add-resource') ?>" class="btn btn-primary">Add Resource</a>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning">Maximum of 5 resources allowed.</div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <table class="table table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($resources)): ?>
                            <?php $i = 1;
                            foreach ($resources as $r): ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><img src="<?= base_url('uploads/resources/' . $r['image']) ?>" width="40"></td>
                                    <td><?= esc($r['title']) ?></td>
                                    <td><?= esc($r['category']) ?></td>
                                    <td><?= $r['status'] == 'active' ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-secondary">Inactive</span>' ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/edit-resource/' . $r['id']) ?>" class="btn btn-sm btn-info">Edit</a>
                                        <button data-id="<?= $r['id'] ?>" class="btn btn-sm btn-danger delete-resource-btn">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="6">No resources found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>

<script>
    $(document).on('click', '.delete-resource-btn', function () {
        const id = $(this).data('id');
        if (confirm("Are you sure you want to delete this resource?")) {
            $.ajax({
                url: "<?= base_url('admin/delete-resource/') ?>" + id,
                type: "POST",
                data: {
                    _method: 'DELETE',
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                },
                success: function () {
                    location.reload();
                },
                error: function () {
                    alert("Failed to delete. Please try again.");
                }
            });
        }
    });
</script>
