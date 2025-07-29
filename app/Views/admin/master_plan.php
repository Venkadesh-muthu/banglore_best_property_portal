<main id="main" class="main">

    <div class="pagetitle">
        <h1>Master Plan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Master Plan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row g-3">

            <!-- Master Plan Image Upload Card -->
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Upload Master Plan Images</h5>

                    <!-- Image Upload Form -->
                    <form method="post" action="#" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="masterPlanImages" class="form-label">Choose Images</label>
                            <input class="form-control" type="file" name="master_plan_images[]" id="masterPlanImages"
                                accept="image/*" multiple>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Upload Images</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form><!-- End form -->

                </div>
            </div><!-- End card -->

        </div><!-- End row -->
    </section><!-- End section -->

</main><!-- End #main -->