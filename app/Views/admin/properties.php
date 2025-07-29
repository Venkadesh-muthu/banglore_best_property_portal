<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Tables</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                <li class="breadcrumb-item">Properties</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Properties</h5>
                        <div class="datatable-search">
                            <a href="add-property"><button class="btn btn-primary">Add Property</button></a>
                        </div>
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success mt-3">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>No.</th>
                                    <th>Property Name</th>
                                    <th>Location</th>
                                    <th>Starting Price</th>
                                    <th>Ending Price</th>
                                    <th>Type</th>
                                    <th>Type Details</th>
                                    <th>Possession Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $serial = 1 + ($perPage * ($currentPage - 1)); ?>
                                <?php if (!empty($properties)): ?>
                                    <?php foreach ($properties as $property): ?>
                                        <tr class="text-center">
                                            <td><?= $serial++ ?></td>
                                            <td><?= esc($property['name']) ?></td>
                                            <td><?= esc($property['location']) ?></td>
                                            <td><?= esc($property['start_price']) ?></td>
                                            <td><?= esc($property['end_price']) ?></td>
                                            <td><?= esc($property['property_type']) ?></td>
                                            <td><?= esc($property['property_type_detail']) ?></td>
                                            <td><?= esc($property['possession_date']) ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/property/edit/' . $property['id']) ?>"
                                                    class="btn btn-sm btn-success">Edit</a>
                                                <button class="btn btn-sm btn-info view-images-btn"
                                                    data-id="<?= $property['id'] ?>" data-bs-toggle="modal"
                                                    data-bs-target="#imageModal">View Images</button>
                                                <button class="btn btn-sm btn-danger delete-btn"
                                                    data-id="<?= $property['id'] ?>">Delete</button>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center">No properties found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>

                        </table>
                        <!-- End Table with stripped rows -->
                        <div class="datatable-bottom">
                            <div class="datatable-info">
                                Showing <?= $pager->getCurrentPage('group1') ?> to
                                <?= $pager->getCurrentPage('group1') + count($properties) - 1 ?> of
                                <?= $pager->getTotal('group1') ?> entries
                            </div>
                            <nav class="datatable-pagination">
                                <?= $pager->links('group1', 'custom_pagination') ?>
                            </nav>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <div class="modal fade" id="imageModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Property Images</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="property-images-content">
                    <!-- AJAX content will load here -->
                </div>
            </div>
        </div>
    </div>

</main><!-- End #main -->
<!-- Add this before your own script -->
<script>
    // Delete property
    $(document).on('click', '.delete-btn', function () {
        let id = $(this).data('id');
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        if (confirm("Delete this property?")) {
            $.ajax({
                url: '<?= base_url('admin/property/delete') ?>/' + id,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (res) {
                    alert('Property deleted successfully!');
                    location.reload();
                },
                error: function (xhr) {
                    console.error('Delete failed:', xhr.responseText);
                    alert('Failed to delete property. Please try again.');
                }
            });
        }
    });


    // View images in modal
    $(document).on('click', '.view-images-btn', function () {
        const id = $(this).data('id');
        $.get("<?= base_url('admin/property/images') ?>/" + id, function (html) {
            $('#property-images-content').html(html);
        });
    });
</script>