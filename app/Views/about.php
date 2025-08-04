<!-- About Page View -->
<div class="hero page-inner overlay" style="background-image: url('images/hero_bg_3.jpg')">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-9 text-center mt-5">
                <h1 class="heading" data-aos="fade-up"><?= esc($about['heading'] ?? 'About') ?></h1>
                <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                    <ol class="breadcrumb text-center justify-content-center">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">About</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- About Us Paragraphs -->
<div class="section">
    <div class="container">
        <div class="row text-left mb-5">
            <div class="col-12">
                <h2 class="font-weight-bold heading text-primary mb-4">About Us</h2>
            </div>
            <div class="col-lg-6">
                <?= $about['paragraphs_left'] ?? '' ?>
            </div>
            <div class="col-lg-6">
                <?= $about['paragraphs_right'] ?? '' ?>
            </div>
        </div>
    </div>
</div>

<!-- Feature Section 1 -->
<div class="section pt-0">
    <div class="container">
        <div class="row justify-content-between mb-5">
            <div class="col-lg-7 mb-5 mb-lg-0 order-lg-2">
                <div class="img-about dots">
                    <?php if (!empty($features[0]['image'])): ?>
                        <img src="<?= base_url('uploads/about/' . esc($features[0]['image'])) ?>" alt="Feature Image 1" class="img-fluid" />
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-4">
                <?php foreach ($features as $feature): ?>
                    <div class="d-flex feature-h mb-4">
                        <!-- Circle container with image inside -->
                        <span class="wrap-icon me-3 d-flex align-items-center justify-content-center">
                            <img src="<?= base_url('uploads/about/' . esc($feature['icon'])) ?>"
                                alt="<?= esc($feature['title']) ?>"
                                class="img-fluid"
                                style="width: 30px; height: 30px; object-fit: contain;">
                        </span>
                        <!-- Text content -->
                        <div class="feature-text">
                            <h3 class="heading"><?= esc($feature['title']) ?></h3>
                            <p class="text-black-50"><?= esc($feature['description']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- Feature Section 2 -->
<div class="section pt-0">
    <div class="container">
        <div class="row justify-content-between mb-5">
            <div class="col-lg-7 mb-5 mb-lg-0">
                <div class="img-about dots">
                    <?php if (!empty($features[1]['image'])): ?>
                        <img src="<?= base_url('uploads/about/' . esc($features[1]['image'])) ?>" alt="Feature Image 2" class="img-fluid" />
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-4">
                <?php foreach ($features as $feature): ?>
                    <div class="d-flex feature-h mb-4">
                        <!-- Circle container with image inside -->
                        <span class="wrap-icon me-3 d-flex align-items-center justify-content-center">
                            <img src="<?= base_url('uploads/about/' . esc($feature['icon'])) ?>"
                                alt="<?= esc($feature['title']) ?>"
                                class="img-fluid"
                                style="width: 30px; height: 30px; object-fit: contain;">
                        </span>
                        <!-- Text content -->
                        <div class="feature-text">
                            <h3 class="heading"><?= esc($feature['title']) ?></h3>
                            <p class="text-black-50"><?= esc($feature['description']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- Image Gallery -->
<div class="section">
    <div class="container">
        <div class="row">
            <?php if (!empty($statistics[0]['images'])): ?>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                    <img src="<?= base_url('uploads/statistics/' . esc($statistics[0]['images'])) ?>" alt="Image 1" class="img-fluid" />
                </div>
            <?php endif; ?>
            <?php if (!empty($statistics[1]['images'])): ?>
                <div class="col-md-4 mt-lg-5" data-aos="fade-up" data-aos-delay="100">
                    <img src="<?= base_url('uploads/statistics/' . esc($statistics[1]['images'])) ?>" alt="Image 2" class="img-fluid" />
                </div>
            <?php endif; ?>
            <?php if (!empty($statistics[2]['images'])): ?>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <img src="<?= base_url('uploads/statistics/' . esc($statistics[2]['images'])) ?>" alt="Image 3" class="img-fluid" />
                </div>
            <?php endif; ?>
        </div>

        <!-- Statistics -->
        <div class="row section-counter mt-5">
            <?php foreach ($statistics as $stat): ?>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3" data-aos="fade-up">
                    <div class="counter-wrap mb-5 mb-lg-0">
                        <span class="number">
                            <span class="countup text-primary"><?= esc($stat['number']) ?></span>
                        </span>
                        <span class="caption text-black-50"><?= esc($stat['caption']) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<!-- Team Members -->
<?php if (!empty($team)): ?>
    <div class="section sec-testimonials bg-light">
        <div class="container">
            <div class="row mb-5 align-items-center">
                <div class="col-md-6">
                    <h2 class="font-weight-bold heading text-primary mb-4 mb-md-0">The Team</h2>
                </div>
            </div>

            <div class="testimonial-slider-wrap">
                <div class="testimonial-slider">
                    <?php foreach ($team as $member): ?>
                        <div class="item">
                            <div class="testimonial">
                                <img src="<?= base_url('uploads/team/' . esc($member['image'])) ?>" alt="Image" class="img-fluid rounded-circle w-25 mb-4" />
                                <h3 class="h5 text-primary"><?= esc($member['name']) ?></h3>
                                <p class="text-black-50"><?= esc($member['position']) ?></p>
                                <p><?= esc($member['description']) ?></p>
                                <ul class="social list-unstyled list-inline dark-hover">
                                    <?php if (!empty($member['twitter'])): ?><li class="list-inline-item"><a href="<?= esc($member['twitter']) ?>"><span class="icon-twitter"></span></a></li><?php endif; ?>
                                    <?php if (!empty($member['facebook'])): ?><li class="list-inline-item"><a href="<?= esc($member['facebook']) ?>"><span class="icon-facebook"></span></a></li><?php endif; ?>
                                    <?php if (!empty($member['linkedin'])): ?><li class="list-inline-item"><a href="<?= esc($member['linkedin']) ?>"><span class="icon-linkedin"></span></a></li><?php endif; ?>
                                    <?php if (!empty($member['instagram'])): ?><li class="list-inline-item"><a href="<?= esc($member['instagram']) ?>"><span class="icon-instagram"></span></a></li><?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
