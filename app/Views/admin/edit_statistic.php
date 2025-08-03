<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Statistic</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/statistics') ?>">Statistics</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Edit Statistic</h5>

                <?= session()->getFlashdata('error') ? '<div class="alert alert-danger">'.session()->getFlashdata('error').'</div>' : '' ?>

                <form action="<?= base_url('admin/update-statistic/' . $statistic['id']) ?>" method="post" enctype="multipart/form-data" onsubmit="return validateImage()">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="caption" class="form-label">Caption</label>
                        <input type="text" name="caption" class="form-control" id="caption" value="<?= esc($statistic['caption']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="number" class="form-label">Number</label>
                        <input type="number" name="number" class="form-control" id="number" value="<?= esc($statistic['number']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="images" class="form-label">Image <small class="text-muted">(Max 1MB)</small></label><br>
                        <?php if (!empty($statistic['images'])): ?>
                            <img src="<?= base_url('uploads/statistics/' . $statistic['images']) ?>" alt="Current Image" style="height: 100px; border:1px solid #ccc;" class="mb-2 d-block" id="existingImage">
                        <?php endif; ?>
                        <input type="file" name="images" class="form-control" id="images" accept="image/*" onchange="previewImage(event)">
                        <div class="mt-2">
                            <img id="imagePreview" style="display:none; height: 100px; border: 1px solid #ddd; padding: 4px;" />
                        </div>
                        <small class="text-muted">Leave blank to keep existing image.</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?= base_url('admin/statistics') ?>" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </section>
</main>

<script>
function validateImage() {
    const input = document.getElementById('images');
    if (input.files.length > 0 && input.files[0].size > 1024 * 1024) {
        alert('Image size must be less than 1MB.');
        return false;
    }
    return true;
}

function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
        const preview = document.getElementById('imagePreview');
        preview.src = reader.result;
        preview.style.display = 'block';
        const existing = document.getElementById('existingImage');
        if (existing) existing.style.display = 'none';
    }
    if (event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
    }
}
</script>
