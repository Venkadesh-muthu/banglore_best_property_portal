<main id="main" class="main">
    <div class="pagetitle">
        <h1>Add Feature</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item active">Add Feature</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Add New Feature</h5>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <form action="<?= base_url('admin/save-feature') ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="row gy-4">
                                <div class="col-md-12">
                                    <label for="icon" class="form-label">Icon (max 1MB)</label>
                                    <input type="file" class="form-control file-upload-check" name="icon" accept="image/*" onchange="previewFile(this, 'iconPreview')" required>
                                    <img id="iconPreview" src="#" alt="Icon Preview" style="display:none; max-height: 80px; margin-top: 10px;"/>
                                </div>

                                <div class="col-md-12">
                                    <label for="image" class="form-label">Image (max 1MB)</label>
                                    <input type="file" class="form-control file-upload-check" name="image" accept="image/*" onchange="previewFile(this, 'imagePreview')" required>
                                    <img id="imagePreview" src="#" alt="Image Preview" style="display:none; max-height: 100px; margin-top: 10px;"/>
                                </div>

                                <div class="col-md-12">
                                    <label for="title" class="form-label">Feature Title</label>
                                    <input type="text" class="form-control" name="title" value="<?= old('title') ?>" required>
                                </div>

                                <div class="col-md-12">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="4" required><?= old('description') ?></textarea>
                                </div>

                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-1"></i> Save Feature
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
        input.addEventListener('change', function (e) {
            const maxSize = 1 * 1024 * 1024; // 1MB
            for (let i = 0; i < this.files.length; i++) {
                const file = this.files[i];
                if (file.size > maxSize) {
                    alert(`"${file.name}" exceeds the 1MB file size limit.`);
                    this.value = ''; // Clear input
                    break;
                }
            }
        });
    });

    function previewFile(input, targetId) {
        const file = input.files[0];
        const preview = document.getElementById(targetId);
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    }
</script>
