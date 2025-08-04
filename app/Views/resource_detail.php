<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

<style>
    .quick-card {
        background: #fff;
        border-radius: 14px;
        padding: 18px 22px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.06);
        border: 1px solid #eee;
        height: 100px;             /* fixed short height for small content */
        transition: 0.3s;
    }
    .quick-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 26px rgba(0,0,0,0.10);
    }
    .quick-card i {
        font-size: 18px;
        width: 26px;
        height: 26px;
        color: #ffffff;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 8px;
    }
    .quick-card small {
        font-size: 13px;
        font-weight: 600;
        color: #6c757d;
    }
    .long-card {
        height: auto;             /* expands only for long content */
        min-height: 130px;
    }
</style>
<section class="service-hero py-5 bg-light" style="margin-top: 8rem !important;">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <small class="badge bg-primary text-uppercase"><?= esc($resource['category']) ?></small>
                <h1 class="display-5 fw-bold mt-2"><?= esc($resource['title']) ?></h1>
                <p class="lead mt-3 text-muted"><?= esc($resource['short_description']) ?></p>
                <div class="mb-2">
                    <span class="badge bg-info me-2"><?= $resource['is_new'] ? 'New' : 'Old' ?></span>
                    <?php if ($resource['is_featured']): ?><span class="badge bg-warning">Featured</span><?php endif; ?>
                </div>
                <p class="text-muted">
                    By <?= esc($resource['author_name']) ?> • <?= date('d M Y', strtotime($resource['publish_date'])) ?> • <?= esc($resource['read_time']) ?>
                </p>
                <a href="<?= base_url('contact') ?>" class="btn btn-warning btn-lg mt-3 px-4">Contact Us</a>
            </div>
            <div class="col-md-6 text-center">
                <?php if (!empty($resource['image'])): ?>
                    <img src="<?= base_url('uploads/resources/' . esc($resource['image'])) ?>" alt="<?= esc($resource['title']) ?>" class="img-fluid rounded shadow-sm">
                <?php else: ?>
                    <img src="<?= base_url('assets/images/default.jpg') ?>" alt="Default Resource Image" class="img-fluid rounded shadow-sm">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">

            <!-- Smaller Information Cards -->
            <div class="col-md-4">
                <div class="quick-card d-flex align-items-center">
                    <i class="fas fa-heading bg-primary"></i>
                    <div>
                        <small>Title</small><br>
                        <?= esc($resource['title']) ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="quick-card d-flex align-items-center">
                    <i class="fas fa-layer-group bg-success"></i>
                    <div>
                        <small>Category</small><br>
                        <?= esc($resource['category']) ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="quick-card d-flex align-items-center">
                    <i class="fas fa-user bg-danger"></i>
                    <div>
                        <small>Author</small><br>
                        <?= esc($resource['author_name']) ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="quick-card d-flex align-items-center">
                    <i class="fas fa-calendar bg-warning"></i>
                    <div>
                        <small>Published</small><br>
                        <?= date('d M Y', strtotime($resource['publish_date'])) ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="quick-card d-flex align-items-center">
                    <i class="fas fa-clock bg-secondary"></i>
                    <div>
                        <small>Read Time</small><br>
                        <?= esc($resource['read_time']) ?>
                    </div>
                </div>
            </div>

            <!-- Long Content Cards -->
            <div class="col-md-4">
                <div class="quick-card long-card">
                    <i class="fas fa-align-left bg-info"></i>
                    <div>
                        <small>Short Description</small><br>
                        <?= esc($resource['short_description']) ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="quick-card long-card">
                    <i class="fas fa-file-lines bg-dark"></i>
                    <div>
                        <small>Description</small><br>
                        <?= esc($resource['description']) ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="quick-card long-card">
                    <i class="fas fa-tag bg-primary"></i>
                    <div>
                        <small>Meta Title</small><br>
                        <?= esc($resource['meta_title']) ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="quick-card long-card">
                    <i class="fas fa-key bg-success"></i>
                    <div>
                        <small>Meta Keywords</small><br>
                        <?= esc($resource['meta_keywords']) ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="quick-card long-card">
                    <i class="fas fa-info-circle bg-danger"></i>
                    <div>
                        <small>Meta Description</small><br>
                        <?= esc($resource['meta_description']) ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="quick-card long-card">
                    <i class="fas fa-tags bg-warning"></i>
                    <div>
                        <small>Tags</small><br>
                        <?= esc($resource['tags']) ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
