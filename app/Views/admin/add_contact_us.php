<main id="main" class="main">
    <div class="pagetitle">
        <h1>Add Contact Info</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/contact-us') ?>">Contact Info</a></li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Add New Contact Info</h5>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <form action="<?= base_url('admin/save-contact') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="row gy-4">

                                <div class="col-md-12">
                                    <label for="location" class="form-label">Location</label>
                                    <textarea name="location" id="location" rows="2" class="form-control" placeholder="Full address"><?= old('location') ?></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="open_days" class="form-label">Open Days</label>
                                    <input type="text" class="form-control" name="open_days" id="open_days" placeholder="e.g., Sunday - Friday" value="<?= old('open_days') ?>">
                                </div>

                                <div class="col-md-6">
                                    <label for="open_hours" class="form-label">Open Hours</label>
                                    <input type="text" class="form-control" name="open_hours" id="open_hours" placeholder="e.g., 11:00 AM - 11:00 PM" value="<?= old('open_hours') ?>">
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="e.g., info@example.com" value="<?= old('email') ?>">
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="e.g., +1 1234 5678 90" value="<?= old('phone') ?>">
                                </div>

                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-1"></i> Save Contact Info
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
