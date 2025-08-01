<div class="hero page-inner overlay" style="background-image: url('images/hero_bg_1.jpg')">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-9 text-center mt-5">
                <h1 class="heading" data-aos="fade-up">Services</h1>

                <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                    <ol class="breadcrumb text-center justify-content-center">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">
                            Services
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="section bg-light">
    <div class="container">
        <div class="row">
            <?php if (!empty($services)): ?>
                <?php foreach ($services as $index => $service): ?>
                    <div class="col-6 col-lg-3" data-aos="fade-up" data-aos-delay="<?= 300 + ($index % 4) * 100 ?>">
                        <div class="box-feature mb-4 text-center">
                            <span class="<?= esc($service['icon']) ?> mb-4 d-block" style="font-size: 2rem;"></span>
                            <h3 class="text-black mb-3 font-weight-bold">
                                <?= esc($service['title']) ?>
                            </h3>
                            <p class="text-black-50">
                                <?= word_limiter(strip_tags($service['description']), 15) ?>
                            </p>
                            <p><a href="<?= base_url('services/' . $service['slug']) ?>" class="learn-more">Read more</a></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-center">No services available at the moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="section sec-testimonials">
    <div class="container">
        <div class="row mb-5 align-items-center">
            <div class="col-md-6">
                <h2 class="font-weight-bold heading text-primary mb-4 mb-md-0">
                    Customer Says
                </h2>
            </div>
            <div class="col-md-6 text-md-end">
                <div id="testimonial-nav">
                    <span class="prev" data-controls="prev">Prev</span>
                    <span class="next" data-controls="next">Next</span>
                </div>
            </div>
        </div>

        <div class="testimonial-slider-wrap">
            <div class="testimonial-slider">
                <?php foreach ([
                    ['img' => 'person_1-min.jpg', 'name' => 'James Smith'],
                    ['img' => 'person_2-min.jpg', 'name' => 'Mike Houston'],
                    ['img' => 'person_3-min.jpg', 'name' => 'Cameron Webster'],
                    ['img' => 'person_4-min.jpg', 'name' => 'Dave Smith']
                ] as $person): ?>
                    <div class="item">
                        <div class="testimonial">
                            <img src="images/<?= $person['img'] ?>" alt="Image" class="img-fluid rounded-circle w-25 mb-4" />
                            <div class="rate">
                                <?php for ($i = 0; $i < 5; $i++): ?>
                                    <span class="icon-star text-warning"></span>
                                <?php endfor; ?>
                            </div>
                            <h3 class="h5 text-primary mb-4"><?= $person['name'] ?></h3>
                            <blockquote>
                                <p>
                                    &ldquo;Far far away, behind the word mountains, far from the
                                    countries Vokalia and Consonantia, there live the blind
                                    texts. Separated they live in Bookmarksgrove right at the
                                    coast of the Semantics, a large language ocean.&rdquo;
                                </p>
                            </blockquote>
                            <p class="text-black-50">Designer, Co-founder</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
