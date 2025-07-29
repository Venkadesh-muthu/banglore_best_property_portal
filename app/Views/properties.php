<div class="hero page-inner overlay" style="background-image: url('images/hero_bg_1.jpg')">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-9 text-center mt-5">
                <h1 class="heading" data-aos="fade-up">All properties</h1>

                <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="200">
                    <ol class="breadcrumb text-center justify-content-center">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active text-white-50" aria-current="page">
                            All properties
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="section section-properties">
    <div class="container">
        <div class="row">
            <?php foreach ($properties as $property): ?>
                <div class="col-md-4 mb-4">
                    <div class="property-item shadow-sm border rounded">
                        <a href="<?= base_url('property_details/' . $property['id']) ?>" class="img d-block">
                            <img src="<?= base_url('uploads/properties/' . $property['image']) ?>"
                                class="img-fluid rounded-top" alt="<?= esc($property['name']) ?>" />
                        </a>
                        <div class="property-content p-3">
                            <div class="price mb-2">
                                <span>₹<?= number_format((float) $property['start_price']) ?> -
                                    ₹<?= number_format((float) $property['end_price']) ?></span>
                            </div>
                            <h5 class="mb-1"><?= esc($property['name']) ?></h5>
                            <p class="text-muted mb-1"><?= esc($property['location']) ?></p>
                            <p class="mb-1">
                                <strong>Type:</strong>
                                <?= esc($property['property_type']) ?>:
                                <span><?= esc($property['property_type_detail']) ?></span><br>
                                <strong>Possession:</strong> <?= esc($property['possession_date']) ?>
                            </p>
                            <a href="<?= base_url('property_details/' . $property['id']) ?>"
                                class="btn btn-sm btn-primary py-2 px-3">See Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>


        <!-- Pagination -->
        <div class="row align-items-center py-4">
            <!-- Page info -->
            <div class="col-md-4 mb-3 mb-md-0">
                <p class="mb-0">
                    <strong>Showing page <?= $pager->getCurrentPage() ?> of <?= $pager->getPageCount() ?></strong>
                </p>
            </div>

            <!-- Pagination -->
            <div class="col-md-8 text-md-end text-center">
                <div class="custom-pagination d-inline-block">
                    <?= $pager->links() ?>
                </div>
            </div>
        </div>

    </div>
</div>