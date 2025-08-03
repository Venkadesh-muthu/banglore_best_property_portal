<main id="main" class="main">
    <div class="pagetitle">
        <h1>Features</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item active">Features</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Feature List</h5>

                <div class="mb-3 text-end">
                    <?php if ($can_add_feature): ?>
                        <a href="<?= base_url('admin/add-feature') ?>" class="btn btn-primary">Add Feature</a>
                    <?php else: ?>
                        <button class="btn btn-secondary" disabled>Maximum 3 Features Reached</button>
                    <?php endif; ?>
                </div>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Icon</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($features)): ?>
                            <?php foreach ($features as $i => $feature): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>

                                    <td>
                                        <?php if (!empty($feature['icon'])): ?>
                                            <img src="<?= base_url('uploads/about/' . $feature['icon']) ?>" alt="Icon" width="40" height="40" style="object-fit: cover; border-radius: 5px;">
                                        <?php else: ?>
                                            <span class="text-muted">No Icon</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php if (!empty($feature['image'])): ?>
                                            <img src="<?= base_url('uploads/about/' . $feature['image']) ?>" alt="Image" width="60" height="60" style="object-fit: cover; border-radius: 5px;">
                                        <?php else: ?>
                                            <span class="text-muted">No Image</span>
                                        <?php endif; ?>
                                    </td>

                                    <td><?= esc($feature['title']) ?></td>
                                    <td><?= esc(word_limiter($feature['description'], 20)) ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/edit-feature/' . $feature['id']) ?>" class="btn btn-sm btn-success">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                    </td>
                                    <td>
                                        <button data-id="<?= $feature['id'] ?>" class="btn btn-sm btn-danger delete-feature-btn">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No features found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>

<script>
    $(document).on('click', '.delete-feature-btn', function () {
        const id = $(this).data('id');
        if (confirm("Delete this feature?")) {
            $.ajax({
                url: "<?= base_url('admin/delete-feature/') ?>" + id,
                type: "POST",
                data: {
                    _method: 'DELETE',
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                },
                success: function () {
                    location.reload();
                },
                error: function () {
                    alert("Delete failed.");
                }
            });
        }
    });
</script>
