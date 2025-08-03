<style>
    .bg-light {
        background-color: #f5f5f5 !important;
    }
</style>
<!-- Hero Section with Breadcrumb -->
<?php
$bgImage = !empty($images) && count($images) > 0
    ? base_url('uploads/properties/' . $images[0]['image'])
    : base_url('uploads/properties/default.jpg');
?>

<div class="hero page-inner overlay"
    style="background-image: url('<?= $bgImage ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-9 text-center mt-5">
                <h1 class="heading" data-aos="fade-up">
                    <?= esc($property['name']) ?>
                </h1>

                <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                    <ol class="breadcrumb text-center justify-content-center">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('properties') ?>">Properties</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">
                            <?= esc($property['name']) ?>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Navigation Tabs -->
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="overflow-auto">
                    <ul class="nav nav-pills flex-nowrap gap-2 justify-content-center" style="min-width: max-content;">
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2 active" data-bs-toggle="tab" href="#main_overview">
                                <i class="bi bi-person me-1"></i> Overview
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" data-bs-toggle="tab" href="#main_master_plan">
                                <i class="bi bi-map me-1"></i> Master Plan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" data-bs-toggle="tab" href="#main_floor_plan"><i
                                    class="bi bi-layout-split me-1"></i> Floor
                                Plans</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" data-bs-toggle="tab" href="#main_amenities"><i
                                    class="bi bi-gem me-1"></i>
                                Amenities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" data-bs-toggle="tab" href="#main_connectivity">
                                <i class="bi bi-diagram-3 me-1"></i> Connectivity
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" data-bs-toggle="tab" href="#mani_legal"><i
                                    class="bi bi-shield-check me-1"></i> Legal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" data-bs-toggle="tab" href="#main_gallery">
                                <i class="bi bi-images me-1"></i> Gallery
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" data-bs-toggle="tab" href="#main_developer"><i
                                    class="bi bi-person-badge me-1"></i> Developer</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link px-3 py-2" data-bs-toggle="tab" href="#main_review">
                                <i class="bi bi-question-circle me-1"></i> Review
                            </a>
                        </li> -->

                        <!-- <li class="nav-item">
                            <a class="nav-link px-3 py-2" data-bs-toggle="tab" href="#guided_home_buying">
                                <i class="bi bi-house me-1"></i> Guided Home Buying
                            </a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a class="nav-link px-3 py-2" href="#"><i class="bi bi-exclamation-circle me-1"></i>
                                Challenges</a>
                        </li> -->

                        <!-- <li class="nav-item">
                            <a class="nav-link px-3 py-2" data-bs-toggle="tab" href="#main_micro_market"><i
                                    class="bi bi-geo-alt me-1"></i> Micro Market</a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a class="nav-link px-3 py-2" href="#"><i class="bi bi-emoji-smile me-1"></i> Peace of
                                Mind</a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a class="nav-link px-3 py-2" data-bs-toggle="tab" href="#main_faq"><i
                                    class="bi bi-question-circle me-1"></i> F.A.Q</a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Property Overview Tab -->
<div class="container tab-content mb-5">
    <div class="tab-pane fade show active" id="main_overview">
        <div class="container py-4">
            <div class="row">
                <h2 class="fw-bold text-primary mb-2 text-center"><?= esc($property['name']) ?></h2>
                <p class="text-muted fs-6 mb-2 text-center"><?= esc($property['location']) ?></p>
                <p class="text-dark lh-lg mt-2">
                    This <strong><?= esc($property['property_type']) ?></strong> property
                    (<?= esc($property['property_type_detail']) ?>) is located in a prime area of
                    <strong><?= esc($property['location']) ?></strong>, with a price range starting from
                    <span class="text-success fw-semibold">₹<?= $property['start_price'] ?></span> up to
                    <span class="text-success fw-semibold">₹<?= $property['end_price'] ?></span>.
                    The expected possession date is <strong><?= esc($property['possession_date']) ?></strong>.
                    This project is currently rated <strong><?= esc($property['rating'] ?? 'N/A') ?>/5</strong>
                    based on
                    various factors.
                </p>
                <div class="col-md-12 mb-4">
                    <div class="img-property-slide-wrap">
                        <div class="img-property-slide">
                            <?php if (!empty($images) && count($images) > 0): ?>
                                <?php foreach ($images as $img): ?>
                                    <img src="<?= base_url('uploads/properties/' . $img['image']) ?>"
                                        class="img-fluid rounded shadow-sm mb-2 preview-image" alt="Property Image"
                                        style="cursor:pointer;">
                                <?php endforeach; ?>
                            <?php else: ?>
                                <img src="<?= base_url('uploads/properties/default.jpg') ?>"
                                    class="img-fluid rounded shadow-sm" alt="No Image Available">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container py-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-dark mb-0">Review</h2>
                    <p class="text-muted"><?= esc($property['name']) ?></p>
                </div>
                <p class="text-muted mb-0 small text-end">
                    Comparing with the average of all properties in <strong><?= esc($property['location']) ?></strong>
                </p>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                <?php
                $review_data = [
                    ['Land Area', 'Acres', $property['land_area'], $property['avg_land_area']],
                    ['Clubhouse Area', 'sqft', $property['clubhouse_area'], $property['avg_clubhouse_area']],
                    ['Park Area', 'Acres', $property['park_area'], $property['avg_park_area']],
                    ['Open Area', '%', $property['open_area'], $property['avg_open_area']],
                    ['Units', '', $property['units'], $property['avg_units']],
                    ['Price Per Sq.Ft.', '₹', $property['price_per_sqft'], $property['avg_price_per_sqft']],
                    ['Clubhouse Factor', 'sqft / unit', $property['clubhouse_factor'], $property['avg_clubhouse_factor']],
                    ['Closest Metro', 'km', $property['metro_distance'], $property['avg_metro_distance'], true],
                    ['Approach Road', 'meters', $property['road_width'], $property['avg_road_width']],
                    ['Unit Density', 'units/acre', $property['unit_density'], $property['avg_unit_density']],
                ];

foreach ($review_data as $data) {
    [$title, $unit, $value, $avg, $lower_is_better] = array_pad($data, 5, false);

    $emoji = 'confused.png'; // default
    if (is_numeric($value) && is_numeric($avg)) {
        $diff = ($value - $avg);
        $percent_diff = $avg > 0 ? ($diff / $avg) * 100 : 0;

        if ($lower_is_better) {
            $emoji = $value < $avg * 0.95 ? 'smile.png' : ($value > $avg * 1.05 ? 'sad-face.png' : 'confused.png');
        } else {
            $emoji = $percent_diff > 5 ? 'smile.png' : ($percent_diff < -5 ? 'sad-face.png' : 'confused.png');
        }
    }

    $img_url = base_url('images/' . $emoji);
    ?>
                    <div class="col">
                        <div class="bg-white p-4 text-center shadow-sm rounded-4 h-100">
                            <img src="<?= $img_url ?>" alt="emoji" class="mb-2" style="width: 36px; height: 36px;">
                            <h4 class="fw-bold text-dark mb-1"><?= $unit . ' ' . esc($value) ?></h4>
                            <p class="text-muted small mb-0"><?= esc($title) ?></p>
                            <small class="text-muted">Avg is: <?= $unit . ' ' . esc($avg) ?></small>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <div class="d-flex flex-wrap gap-3 mt-5">
                <a href="#insights" class="btn btn-dark px-4 py-2">See Property Insights</a>
                <a href="#compare" class="btn btn-outline-dark px-4 py-2">Compare With Peers</a>
            </div>
        </div>
    </div>
<!-- Lightbox Modal -->
<div id="lightbox" class="lightbox">
    <span class="lightbox-close" onclick="closeLightbox()">×</span>
    <img id="lightbox-img" src="" alt="Full Image">
</div>
<div class="tab-pane fade" id="main_master_plan">
    <div class="section">
        <div class="container py-4">
            <h2 class="mb-4 text-center"><?= esc($property['name']) ?></h2>
            <div class="row justify-content-center">
                <div class="col-lg-8 mb-4">
                    <div class="img-property-slide-wrap">
                        <div class="img-property-slide d-flex flex-wrap justify-content-center gap-3">
                            <?php if (!empty($master_plan_image) && count($master_plan_image) > 0): ?>
                                <?php foreach ($master_plan_image as $plan_img): ?>
                                    <div class="image-box">
                                        <img src="<?= base_url('uploads/master_plans/' . $plan_img['master_plan_image']) ?>"
                                            class="img-fluid rounded shadow-sm preview-image" alt="Master Plan Image"
                                            style="max-width: 100%; height: auto; cursor: pointer;">
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <img src="<?= base_url('uploads/master_plans/default_master_plan.jpg') ?>"
                                    class="img-fluid rounded shadow-sm" alt="No Master Plan Available"
                                    style="max-width: 100%; height: auto;">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tab-pane fade show" id="main_floor_plan">
    <div class="section bg-body-tertiary py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">
                <?= esc($property['name']) ?> – Floor Plans
            </h2>

            <?php
            $groupedPlans = [];
foreach ($floor_plans as $plan) {
    $type = $plan['bhk_type'];
    $size = $plan['saleable_area'];
    if (!isset($groupedPlans[$type])) {
        $groupedPlans[$type] = [];
    }
    if (!in_array($size, $groupedPlans[$type])) {
        $groupedPlans[$type][] = $size;
    }
}
?>

            <!-- Summary Section -->
            <div class="bg-opacity-75 rounded-4 mb-5">
                <h4 class="text-center text-dark fw-bold mb-4">
                    🏢 Available Floor Plan Configurations
                </h4>
                <div class="mb-4">
                    <p class="text-dark lh-lg">
                        <?= esc($property['name']) ?> offers
                        <?php
            $types = array_keys($groupedPlans);
$lastType = array_pop($types);
echo implode(', ', $types) . ' and ' . $lastType;
?>.
                        <?php foreach ($groupedPlans as $type => $sizes): ?>
                            <?= esc($type) ?> has <?= count($sizes) ?> configuration<?= count($sizes) > 1 ? 's' : '' ?>:
                            <?php
    $lastSize = array_pop($sizes);
                            echo implode(', ', $sizes) . ' and ' . $lastSize;
                            ?> sq.ft.;
                        <?php endforeach; ?>
                    </p>
                </div>
                <div class="row g-3">
                    <?php foreach ($groupedPlans as $type => $sizes): ?>
                        <div class="col-md-6 col-lg-3">
                            <div class="d-flex align-items-start p-3 bg-white rounded-3 shadow-sm h-75">
                                <div>
                                    <div class="fw-semibold text-primary-emphasis fs-6 mb-1"><?= esc($type) ?></div>
                                    <div class="text-muted small mb-2">
                                        <?= count($sizes) ?> configuration<?= count($sizes) > 1 ? 's' : '' ?>
                                    </div>
                                    <div class="d-flex flex-wrap gap-2">
                                        <?php foreach ($sizes as $size): ?>
                                            <span class="badge bg-primary-subtle text-primary-emphasis px-2 py-1 small">
                                                <?= esc($size) ?> sq.ft
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>


                <!-- Filters -->
                <div class="row mb-4 g-4">
                    <div class="col-md-6">
                        <label for="filterType" class="form-label fw-semibold text-dark">Filter by BHK Type</label>
                        <select class="form-select shadow-sm" id="filterType">
                            <?php
                            $types = array_unique(array_column($floor_plans, 'bhk_type'));
foreach ($types as $index => $type): ?>
                                <option value="<?= esc($type) ?>" <?= $index === 0 ? 'selected' : '' ?>>
                                    <?= esc($type) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="filterSize" class="form-label fw-semibold text-dark">Filter by Saleable
                            Area</label>
                        <select class="form-select shadow-sm" id="filterSize">
                            <?php
$sizes = array_unique(array_column($floor_plans, 'saleable_area'));
foreach ($sizes as $index => $size): ?>
                                <option value="<?= esc($size) ?>" <?= $index === 0 ? 'selected' : '' ?>>
                                    <?= esc($size) ?> sq.ft
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Floor Plan Cards -->
                <div class="row gy-5" id="floorPlanList">
                    <?php foreach ($floor_plans as $plan): ?>
                        <div class="col-12 floor-plan-item" data-type="<?= esc($plan['bhk_type']) ?>"
                            data-size="<?= esc($plan['saleable_area']) ?>">
                            <div class="card border-0 rounded-4 shadow-lg overflow-hidden">
                                <div class="row g-0 align-items-center">
                                    <!-- Image -->
                                    <div
                                        class="col-md-5 bg-body-secondary d-flex align-items-center justify-content-center p-4">
                                        <?php if (!empty($plan['images'])): ?>
                                            <img src="<?= base_url('uploads/floor_plans/' . esc($plan['images'][0]['image'])) ?>"
                                                class="img-fluid rounded-3 border" alt="Floor Plan Image">
                                        <?php else: ?>
                                            <div class="text-center text-muted">No image available</div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Details -->
                                    <div class="col-md-7 p-4">
                                        <h4 class="fw-bold text-primary mb-4">
                                            <?= esc($plan['bhk_type']) ?> @ ₹<?= $plan['price'] ?? 0, 2 ?> Cr
                                        </h4>
                                        <div class="row gy-3 gx-4">
                                            <div class="col-6 col-md-4">
                                                <h6>Saleable Area</h6>
                                                <div><?= esc($plan['saleable_area']) ?> Sq.Ft</div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <h6>Carpet Area</h6>
                                                <div><?= esc($plan['carpet_area']) ?> Sq.Ft</div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <h6>Efficiency</h6>
                                                <div><?= esc($plan['efficiency']) ?>%</div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <h6>Floor Height</h6>
                                                <div><?= esc($plan['floor_height']) ?> M</div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <h6>Bathrooms</h6>
                                                <div><?= esc($plan['bathroom_count']) ?></div>
                                            </div>
                                            <div class="col-6 col-md-4">
                                                <h6>Balconies</h6>
                                                <div><?= esc($plan['balcony_count']) ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tab-pane fade show" id="main_amenities">
    <div class="section">

        <!-- Specifications Card -->
        <div class="card mb-4 p-4 border-0 rounded-4">
            <div class="card-body">
                <h5 class="card-title mb-4 text-primary fw-semibold">Specifications</h5>

                <!-- Sub-tabs for Specification Categories -->
                <ul class="nav nav-pills mb-4 gap-2" id="spec-sub-tabs" role="tablist">
                    <?php $i = 0;
foreach ($grouped_specifications as $section => $specs): ?>
                        <li class="nav-item" role="presentation">
                            <button class="bg-secondary nav-link d-flex align-items-center <?= $i === 0 ? 'active' : '' ?>"
                                id="tab-<?= esc($section) ?>" data-bs-toggle="pill"
                                data-bs-target="#pane-<?= esc($section) ?>" type="button" role="tab"
                                aria-controls="pane-<?= esc($section) ?>" aria-selected="<?= $i === 0 ? 'true' : 'false' ?>"
                                style="border-radius: 10px; padding: 0.5rem 1rem;">
                                <img src="<?= base_url('/images/' . $specs['title_image']) ?>" alt="<?= esc($section) ?>"
                                    width="24" height="24" class="me-2" />
                                <span><?= ucfirst(str_replace('_', ' ', esc($section))) ?></span>
                            </button>
                        </li>
                        <?php $i++; endforeach; ?>
                </ul>

                <!-- Sub-tab Content -->
                <div class="tab-content" id="spec-tabContent">
                    <?php $i = 0;
foreach ($grouped_specifications as $section => $specs): ?>
                        <div class="tab-pane fade <?= $i === 0 ? 'show active' : '' ?>" id="pane-<?= esc($section) ?>"
                            role="tabpanel" aria-labelledby="tab-<?= esc($section) ?>">
                            <div class="row">
                                <?php foreach ($specs['fields'] as $label => $spec): ?>
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div
                                            class="d-flex align-items-center p-4 bg-white rounded-3 shadow-sm h-100 <?= empty($spec['value']) ? 'opacity-50 text-muted' : '' ?>">
                                            <div class="me-3">
                                                <?php if (!empty($spec['icon'])): ?>
                                                    <img src="<?= base_url('images/' . $spec['icon']) ?>" alt="<?= esc($label) ?>"
                                                        width="40" height="40" style="object-fit: contain;" />
                                                <?php endif; ?>
                                            </div>
                                            <div>
                                                <div class="fw-semibold"><?= esc($label) ?></div>
                                                <div class="text-muted small">
                                                    <?= !empty($spec['value']) ? esc($spec['value']) : 'Not specified' ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php $i++; endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Amenities Card -->
        <div class="card border-0 p-3">
            <div class="card-body">
                <h5 class="card-title">Amenities</h5>

                <?php
                $all_amenities = [
'lifestyle' => [
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
],
'sports' => [
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
],
'natural' => [
    'Lake',
    'Forest',
    'Army Land',
    'Mountain/Hill',
    'Golf Course',
    'Park Area'
],
                ];

// ✅ Image file mapping (custom names)
$amenity_images = [
    'Pet Park' => 'dog-park.png',
    'Supermarket' => 'super-market.png',
    'Pharmacy/Clinic' => 'pharmacy.png',
    'Library' => 'search.png',
    'Sauna' => 'sauna.png',
    'Amphitheatre' => 'amphitheatre.png',
    'Swimming Pool' => 'swim.png',
    'Gym - Indoor' => 'exercise.png',
    'Gym - Outdoor' => 'pull-up-bar.png',
    'Cafe/Restaurant' => 'table.png',
    'Jacuzzi' => 'bathroom (1).png',
    'Kids Play Area' => 'playground.png',
    'Salon' => 'salon.png',
    'Play School' => 'abacus.png',
    'Heated Pool' => 'swimming.png',

    'Running Track' => 'track-and-field.png',
    'Basketball' => 'net.png',
    'Badminton' => 'badminton.png',
    'Cricket Pitch' => 'cricket-ground.png',
    'Cricket Ground' => 'stadium.png',
    'Football Ground' => 'soccer.png',
    'Squash' => 'squash.png',
    'Skating' => 'ice-skating.png',
    'Lawn Tennis' => 'game.png',
    'Volleyball Net' => 'volleyball.png',

    'Lake' => 'lake.png',
    'Forest' => 'wood.png',
    'Army Land' => 'land-mine.png',
    'Mountain/Hill' => 'mountain.png',
    'Golf Course' => 'golf-hole.png',
    'Park Area' => 'picnic.png',
];
?>

                <?php foreach ($all_amenities as $category => $items): ?>
                    <h6 class="mt-4 text-capitalize"><?= ucfirst($category) ?> Amenities</h6>
                    <div class="d-flex flex-wrap gap-4 mt-2 p-3">
                        <?php foreach ($items as $item): ?>
                            <?php
            $selected = false;
                            $rare = null;

                            if (!empty($grouped_amenities[$category])) {
                                foreach ($grouped_amenities[$category] as $amenity) {
                                    if ($amenity['name'] === $item) {
                                        $selected = $amenity['selected'];
                                        $rare = $amenity['rare'];
                                        break;
                                    }
                                }
                            }

                            $img_file = $amenity_images[$item] ?? 'default.png';
                            $img_url = base_url('images/' . $img_file);
                            ?>

                            <div class="position-relative d-flex flex-column align-items-start p-3 rounded <?= $selected ? '' : 'opacity-50 border-muted' ?> min-w-40 shadow-sm"
                                style="width: 180px; background-color: <?= $selected ? 'color-mix(in oklab, rgb(0, 200, 200) 10%, white)' : '#ffffff' ?>; background-image: 
                         <?= $selected ? 'linear-gradient(to bottom, color-mix(in oklab, rgb(0, 200, 200) 15%, transparent) 10%, transparent 90%)' : 'none' ?>; color: #212529; transition: all 0.4s ease;">

                                <!-- Amenity Image Icon -->
                                <img src="<?= $img_url ?>" alt="<?= esc($item) ?>"
                                    onerror="this.onerror=null; this.src='<?= base_url('uploads/amenities/default.png') ?>';"
                                    class="mb-2" style="width: 48px; height: 48px; object-fit: contain;">

                                <p class="mt-2 mb-0 text-sm fw-semibold"><?= esc($item) ?></p>

                                <?php if ($rare === 'RARE'): ?>
                                    <span class="badge bg-danger text-dark position-absolute top-0 end-0 m-1">RARE</span>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>


    </div>
</div>
<div class="tab-pane fade show" id="main_connectivity">
    <div class="container py-4">
        <h4 class="fw-bold"><?= esc($property['name']) ?> Connectivity</h4>

        <!-- Category Tabs - Scrollable on Mobile -->
        <div class="overflow-auto mb-4">
            <div class="d-flex flex-nowrap gap-2">
                <button type="button" class="btn btn-outline-success active rounded-pill px-4 py-2 shadow-none"
                    onclick="setActiveButton(this); loadCategory('transit')">
                    <i class="bi bi-train-front me-1"></i> Transit
                </button>
                <button type="button" class="btn btn-outline-success rounded-pill px-4 py-2 shadow-none"
                    onclick="setActiveButton(this); loadCategory('schools')">
                    <i class="bi bi-book me-1"></i> Schools
                </button>
                <button type="button" class="btn btn-outline-success rounded-pill px-4 py-2 shadow-none"
                    onclick="setActiveButton(this); loadCategory('hospitals')">
                    <i class="bi bi-hospital me-1"></i> Hospitals
                </button>
                <button type="button" class="btn btn-outline-success rounded-pill px-4 py-2 shadow-none"
                    onclick="setActiveButton(this); loadCategory('offices')">
                    <i class="bi bi-building me-1"></i> Offices
                </button>
                <button type="button" class="btn btn-outline-success rounded-pill px-4 py-2 shadow-none"
                    onclick="setActiveButton(this); loadCategory('malls')">
                    <i class="bi bi-shop me-1"></i> Malls
                </button>
            </div>
        </div>

        <!-- Map and Location List -->
        <div class="row gy-4">
            <!-- Map Section -->
            <div class="col-lg-8 col-12">
                <div class="position-relative">
                    <div id="map" style="height: 400px;" class="w-100 rounded shadow-sm"></div>
                    <div class="position-absolute top-50 start-50 translate-middle text-white fs-5 fw-bold bg-dark bg-opacity-50 px-3 py-2 rounded"
                        id="mapOverlay">
                        Click to enable
                    </div>
                </div>
            </div>

            <!-- Location Info List -->
            <div class="col-lg-4 col-12">
                <div class="list-group">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="mani_legal">
    <div class="container py-4">
        <h4 class="fw-bold mb-2 text-primary">Legal Approvals</h4>

        <?php if (!empty($legalApprovals)): ?>
            <h6 class="mb-4 text-dark">
                <strong><?= esc($property['name']) ?></strong> has received
                <strong><?= count(array_filter($legalApprovals, fn ($a) => $a['status'] === 'Approved')) ?> out of
                    <?= count($legalApprovals) ?> important approvals</strong> as per <strong>RERA</strong>.
            </h6>

            <?php
            // Icons assigned by index (0 to 6)
            $iconList = [
                'book.png',
                'strategic-plan.png',
                'water-cycle.png',
                'factory.png',
                'project.png',
                'building.png',
                'fire-alarm.png',
            ];
            ?>

            <div class="row g-4">
                <?php foreach ($legalApprovals as $i => $a): ?>
                    <?php
                    $status = $a['status'];
                    $badge = $status === 'Approved' ? 'success' : 'secondary';
                    $ext = strtolower(pathinfo($a['document_file'], PATHINFO_EXTENSION));
                    $isPdf = $ext === 'pdf';
                    $docPath = base_url('documents/' . $a['document_file']);

                    // Get icon by index, fallback if not found
                    $icon = isset($iconList[$i]) ? $iconList[$i] : 'legal-icon.png';
                    ?>

                    <div class="col-md-6 col-lg-4">
                        <div class="d-flex align-items-center p-3 bg-white rounded-4 shadow-sm h-100 justify-content-between">
                            <div class="d-flex align-items-start">
                                <!-- Approval Icon -->
                                <img src="<?= base_url('images/' . $icon) ?>" alt="Icon" width="32" height="32"
                                    class="me-3 mt-1">

                                <!-- Text Content -->
                                <div>
                                    <div class="fw-semibold"><?= esc($a['title']) ?></div>
                                    <div class="text-muted small">
                                        <?= $a['approved_by'] ? 'Approved by ' . esc($a['approved_by']) : 'No approval yet' ?>
                                    </div>
                                    <div class="mt-1">
                                        <span class="badge bg-<?= $badge ?>"><?= esc($status) ?></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Document Link -->
                            <?php if (!empty($a['document_file'])): ?>
                                <a <?= $isPdf ? 'href="' . $docPath . '" target="_blank"' : 'href="#" data-bs-toggle="modal" data-bs-target="#docModal' . $i . '"' ?> class="text-decoration-none ms-3"
                                    title="View Document">
                                    <svg width="28" height="28" viewBox="0 0 49 48" fill="none" aria-hidden="true">
                                        <path
                                            d="M29.853 8h11.706m0 0v11.706m0-11.706-10.73 10.73-10.73 10.73m18.607-4.95v11.705a3.9 3.9 0 0 1-3.902 3.902h-21.46a3.9 3.9 0 0 1-3.903-3.902v-21.46a3.9 3.9 0 0 1 3.902-3.902H25.05"
                                            stroke="#292D32"></path>
                                    </svg>
                                </a>

                                <?php if (!$isPdf): ?>
                                    <!-- Image Modal -->
                                    <div class="modal fade" id="docModal<?= $i ?>" tabindex="-1"
                                        aria-labelledby="docModalLabel<?= $i ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"><?= esc($a['title']) ?> Document</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="<?= $docPath ?>" alt="<?= esc($a['title']) ?> Image"
                                                        class="img-fluid rounded shadow-sm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">No legal approvals available for this property.</div>
        <?php endif; ?>
    </div>
</div>
<div class="tab-pane fade" id="main_gallery">
    <div class="container py-4">
        <h4 class="fw-bold mb-4 text-primary">Gallery</h4>
        <div class="row g-3">

            <!-- Property Images -->
            <?php if (!empty($images)): ?>
                <?php foreach ($images as $img): ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="card border-0 shadow-sm">
                            <img src="<?= base_url('uploads/properties/' . $img['image']) ?>" class="img-fluid rounded"
                                alt="Property Image">
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- Master Plan Images (Using Your Working Code) -->
            <div class="col-12">
                <h5 class="fw-semibold mt-4 mb-2 text-secondary">Master Plan</h5>
            </div>
            <?php if (!empty($master_plan_image) && count($master_plan_image) > 0): ?>
                <?php foreach ($master_plan_image as $plan_img): ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="image-box">
                            <img src="<?= base_url('uploads/master_plans/' . $plan_img['master_plan_image']) ?>"
                                class="img-fluid rounded shadow-sm preview-image" alt="Master Plan Image"
                                style="max-width: 100%; height: auto; cursor: pointer;">
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-md-4 col-sm-6">
                    <img src="<?= base_url('uploads/master_plans/default_master_plan.jpg') ?>"
                        class="img-fluid rounded shadow-sm" alt="No Master Plan Available"
                        style="max-width: 100%; height: auto;">
                </div>
            <?php endif; ?>

            <!-- Floor Plan Images -->
            <?php if (!empty($floor_plans)): ?>
                <div class="col-12">
                    <h5 class="fw-semibold mt-4 mb-2 text-secondary">Floor Plans</h5>
                </div>
                <?php foreach ($floor_plans as $plan): ?>
                    <?php if (!empty($plan['images'])): ?>
                        <?php foreach ($plan['images'] as $img): ?>
                            <div class="col-md-4 col-sm-6">
                                <div class="card border-0 shadow-sm">
                                    <img src="<?= base_url('uploads/floor_plans/' . $img['image']) ?>" class="img-fluid rounded"
                                        alt="Floor Plan">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</div>

<div class="tab-pane fade" id="main_developer">
    <div class="container py-4">
        <h4 class="fw-bold mb-4 text-primary">About the Developer</h4>

        <?php if (!empty($developer)): ?>
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="row g-4 align-items-center">
                    <!-- Developer Info -->
                    <div class="col-md-8">
                        <h5 class="fw-bold mb-2 text-dark"><?= esc($developer['name']) ?></h5>

                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-calendar-check me-2 text-primary"></i>
                                <span class="fw-semibold">Established On:</span>
                                <span class="ms-2 text-muted"><?= esc($developer['established_year']) ?></span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-building-check me-2 text-primary"></i>
                                <span class="fw-semibold">Completed Projects:</span>
                                <span class="ms-2 text-muted"><?= esc($developer['completed_projects']) ?></span>
                            </div>
                        </div>

                        <a href="<?= base_url('developers/' . $developer['id']) ?>"
                            class="text-decoration-none fw-semibold text-primary mb-3 d-inline-block">
                            <i class="bi bi-arrow-right-circle me-1"></i> See all properties by
                            <?= esc($developer['name']) ?>
                        </a>

                        <p class="text-muted mb-0 small lh-lg">
                            <?= nl2br(esc($developer['description'])) ?>
                        </p>
                    </div>

                    <!-- Developer Image / Logo -->
                    <div class="col-md-4 text-center text-md-end">
                        <img src="<?= base_url('uploads/developers/' . $developer['image']) ?>"
                            alt="<?= esc($developer['name']) ?>" class="img-fluid rounded" style="max-width: 180px;">
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-warning rounded-4 shadow-sm p-4">
                <p class="mb-0 text-muted">Developer information is not available at the moment.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

</div>
<!-- Lightbox Script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const previewImages = document.querySelectorAll('.preview-image');
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');

        previewImages.forEach(img => {
            img.addEventListener('click', function () {
                lightboxImg.src = this.src;
                lightbox.style.display = 'flex';
            });
        });

        window.closeLightbox = function () {
            lightbox.style.display = 'none';
            lightboxImg.src = '';
        };

        lightbox.addEventListener('click', function (e) {
            if (e.target === lightbox || e.target.classList.contains('lightbox-close')) {
                closeLightbox();
            }
        });
    });
</script>
<script>
    let map;
    let mapEnabled = false;
    let locationMarkers = {};
    let propertyLat = null;
    let propertyLng = null;

    document.addEventListener('DOMContentLoaded', function () {
        const address = "<?= esc($property['location']) ?>";
        geocodeAddress(address, function (lat, lng) {
            propertyLat = lat;
            propertyLng = lng;

            const tabTrigger = document.querySelector('a[href="#main_connectivity"]');
            const mapOverlay = document.getElementById('mapOverlay');

            if (tabTrigger) {
                tabTrigger.addEventListener('shown.bs.tab', function () {
                    enableMap();
                    loadCategory('transit');
                });
            }

            if (mapOverlay) {
                mapOverlay.addEventListener('click', enableMap);
            }
        });
    });

    function geocodeAddress(address, callback) {
        const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`;

        fetch(url)
            .then(res => res.json())
            .then(data => {
                if (data.length > 0) {
                    const lat = parseFloat(data[0].lat);
                    const lng = parseFloat(data[0].lon);
                    callback(lat, lng);
                } else {
                    alert("Location not found for: " + address);
                    console.error("Geocoding failed:", address);
                    document.getElementById('mapOverlay').textContent = "Location not found";
                }
            })
            .catch(err => {
                alert("Geocoding error occurred.");
                console.error("Geocoding error:", err);
            });
    }


    function enableMap() {
        const overlay = document.getElementById('mapOverlay');
        if (overlay) overlay.style.display = 'none';

        if (!mapEnabled && propertyLat && propertyLng) {
            setTimeout(initMap, 100);
            mapEnabled = true;
        }
    }

    function initMap() {
        map = L.map('map').setView([propertyLat, propertyLng], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        const buildingIcon = L.icon({
            iconUrl: '<?= base_url('images/office-area.png') ?>', // building icon
            iconSize: [52, 55],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });

        L.marker([propertyLat, propertyLng], { icon: buildingIcon })
            .addTo(map)
            .bindPopup("<b>Property Location</b>")
            .openPopup();
    }


    function setActiveButton(button) {
        const buttons = button.parentElement.querySelectorAll('.btn');
        buttons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
    }

    async function loadCategory(category) {
        if (!mapEnabled) return;

        const categoriesMap = {
            transit: { key: 'public_transport', value: 'platform' },
            schools: { key: 'amenity', value: 'school' },
            hospitals: { key: 'amenity', value: 'hospital' },
            offices: { key: 'office', value: 'yes' },
            malls: { key: 'shop', value: 'mall' }
        };

        const tag = categoriesMap[category];
        if (!tag) {
            console.error("Invalid category:", category);
            return;
        }

        const radius = 5000;

        // Clear ALL previous markers
        Object.values(locationMarkers).forEach(marker => {
            if (marker && typeof marker.remove === 'function') {
                marker.remove(); // Remove from map
            }
        });
        locationMarkers = {}; // Reset

        const listGroup = document.querySelector('.list-group');
        listGroup.innerHTML = '<div class="p-2 text-center">Loading nearby places...</div>';

        const query = `
        [out:json];
        (
            node[${tag.key}=${tag.value}](around:${radius},${propertyLat},${propertyLng});
            way[${tag.key}=${tag.value}](around:${radius},${propertyLat},${propertyLng});
            relation[${tag.key}=${tag.value}](around:${radius},${propertyLat},${propertyLng});
        );
        out center;`;

        try {
            const response = await fetch("https://overpass-api.de/api/interpreter", {
                method: "POST",
                body: query
            });
            const data = await response.json();

            listGroup.innerHTML = '';
            const bounds = [];

            const seen = new Set();

            for (const el of data.elements) {
                const lat = el.lat || (el.center && el.center.lat);
                const lng = el.lon || (el.center && el.center.lon);
                const name = el.tags?.name || 'Unnamed';
                if (!lat || !lng) continue;

                // Create deduplication key per category
                const uniqueKey = `${category}-${lat.toFixed(5)}-${lng.toFixed(5)}-${name.toLowerCase()}`;
                if (seen.has(uniqueKey)) continue;
                seen.add(uniqueKey);

                const { distanceText, durationText } = await getDistanceDuration(lat, lng);

                const marker = L.marker([lat, lng])
                    .addTo(map)
                    .bindPopup(`<b>${name}</b><br>Distance: ${distanceText}<br>Duration: ${durationText}`);

                locationMarkers[uniqueKey] = marker;
                bounds.push([lat, lng]);

                const listItem = document.createElement('div');
                listItem.className = 'list-group-item d-flex justify-content-between align-items-center cursor-pointer';
                listItem.innerHTML = `
                <div>
                    <h6 class="mb-1">${name}</h6>
                    <small class="text-muted">Distance: ${distanceText}, Duration: ${durationText}</small>
                </div>`;
                listItem.onclick = () => focusOnLocation(uniqueKey);
                listGroup.appendChild(listItem);
            }

            if (bounds.length > 0) map.fitBounds(bounds);
            if (data.elements.length === 0) {
                listGroup.innerHTML = '<div class="p-2 text-center text-muted">No places found in this category.</div>';
            }

        } catch (error) {
            console.error("Error loading category:", error);
            listGroup.innerHTML = '<div class="p-2 text-center text-danger">Error loading data</div>';
        }
    }



    async function getDistanceDuration(destLat, destLng) {
        try {
            const response = await fetch('/ors_proxy', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    coordinates: [
                        [propertyLng, propertyLat],
                        [destLng, destLat]
                    ]
                })
            });

            if (!response.ok) {
                console.error("ORS request failed:", response.statusText);
                return {
                    distanceText: 'N/A',
                    durationText: 'N/A'
                };
            }

            const data = await response.json();

            if (!data || !data.routes || data.routes.length === 0) {
                console.error("No route data returned from ORS", data);
                return {
                    distanceText: 'N/A',
                    durationText: 'N/A'
                };
            }

            const summary = data.routes[0].summary;
            let km = (summary.distance / 1000).toFixed(2);
            let mins = Math.round(summary.duration / 60);

            return {
                distanceText: km + " km",
                durationText: mins + " mins"
            };

        } catch (err) {
            console.error("ORS API Error:", err);
            return {
                distanceText: 'N/A',
                durationText: 'N/A'
            };
        }
    }


    function focusOnLocation(uniqueKey) {
        const marker = locationMarkers[uniqueKey];
        if (marker) {
            map.setView(marker.getLatLng(), 16);
            marker.openPopup();
        }
    }


</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterType = document.getElementById('filterType');
        const filterSize = document.getElementById('filterSize');
        const floorPlans = document.querySelectorAll('.floor-plan-item');

        // Build size map dynamically from DOM
        const bhkSizeMap = {};
        floorPlans.forEach(plan => {
            const type = plan.getAttribute('data-type');
            const size = plan.getAttribute('data-size');
            if (!bhkSizeMap[type]) bhkSizeMap[type] = new Set();
            bhkSizeMap[type].add(size);
        });

        function updateSizeDropdown(selectedType) {
            const sizes = bhkSizeMap[selectedType] ? Array.from(bhkSizeMap[selectedType]) : [];

            // Clear and populate size dropdown
            filterSize.innerHTML = '<option value="">All Sizes</option>';
            sizes.sort((a, b) => parseFloat(a) - parseFloat(b)).forEach(size => {
                const option = document.createElement('option');
                option.value = size;
                option.textContent = `${size} sq.ft`;
                filterSize.appendChild(option);
            });
        }

        function filterFloorPlans() {
            const selectedType = filterType.value;
            const selectedSize = filterSize.value;

            floorPlans.forEach(plan => {
                const type = plan.getAttribute('data-type');
                const size = plan.getAttribute('data-size');

                const matchesType = !selectedType || type === selectedType;
                const matchesSize = !selectedSize || size === selectedSize;

                plan.style.display = (matchesType && matchesSize) ? 'block' : 'none';
            });
        }

        filterType.addEventListener('change', () => {
            updateSizeDropdown(filterType.value);
            filterFloorPlans();
        });

        filterSize.addEventListener('change', filterFloorPlans);

        // Initialize
        updateSizeDropdown(filterType.value);
        filterFloorPlans();
    });
</script>