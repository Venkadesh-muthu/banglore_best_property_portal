<main id="main" class="main">

    <div class="pagetitle">
        <h1>Property</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                <li class="breadcrumb-item active"><a href="properties">All property</a></li>
                <li class="breadcrumb-item active">Add property</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <ul class="nav nav-pills flex-wrap gap-2 justify-content-start mt-4">
                        <!-- Overview -->
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2 active <?= ($title == 'Add property') ? 'active' : '' ?>"
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
                            <a class="nav-link px-3 py-2" data-bs-toggle="tab" href="#main_developer">
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

    <form action="<?= base_url('admin/save-property') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="main_overview">
                <section class="section">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Property Details</h5>
                                    <?php $validation = session()->get('validation'); ?>

                                    <!-- Global Error Message -->
                                    <?php if (session()->getFlashdata('error')): ?>
                                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                                    <?php endif; ?>

                                    <!-- Success Message -->
                                    <?php if (session()->getFlashdata('success')): ?>
                                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                                    <?php endif; ?>
                                    <div class="row">
                                        <!-- Property Name -->
                                        <div class="col-6">
                                            <label for="propertyName" class="form-label">Property Name</label>
                                            <input type="text" class="form-control" id="propertyName" name="name"
                                                placeholder="e.g., Prestige Lakeside Habitat" required>
                                        </div>

                                        <!-- Location -->
                                        <div class="col-6">
                                            <label for="propertyLocation" class="form-label">Location</label>
                                            <input type="text" class="form-control" id="propertyLocation"
                                                name="location" placeholder="e.g., Whitefield, Bangalore">
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                        <label for="startPrice" class="form-label">Starting Price (₹)</label>
                                        <input type="text" class="form-control" id="startPrice" name="start_price" placeholder="e.g., 10000000">
                                        <div id="startPriceError" class="text-danger small mt-1"></div>
                                        </div>
                                        <div class="col-md-6">
                                        <label for="endPrice" class="form-label">Ending Price (₹)</label>
                                        <input type="text" class="form-control" id="endPrice" name="end_price" placeholder="e.g., 20000000">
                                        <div id="endPriceError" class="text-danger small mt-1"></div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <label class="form-label d-block">Property type</label>
                                            <select name="property_type" id="property_type" class="form-select">
                                                <option value="">Select type</option>
                                                <option value="apartment">Apartment</option>
                                                <option value="villa">Villa</option>
                                                <option value="plot">Plot</option>
                                            </select>

                                            <!-- Apartment type checkboxes -->
                                            <div id="apartmentTypes" class="mt-2" style="display: none;">
                                                <label class="form-label d-block">Apartment Type</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="aptStudio"
                                                        name="apartment_type[]" value="Studio">
                                                    <label class="form-check-label" for="aptStudio">Studio</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="apt1BHK"
                                                        name="apartment_type[]" value="1BHK">
                                                    <label class="form-check-label" for="apt1BHK">1 BHK</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="apt1_5BHK"
                                                        name="apartment_type[]" value="1.5BHK">
                                                    <label class="form-check-label" for="apt1_5BHK">1.5 BHK</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="apt2BHK"
                                                        name="apartment_type[]" value="2BHK">
                                                    <label class="form-check-label" for="apt2BHK">2 BHK</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="apt2_5BHK"
                                                        name="apartment_type[]" value="2.5BHK">
                                                    <label class="form-check-label" for="apt2_5BHK">2.5 BHK</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="apt3BHK"
                                                        name="apartment_type[]" value="3BHK">
                                                    <label class="form-check-label" for="apt3BHK">3 BHK</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="apt3_5BHK"
                                                        name="apartment_type[]" value="3.5BHK">
                                                    <label class="form-check-label" for="apt3_5BHK">3.5 BHK</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="apt4BHK"
                                                        name="apartment_type[]" value="4BHK">
                                                    <label class="form-check-label" for="apt4BHK">4 BHK</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="apt4_5BHK"
                                                        name="apartment_type[]" value="4.5BHK">
                                                    <label class="form-check-label" for="apt4_5BHK">4.5 BHK</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="apt5BHK"
                                                        name="apartment_type[]" value="5BHK">
                                                    <label class="form-check-label" for="apt5BHK">5 BHK</label>
                                                </div>
                                            </div>

                                            <!-- Villa type checkboxes -->
                                            <div id="villaTypes" class="mt-2" style="display: none;">
                                                <label class="form-label d-block">Villa Type</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="villa3BHK"
                                                        name="villa_type[]" value="3BHK">
                                                    <label class="form-check-label" for="villa3BHK">3 BHK</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="villa3_5BHK"
                                                        name="villa_type[]" value="3.5BHK">
                                                    <label class="form-check-label" for="villa3_5BHK">3.5 BHK</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="villa4BHK"
                                                        name="villa_type[]" value="4BHK">
                                                    <label class="form-check-label" for="villa4BHK">4 BHK</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="villa4_5BHK"
                                                        name="villa_type[]" value="4.5BHK">
                                                    <label class="form-check-label" for="villa4_5BHK">4.5 BHK</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="villa5BHK"
                                                        name="villa_type[]" value="5BHK">
                                                    <label class="form-check-label" for="villa5BHK">5 BHK</label>
                                                </div>
                                            </div>

                                            <div id="plotInput" class="mt-2" style="display: none;">
                                                <label class="form-label d-block">Plot Sizes</label>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="plot30x40"
                                                        name="plot_type[]" value="30 X 40">
                                                    <label class="form-check-label" for="plot30x40">30 X 40</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="plot30x50"
                                                        name="plot_type[]" value="30 X 50">
                                                    <label class="form-check-label" for="plot30x50">30 X 50</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="plot40x60"
                                                        name="plot_type[]" value="40 X 60">
                                                    <label class="form-check-label" for="plot40x60">40 X 60</label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                        <label for="property_videos" class="form-label">Videos (Max 2)</label>
                                        <input 
                                            type="file" 
                                            class="form-control file-upload-check"
                                            name="property_videos[]" 
                                            id="property_videos" 
                                            multiple 
                                            accept="video/*"
                                            onchange="limitPropertyVideos(this)">
                                        <small class="text-muted">You can upload up to 2 videos only.</small>
                                    </div>

                                    </div>
                                    <div class="row mt-3">
                                        <!-- Possession Date -->
                                        <div class="col-md-6">
                                            <label for="possessionDate" class="form-label">Possession Date</label>
                                            <input type="month" class="form-control" id="possessionDate"
                                                name="possession_date"
                                                value="<?= old('possession_date', date('Y-m')) ?>">
                                        </div>

                                        <!-- Image Upload -->
                                        <div class="col-md-6">
                                            <label for="property_images" class="form-label">Images</label>
                                            <input type="file" class="form-control file-upload-check"
                                                name="property_images[]" id="property_images" multiple accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="tab-pane fade" id="main_review">
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Review Details</h5>
                            <div class="row g-3 review-form">

                                <!-- Land Area -->
                                <div class="col-md-3">
                                    <b class="form-label">Land Area (Acres)</b>
                                    <input type="hidden" name="label_land_area" value="Land Area">
                                    <input type="text" class="form-control" id="land_area" name="land_area"
                                        placeholder="Acres">
                                    <input type="text" class="form-control mt-2" id="avg_land_area" name="avg_land_area"
                                        placeholder="Avg Acres">
                                </div>

                                <!-- Clubhouse Area -->
                                <div class="col-md-3">
                                    <b class="form-label">Clubhouse Area (Sqft)</b>
                                    <input type="hidden" name="label_clubhouse_area" value="Clubhouse Area">
                                    <input type="text" class="form-control" id="clubhouse_area" name="clubhouse_area"
                                        placeholder="Sqft">
                                    <input type="text" class="form-control mt-2" id="avg_clubhouse_sqft"
                                        name="avg_clubhouse_sqft" placeholder="Avg Sqft">
                                </div>

                                <!-- Park Area -->
                                <div class="col-md-3">
                                    <b class="form-label">Park Area (Acres)</b>
                                    <input type="hidden" name="label_park_area" value="Park Area">
                                    <input type="text" class="form-control" id="park_area" name="park_area"
                                        placeholder="Acres">
                                    <input type="text" class="form-control mt-2" id="avg_park_area" name="avg_park_area"
                                        placeholder="Avg Acres">
                                </div>

                                <!-- Open Area -->
                                <div class="col-md-3">
                                    <b class="form-label">Open Area (%)</b>
                                    <input type="hidden" name="label_open_area" value="Open Area">
                                    <input type="text" class="form-control" id="open_area" name="open_area"
                                        placeholder="%">
                                    <input type="text" class="form-control mt-2" id="avg_open_area" name="avg_open_area"
                                        placeholder="Avg %">
                                </div>

                                <!-- Units -->
                                <div class="col-md-3">
                                    <b class="form-label">Units</b>
                                    <input type="hidden" name="label_units" value="Units">
                                    <input type="text" class="form-control" id="units" name="units" placeholder="Units">
                                    <input type="text" class="form-control mt-2" id="avg_units" name="avg_units"
                                        placeholder="Avg Units">
                                </div>

                                <!-- Price Per Sq.Ft. -->
                                <div class="col-md-3">
                                    <b class="form-label">Price per Sq.Ft.</b>
                                    <input type="hidden" name="label_price_per_sqft" value="Price Per Sq.Ft.">
                                    <input type="text" class="form-control" id="price_per_sqft" name="price_per_sqft"
                                        placeholder="Rs/Sqft">
                                    <input type="text" class="form-control mt-2" id="avg_price_per_sqft"
                                        name="avg_price_per_sqft" placeholder="Avg Rs/Sqft">
                                </div>

                                <!-- Clubhouse Factor -->
                                <div class="col-md-3">
                                    <b class="form-label">Clubhouse Factor (Sqft/Unit)</b>
                                    <input type="hidden" name="label_clubhouse_factor" value="Clubhouse Factor">
                                    <input type="text" class="form-control" id="clubhouse_factor"
                                        name="clubhouse_factor" placeholder="Sqft/Unit">
                                    <input type="text" class="form-control mt-2" id="avg_clubhouse_factor"
                                        name="avg_clubhouse_factor" placeholder="Avg Sqft/Unit">
                                </div>

                                <!-- Metro Distance -->
                                <div class="col-md-3">
                                    <b class="form-label">Closest Metro (Km)</b>
                                    <input type="hidden" name="label_metro_distance" value="Metro Distance">
                                    <input type="text" class="form-control" id="metro_distance" name="metro_distance"
                                        placeholder="Km">
                                    <input type="text" class="form-control mt-2" id="avg_metro_distance"
                                        name="avg_metro_distance" placeholder="Avg Km">
                                </div>

                                <!-- Approach Road -->
                                <div class="col-md-3">
                                    <b class="form-label">Road Width (m)</b>
                                    <input type="hidden" name="label_road_width" value="Approach Road Width">
                                    <input type="text" class="form-control" id="road_width" name="road_width"
                                        placeholder="Meters">
                                    <input type="text" class="form-control mt-2" id="avg_road_width"
                                        name="avg_road_width" placeholder="Avg Meters">
                                </div>

                                <!-- Unit Density -->
                                <div class="col-md-3">
                                    <b class="form-label">Unit Density (Units/Acre)</b>
                                    <input type="hidden" name="label_unit_density" value="Unit Density">
                                    <input type="text" class="form-control" id="unit_density" name="unit_density"
                                        placeholder="Units/Acre">
                                    <input type="text" class="form-control mt-2" id="avg_unit_density"
                                        name="avg_unit_density" placeholder="Avg Units/Acre">
                                </div>

                            </div>

                        </div>
                    </div>
                </section>
            </div>
            <div class="tab-pane fade" id="main_master_plan">
                <section class="section">
                    <div class="row g-3">

                        <!-- Master Plan Image Upload Card -->
                        <div class="card mt-4">
                            <div class="card-body">
                                <h5 class="card-title">Upload Master Plan Images</h5>
                                <div class="mb-3">
                                    <label for="masterPlanImages" class="form-label">Choose Images</label>
                                    <input class="form-control file-upload-check" type="file" name="master_plan_image[]"
                                        id="masterPlanImages" accept="image/*" multiple>
                                </div>
                            </div>
                        </div><!-- End card -->
                    </div><!-- End row -->
                </section><!-- End section -->
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
                                        <?php foreach (['Pet Park', 'Supermarket', 'Pharmacy/Clinic', 'Library', 'Sauna', 'Amphitheatre', 'Swimming Pool', 'Gym - Indoor', 'Gym - Outdoor', 'Cafe/Restaurant', 'Jacuzzi', 'Kids Play Area', 'Salon', 'Play School', 'Heated Pool'] as $item): ?>
                                            <div class="col-md-4 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check me-2">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="lifestyle_amenities[]" value="<?= $item ?>"
                                                            id="lifestyle_<?= md5($item) ?>">
                                                        <label class="form-check-label"
                                                            for="lifestyle_<?= md5($item) ?>"><?= $item ?></label>
                                                    </div>
                                                    <!-- <select class="form-select form-select-sm ms-auto"
                                                        name="lifestyle_rare[<?= $item ?>]" style="width: 100px;">
                                                        <option value="">Normal</option>
                                                        <option value="RARE">RARE</option>
                                                    </select> -->
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- Sports Amenities -->
                                <div class="tab-pane fade" id="pills-sports" role="tabpanel">
                                    <div class="row">
                                        <?php foreach (['Running Track', 'Basketball', 'Badminton', 'Cricket Pitch', 'Cricket Ground', 'Football Ground', 'Squash', 'Skating', 'Lawn Tennis', 'Volleyball Net'] as $item): ?>
                                            <div class="col-md-4 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check me-2">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="sports_amenities[]" value="<?= $item ?>"
                                                            id="sports_<?= md5($item) ?>">
                                                        <label class="form-check-label"
                                                            for="sports_<?= md5($item) ?>"><?= $item ?></label>
                                                    </div>
                                                    <!-- <select class="form-select form-select-sm ms-auto"
                                                        name="sports_rare[<?= $item ?>]" style="width: 100px;">
                                                        <option value="">Normal</option>
                                                        <option value="RARE">RARE</option>
                                                    </select> -->
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- Natural Amenities -->
                                <div class="tab-pane fade" id="pills-natural" role="tabpanel">
                                    <div class="row">
                                        <?php foreach (['Lake', 'Forest', 'Army Land', 'Mountain/Hill', 'Golf Course', 'Park Area'] as $item): ?>
                                            <div class="col-md-4 mb-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="form-check me-2">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="natural_amenities[]" value="<?= $item ?>"
                                                            id="natural_<?= md5($item) ?>">
                                                        <label class="form-check-label"
                                                            for="natural_<?= md5($item) ?>"><?= $item ?></label>
                                                    </div>
                                                    <!-- <select class="form-select form-select-sm ms-auto"
                                                        name="natural_rare[<?= $item ?>]" style="width: 100px;">
                                                        <option value="">Normal</option>
                                                        <option value="RARE">RARE</option>
                                                    </select> -->
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- Specifications -->
                                <div class="tab-pane fade" id="pills-spec" role="tabpanel">
                                    <!-- Flooring -->
                                    <h6 class="mb-3 mt-3">🧱 Flooring</h6>
                                    <div class="row">
                                        <?php
                                        $flooring = [
                                            'Living Room' => 'Vitrified',
                                            'Bedroom' => 'Vitrified',
                                            'Master Bedroom' => 'Vitrified',
                                            'Kitchen' => 'Ceramic Flooring + Wall Tile',
                                            'Toilets' => 'Ceramic Flooring + Wall Tile'
                                        ];
                            foreach ($flooring as $room => $default): ?>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label"><?= $room ?></label>
                                                <input type="text" name="specifications[flooring][<?= $room ?>]"
                                                    class="form-control" value="<?= $default ?>">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <!-- Doors & Windows -->
                                    <h6 class="mb-3 mt-4">🚪 Doors & Windows</h6>
                                    <div class="row">
                                        <?php
                            $doors = [
                                'Toilets' => 'Engineered Wood',
                                'Balcony Door' => 'UPVC Sliding Door',
                                'Window' => 'UPVC Sliding Door',
                                'Main Door' => 'Polished Teak Wood',
                                'Internal Door' => 'Timber With Both Side Laminated'
                            ];
                            foreach ($doors as $part => $default): ?>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label"><?= $part ?></label>
                                                <input type="text" name="specifications[doors][<?= $part ?>]"
                                                    class="form-control" value="<?= $default ?>">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <!-- Paint -->
                                    <h6 class="mb-3 mt-4">🎨 Paint</h6>
                                    <div class="row">
                                        <?php
                            $paint = [
                                'Internal Paint' => 'Plastic Emulsion',
                                'External Paint' => 'Acrylic Emulsion'
                            ];
                            foreach ($paint as $type => $default): ?>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label"><?= $type ?></label>
                                                <input type="text" name="specifications[paint][<?= $type ?>]"
                                                    class="form-control" value="<?= $default ?>">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                    <!-- Others -->
                                    <h6 class="mb-3 mt-4">🔧 Others</h6>
                                    <div class="row">
                                        <?php
                            $others = [
                                'Construction Technology' => 'RCC Framed Structure',
                                'Sanitary Fittings' => 'Chromium Plated'
                            ];
                            foreach ($others as $type => $default): ?>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label"><?= $type ?></label>
                                                <input type="text" name="specifications[others][<?= $type ?>]"
                                                    class="form-control" value="<?= $default ?>">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
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
                            <h5 class="card-title">Legal Approvals</h5>

                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                            <?php endif; ?>

                            <div class="row">
                                <?php
                                $legalApprovals = [
                                    ['title' => 'Khata', 'approved_by' => 'BBMP', 'status' => 'Approved'],
                                    ['title' => 'Development Plan', 'approved_by' => 'BDA', 'status' => 'Approved'],
                                    ['title' => 'Water NOC', 'approved_by' => 'BWSSB', 'status' => 'Approved'],
                                    ['title' => 'Pollution Board NOC', 'approved_by' => 'MOEF', 'status' => 'Approved'],
                                    ['title' => 'Building Plan', 'approved_by' => 'BBMP', 'status' => 'Approved'],
                                    ['title' => 'Height NOC', 'approved_by' => 'No approval yet', 'status' => 'Not Available'],
                                    ['title' => 'Fire NOC', 'approved_by' => 'KSFESD', 'status' => 'Approved'],
                                ];

                            foreach ($legalApprovals as $index => $item): ?>
                                    <div class="row mb-4 border-bottom pb-3">
                                        <div class="col-md-4">
                                            <label class="form-label">Approval Title</label>
                                            <input type="text" class="form-control"
                                                name="legal_approvals[<?= $index ?>][title]" value="<?= $item['title'] ?>">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Approved By</label>
                                            <input type="text" class="form-control"
                                                name="legal_approvals[<?= $index ?>][approved_by]"
                                                value="<?= $item['approved_by'] ?>">
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
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="tab-pane fade" id="main_micro_market" role="tabpanel">
                <div class="section">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Micro Market Documents</h5>
                            <div class="row g-4">
                                <?php
                            // Default micro market document entries
                            $microMarketDocuments = $microMarketDocuments ?? [
                                [
                                    'title' => 'City Development Plan',
                                    'description' => 'Used to identify land types, flood risks, etc.',
                                    'link_text' => 'Unlock & Analyze CDP',
                                    'link_url' => '#',
                                ],
                                [
                                    'title' => 'Marketing Brochure',
                                    'description' => 'Everything about the project from builder\'s view',
                                    'link_text' => 'No Document',
                                    'link_url' => '#',
                                ],
                                [
                                    'title' => 'Legal Opinion',
                                    'description' => 'Litigations by builder. Not a clean title doc.',
                                    'link_text' => 'See Document',
                                    'link_url' => '#',
                                ],
                                [
                                    'title' => 'Development Rights',
                                    'description' => 'Terms between landowner & builder.',
                                    'link_text' => 'See Document',
                                    'link_url' => '#',
                                ],
                            ];

                            // Default section info
                            $microMarketSection = $microMarketSection ?? [
                                'title' => 'Gunjur',
                                'description' => 'Gunjur is a rapidly developing locality in South Bengaluru, known for its residential properties and growing infrastructure. With improved connectivity to major roads and tech parks...',
                            ];
                            ?>

                                <?php for ($i = 0; $i < 4; $i++):
                                    $doc = $microMarketDocuments[$i] ?? ['title' => '', 'description' => '', 'link_text' => '', 'link_url' => '', 'icon' => ''];
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
                                                <label class="form-label">Documents</label>
                                                <input type="file" name="documents[<?= $i ?>][image]"
                                                    class="form-control file-upload-check">
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
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="section_title" class="form-control"
                                        value="<?= esc($microMarketSection['title'] ?? '') ?>">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Description</label>
                                    <textarea name="section_description" class="form-control"
                                        rows="4"><?= esc($microMarketSection['description'] ?? '') ?></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div> -->
            <button type="submit" class="btn btn-success">Save</button>
            <a href="properties"><button type="button" class="btn btn-danger">Cancel</button></a>
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
    document.addEventListener('DOMContentLoaded', function () {
        const propertyTypeSelect = document.getElementById('property_type');
        const apartmentDiv = document.getElementById('apartmentTypes');
        const villaDiv = document.getElementById('villaTypes');
        const plotDiv = document.getElementById('plotInput');

        function togglePropertyTypeFields() {
            const selectedType = propertyTypeSelect.value;

            // Hide all by default
            apartmentDiv.style.display = 'none';
            villaDiv.style.display = 'none';
            plotDiv.style.display = 'none';

            // Show based on selection
            if (selectedType === 'apartment') {
                apartmentDiv.style.display = 'block';
            } else if (selectedType === 'villa') {
                villaDiv.style.display = 'block';
            } else if (selectedType === 'plot') {
                plotDiv.style.display = 'block';
            }
        }

        // Initial trigger (in case of edit form with pre-selected type)
        togglePropertyTypeFields();

        // Add change listener
        propertyTypeSelect.addEventListener('change', togglePropertyTypeFields);
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const bhkDropdown = document.getElementById("bhkDropdown");
        const addFloorPlanBtn = document.getElementById("addFloorPlanBtn");
        const floorPlanWrapper = document.getElementById("floorPlanWrapper");

        let selectedType = ''; // apartment, villa, plot
        let floorPlanIndex = 0;

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
                document.querySelectorAll('input[name="apartment_type[]"]:checked').forEach(chk => {
                    bhkOptions.push(chk.value);
                });
            }

            if (selectedType === 'villa') {
                document.querySelectorAll('input[name="villa_type[]"]:checked').forEach(chk => {
                    bhkOptions.push(chk.value);
                });
            }

            if (selectedType === 'plot') {
                document.querySelectorAll('input[name="plot_type[]"]:checked').forEach(chk => {
                    bhkOptions.push(chk.value);
                });
            }

            bhkOptions.forEach(opt => {
                const option = document.createElement("option");
                option.value = opt;
                option.text = opt;
                bhkDropdown.appendChild(option);
            });
        }
        // Prevent tab switch if type not selected
        document.querySelector('a[href="#main_floor_plan"]').addEventListener('show.bs.tab', function (e) {
            const selected = getSelectedPropertyType();
            if (!selected) {
                e.preventDefault();
                alert("Please select a property type before accessing the Floor Plan.");
            }
        });
        // Show Add Floor Plan button only if a BHK type is selected
        bhkDropdown.addEventListener("change", function () {
            addFloorPlanBtn.style.display = this.value ? "inline-block" : "none";
        });

        // Add floor plan block dynamically
        addFloorPlanBtn.addEventListener("click", function () {
            const bhk = bhkDropdown.value;
            if (!bhk) return;

            const block = document.createElement("div");
            block.className = "floor-plan-block row border rounded p-3 my-2 position-relative";

            if (selectedType === 'plot') {
                // Only show limited fields for plot
                block.innerHTML = `
                    <h5 class="mb-3"><strong>${bhk} Plot Details</strong></h5>
                    <input type="hidden" name="floor_plans[${floorPlanIndex}][bhk]" value="${bhk}">
                    <input type="hidden" name="floor_plans[${floorPlanIndex}][type]" value="plot">

                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label>Price</label>
                            <input type="text" name="floor_plans[${floorPlanIndex}][price]" class="form-control">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Saleable Area</label>
                            <input type="text" name="floor_plans[${floorPlanIndex}][saleable_area]" class="form-control">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Entrance Direction</label>
                            <input type="text" name="floor_plans[${floorPlanIndex}][entrance_direction]" class="form-control">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label>Images</label>
                            <input type="file" name="floor_plans[${floorPlanIndex}][images][]" multiple class="form-control file-upload-check" accept="image/*">
                        </div>
                        <div class="col-md-1 mb-2">
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 remove-floor-plan">Remove</button>
                        </div>
                    </div>
                `;
            } else {
                // Full fields for apartment/villa
                block.innerHTML = `
                    <h5 class="mb-3"><strong>${bhk} Floor Plan</strong></h5>
                    <input type="hidden" name="floor_plans[${floorPlanIndex}][bhk]" value="${bhk}">
                    <input type="hidden" name="floor_plans[${floorPlanIndex}][type]" value="${selectedType}">

                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label>Price</label>
                            <input type="text" name="floor_plans[${floorPlanIndex}][price]" class="form-control">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Saleable Area</label>
                            <input type="text" name="floor_plans[${floorPlanIndex}][saleable_area]" class="form-control">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Carpet Area</label>
                            <input type="text" name="floor_plans[${floorPlanIndex}][carpet_area]" class="form-control">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Efficiency</label>
                            <input type="text" name="floor_plans[${floorPlanIndex}][efficiency]" class="form-control">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Floor Height</label>
                            <input type="text" name="floor_plans[${floorPlanIndex}][floor_height]" class="form-control">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Bathrooms</label>
                            <input type="number" name="floor_plans[${floorPlanIndex}][bathroom_count]" class="form-control">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label>Balconies</label>
                            <input type="number" name="floor_plans[${floorPlanIndex}][balcony_count]" class="form-control">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label>Images</label>
                            <input type="file" name="floor_plans[${floorPlanIndex}][images][]" multiple class="form-control floorplan-image-input file-upload-check" accept="image/*">
                        </div>
                       <div class="col-md-1 mb-2">
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 remove-floor-plan">Remove</button>
                        </div>
                    </div>
                `;
            }
            // After floorPlanWrapper.appendChild(block);
            block.querySelector('.floorplan-image-input').addEventListener('change', function (e) {
                const maxSize = 1 * 1024 * 1024; // 1MB
                for (let i = 0; i < this.files.length; i++) {
                    if (this.files[i].size > maxSize) {
                        alert(`"${this.files[i].name}" exceeds 1MB limit.`);
                        this.value = ''; // Clear selection
                        break;
                    }
                }
            });

            floorPlanWrapper.prepend(block);
            floorPlanIndex++;
        });

        // Remove floor plan
        floorPlanWrapper.addEventListener("click", function (e) {
            if (e.target.classList.contains("remove-floor-plan")) {
                e.target.closest(".floor-plan-block").remove();
            }
        });

        // Populate dropdown when floor plan tab is clicked
        document.querySelector('a[href="#main_floor_plan"]').addEventListener("click", populateBHKDropdown);
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
<script>
function limitPropertyVideos(input) {
    if (input.files.length > 2) {
        alert('You can upload a maximum of 2 videos.');
        input.value = '';
    }
}
</script>
