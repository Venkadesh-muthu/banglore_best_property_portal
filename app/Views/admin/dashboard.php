<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Properties Card -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">

                    <div class="card-body">
                        <h5 class="card-title">Properties <span>| Total</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-building"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?= $totalProperties ?></h6>
                                <span class="text-muted small pt-2 ps-1">total properties</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- End Properties Card -->
        </div>
    </section>

</main><!-- End #main -->