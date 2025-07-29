<main id="main" class="main">

    <div class="pagetitle">
        <h1>Review</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Review</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Review Details</h5>
                <div class="row g-3 review-form">
                    <!-- Land Area -->
                    <div class="col-md-6">
                        <b for="landArea" class="form-label">Project Land Area (in Acres)</b>
                        <input type="text" class="form-control" id="landArea" name="land_area" placeholder="Land Area">

                        <input type="text" class="form-control" id="avgLandArea" name="avg_land_area"
                            placeholder="Average Land Area">
                    </div>

                    <!-- Clubhouse Area -->
                    <div class="col-md-6">
                        <label for="clubhouseArea" class="form-label">Clubhouse Area (in sqft)</label>
                        <input type="text" class="form-control" id="clubhouseArea" name="clubhouse_area"
                            placeholder="Project Clubhouse Area">
                    </div>
                    <div class="col-md-6">
                        <label for="avgClubhouseArea" class="form-label">Average Clubhouse Area (in sqft)</label>
                        <input type="text" class="form-control" id="avgClubhouseArea" name="avg_clubhouse_area"
                            placeholder="Average Clubhouse Area">
                    </div>

                    <!-- Park Area -->
                    <div class="col-md-6">
                        <label for="parkArea" class="form-label">Park Area (in Acres)</label>
                        <input type="text" class="form-control" id="parkArea" name="park_area"
                            placeholder="Project Park Area">
                    </div>
                    <div class="col-md-6">
                        <label for="avgParkArea" class="form-label">Average Park Area (in Acres)</label>
                        <input type="text" class="form-control" id="avgParkArea" name="avg_park_area"
                            placeholder="Average Park Area">
                    </div>

                    <!-- Open Area -->
                    <div class="col-md-6">
                        <label for="openArea" class="form-label">Open Area (%)</label>
                        <input type="text" class="form-control" id="openArea" name="open_area"
                            placeholder="Project Open Area">
                    </div>
                    <div class="col-md-6">
                        <label for="avgOpenArea" class="form-label">Average Open Area (%)</label>
                        <input type="text" class="form-control" id="avgOpenArea" name="avg_open_area"
                            placeholder="Average Open Area">
                    </div>

                    <!-- Units -->
                    <div class="col-md-6">
                        <label for="units" class="form-label">Units</label>
                        <input type="text" class="form-control" id="units" name="units"
                            placeholder="Project Total Units">
                    </div>
                    <div class="col-md-6">
                        <label for="avgUnits" class="form-label">Average Units</label>
                        <input type="text" class="form-control" id="avgUnits" name="avg_units"
                            placeholder="Average Units">
                    </div>

                    <!-- Price Per Sq.Ft. -->
                    <div class="col-md-6">
                        <label for="pricePerSqft" class="form-label">Price Per Sq.Ft.</label>
                        <input type="text" class="form-control" id="pricePerSqft" name="price_per_sqft"
                            placeholder="Project Price Per Sq.Ft.">
                    </div>
                    <div class="col-md-6">
                        <label for="avgPricePerSqft" class="form-label">Average Price Per Sq.Ft.</label>
                        <input type="text" class="form-control" id="avgPricePerSqft" name="avg_price_per_sqft"
                            placeholder="Average Price Per Sq.Ft.">
                    </div>

                    <!-- Clubhouse Factor -->
                    <div class="col-md-6">
                        <label for="clubhouseFactor" class="form-label">Clubhouse Factor (sqft/unit)</label>
                        <input type="text" class="form-control" id="clubhouseFactor" name="clubhouse_factor"
                            placeholder="Project Clubhouse Factor">
                    </div>
                    <div class="col-md-6">
                        <label for="avgClubhouseFactor" class="form-label">Average Clubhouse Factor (sqft/unit)</label>
                        <input type="text" class="form-control" id="avgClubhouseFactor" name="avg_clubhouse_factor"
                            placeholder="Average Clubhouse Factor">
                    </div>

                    <!-- Closest Metro -->
                    <div class="col-md-6">
                        <label for="metroDistance" class="form-label">Closest Metro (in kms)</label>
                        <input type="text" class="form-control" id="metroDistance" name="metro_distance"
                            placeholder="Project Metro Distance">
                    </div>
                    <div class="col-md-6">
                        <label for="avgMetroDistance" class="form-label">Average Closest Metro (in kms)</label>
                        <input type="text" class="form-control" id="avgMetroDistance" name="avg_metro_distance"
                            placeholder="Average Metro Distance">
                    </div>

                    <!-- Approach Road -->
                    <div class="col-md-6">
                        <label for="approachRoadWidth" class="form-label">Approach Road Width (in meters)</label>
                        <input type="text" class="form-control" id="approachRoadWidth" name="approach_road_width"
                            placeholder="Project Road Width">
                    </div>
                    <div class="col-md-6">
                        <label for="avgApproachRoadWidth" class="form-label">Average Approach Road Width (in
                            meters)</label>
                        <input type="text" class="form-control" id="avgApproachRoadWidth" name="avg_approach_road_width"
                            placeholder="Average Road Width">
                    </div>

                    <!-- Unit Density -->
                    <div class="col-md-6">
                        <label for="unitDensity" class="form-label">Unit Density (units/acre)</label>
                        <input type="text" class="form-control" id="unitDensity" name="unit_density"
                            placeholder="Project Unit Density">
                    </div>
                    <div class="col-md-6">
                        <label for="avgUnitDensity" class="form-label">Average Unit Density (units/acre)</label>
                        <input type="text" class="form-control" id="avgUnitDensity" name="avg_unit_density"
                            placeholder="Average Unit Density">
                    </div>

                    <!-- Submit -->
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Save Review</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>