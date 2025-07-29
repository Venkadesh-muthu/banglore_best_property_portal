<main id="main" class="main">

    <div class="pagetitle">
        <h1>Developers</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item active">Developers</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">All Developers</h5>
                        <div class="mb-3 text-end">
                            <a href="<?= base_url('admin/add-developer') ?>" class="btn btn-primary">Add Developer</a>
                        </div>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <table class="table table-striped text-center">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Established</th>
                                    <th>Completed Projects</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $serial = 1 + ($perPage * ($currentPage - 1)); ?>
                                <?php if (!empty($developers)): ?>
                                    <?php foreach ($developers as $dev): ?>
                                        <tr>
                                            <td><?= $serial++ ?></td>
                                            <td><?= esc($dev['name']) ?></td>
                                            <td><?= esc($dev['established_year']) ?></td>
                                            <td><?= esc($dev['completed_projects']) ?></td>
                                            <td>
                                                <?php if (!empty($dev['image'])): ?>
                                                    <button class="btn btn-sm btn-info view-logo-btn"
                                                        data-img="<?= base_url('uploads/developers/' . $dev['image']) ?>"
                                                        data-bs-toggle="modal" data-bs-target="#logoModal">View</button>
                                                <?php else: ?>
                                                    <span class="text-muted">No Image</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('admin/developer/edit/' . $dev['id']) ?>"
                                                    class="btn btn-sm btn-success">Edit</a>
                                                <button class="btn btn-sm btn-danger delete-dev-btn"
                                                    data-id="<?= $dev['id'] ?>">
                                                    Delete
                                                </button>


                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No developers found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="datatable-info">
                                Showing <?= $pager->getCurrentPage('group1') ?> to
                                <?= $pager->getCurrentPage('group1') + count($developers) - 1 ?> of
                                <?= $pager->getTotal('group1') ?> entries
                            </div>
                            <?= $pager->links('group1', 'custom_pagination') ?>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Developer Logo Modal -->
    <div class="modal fade" id="logoModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Developer Logo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="logoModalImage" src="#" alt="Developer Logo" class="img-fluid rounded border">
                </div>
            </div>
        </div>
    </div>

</main>

<!-- Developer JS -->
<script>
    // Delete developer
    $(document).on('click', '.delete-dev-btn', function () {
        let id = $(this).data('id');
        if (confirm("Are you sure you want to delete this developer?")) {
            $.ajax({
                url: "<?= base_url('admin/delete-developer/') ?>" + id,
                type: "DELETE",
                success: function (res) {
                    alert('Developer deleted successfully!');
                    location.reload();
                },
                error: function (xhr) {
                    console.error('Error deleting developer:', xhr.responseText);
                    alert('Failed to delete developer.');
                }
            });
        }
    });

    // View logo in modal
    $(document).on('click', '.view-logo-btn', function () {
        let imageUrl = $(this).data('img');
        $('#logoModalImage').attr('src', imageUrl);
    });
</script>
<script>
    $(document).on('click', '.delete-dev-btn', function (e) {
        e.preventDefault();
        const id = $(this).data('id');
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Show browser confirm box
        if (confirm('Are you sure you want to delete this developer?')) {
            $.ajax({
                url: '<?= base_url('admin/developer/delete') ?>/' + id,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (res) {
                    // alert(res.success || 'Developer deleted successfully!');
                    location.reload();
                }
            });
        }
    });
</script>