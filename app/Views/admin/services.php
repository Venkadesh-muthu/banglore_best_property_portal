<main id="main" class="main">
    <div class="pagetitle">
        <h1>Services</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item active">Services</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">All Services</h5>

                <?php if (count($services) < 5): ?>
                    <div class="mb-3 text-end">
                        <a href="<?= base_url('admin/add-service') ?>" class="btn btn-primary">Add Service</a>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning">Maximum of 5 services allowed.</div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <table class="table table-bordered table-hover text-center">
                    <thead class="table-light ">
                        <tr>
                            <th>#</th>
                            <th>Icon</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($services)): ?>
                            <?php $i = 1;
                            foreach ($services as $s): ?>
                                <tr>
                                    <td><?= $i++ ?></td>

                                    <td>
                                        <?php if (!empty($s['icon'])): ?>
                                            <img src="<?= base_url('uploads/icons/' . $s['icon']) ?>" alt="Icon" width="40" height="40">
                                        <?php else: ?>
                                            <span class="text-muted">No Icon</span>
                                        <?php endif; ?>
                                    </td>

                                    <td><?= esc($s['title']) ?></td>

                                    <td><?= esc(strlen($s['short_description']) > 80 ? substr($s['short_description'], 0, 77) . '...' : $s['short_description']) ?></td>

                                    <td><?= date('d M Y, h:i A', strtotime($s['created_at'])) ?></td>

                                    <td>
                                        <?= $s['status'] ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-secondary">Inactive</span>' ?>
                                    </td>

                                    <td>
                                        <a href="<?= base_url('admin/edit-service/' . $s['id']) ?>" class="btn btn-sm btn-success">Edit</a>
                                        <button data-id="<?= $s['id'] ?>" class="btn btn-sm btn-danger delete-service-btn">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="7">No services found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>

<script>
    $(document).on('click', '.delete-service-btn', function () {
        const id = $(this).data('id');
        if (confirm("Are you sure you want to delete this service?")) {
            $.ajax({
                url: "<?= base_url('admin/delete-service/') ?>" + id,
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
