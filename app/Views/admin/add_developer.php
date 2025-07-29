<main id="main" class="main">
    <div class="pagetitle">
        <h1>Developer</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item active"><a href="<?= base_url('admin/developers') ?>">All Developers</a></li>
                <li class="breadcrumb-item active">Add Developer</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Add Developers</h5>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <form action="<?= base_url('admin/save-developer') ?>" method="post"
                            enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <label for="devName" class="form-label">Developer Name</label>
                                    <input type="text" class="form-control" name="name" id="devName"
                                        placeholder="e.g., Goyal & Co | Hariyana Group" value="<?= old('name') ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="property_id" class="form-label">Related Property</label>
                                    <select class="form-select" name="property_id" id="property_id">
                                        <option value="">-- Select Property --</option>
                                        <?php foreach ($properties as $property): ?>
                                            <option value="<?= $property['id'] ?>" <?= old('property_id') == $property['id'] ? 'selected' : '' ?>>
                                                <?= esc($property['name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="establishedYear" class="form-label">Established Year</label>
                                    <input type="number" class="form-control" name="established_year"
                                        id="establishedYear" placeholder="e.g., 1970"
                                        value="<?= old('established_year') ?>" min="1900" max="<?= date('Y') ?>">
                                </div>

                                <div class="col-md-6">
                                    <label for="completedProjects" class="form-label">Completed
                                        Projects</label>
                                    <input type="text" class="form-control" name="completed_projects"
                                        id="completedProjects" placeholder="e.g., 200+"
                                        value="<?= old('completed_projects') ?>">
                                </div>

                                <div class="col-md-6">
                                    <label for="devImage" class="form-label">Developer Image / Logo</label>
                                    <input type="file" class="form-control file-upload-check" name="image" id="devImage"
                                        accept="image/*">
                                </div>

                                <div class="col-12">
                                    <label for="description" class="form-label">About the Developer</label>
                                    <textarea class="form-control" name="description" id="description" rows="6"
                                        placeholder="Enter detailed description about the developer"><?= old('description') ?></textarea>
                                </div>

                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-1"></i> Save Developer
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
    document.getElementById('devImage').addEventListener('change', function (e) {
        const file = this.files[0];
        if (file) {
            const preview = document.getElementById('previewImage');
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    });
</script>
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
</script>