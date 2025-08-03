<main id="main" class="main">
    <div class="pagetitle">
        <h1>About Section</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item active">Add About</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Add About Content</h5>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <form action="<?= base_url('admin/save-about') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <label for="heading" class="form-label">Heading</label>
                                    <input type="text" class="form-control" name="heading" id="heading" placeholder="e.g., Welcome to SJ Group" value="<?= old('heading') ?>">
                                </div>

                                <div class="col-md-12">
                                    <label for="paragraphs_left" class="form-label">Left Paragraph</label>
                                    <textarea class="form-control" name="paragraphs_left" id="paragraphs_left" rows="5" placeholder="Enter left paragraph..."><?= old('paragraphs_left') ?></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label for="paragraphs_right" class="form-label">Right Paragraph</label>
                                    <textarea class="form-control" name="paragraphs_right" id="paragraphs_right" rows="5" placeholder="Enter right paragraph..."><?= old('paragraphs_right') ?></textarea>
                                </div>

                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-1"></i> Save About
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
