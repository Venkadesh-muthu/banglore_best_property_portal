<!-- Hero Banner -->
<div class="hero position-relative d-flex align-items-center justify-content-center text-white"
     style="
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.65)),
                    url('images/hero_bg_1.jpg') center/cover no-repeat;
        height: 260px;
        border-bottom-left-radius: 30px;
        border-bottom-right-radius: 30px;
        overflow: hidden;
    ">
    <div class="container text-center">
        <h1 class="fs-2 fw-semibold mb-2" data-aos="fade-up" style="color: white !important;">Compare Properties</h1>
        <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="150">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url() ?>" class="text-white-50 text-decoration-none">Home</a>
                </li>
                <li class="breadcrumb-item active text-white-50" aria-current="page">Compare</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Compare Section -->
<div class="section">
    <div class="container">
        <div id="compareSection">
            <h2 class="text-center fw-bold mb-4">🔍 Compare Two Properties</h2>

            <!-- Property Selection Form -->
            <form method="get" action="<?= base_url('compare_properties') ?>" class="row g-3 align-items-end shadow-sm p-4 bg-light rounded-4 mb-5">
                <div class="col-md-5">
                    <label for="property1" class="form-label">🏠 Select Property 1</label>
                    <select name="property1" id="property1" class="form-select" required>
                        <option value="">-- Select Property 1 --</option>
                        <?php foreach ($allProperties as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= esc($p['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-5">
                    <label for="property2" class="form-label">🏠 Select Property 2</label>
                    <select name="property2" id="property2" class="form-select" required>
                        <option value="">-- Select Property 2 --</option>
                        <?php foreach ($allProperties as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= esc($p['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="bi bi-sliders"></i> Compare
                    </button>
                </div>
            </form>

            <!-- Comparison Table -->
            <?php if ($property1 && $property2): ?>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle shadow-sm rounded-4 overflow-hidden">
                        <thead class="table-primary text-center text-white">
                            <tr>
                                <th class="bg-primary-subtle">Feature</th>
                                <th><?= esc($property1['name']) ?></th>
                                <th><?= esc($property2['name']) ?></th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <th>📍 Location</th>
                                <td><?= esc($property1['location']) ?></td>
                                <td><?= esc($property2['location']) ?></td>
                            </tr>
                            <?php
                                if (!function_exists('formatINR')) {
                                    function formatINR($amount)
                                    {
                                        $amount = floatval(str_replace(',', '', $amount)); // Ensure it's a float

                                        if ($amount >= 10000000) {
                                            return number_format($amount / 10000000, 2) . ' Cr';
                                        } elseif ($amount >= 100000) {
                                            return number_format($amount / 100000, 2) . ' Lakh';
                                        } else {
                                            return number_format($amount);
                                        }
                                    }
                                }
                    ?>

                            <tr>
                                <th>💰 Price Range</th>
                                <td>₹<?= formatINR($property1['start_price']) ?> - ₹<?= formatINR($property1['end_price']) ?></td>
                                <td>₹<?= formatINR($property2['start_price']) ?> - ₹<?= formatINR($property2['end_price']) ?></td>
                            </tr>

                            <tr>
                                <th>📏 Land Area</th>
                                <td><?= esc($property1['land_area']) ?> sqft</td>
                                <td><?= esc($property2['land_area']) ?> sqft</td>
                            </tr>
                            <tr>
                                <th>🚇 Metro Distance</th>
                                <td><?= esc($property1['metro_distance']) ?> km</td>
                                <td><?= esc($property2['metro_distance']) ?> km</td>
                            </tr>
                            <tr>
                                <th>🏢 Clubhouse Area</th>
                                <td><?= esc($property1['clubhouse_area']) ?> sqft</td>
                                <td><?= esc($property2['clubhouse_area']) ?> sqft</td>
                            </tr>
                            <tr>
                                <th>📆 Possession Date</th>
                                <td><?= esc($property1['possession_date']) ?></td>
                                <td><?= esc($property2['possession_date']) ?></td>
                            </tr>
                            <!-- Add more comparison fields as needed -->
                        </tbody>
                    </table>
                </div>
            <?php elseif ($_GET): ?>
                <div class="alert alert-warning text-center shadow-sm rounded-3">
                    ⚠️ Please select two different properties for comparison.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const property1 = document.getElementById('property1');
        const property2 = document.getElementById('property2');

        function updateProperty2Options() {
            const selectedValue = property1.value;

            Array.from(property2.options).forEach(option => {
                if (option.value === selectedValue && selectedValue !== "") {
                    option.style.display = 'none';
                } else {
                    option.style.display = '';
                }
            });

            // If property2 was already selected as the same, reset it
            if (property2.value === selectedValue) {
                property2.value = '';
            }
        }

        property1.addEventListener('change', updateProperty2Options);

        // Run on page load to initialize
        updateProperty2Options();
    });
</script>
<?php if (isset($_GET['property1']) && isset($_GET['property2'])): ?>
<script>
    window.addEventListener('DOMContentLoaded', function () {
        const target = document.getElementById('compareSection');
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
</script>
<?php endif; ?>
