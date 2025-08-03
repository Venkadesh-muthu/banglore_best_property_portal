<main id="main" class="main">
    <div class="pagetitle">
        <h1>About Us</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item active">About Us</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title">About Section</h5>

                <?php if (empty($about)): ?>
                    <div class="mb-3 text-end">
                        <a href="<?= base_url('admin/add-about') ?>" class="btn btn-primary">Add About</a>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">About section already added. You can edit or delete it below.</div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <table class="table table-bordered table-hover text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Heading</th>
                            <th>Paragraph (Left)</th>
                            <th>Paragraph (Right)</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($about)): ?>
                            <tr>
                                <td>1</td>
                                <td><?= esc($about['heading']) ?></td>
                                <td><?= esc($about['paragraphs_left']) ?></td>
                                <td><?= esc($about['paragraphs_right']) ?></td>
                                <td>
                                    <a href="<?= base_url('admin/edit-about/' . $about['id']) ?>" class="btn btn-sm btn-success">Edit</a>
                                </td>
                                <td><button data-id="<?= $about['id'] ?>" class="btn btn-sm btn-danger delete-about-btn">Delete</button></td>
                            </tr>
                        <?php else: ?>
                            <tr><td colspan="5">No About Us content found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>

<!-- Delete About JS -->
<script>
    $(document).on('click', '.delete-about-btn', function () {
        const id = $(this).data('id');
        if (confirm("Are you sure you want to delete this About section?")) {
            $.ajax({
                url: "<?= base_url('admin/delete-about/') ?>" + id,
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
