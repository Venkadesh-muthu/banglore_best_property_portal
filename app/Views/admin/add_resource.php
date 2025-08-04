<main id="main" class="main">
    <div class="pagetitle">
        <h1>Add Resource</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/resources') ?>">All Resources</a></li>
                <li class="breadcrumb-item active">Add</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Add New Resource</h5>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <form action="<?= base_url('admin/save-resource') ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <label for="title" class="form-label">Resource Title</label>
                                    <input type="text" class="form-control" name="title" id="title"
                                        placeholder="e.g., Investment Guide 2025"
                                        value="<?= old('title') ?>">
                                </div>

                                <div class="col-md-6">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control" name="slug" id="slug"
                                           placeholder="e.g., investment-guide-2025" value="<?= old('slug') ?>">
                                </div>

                                <div class="col-md-6">
                                    <label for="category" class="form-label">Category</label>
                                    <input type="text" class="form-control" name="category" id="category"
                                           placeholder="e.g., Blog, Guide, Report"
                                           value="<?= old('category') ?>">
                                </div>

                                <div class="col-md-6">
                                    <label for="author_name" class="form-label">Author Name</label>
                                    <input type="text" class="form-control" name="author_name" id="author_name"
                                           placeholder="Author Name"
                                           value="<?= old('author_name') ?>">
                                </div>

                                <div class="col-md-4">
                                    <label for="publish_date" class="form-label">Publish Date</label>
                                    <input type="date" class="form-control" name="publish_date" id="publish_date"
                                           value="<?= old('publish_date') ?>">
                                </div>

                                <div class="col-md-4">
                                    <label for="read_time" class="form-label">Read Time</label>
                                    <input type="text" class="form-control" name="read_time" id="read_time"
                                           placeholder="e.g., 5 mins read"
                                           value="<?= old('read_time') ?>">
                                </div>

                                <div class="col-md-4">
                                    <label for="image" class="form-label">Resource Image</label>
                                    <input type="file" class="form-control file-upload-check" name="image" id="image" accept="image/*">
                                </div>
                                <div class="col-12">
                                    <label for="short_description" class="form-label">Short Description</label>
                                    <textarea class="form-control" name="short_description" id="short_description" rows="3"
                                            placeholder="This will show as summary on listing pages"><?= old('short_description') ?></textarea>
                                </div>
                                <div class="col-12">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="4"
                                              placeholder="Brief resource content..."><?= old('description') ?></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="meta_title" class="form-label">Meta Title</label>
                                    <input type="text" class="form-control" name="meta_title" id="meta_title"
                                           value="<?= old('meta_title') ?>">
                                </div>

                                <div class="col-md-6">
                                    <label for="meta_keywords" class="form-label">Meta Keywords (comma separated)</label>
                                    <input type="text" class="form-control" name="meta_keywords" id="meta_keywords"
                                           value="<?= old('meta_keywords') ?>">
                                </div>

                                <div class="col-12">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea class="form-control" name="meta_description" id="meta_description" rows="3"><?= old('meta_description') ?></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="tags" class="form-label">Tags (comma separated)</label>
                                    <input type="text" class="form-control" name="tags" id="tags"
                                           value="<?= old('tags') ?>">
                                </div>

                                <div class="col-md-3">
                                    <label for="is_new" class="form-label">Is New?</label>
                                    <select name="is_new" class="form-select" id="is_new">
                                        <option value="1" <?= old('is_new') == 1 ? 'selected' : '' ?>>Yes</option>
                                        <option value="0" <?= old('is_new') === '0' ? 'selected' : '' ?>>No</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="is_featured" class="form-label">Is Featured?</label>
                                    <select name="is_featured" class="form-select" id="is_featured">
                                        <option value="1" <?= old('is_featured') == 1 ? 'selected' : '' ?>>Yes</option>
                                        <option value="0" <?= old('is_featured') === '0' ? 'selected' : '' ?>>No</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" name="status" id="status">
                                        <option value="active" <?= old('status') == 'active' ? 'selected' : '' ?>>Active</option>
                                        <option value="inactive" <?= old('status') == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                </div>

                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-1"></i> Save Resource
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
