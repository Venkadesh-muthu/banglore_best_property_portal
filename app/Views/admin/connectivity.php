<main id="main" class="main">

    <div class="pagetitle">
        <h1>Connectivity</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Connectivity</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row g-3">

            <!-- Connectivity Form Card -->
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Connectivity Details</h5>

                    <!-- Connectivity Form -->
                    <form method="post" action="#">
                        <div class="row g-3">
                            <!-- Entry 1 -->
                            <div class="col-md-4">
                                <label class="form-label">Place Name</label>
                                <input type="text" class="form-control" name="connectivity_place[]"
                                    placeholder="e.g., Ambedkar nagar Metro Station">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Distance (Km)</label>
                                <input type="text" class="form-control" name="connectivity_distance[]"
                                    placeholder="e.g., 6.2">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Travel Time (mins)</label>
                                <input type="text" class="form-control" name="connectivity_time[]"
                                    placeholder="e.g., 7">
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary">Save Connectivity</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </div><!-- End row -->
                    </form><!-- End form -->

                </div>
            </div><!-- End card -->

        </div><!-- End row -->
    </section><!-- End section -->

</main><!-- End #main -->