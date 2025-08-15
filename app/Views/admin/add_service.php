<main id="main" class="main">
    <div class="pagetitle">
        <h1>Services</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/services') ?>">All Services</a></li>
                <li class="breadcrumb-item active">Add Service</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Add New Service</h5>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <form action="<?= base_url('admin/save-service') ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <label for="title" class="form-label">Service Title</label>
                                    <input type="text" class="form-control" name="title" id="title"
                                           placeholder="e.g., RERA Registration Assistance"
                                           value="<?= old('title') ?>">
                                </div>

                                <div class="col-md-6">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control" name="slug" id="slug"
                                           placeholder="e.g., rera-registration-assistance" value="<?= old('slug') ?>">
                                </div>

                                <!-- <div class="col-md-6">
                                    <label for="icon" class="form-label">Service Icon/Image</label>
                                    <input type="file" class="form-control file-upload-check" name="icon" id="icon" accept="image/*">
                                </div> -->

                                <div class="col-md-6">
                                    <label for="image" class="form-label">Main Service Image</label>
                                    <input type="file" class="form-control file-upload-check" name="image" id="image" accept="image/*">
                                </div>
                                <div class="col-12">
                                    <label for="short_description" class="form-label">Short Description</label>
                                    <textarea class="form-control" name="short_description" id="short_description" rows="2"
                                              placeholder="Short summary..."><?= old('short_description') ?></textarea>
                                </div>

                                <div class="col-12">
                                    <label for="long_description" class="form-label">Long Description</label>
                                    <textarea class="form-control" name="long_description" id="long_description" rows="4"
                                              placeholder="Full service details..."><?= old('long_description') ?></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="meta_title" class="form-label">Meta Title (SEO)</label>
                                    <input type="text" class="form-control" name="meta_title" id="meta_title"
                                           placeholder="SEO Meta Title" value="<?= old('meta_title') ?>">
                                </div>

                                <div class="col-12">
                                    <label for="meta_description" class="form-label">Meta Description (SEO)</label>
                                    <textarea class="form-control" name="meta_description" id="meta_description" rows="2"
                                              placeholder="SEO Meta Description..."><?= old('meta_description') ?></textarea>
                                </div>

                                <div class="col-12">
                                    <label for="meta_keywords" class="form-label">Meta Keywords (comma-separated)</label>
                                    <input type="text" class="form-control" name="meta_keywords" id="meta_keywords"
                                           placeholder="e.g., real estate, registration, service"
                                           value="<?= old('meta_keywords') ?>">
                                </div>

                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" name="status" id="status">
                                        <option value="1" <?= old('status') == 1 ? 'selected' : '' ?>>Active</option>
                                        <option value="0" <?= old('status') === '0' ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                </div>

                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-1"></i> Save Service
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

<script>
    document.querySelectorAll('.file-upload-check').forEach(input => {
        input.addEventListener('change', function () {
            const maxSize = 1 * 1024 * 1024; // 1MB
            for (let i = 0; i < this.files.length; i++) {
                const file = this.files[i];
                if (file.size > maxSize) {
                    alert(`"${file.name}" exceeds the 1MB file size limit.`);
                    this.value = '';
                    break;
                }
            }
        });
    });
</script>
