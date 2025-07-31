<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Service</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/services') ?>">All Services</a></li>
                <li class="breadcrumb-item active">Edit Service</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Edit Service</h5>

                        <form action="<?= base_url('admin/update-service/' . $service['id']) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="row gy-4">
                                <!-- Title & Slug -->
                                <div class="col-md-6">
                                    <label class="form-label">Service Title</label>
                                    <input type="text" class="form-control" name="title" value="<?= esc($service['title']) ?>">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Slug</label>
                                    <input type="text" class="form-control" name="slug" value="<?= esc($service['slug']) ?>">
                                </div>

                                <!-- Icons -->
                                <div class="col-md-6">
                                    <label class="form-label">Service Icon</label>
                                    <input type="file" class="form-control file-upload-check" name="icon" accept="image/*">
                                    <?php if (!empty($service['icon'])): ?>
                                        <img src="<?= base_url('uploads/icons/' . $service['icon']) ?>" class="mt-2" height="50">
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Main Image</label>
                                    <input type="file" class="form-control file-upload-check" name="image" accept="image/*">
                                    <?php if (!empty($service['image'])): ?>
                                        <img src="<?= base_url('uploads/services/' . $service['image']) ?>" class="mt-2" height="50">
                                    <?php endif; ?>
                                </div>

                                <!-- Descriptions -->

                                <div class="col-12">
                                    <label class="form-label">Short Description</label>
                                    <textarea name="short_description" class="form-control" rows="2"><?= esc($service['short_description']) ?></textarea>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Long Description</label>
                                    <textarea name="long_description" class="form-control" rows="4"><?= esc($service['long_description']) ?></textarea>
                                </div>

                                <!-- SEO Fields -->
                                <div class="col-md-6">
                                    <label class="form-label">Meta Title</label>
                                    <input type="text" class="form-control" name="meta_title" value="<?= esc($service['meta_title']) ?>">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Meta Description</label>
                                    <textarea name="meta_description" class="form-control" rows="2"><?= esc($service['meta_description']) ?></textarea>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Meta Keywords</label>
                                    <input type="text" class="form-control" name="meta_keywords" value="<?= esc($service['meta_keywords']) ?>">
                                </div>

                                <!-- Status -->
                                <div class="col-md-6">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="1" <?= $service['status'] == 1 ? 'selected' : '' ?>>Active</option>
                                        <option value="0" <?= $service['status'] == 0 ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                </div>

                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-arrow-repeat me-1"></i> Update Service
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    document.querySelectorAll('.file-upload-check').forEach(input => {
        input.addEventListener('change', function () {
            const maxSize = 1 * 1024 * 1024;
            for (let i = 0; i < this.files.length; i++) {
                const file = this.files[i];
                if (file.size > maxSize) {
                    alert(`${file.name} exceeds 1MB limit.`);
                    this.value = '';
                    break;
                }
            }
        });
    });
</script>
