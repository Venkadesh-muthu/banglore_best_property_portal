<!-- Hero Section with Breadcrumb -->
<div class="hero page-inner overlay" style="background-image: url('<?= base_url('images/hero_bg_3.jpg') ?>')">
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
                            <a class="nav-link px-3 py-2" data-bs-toggle="tab" href="#main_review">
                                <i class="bi bi-question-circle me-1"></i> Review
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" data-bs-toggle="tab" href="#main_connectivity">
                                <i class="bi bi-diagram-3 me-1"></i> Connectivity
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link px-3 py-2" data-bs-toggle="tab" href="#guided_home_buying">
                                <i class="bi bi-house me-1"></i> Guided Home Buying
                            </a>
                        </li> -->
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
                            <a class="nav-link px-3 py-2" href="#"><i class="bi bi-gem me-1"></i> Amenities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" href="#"><i class="bi bi-exclamation-circle me-1"></i>
                                Challenges</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" href="#"><i class="bi bi-shield-check me-1"></i> Legal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" href="#"><i class="bi bi-geo-alt me-1"></i> Micro Market</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" href="#"><i class="bi bi-person-badge me-1"></i> Developer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" href="#"><i class="bi bi-emoji-smile me-1"></i> Peace of
                                Mind</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-3 py-2" href="#"><i class="bi bi-question-circle me-1"></i> F.A.Q</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Property Overview Tab -->
<div class="container tab-content mb-5">
    <div class="tab-pane fade show active" id="main_overview">
        <div class="section">
            <div class="container py-4">
                <h2 class="mb-4"><?= esc($property['name']) ?></h2>
                <div class="row">
                    <!-- Property Images -->
                    <div class="col-md-6 mb-4">
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

                    <!-- Property Details -->
                    <div class="col-md-6">
                        <p><strong>Location:</strong> <?= esc($property['location']) ?></p>
                        <p><strong>Price:</strong> ₹<?= $property['start_price'] ?> -
                            ₹<?= $property['end_price'] ?></p>
                        <p><strong>Type:</strong>
                            <?= esc($property['property_type']) ?>:
                            <span><?= esc($property['property_type_detail']) ?></span>
                        </p>
                        <p><strong>Possession Date:</strong> <?= esc($property['possession_date']) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="lightbox">
        <span class="lightbox-close" onclick="closeLightbox()">×</span>
        <img id="lightbox-img" src="" alt="Full Image">
    </div>

    <!-- Review Tab -->
    <div class="tab-pane fade" id="main_review">
        <div class="container py-4">
            <!-- Property Info -->
            <div class="mb-4">
                <h4 class="fw-bold"><?= esc($property['name']) ?></h4>
                <p class="text-muted mb-1"><?= esc($property['location']) ?></p>
                <h5 class="text-success">
                    ₹<?= $property['start_price'] ?> -
                    ₹<?= $property['end_price'] ?>
                </h5>
                <p><strong>Type:</strong>
                    <?= esc($property['property_type']) ?>:
                    <span><?= esc($property['property_type_detail']) ?></span><br>
                </p>
                <p><strong>Possession:</strong> <?= esc($property['possession_date']) ?></p>
                <p><strong>Rating:</strong> <?= esc($property['rating'] ?? 'N/A') ?> / 5</p>
            </div>

            <!-- Review Metrics -->
            <div class="row g-4">
                <?php
                $review_data = [
                    ['Land Area', $property['land_area'] . ' Acres', $property['avg_land_area'] . ' Acres'],
                    ['Clubhouse Area', $property['clubhouse_area'] . ' sqft', $property['avg_clubhouse_area'] . ' sqft'],
                    ['Park Area', $property['park_area'] . ' Acres', $property['avg_park_area'] . ' Acres'],
                    ['Open Area', $property['open_area'] . '%', $property['avg_open_area'] . '%'],
                    ['Total Units', $property['units'], $property['avg_units'] . ' units'],
                    ['Price Per Sq.Ft.', '₹' . $property['price_per_sqft'], '₹' . $property['avg_price_per_sqft']],
                    ['Clubhouse Factor', $property['clubhouse_factor'] . ' sqft / unit', $property['avg_clubhouse_factor'] . ' sqft / unit'],
                    ['Closest Metro', $property['metro_distance'] . ' km', $property['avg_metro_distance'] . ' km'],
                    ['Approach Road Width', $property['road_width'] . ' meters', $property['avg_road_width'] . ' meters'],
                    ['Unit Density', $property['unit_density'] . ' units/acre', $property['avg_unit_density'] . ' units/acre']
                ];

                foreach ($review_data as [$title, $value, $avg]) {
                    ?>
                    <div class="col-md-4">
                        <div class="card p-3 shadow-sm">
                            <h6 class="mb-1"><?= esc($title) ?></h6>
                            <p class="mb-1"><?= esc($value) ?></p>
                            <small class="text-muted">Avg is: <?= esc($avg) ?></small>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Connectivity Section -->
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
        <div class="section">
            <div class="container py-4">
                <h2 class="mb-5 text-center"><?= esc($property['name']) ?> – Floor Plans</h2>
                <?php
                // Group floor plans by BHK type
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

                <!-- Floor Plan Summary Section -->
                <div class="bg-light p-4 rounded shadow mb-5">
                    <h3 class="text-center mb-4">Available Floor Plan Configurations
                    </h3>

                    <div class="row">
                        <?php foreach ($groupedPlans as $type => $sizes): ?>
                            <div class="col-md-4 mb-4">
                                <div class="border rounded p-3 h-100 bg-white shadow-sm">
                                    <h5 class="mb-3 text-primary"><?= esc($type) ?></h5>
                                    <p><strong><?= count($sizes) ?></strong>
                                        configuration<?= count($sizes) > 1 ? 's' : '' ?> available:</p>
                                    <div class="d-flex flex-wrap gap-2">
                                        <?php foreach ($sizes as $size): ?>
                                            <span class="badge bg-secondary p-2 fs-6"><?= esc($size) ?> sq.ft</span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Filters -->
                <div class="row mb-5">
                    <div class="col-md-6">
                        <select class="form-select" id="filterType">
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
                        <select class="form-select" id="filterSize">
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

                <!-- Floor Plan List -->
                <div class="row" id="floorPlanList">
                    <?php foreach ($floor_plans as $plan): ?>
                        <div class="col-md-12 floor-plan-item mb-4" data-type="<?= esc($plan['bhk_type']) ?>"
                            data-size="<?= esc($plan['saleable_area']) ?>">
                            <div class="row g-4 p-4 border rounded shadow-sm bg-white align-items-center">

                                <!-- Left Column: Details -->
                                <div class="col-md-6">
                                    <h4 class="mb-4"><?= esc($plan['bhk_type']) ?> @
                                        ₹<?= $plan['price'] ?? 0, 2 ?> Cr</h4>

                                    <div class="row">
                                        <div class="col-4 mb-3">
                                            <h5>Saleable Area</h5>
                                            <p><?= esc($plan['saleable_area']) ?> Sq.Ft</p>
                                        </div>
                                        <div class="col-4 mb-3">
                                            <h5>Carpet Area</h5>
                                            <p><?= esc($plan['carpet_area']) ?> Sq.Ft</p>
                                        </div>
                                        <div class="col-4 mb-3">
                                            <h5>Efficiency</h5>
                                            <p><?= esc($plan['efficiency']) ?>%</p>
                                        </div>
                                        <div class="col-4 mb-3">
                                            <h5>Floor Height</h5>
                                            <p><?= esc($plan['floor_height']) ?> M</p>
                                        </div>
                                        <div class="col-4 mb-3">
                                            <h5>Bathroom Count</h5>
                                            <p><?= esc($plan['bathroom_count']) ?></p>
                                        </div>
                                        <div class="col-4 mb-3">
                                            <h5>Balconies</h5>
                                            <p><?= esc($plan['balcony_count']) ?></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column: Image -->
                                <div class="col-md-6 text-center">
                                    <?php if (!empty($plan['images'])): ?>
                                        <img src="<?= base_url('uploads/floor_plans/' . esc($plan['images'][0]['image'])) ?>"
                                            class="img-fluid rounded border" alt="Floor Plan Image">
                                    <?php else: ?>
                                        <p>No image available</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
    <!-- Lightbox Modal -->
    <div id="lightbox" class="lightbox">
        <span class="lightbox-close" onclick="closeLightbox()">×</span>
        <img id="lightbox-img" src="" alt="Full Image">
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

        fetch(url, {
            headers: {
                'User-Agent': 'YourAppName/1.0 (your@email.com)',
                'Referer': window.location.origin
            }
        })
            .then(res => res.json())
            .then(data => {
                if (data.length > 0) {
                    const lat = parseFloat(data[0].lat);
                    const lng = parseFloat(data[0].lon);
                    callback(lat, lng);
                } else {
                    console.error("Geocoding failed: No results found");
                }
            })
            .catch(err => {
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

        L.marker([propertyLat, propertyLng])
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

        const data = await response.json();

        if (data.routes && data.routes.length > 0) {
            const summary = data.routes[0].summary;
            let meters = summary.distance;
            let seconds = summary.duration;

            let km = (meters / 1000).toFixed(2);
            let mins = Math.round(seconds / 60);

            return {
                distanceText: km + " km",
                durationText: mins + " mins"
            };
        } else {
            console.error("No valid route data received from ORS.", data);
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

        filterType.addEventListener('change', filterFloorPlans);
        filterSize.addEventListener('change', filterFloorPlans);

        // Default filter on page load
        filterFloorPlans();
    });
</script>