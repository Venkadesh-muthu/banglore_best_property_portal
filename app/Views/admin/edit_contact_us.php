<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Contact Info</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/contact-us') ?>">Contact Info</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Edit Contact Info</h5>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <form action="<?= base_url('admin/update-contact/' . $contact['id']) ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="row gy-4">

                                <div class="col-md-12">
                                    <label for="location" class="form-label">Location</label>
                                    <textarea name="location" id="location" rows="2" class="form-control"><?= old('location', $contact['location']) ?></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="open_days" class="form-label">Open Days</label>
                                    <input type="text" class="form-control" name="open_days" id="open_days" value="<?= old('open_days', $contact['open_days']) ?>">
                                </div>

                                <div class="col-md-6">
                                    <label for="open_hours" class="form-label">Open Hours</label>
                                    <input type="text" class="form-control" name="open_hours" id="open_hours" value="<?= old('open_hours', $contact['open_hours']) ?>">
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" value="<?= old('email', $contact['email']) ?>">
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" id="phone" value="<?= old('phone', $contact['phone']) ?>">
                                </div>

                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-1"></i> Update Contact Info
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div> <!-- card-body -->
                </div> <!-- card -->
            </div>
        </div>
    </section>
</main>
