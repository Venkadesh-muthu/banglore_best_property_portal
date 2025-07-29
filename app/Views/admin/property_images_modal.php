<?php if (!empty($images)): ?>
    <div class="row">
        <?php foreach ($images as $img): ?>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <img src="<?= base_url('uploads/properties/' . $img['image']) ?>" class="card-img-top" alt="Property Image">
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p class="text-center">No images found for this property.</p>
<?php endif; ?>