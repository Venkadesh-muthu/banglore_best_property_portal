<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit About Section</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item active">Edit About</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Edit About Content</h5>

                <!-- Flash Messages -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form action="<?= base_url('admin/update-about/' . $about['id']) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="heading" class="form-label">Heading</label>
                        <input type="text" class="form-control" id="heading" name="heading" value="<?= esc($about['heading']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="paragraphs_left" class="form-label">Paragraph (Left)</label>
                        <textarea class="form-control" id="paragraphs_left" name="paragraphs_left" rows="4" required><?= esc($about['paragraphs_left']) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="paragraphs_right" class="form-label">Paragraph (Right)</label>
                        <textarea class="form-control" id="paragraphs_right" name="paragraphs_right" rows="4" required><?= esc($about['paragraphs_right']) ?></textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="<?= base_url('admin/about') ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
