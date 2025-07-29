<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Property</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/properties') ?>">All Properties</a></li>
                <li class="breadcrumb-item active">Edit Property</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <ul class="nav nav-pills flex-wrap gap-2 justify-content-start mt-4">
                        <!-- Overview -->
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2 active <?= ($title == 'Edit property') ? 'active' : '' ?>"
                                data-bs-toggle="tab" href="#main_overview">
                                <i class="bi bi-person me-1"></i> Overview
                            </a>
                        </li>

                        <!-- Review -->
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2 collapsed" data-bs-toggle="tab" href="#main_review">
                                <i class="bi bi-question-circle me-1"></i> Review
                            </a>
                        </li>

                        <!-- Connectivity -->
                        <!-- <li class="nav-item">
                            <a class="nav-link px-3 py-2 collapsed" data-bs-toggle="tab" href="#main_connectivity">
                                <i class="bi bi-diagram-3 me-1"></i> Connectivity
                            </a>
                        </li> -->

                        <!-- Guided Home Buying -->
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2 collapsed" data-bs-toggle="tab" href="#guided_home_buying">
                                <i class="bi bi-house me-1"></i> Guided Home Buying
                            </a>
                        </li>

                        <!-- Master Plan -->
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2 collapsed" data-bs-toggle="tab" href="#main_master_plan">
                                <i class="bi bi-map me-1"></i> Master Plan
                            </a>
                        </li>

                        <!-- Floor Plans -->
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" href="#">
                                <i class="bi bi-layout-split me-1"></i> Floor Plans
                            </a>
                        </li>

                        <!-- Amenities -->
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" href="#">
                                <i class="bi bi-gem me-1"></i> Amenities
                            </a>
                        </li>

                        <!-- Challenges -->
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" href="#">
                                <i class="bi bi-exclamation-circle me-1"></i> Challenges
                            </a>
                        </li>

                        <!-- Legal -->
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" href="#">
                                <i class="bi bi-shield-check me-1"></i> Legal
                            </a>
                        </li>

                        <!-- Micro Market -->
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" href="#">
                                <i class="bi bi-geo-alt me-1"></i> Micro Market
                            </a>
                        </li>

                        <!-- Developer -->
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" href="#">
                                <i class="bi bi-person-badge me-1"></i> Developer
                            </a>
                        </li>

                        <!-- Peace of Mind -->
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" href="#">
                                <i class="bi bi-emoji-smile me-1"></i> Peace of Mind
                            </a>
                        </li>

                        <!-- FAQ -->
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" href="#">
                                <i class="bi bi-question-circle me-1"></i> F.A.Q
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <form action="<?= base_url('admin/property/update/' . $property['id']) ?>" method="post"
        enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="main_overview">
                <section class="section">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h5 class="card-title">Edit Property Details</h5>

                                    <!-- Error Messages -->
                                    <?php if (session()->getFlashdata('error')): ?>
                                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                                    <?php endif; ?>
                                    <?php if (session()->getFlashdata('success')): ?>
                                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                                    <?php endif; ?>

                                    <div class="row">
                                        <div class="col-6">
                                            <label class="form-label">Property Name</label>
                                            <input type="text" name="name" class="form-control"
                                                value="<?= esc($property['name']) ?>">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Location</label>
                                            <input type="text" name="location" class="form-control"
                                                value="<?= esc($property['location']) ?>">
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <label class="form-label">Start Price (₹)</label>
                                            <input type="text" name="start_price" class="form-control"
                                                value="<?= esc($property['start_price']) ?>">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">End Price (₹)</label>
                                            <input type="text" name="end_price" class="form-control"
                                                value="<?= esc($property['end_price']) ?>">
                                        </div>
                                    </div>

                                    <?php
                                    $propertyType = $property['property_type'] ?? '';
                                    $propertyDetail = $property['property_type_detail'] ?? '';
                                    $propertyTypeDetails = explode(',', $propertyDetail);
                                    ?>

                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <label class="form-label d-block">Property type</label>
                                            <select name="property_type" id="property_type" class="form-select">
                                                <option value="">Select type</option>
                                                <option value="apartment" <?= $propertyType === 'apartment' ? 'selected' : '' ?>>Apartment</option>
                                                <option value="villa" <?= $propertyType === 'villa' ? 'selected' : '' ?>>Villa</option>
                                                <option value="plot" <?= $propertyType === 'plot' ? 'selected' : '' ?>>Plot</option>
                                            </select>

                                            <!-- Apartment type checkboxes -->
                                            <div id="apartmentTypes" class="mt-2" style="display: none;">
                                                <label class="form-label d-block">Apartment Type</label>
                                                <?php foreach (['Studio','1BHK','1.5BHK','2BHK','2.5BHK','3BHK','3.5BHK','4BHK','4.5BHK','5BHK'] as $type): ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="apt<?= $type ?>" name="apartment_type[]"
                                                            value="<?= $type ?>" <?= in_array($type, $propertyTypeDetails) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="apt<?= $type ?>"><?= $type ?></label>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>

                                            <!-- Villa type checkboxes -->
                                            <div id="villaTypes" class="mt-2" style="display: none;">
                                                <label class="form-label d-block">Villa Type</label>
                                                <?php foreach (['3BHK','3.5BHK','4BHK','4.5BHK','5BHK'] as $type): ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="villa<?= $type ?>" name="villa_type[]"
                                                            value="<?= $type ?>" <?= in_array($type, $propertyTypeDetails) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="villa<?= $type ?>"><?= $type ?></label>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>

                                            <!-- Plot input field -->
                                            <?php
                                                $plotSizes = ['30 X 40', '30 X 50', '40 X 60'];
                                                $selectedPlots = ($propertyType === 'plot' && is_array($propertyTypeDetails)) ? $propertyTypeDetails : [];
                                            ?>
                                            <div id="plotInput" class="mt-2" style="display: none;">
                                                <label class="form-label d-block">Plot Sizes</label>
                                                <?php foreach ($plotSizes as $size): ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="plot<?= str_replace(' ', '', $size) ?>"
                                                            name="plot_type[]"
                                                            value="<?= $size ?>"
                                                            <?= in_array($size, $selectedPlots) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="plot<?= str_replace(' ', '', $size) ?>"><?= $size ?></label>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <label class="form-label">Possession Date</label>
                                            <input type="date" name="possession_date" class="form-control"
                                                value="<?= esc($property['possession_date']) ?>">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Upload New Images</label>
                                            <input type="file" class="form-control" name="images[]" id="images" multiple
                                                accept="image/*">
                                            <small class="text-muted">Leave empty if no new images.</small>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <label class="form-label">Current Images</label><br>
                                            <div id="image-container">
                                                <?php if (!empty($propertyImages)): ?>
                                                    <?php foreach ($propertyImages as $img): ?>
                                                        <div class="d-inline-block position-relative m-1 image-box"
                                                            data-id="<?= $img['id'] ?>">
                                                            <img src="<?= base_url('uploads/properties/' . $img['image']) ?>"
                                                                class="img-thumbnail" style="width: 100px; height: auto;">
                                                            <button type="button"
                                                                class="btn btn-sm btn-danger position-absolute top-0 end-0 delete-image-btn"
                                                                data-id="<?= $img['id'] ?>"
                                                                title="Delete image">&times;</button>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <p>No images available.</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="tab-pane fade show" id="main_review">
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Review Details</h5>
                            <div class="row g-3 review-form">

                                <!-- Land Area -->
                                <div class="col-md-3">
                                    <b class="form-label">Project Land Area (Acres)</b>
                                    <input type="text" class="form-control" name="land_area"
                                        value="<?= esc($property['land_area'] ?? '') ?>" placeholder="Acres">
                                    <input type="text" class="form-control mt-2" name="avg_land_area"
                                        value="<?= esc($property['avg_land_area'] ?? '') ?>" placeholder="Avg Acres">
                                </div>

                                <!-- Clubhouse Area -->
                                <div class="col-md-3">
                                    <b class="form-label">Clubhouse Area (Sqft)</b>
                                    <input type="text" class="form-control" name="clubhouse_area"
                                        value="<?= esc($property['clubhouse_area'] ?? '') ?>" placeholder="Sqft">
                                    <input type="text" class="form-control mt-2" name="avg_clubhouse_sqft"
                                        value="<?= esc($property['avg_clubhouse_area'] ?? '') ?>"
                                        placeholder="Avg Sqft">
                                </div>

                                <!-- Park Area -->
                                <div class="col-md-3">
                                    <b class="form-label">Park Area (Acres)</b>
                                    <input type="text" class="form-control" name="park_area"
                                        value="<?= esc($property['park_area'] ?? '') ?>" placeholder="Acres">
                                    <input type="text" class="form-control mt-2" name="avg_park_area"
                                        value="<?= esc($property['avg_park_area'] ?? '') ?>" placeholder="Avg Acres">
                                </div>

                                <!-- Open Area -->
                                <div class="col-md-3">
                                    <b class="form-label">Open Area (%)</b>
                                    <input type="text" class="form-control" name="open_area"
                                        value="<?= esc($property['open_area'] ?? '') ?>" placeholder="%">
                                    <input type="text" class="form-control mt-2" name="avg_open_area"
                                        value="<?= esc($property['avg_open_area'] ?? '') ?>" placeholder="Avg %">
                                </div>

                                <!-- Units -->
                                <div class="col-md-3">
                                    <b class="form-label">Units</b>
                                    <input type="text" class="form-control" name="units"
                                        value="<?= esc($property['units'] ?? '') ?>" placeholder="Units">
                                    <input type="text" class="form-control mt-2" name="avg_units"
                                        value="<?= esc($property['avg_units'] ?? '') ?>" placeholder="Avg Units">
                                </div>

                                <!-- Price Per Sq.Ft. -->
                                <div class="col-md-3">
                                    <b class="form-label">Price per Sq.Ft.</b>
                                    <input type="text" class="form-control" name="price_per_sqft"
                                        value="<?= esc($property['price_per_sqft'] ?? '') ?>" placeholder="Rs/Sqft">
                                    <input type="text" class="form-control mt-2" name="avg_price_per_sqft"
                                        value="<?= esc($property['avg_price_per_sqft'] ?? '') ?>"
                                        placeholder="Avg Rs/Sqft">
                                </div>

                                <!-- Clubhouse Factor -->
                                <div class="col-md-3">
                                    <b class="form-label">Clubhouse Factor (Sqft/Unit)</b>
                                    <input type="text" class="form-control" name="clubhouse_factor"
                                        value="<?= esc($property['clubhouse_factor'] ?? '') ?>" placeholder="Sqft/Unit">
                                    <input type="text" class="form-control mt-2" name="avg_clubhouse_factor"
                                        value="<?= esc($property['avg_clubhouse_factor'] ?? '') ?>"
                                        placeholder="Avg Sqft/Unit">
                                </div>

                                <!-- Metro Distance -->
                                <div class="col-md-3">
                                    <b class="form-label">Closest Metro (Km)</b>
                                    <input type="text" class="form-control" name="metro_distance"
                                        value="<?= esc($property['metro_distance'] ?? '') ?>" placeholder="Km">
                                    <input type="text" class="form-control mt-2" name="avg_metro_distance"
                                        value="<?= esc($property['avg_metro_distance'] ?? '') ?>" placeholder="Avg Km">
                                </div>

                                <!-- Approach Road -->
                                <div class="col-md-3">
                                    <b class="form-label">Road Width (m)</b>
                                    <input type="text" class="form-control" name="road_width"
                                        value="<?= esc($property['road_width'] ?? '') ?>" placeholder="Meters">
                                    <input type="text" class="form-control mt-2" name="avg_road_width"
                                        value="<?= esc($property['avg_road_width'] ?? '') ?>" placeholder="Avg Meters">
                                </div>

                                <!-- Unit Density -->
                                <div class="col-md-3">
                                    <b class="form-label">Unit Density (Units/Acre)</b>
                                    <input type="text" class="form-control" name="unit_density"
                                        value="<?= esc($property['unit_density'] ?? '') ?>" placeholder="Units/Acre">
                                    <input type="text" class="form-control mt-2" name="avg_unit_density"
                                        value="<?= esc($property['avg_unit_density'] ?? '') ?>"
                                        placeholder="Avg Units/Acre">
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="tab-pane fade" id="main_master_plan">
                <section class="section">
                    <div class="row g-3">

                        <!-- Existing Master Plan Images (Styled like Property Images) -->
                        <?php if (!empty($masterPlans)) : ?>
                            <div class="card mt-4">
                                <div class="card-body">
                                    <h5 class="card-title">Existing Master Plan Images</h5>
                                    <div id="masterplan-image-container">
                                        <?php foreach ($masterPlans as $image) : ?>
                                            <div class="d-inline-block position-relative m-1 image-box" data-id="<?= $image['id'] ?>">
                                                <img src="<?= base_url('uploads/master_plans/' . $image['master_plan_image']) ?>"
                                                    class="img-thumbnail" style="width: 100px; height: auto;">
                                                <span class="delete-icon btn btn-sm btn-danger position-absolute top-0 end-0"
                                                    data-id="<?= $image['id'] ?>">&times;</span>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Upload New Master Plan Images -->
                        <div class="card mt-4">
                            <div class="card-body">
                                <h5 class="card-title">Upload Master Plan Images</h5>
                                <div class="mb-3">
                                    <label for="masterPlanImages" class="form-label">Choose Images</label>
                                    <input class="form-control" type="file" name="master_plan_image[]" id="masterPlanImages" accept="image/*" multiple>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>

                                


        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="<?= base_url('admin/properties') ?>" class="btn btn-danger">Cancel</a>
        </div>
    </form>
</main>
<script>
    
    $(document).on('click', '.delete-image-btn', function () {
        let imageId = $(this).data('id');
        if (confirm('Are you sure to delete this image?')) {
            $.ajax({
                url: '<?= base_url('admin/property/image/delete') ?>/' + imageId,
                type: 'POST', // Changed from DELETE to POST
                data: {
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>' // CSRF token correctly passed
                },
                success: function (res) {
                    alert(res.message);
                    location.reload();
                },
                error: function () {
                    alert('Failed to delete image.');
                }
            });
        }
    });


</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-icon').forEach(icon => {
        icon.addEventListener('click', function () {
            const id = this.dataset.id;
            const url = `<?= base_url('admin/delete_master_plan') ?>/${id}`;

            if (confirm("Are you sure you want to delete this image?")) {
                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                    }
                }).then(res => res.json()).then(data => {
                    if (data.status === 'success') {
                        this.closest('.image-box').remove();
                    } else {
                        alert('Failed to delete image.');
                    }
                });
            }
        });
    });
});
</script>

<script>
    document.getElementById('images').addEventListener('change', function (e) {
        const maxSize = 1 * 1024 * 1024; // 1MB
        for (let i = 0; i < this.files.length; i++) {
            if (this.files[i].size > maxSize) {
                alert(`"${this.files[i].name}" exceeds 1MB limit.`);
                this.value = ''; // Clear all selected files
                break;
            }
        }
    });
</script>
<script>
    function togglePropertyDetails() {
        const propertyType = document.getElementById('property_type').value;
        document.getElementById('apartmentTypes').style.display = 'none';
        document.getElementById('villaTypes').style.display = 'none';
        document.getElementById('plotInput').style.display = 'none';

        if (propertyType === 'apartment') {
            document.getElementById('apartmentTypes').style.display = 'block';
        } else if (propertyType === 'villa') {
            document.getElementById('villaTypes').style.display = 'block';
        } else if (propertyType === 'plot') {
            document.getElementById('plotInput').style.display = 'block';
        }
    }

    // Initial call to show on page load (for edit form)
    document.addEventListener('DOMContentLoaded', togglePropertyDetails);

    // On change
    document.getElementById('property_type').addEventListener('change', togglePropertyDetails);
</script>
