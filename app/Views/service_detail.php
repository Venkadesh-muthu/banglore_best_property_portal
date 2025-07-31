<!-- Hero Section -->
<section class="service-hero py-5 bg-light" style="margin-top: 8rem !important;">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <small class="text-muted fw-bold text-uppercase">No more blind visits</small>
                <h1 class="display-5 fw-bold mt-2"><?= esc($service['title']) ?></h1>
                <p class="lead mt-3"><?= esc($service['short_description']) ?></p>
                <a href="<?= base_url('contact') ?>" class="btn btn-warning btn-lg mt-3 px-4">Book An Appointment</a>
                <p class="text-muted mt-3">Guided <?= esc($service['title']) ?> service trusted by hundreds.</p>
            </div>
            <div class="col-md-6 text-center">
                <?php if (!empty($service['image'])): ?>
                    <img src="<?= base_url('uploads/services/' . $service['image']) ?>" alt="<?= esc($service['title']) ?>" class="img-fluid rounded shadow-sm">
                <?php else: ?>
                    <img src="<?= base_url('assets/images/default-service.jpg') ?>" alt="Service Image" class="img-fluid rounded shadow-sm">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!-- SEO Information (Premium Styled) -->
<section class="py-5 bg-light mt-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold display-6">SEO Optimization Overview</h2>
            <p class="text-muted fs-5">Boost your search visibility with clean and optimized meta details.</p>
        </div>

        <div class="row g-4">
            <!-- Meta Title -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 hover-scale bg-white rounded-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-type display-6 text-primary me-3"></i>
                            <div>
                                <h6 class="fw-bold mb-0 text-secondary">Meta Title</h6>
                                <span class="badge bg-primary-subtle text-primary small">Recommended: ≤ 60 chars</span>
                            </div>
                        </div>
                        <p class="text-dark fs-6 mb-0"><?= esc($service['meta_title']) ?: 'Legal Help for Bangalore Properties' ?></p>
                    </div>
                </div>
            </div>

            <!-- Meta Description -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 hover-scale bg-white rounded-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-chat-square-text display-6 text-success me-3"></i>
                            <div>
                                <h6 class="fw-bold mb-0 text-secondary">Meta Description</h6>
                                <span class="badge bg-success-subtle text-success small">Recommended: ≤ 160 chars</span>
                            </div>
                        </div>
                        <p class="text-dark fs-6 mb-0"><?= esc($service['meta_description']) ?: 'Legal document verification and property law support in Bangalore.' ?></p>
                    </div>
                </div>
            </div>

            <!-- Meta Keywords -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 hover-scale bg-white rounded-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-tags display-6 text-warning me-3"></i>
                            <div>
                                <h6 class="fw-bold mb-0 text-secondary">Meta Keywords</h6>
                                <span class="badge bg-warning-subtle text-warning small">Separated by commas</span>
                            </div>
                        </div>
                        <p class="text-dark fs-6 mb-0"><?= esc($service['meta_keywords']) ?: 'legal support, property law, bangalore documentation' ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Service Metrics -->
<section class="py-5 bg-white border-top">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-md-3">
                <h2 class="fw-bold text-primary">2750+</h2>
                <p class="text-muted mb-0">Hours of Advice</p>
            </div>
            <div class="col-md-3">
                <h2 class="fw-bold text-success">520M+</h2>
                <p class="text-muted mb-0">Sq. Feet Analyzed</p>
            </div>
            <div class="col-md-3">
                <h2 class="fw-bold text-warning">210+</h2>
                <p class="text-muted mb-0">Partner Builders</p>
            </div>
            <div class="col-md-3">
                <h2 class="fw-bold text-danger">500+</h2>
                <p class="text-muted mb-0">Projects Across Bangalore</p>
            </div>
        </div>
    </div>
</section>

<!-- Service Details -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-8">
                <h2 class="mb-3">What’s included?</h2>
                <p><?= esc($service['long_description']) ?></p>

                <div class="mt-4">
                    <h4>How it helps you:</h4>
                    <ul class="list-group list-group-flush border rounded bg-white">
                        <li class="list-group-item">✅ Peace of mind before buying</li>
                        <li class="list-group-item">✅ Verified documents & insights</li>
                        <li class="list-group-item">✅ Expert assistance throughout</li>
                        <li class="list-group-item">✅ Save money, avoid bad deals</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h5 class="card-title">Need Help?</h5>
                        <p class="card-text">Book a free consultation with our experts.</p>
                        <a href="<?= base_url('contact') ?>" class="btn btn-outline-dark">Talk to Us</a>
                    </div>
                </div>

                <?php if (!empty($service['image'])): ?>
                    <div class="mt-4 text-center">
                        <img src="<?= base_url('uploads/services/' . $service['image']) ?>" alt="<?= esc($service['title']) ?>" class="img-fluid rounded shadow">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="bg-white py-5">
    <div class="container text-center">
        <h2 class="mb-4 fw-bold">Why choose our service?</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <i class="bi bi-check2-circle display-4 text-primary"></i>
                <h5 class="mt-3">Trustworthy</h5>
                <p>Backed by expert teams.</p>
            </div>
            <div class="col-md-3">
                <i class="bi bi-file-earmark-check display-4 text-success"></i>
                <h5 class="mt-3">Verified Info</h5>
                <p>We research every detail.</p>
            </div>
            <div class="col-md-3">
                <i class="bi bi-clock-history display-4 text-warning"></i>
                <h5 class="mt-3">Time-Saving</h5>
                <p>We fast-track your decision.</p>
            </div>
            <div class="col-md-3">
                <i class="bi bi-currency-rupee display-4 text-danger"></i>
                <h5 class="mt-3">Cost-Effective</h5>
                <p>We help you save lakhs.</p>
            </div>
        </div>
    </div>
</section>

