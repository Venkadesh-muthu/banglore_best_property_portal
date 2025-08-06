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
                        <!-- <li class="nav-item">
                            <a class="nav-link px-3 py-2 collapsed" data-bs-toggle="tab" href="#guided_home_buying">
                                <i class="bi bi-house me-1"></i> Guided Home Buying
                            </a>
                        </li> -->

                        <!-- Master Plan -->
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2 collapsed" data-bs-toggle="tab" href="#main_master_plan">
                                <i class="bi bi-map me-1"></i> Master Plan
                            </a>
                        </li>

                        <!-- Floor Plans -->
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" data-bs-toggle="tab" href="#main_floor_plan">
                                <i class="bi bi-layout-split me-1"></i> Floor Plans
                            </a>
                        </li>

                        <!-- Amenities -->
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" data-bs-toggle="tab" href="#main_amenities">
                                <i class="bi bi-gem me-1"></i> Amenities
                            </a>
                        </li>

                        <!-- Challenges -->
                        <!-- <li class="nav-item">
                            <a class="nav-link px-3 py-2" href="#">
                                <i class="bi bi-exclamation-circle me-1"></i> Challenges
                            </a>
                        </li> -->

                        <!-- Legal -->
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" data-bs-toggle="tab" href="#main_legal">
                                <i class="bi bi-shield-check me-1"></i> Legal
                            </a>
                        </li>

                        <!-- Micro Market -->
                        <!-- <li class="nav-item">
                            <a class="nav-link px-3 py-2" data-bs-toggle="tab" href="#main_micro_market">
                                <i class="bi bi-geo-alt me-1"></i> Micro Market
                            </a>
                        </li> -->

                        <!-- Developer -->
                        <!-- <li class="nav-item">
                            <a class="nav-link px-3 py-2" href="#">
                                <i class="bi bi-person-badge me-1"></i> Developer
                            </a>
                        </li> -->

                        <!-- Peace of Mind -->
                        <!-- <li class="nav-item">
                            <a class="nav-link px-3 py-2" href="#">
                                <i class="bi bi-emoji-smile me-1"></i> Peace of Mind
                            </a>
                        </li> -->

                        <!-- FAQ -->
                        <!-- <li class="nav-item">
                            <a class="nav-link px-3 py-2" href="#">
                                <i class="bi bi-question-circle me-1"></i> F.A.Q
                            </a>
                        </li> -->
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
                                                value="<?= esc($property['name']) ?>" required>
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
                                            <input type="text" name="start_price" id="startPrice" class="form-control"
                                            value="<?= esc(number_format($property['start_price'], 0, '', ',')) ?>">
                                            <small id="startPriceError" class="text-danger"></small>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">End Price (₹)</label>
                                            <input type="text" name="end_price" id="endPrice" class="form-control"
                                            value="<?= esc(number_format($property['end_price'], 0, '', ',')) ?>">
                                            <small id="endPriceError" class="text-danger"></small>
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
                                                <?php
                            $types = ['apartment', 'villa', 'plot'];
                foreach ($types as $type) {
                    $selected = ($propertyType === $type) ? 'selected' : '';
                    echo '<option value="' . $type . '" ' . $selected . '>' . ucfirst($type) . '</option>';
                }
                ?>
                                            </select>

                                            <!-- Apartment Types -->
                                            <?php
                                            $apartmentTypes = ['Studio', '1BHK', '1.5BHK', '2BHK', '2.5BHK', '3BHK', '3.5BHK', '4BHK', '4.5BHK', '5BHK'];
                ?>
                                            <div id="apartmentTypes" class="mt-2" style="display: none;">
                                                <label class="form-label d-block">Apartment Type</label>
                                                <?php
                    foreach ($apartmentTypes as $type) {
                        $id = 'apt' . preg_replace('/[^a-zA-Z0-9]/', '', $type);
                        $checked = in_array($type, $propertyTypeDetails) ? 'checked' : '';
                        echo '<div class="form-check form-check-inline">';
                        echo '<input class="form-check-input" type="checkbox" id="' . $id . '" name="apartment_type[]" value="' . $type . '" ' . $checked . '>';
                        echo '<label class="form-check-label" for="' . $id . '">' . $type . '</label>';
                        echo '</div>';
                    }
                ?>
                                            </div>

                                            <!-- Villa Types -->
                                            <?php
                                            $villaTypes = ['3BHK', '3.5BHK', '4BHK', '4.5BHK', '5BHK'];
                ?>
                                            <div id="villaTypes" class="mt-2" style="display: none;">
                                                <label class="form-label d-block">Villa Type</label>
                                                <?php
                    foreach ($villaTypes as $type) {
                        $id = 'villa' . preg_replace('/[^a-zA-Z0-9]/', '', $type);
                        $checked = in_array($type, $propertyTypeDetails) ? 'checked' : '';
                        echo '<div class="form-check form-check-inline">';
                        echo '<input class="form-check-input" type="checkbox" id="' . $id . '" name="villa_type[]" value="' . $type . '" ' . $checked . '>';
                        echo '<label class="form-check-label" for="' . $id . '">' . $type . '</label>';
                        echo '</div>';
                    }
                ?>
                                            </div>

                                            <!-- Plot Sizes -->
                                            <?php
                                            $plotSizes = ['30 X 40', '30 X 50', '40 X 60'];
                $selectedPlots = ($propertyType === 'plot' && is_array($propertyTypeDetails)) ? $propertyTypeDetails : [];
                ?>
                                            <div id="plotInput" class="mt-2" style="display: none;">
                                                <label class="form-label d-block">Plot Sizes</label>
                                                <?php
                    foreach ($plotSizes as $size) {
                        $id = 'plot' . preg_replace('/[^a-zA-Z0-9]/', '', $size);
                        $checked = in_array($size, $selectedPlots) ? 'checked' : '';
                        echo '<div class="form-check form-check-inline">';
                        echo '<input class="form-check-input" type="checkbox" id="' . $id . '" name="plot_type[]" value="' . $size . '" ' . $checked . '>';
                        echo '<label class="form-check-label" for="' . $id . '">' . $size . '</label>';
                        echo '</div>';
                    }
                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <label class="form-label">Possession Date</label>
                                            <input type="month" name="possession_date" class="form-control"
                                                id="possessionDate" value="<?= esc($property['possession_date']) ?>">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Upload New Images</label>
                                            <input type="file" class="form-control file-upload-check" name="images[]"
                                                id="images" multiple accept="image/*">
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
                        <?php if (!empty($masterPlans)): ?>
                            <div class="card mt-4">
                                <div class="card-body">
                                    <h5 class="card-title">Existing Master Plan Images</h5>
                                    <div id="masterplan-image-container">
                                        <?php foreach ($masterPlans as $image): ?>
                                            <div class="d-inline-block position-relative m-1 image-box"
                                                data-id="<?= $image['id'] ?>">
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
                                    <input class="form-control file-upload-check" type="file" name="master_plan_image[]"
                                        id="masterPlanImages" accept="image/*" multiple>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>
            <div class="tab-pane fade" id="main_floor_plan">
                <div class="section">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Floor Plan Details</h5>

                            <div id="floorPlanRepeater">
                                <div class="floor-plan-group border rounded p-3 mb-4">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label>Select Plan Type</label>
                                            <select id="bhkDropdown" class="form-select">
                                                <option value="">-- Select Plan Type --</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 d-flex align-items-end">
                                            <button type="button" class="btn btn-primary ms-2" id="addFloorPlanBtn"
                                                style="display:none;">+ Add Floor Plan</button>
                                        </div>
                                    </div>

                                    <!-- Wrapper where floor plans will be appended -->
                                    <div id="floorPlanWrapper"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="main_amenities">
                <div class="section">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Amenities & Specifications</h5>

                            <ul class="nav nav-pills gap-2 mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-lifestyle-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-lifestyle" type="button">Lifestyle</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-sports-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-sports" type="button">Sports</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-natural-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-natural" type="button">Natural</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-spec-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-spec" type="button">Specifications</button>
                                </li>
                            </ul>

                            <div class="tab-content" id="pills-tabContent">
                                <!-- Lifestyle Amenities -->
                                <div class="tab-pane fade show active" id="pills-lifestyle" role="tabpanel">
                                    <div class="row">
                                        <?php
                                        $lifestyleItems = [
                                            'Pet Park',
                                            'Supermarket',
                                            'Pharmacy/Clinic',
                                            'Library',
                                            'Sauna',
                                            'Amphitheatre',
                                            'Swimming Pool',
                                            'Gym - Indoor',
                                            'Gym - Outdoor',
                                            'Cafe/Restaurant',
                                            'Jacuzzi',
                                            'Kids Play Area',
                                            'Salon',
                                            'Play School',
                                            'Heated Pool'
                                        ];

                $selectedLifestyle = [];
                $rareLifestyle = [];
                foreach ($grouped_amenities['lifestyle'] ?? [] as $a) {
                    $selectedLifestyle[$a['name']] = true;
                    $rareLifestyle[$a['name']] = $a['rare'] ?? 'NORMAL';
                }
                ?>
                                        <div class="tab-pane fade show active" id="pills-lifestyle" role="tabpanel">
                                            <div class="row">
                                                <?php foreach ($lifestyleItems as $item):
                                                    $isChecked = isset($selectedLifestyle[$item]);
                                                    $rareValue = $rareLifestyle[$item] ?? '';
                                                    ?>
                                                    <div class="col-md-4 mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check me-2">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="lifestyle_amenities[]" value="<?= $item ?>"
                                                                    id="lifestyle_<?= md5($item) ?>" <?= $isChecked ? 'checked' : '' ?>>
                                                                <label class="form-check-label"
                                                                    for="lifestyle_<?= md5($item) ?>">
                                                                    <?= $item ?>
                                                                </label>
                                                            </div>
                                                            <!-- <select class="form-select form-select-sm ms-auto"
                                                                name="lifestyle_rare[<?= $item ?>]" style="width: 100px;">
                                                                <option value="NORMAL" <?= $rareValue === 'NORMAL' ? 'selected' : '' ?>>Normal</option>
                                                                <option value="RARE" <?= $rareValue === 'RARE' ? 'selected' : '' ?>>RARE</option>
                                                            </select> -->
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sports Amenities -->
                                <div class="tab-pane fade" id="pills-sports" role="tabpanel">
                                    <div class="row">
                                        <?php
                                        $sportsItems = [
                                            'Running Track',
                                            'Basketball',
                                            'Badminton',
                                            'Cricket Pitch',
                                            'Cricket Ground',
                                            'Football Ground',
                                            'Squash',
                                            'Skating',
                                            'Lawn Tennis',
                                            'Volleyball Net'
                                        ];

                $selectedSports = [];
                $rareSports = [];
                foreach ($grouped_amenities['sports'] ?? [] as $a) {
                    $selectedSports[$a['name']] = true;
                    $rareSports[$a['name']] = $a['rare'] ?? 'NORMAL';
                }

                foreach ($sportsItems as $item):
                    $isChecked = isset($selectedSports[$item]);
                    $rareValue = $rareSports[$item] ?? '';
                    ?>
                                            <div class="col-md-4 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check me-2">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="sports_amenities[]" value="<?= $item ?>"
                                                            id="sports_<?= md5($item) ?>" <?= $isChecked ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="sports_<?= md5($item) ?>">
                                                            <?= $item ?>
                                                        </label>
                                                    </div>
                                                    <!-- <select class="form-select form-select-sm ms-auto"
                                                        name="sports_rare[<?= $item ?>]" style="width: 100px;">
                                                        <option value="NORMAL" <?= $rareValue === 'NORMAL' ? 'selected' : '' ?>>Normal</option>
                                                        <option value="RARE" <?= $rareValue === 'RARE' ? 'selected' : '' ?>>
                                                            RARE</option>
                                                    </select> -->
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <!-- Natural Amenities -->
                                <div class="tab-pane fade" id="pills-natural" role="tabpanel">
                                    <div class="row">
                                        <?php
                                        $naturalItems = ['Lake', 'Forest', 'Army Land', 'Mountain/Hill', 'Golf Course', 'Park Area'];

                $selectedNatural = [];
                $rareNatural = [];
                foreach ($grouped_amenities['natural'] ?? [] as $a) {
                    $selectedNatural[$a['name']] = true;
                    $rareNatural[$a['name']] = $a['rare'] ?? 'NORMAL';
                }

                foreach ($naturalItems as $item):
                    $isChecked = isset($selectedNatural[$item]);
                    $rareValue = $rareNatural[$item] ?? '';
                    ?>
                                            <div class="col-md-4 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check me-2">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="natural_amenities[]" value="<?= $item ?>"
                                                            id="natural_<?= md5($item) ?>" <?= $isChecked ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="natural_<?= md5($item) ?>">
                                                            <?= $item ?>
                                                        </label>
                                                    </div>
                                                    <!-- <select class="form-select form-select-sm ms-auto"
                                                        name="natural_rare[<?= $item ?>]" style="width: 100px;">
                                                        <option value="NORMAL" <?= $rareValue === 'NORMAL' ? 'selected' : '' ?>>Normal</option>
                                                        <option value="RARE" <?= $rareValue === 'RARE' ? 'selected' : '' ?>>
                                                            RARE</option>
                                                    </select> -->
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <?php
                                function inputBlock($title, $name, $defaults, $existing = [])
                                {
                                    echo "<h6 class='mb-3 mt-3'>$title</h6>";
                                    echo "<div class='row'>";
                                    foreach ($defaults as $label => $default) {
                                        $value = $existing[$label] ?? $default;
                                        echo "<div class='col-md-6 mb-3'>
                                                <label class='form-label'>" . esc($label) . "</label>
                                                <input type='text' name='specifications[" . esc($name) . "][" . esc($label) . "]' class='form-control' value='" . esc($value) . "'>
                                            </div>";
                                    }
                                    echo "</div>";
                                }
                ?>

                                <!-- Specifications -->
                                <div class="tab-pane fade" id="pills-spec" role="tabpanel">
                                    <?php
                    inputBlock('🧱 Flooring', 'flooring', [
                        'Living Room' => 'Vitrified',
                        'Bedroom' => 'Vitrified',
                        'Master Bedroom' => 'Vitrified',
                        'Kitchen' => 'Ceramic Flooring + Wall Tile',
                        'Toilets' => 'Ceramic Flooring + Wall Tile'
                    ], $specifications['flooring'] ?? []);

                inputBlock('🚪 Doors & Windows', 'doors', [
                    'Toilets' => 'Engineered Wood',
                    'Balcony Door' => 'UPVC Sliding Door',
                    'Window' => 'UPVC Sliding Door',
                    'Main Door' => 'Polished Teak Wood',
                    'Internal Door' => 'Timber With Both Side Laminated'
                ], $specifications['doors'] ?? []);

                inputBlock('🎨 Paint', 'paint', [
                    'Internal Paint' => 'Plastic Emulsion',
                    'External Paint' => 'Acrylic Emulsion'
                ], $specifications['paint'] ?? []);

                inputBlock('🔧 Others', 'others', [
                    'Construction Technology' => 'RCC Framed Structure',
                    'Sanitary Fittings' => 'Chromium Plated'
                ], $specifications['others'] ?? []);
                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="main_legal" role="tabpanel">
                <div class="section">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Legal Approvals</h5>

                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                            <?php endif; ?>

                            <div class="row">
                                <?php foreach ($legalApprovals as $index => $item): ?>
                                    <div class="row mb-4 border-bottom pb-3">
                                        <input type="hidden" name="legal_approvals[<?= $index ?>][id]"
                                            value="<?= esc($item['id']) ?>">
                                        <div class="col-md-4">
                                            <label class="form-label">Approval Title</label>
                                            <input type="text" class="form-control"
                                                name="legal_approvals[<?= $index ?>][title]"
                                                value="<?= esc($item['title']) ?>">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Approved By</label>
                                            <input type="text" class="form-control"
                                                name="legal_approvals[<?= $index ?>][approved_by]"
                                                value="<?= esc($item['approved_by']) ?>">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Status</label>
                                            <select name="legal_approvals[<?= $index ?>][status]" class="form-select">
                                                <option value="Approved" <?= $item['status'] === 'Approved' ? 'selected' : '' ?>>Approved</option>
                                                <option value="Not Available" <?= $item['status'] === 'Not Available' ? 'selected' : '' ?>>Not Available</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Document (PDF/Image)</label>
                                            <input type="file" class="form-control file-upload-check"
                                                name="legal_approvals[<?= $index ?>][document_file]" accept=".pdf,image/*">

                                            <?php if (!empty($item['document_file'])): ?>
                                                <small class="text-muted d-block mt-1">
                                                    Existing: <a href="<?= base_url('documents/' . $item['document_file']) ?>"
                                                        target="_blank">View</a>
                                                </small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show" id="main_micro_market" role="tabpanel">
                <div class="section">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Micro Market Documents</h5>
                            <div class="row g-4">
                                <?php for ($i = 0; $i < 4; $i++):
                                    $doc = $microMarketDocuments[$i] ?? [
                                        'title' => '',
                                        'description' => '',
                                        'link_text' => '',
                                        'link_url' => '',
                                        'image' => '',
                                    ];
                                    ?>
                                    <div class="col-12 border rounded p-3 mb-3">
                                        <h6 class="fw-bold mb-3">Document <?= $i + 1 ?></h6>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Title</label>
                                                <input type="text" name="documents[<?= $i ?>][title]" class="form-control"
                                                    value="<?= esc($doc['title']) ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Document (PDF/Image)</label>
                                                <input type="file" name="documents[<?= $i ?>][image]"
                                                    class="form-control file-upload-check">
                                                <?php if (!empty($doc['image'])): ?>
                                                    <div class="mt-2">
                                                        <a href="<?= base_url('documents/' . $doc['image']) ?>" target="_blank"
                                                            class="btn btn-sm btn-outline-primary">
                                                            View Current Document
                                                        </a>
                                                        <input type="hidden" name="documents[<?= $i ?>][old_image]"
                                                            value="<?= esc($doc['image']) ?>">
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Description</label>
                                                <textarea name="documents[<?= $i ?>][description]" class="form-control"
                                                    rows="2"><?= esc($doc['description']) ?></textarea>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Link Text (Optional)</label>
                                                <input type="text" name="documents[<?= $i ?>][link_text]"
                                                    class="form-control" value="<?= esc($doc['link_text']) ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Link URL (Optional)</label>
                                                <input type="text" name="documents[<?= $i ?>][link_url]"
                                                    class="form-control" value="<?= esc($doc['link_url']) ?>">
                                            </div>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>

                            <hr class="my-4">

                            <h5 class="card-title">Micro Market Section</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="section_image" class="form-control file-upload-check">
                                    <?php if (!empty($microMarketSection['section_image'])): ?>
                                        <div class="mt-2">
                                            <img src="<?= base_url('images/' . $microMarketSection['section_image']) ?>"
                                                class="img-fluid rounded" style="max-height: 120px;" alt="Section Image">
                                            <input type="hidden" name="section_old_image"
                                                value="<?= esc($microMarketSection['section_image']) ?>">
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="section_title" class="form-control"
                                        value="<?= esc($microMarketSection['section_title'] ?? '') ?>">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Description</label>
                                    <textarea name="section_description" class="form-control"
                                        rows="4"><?= esc($microMarketSection['section_description'] ?? '') ?></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="<?= base_url('admin/properties') ?>" class="btn btn-danger">Cancel</a>
        </div>
    </form>
</main>
<!-- Include jQuery & jQuery UI -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>
    $(function () {
        $('#possessionDate').datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy-mm',
            onClose: function (dateText, inst) {
                const month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                const year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).val(year + '-' + ('0' + (parseInt(month) + 1)).slice(-2));
            },
            beforeShow: function (input, inst) {
                $('#ui-datepicker-div').addClass('month_year_datepicker');
            }
        });
    });

    // Remove calendar days
    $(document).on("focus", "#possessionDate", function () {
        $(".ui-datepicker-calendar").hide();
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const propertyNameInput = document.getElementById('propertyName');

        // Attach to all tab links
        document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tabLink => {
            tabLink.addEventListener('show.bs.tab', function (e) {
                // Get the target tab ID (e.g., "#main_legal", "#main_other_tab")
                const targetTab = e.target.getAttribute('href');

                // If the tab being opened is NOT the overview tab (that contains #propertyName)
                // And if #propertyName is empty, show alert
                if (targetTab !== '#main_overview') {
                    if (propertyNameInput && propertyNameInput.value.trim() === '') {
                        e.preventDefault(); // prevent tab switch
                        alert("Please enter the Property Name before proceeding to other tabs.");
                        propertyNameInput.focus();
                    }
                }
            });
        });
    });
</script>
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const bhkDropdown = document.getElementById("bhkDropdown");
        const addFloorPlanBtn = document.getElementById("addFloorPlanBtn");
        const floorPlanWrapper = document.getElementById("floorPlanWrapper");

        let selectedType = '';
        let floorPlanIndex = 0;

        const existingFloorPlans = <?= json_encode($floorPlans ?? []) ?>;

        function getSelectedPropertyType() {
            if (document.getElementById("apartmentTypes").style.display === "block") return 'apartment';
            if (document.getElementById("villaTypes").style.display === "block") return 'villa';
            if (document.getElementById("plotInput").style.display === "block") return 'plot';
            return '';
        }

        function populateBHKDropdown() {
            bhkDropdown.innerHTML = '<option value="">-- Select BHK Type --</option>';
            let bhkOptions = [];

            selectedType = getSelectedPropertyType();

            if (selectedType === 'apartment') {
                document.querySelectorAll('input[name="apartment_type[]"]:checked').forEach(chk => bhkOptions.push(chk.value));
            }

            if (selectedType === 'villa') {
                document.querySelectorAll('input[name="villa_type[]"]:checked').forEach(chk => bhkOptions.push(chk.value));
            }

            if (selectedType === 'plot') {
                document.querySelectorAll('input[name="plot_type[]"]:checked').forEach(chk => bhkOptions.push(chk.value));
            }

            bhkOptions.forEach(opt => {
                const option = document.createElement("option");
                option.value = opt;
                option.text = opt;
                bhkDropdown.appendChild(option);
            });
        }

        // Restrict floor plan tab without property type
        document.querySelector('a[href="#main_floor_plan"]').addEventListener('show.bs.tab', function (e) {
            const selected = getSelectedPropertyType();
            if (!selected) {
                e.preventDefault();
                alert("Please select a property type before accessing the Floor Plan.");
            }
        });

        bhkDropdown.addEventListener("change", function () {
            addFloorPlanBtn.style.display = this.value ? "inline-block" : "none";
        });

        addFloorPlanBtn.addEventListener("click", function () {
            const bhk_type = bhkDropdown.value;
            if (!bhk_type) return;
            selectedType = getSelectedPropertyType();
            createFloorPlanBlock({ bhk_type: bhk_type, type: selectedType });
        });

        floorPlanWrapper.addEventListener("click", function (e) {
            if (e.target.classList.contains("remove-floor-plan")) {
                const button = e.target;
                const floorPlanId = button.getAttribute("data-id");

                // For new, unsaved plans – remove without AJAX
                if (!floorPlanId) {
                    button.closest(".floor-plan-block").remove();
                    return;
                }

                if (confirm("Are you sure you want to delete this floor plan?")) {
                    fetch(`/admin/delete_floor_plan/${floorPlanId}`, {
                        method: "DELETE",
                        headers: {
                            "Content-Type": "application/json",
                            "X-Requested-With": "XMLHttpRequest"
                        }
                    })
                        .then(response => {
                            if (!response.ok) throw new Error("Server error");
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                button.closest(".floor-plan-block").remove();
                            } else {
                                alert("Delete failed: " + (data.message || "Unknown error"));
                            }
                        })
                        .catch(error => {
                            console.error("Error deleting floor plan:", error);
                            alert("Something went wrong. Please try again.");
                        });
                }
            }
        });


        document.querySelector('a[href="#main_floor_plan"]').addEventListener("click", populateBHKDropdown);

        // Function to create floor plan block
        function createFloorPlanBlock(plan = {}) {
            const isPlot = plan.type === 'plot';
            const bhk = plan.bhk_type || '';
            const block = document.createElement("div");
            block.className = "floor-plan-block row border rounded p-3 my-2 position-relative";

            let html = `
                <h5 class="mb-3"><strong>${bhk} ${isPlot ? 'Plot Details' : 'Floor Plan'}</strong></h5>
                ${plan.id ? `<input type="hidden" name="floor_plans[${floorPlanIndex}][id]" value="${plan.id}">` : ''}
                <input type="hidden" name="floor_plans[${floorPlanIndex}][bhk]" value="${bhk}">
                <input type="hidden" name="floor_plans[${floorPlanIndex}][type]" value="${plan.type || selectedType}">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label>Price</label>
                        <input type="text" name="floor_plans[${floorPlanIndex}][price]" class="form-control" value="${plan.price || ''}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Saleable Area</label>
                        <input type="text" name="floor_plans[${floorPlanIndex}][saleable_area]" class="form-control" value="${plan.saleable_area || ''}">
                    </div>`;

            if (isPlot) {
                html += `
                    <div class="col-md-4 mb-2">
                        <label>Entrance Direction</label>
                        <input type="text" name="floor_plans[${floorPlanIndex}][entrance_direction]" class="form-control" value="${plan.entrance_direction || ''}">
                    </div>`;
            } else {
                html += `
                    <div class="col-md-4 mb-2">
                        <label>Carpet Area</label>
                        <input type="text" name="floor_plans[${floorPlanIndex}][carpet_area]" class="form-control" value="${plan.carpet_area || ''}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Efficiency</label>
                        <input type="text" name="floor_plans[${floorPlanIndex}][efficiency]" class="form-control" value="${plan.efficiency || ''}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Floor Height</label>
                        <input type="text" name="floor_plans[${floorPlanIndex}][floor_height]" class="form-control" value="${plan.floor_height || ''}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Bathrooms</label>
                        <input type="number" name="floor_plans[${floorPlanIndex}][bathroom_count]" class="form-control" value="${plan.bathroom_count || ''}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Balconies</label>
                        <input type="number" name="floor_plans[${floorPlanIndex}][balcony_count]" class="form-control" value="${plan.balcony_count || ''}">
                    </div>`;
            }

            html += `
                <div class="col-md-3 mb-2">
                    <label>Images</label>
                    <input type="file" name="floor_plans[${floorPlanIndex}][images][]" multiple class="form-control floorplan-image-input file-upload-check" accept="image/*">
                </div>
                <div class="col-md-1 mb-2">
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 remove-floor-plan"${plan.id ? `data-id="${plan.id}"` : ''}>
                            Remove
                        </button>
                </div>
            </div>`;

            block.innerHTML = html;

            // const imageInput = block.querySelector('.floorplan-image-input');
            // imageInput.addEventListener('change', function () {
            //     const maxSize = 1 * 1024 * 1024;
            //     for (let i = 0; i < this.files.length; i++) {
            //         if (this.files[i].size > maxSize) {
            //             alert(`"${this.files[i].name}" exceeds 1MB limit.`);
            //             this.value = '';
            //             break;
            //         }
            //     }
            // });

            floorPlanWrapper.prepend(block);
            floorPlanIndex++;
        }

        // Render existing floor plans on load
        existingFloorPlans.forEach(plan => createFloorPlanBlock(plan));
    });
</script>
<script>
  const startInput = document.getElementById('startPrice');
  const endInput = document.getElementById('endPrice');
  const startError = document.getElementById('startPriceError');
  const endError = document.getElementById('endPriceError');

  // Format to Indian numbering (e.g., 1,00,000)
  function formatToINR(num) {
    return num.toLocaleString('en-IN');
  }

  function validatePrices() {
    let rawStart = startInput.value.replace(/,/g, '');
    let rawEnd = endInput.value.replace(/,/g, '');

    let startVal = parseInt(rawStart) || 0;
    let endVal = parseInt(rawEnd) || 0;

    // Format while typing
    if (rawStart) startInput.value = formatToINR(startVal);
    if (rawEnd) endInput.value = formatToINR(endVal);

    // Start Price ≥ ₹1 Lakh (1,00,000)
    if (startVal < 100000) {
      startError.textContent = 'Starting Price must be at least ₹1 Lakh (₹1,00,000)';
    } else {
      startError.textContent = '';
    }

    // End Price must be > Start Price
    if (endVal && endVal <= startVal) {
      endError.textContent = 'Ending Price must be greater than Starting Price';
    } else {
      endError.textContent = '';
    }
  }

  startInput.addEventListener('input', validatePrices);
  endInput.addEventListener('input', validatePrices);
  window.addEventListener('DOMContentLoaded', validatePrices);
</script>
