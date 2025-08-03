<main id="main" class="main">
    <div class="pagetitle">
        <h1>Statistics</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item active">Statistics</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Statistics</h5>

                <div class="mb-3 text-end">
                    <a href="<?= base_url('admin/add-statistic') ?>" class="btn btn-primary">Add Statistic</a>
                </div>

                <?= session()->getFlashdata('success') ? '<div class="alert alert-success">' . session()->getFlashdata('success') . '</div>' : '' ?>
                <?= session()->getFlashdata('error') ? '<div class="alert alert-danger">' . session()->getFlashdata('error') . '</div>' : '' ?>

                <table class="table table-bordered table-hover text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Caption</th>
                            <th>Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($statistics)): ?>
                            <?php foreach ($statistics as $i => $stat): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td>
                                        <?php if (!empty($stat['images'])): ?>
                                            <img src="<?= base_url('uploads/statistics/' . $stat['images']) ?>" alt="Image" style="height: 40px;">
                                        <?php else: ?>
                                            <span class="text-muted">No Image</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($stat['caption']) ?></td>
                                    <td><?= esc($stat['number']) ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/edit-statistic/' . $stat['id']) ?>" class="btn btn-sm btn-success">Edit</a>
                                        <button data-id="<?= $stat['id'] ?>" class="btn btn-sm btn-danger delete-statistics-btn">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5">No statistics found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>
<script>
    $(document).on('click', '.delete-statistics-btn', function () {
        const id = $(this).data('id');
        if (confirm("Delete this statistic?")) {
            $.ajax({
                url: "<?= base_url('admin/delete-statistic/') ?>" + id,
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
