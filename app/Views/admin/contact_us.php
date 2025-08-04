<main id="main" class="main">
    <div class="pagetitle">
        <h1>Contact Us</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item active">Contact Info</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Contact Information</h5>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <?php if (empty($contact)): ?>
                    <div class="mb-3 text-end">
                        <a href="<?= base_url('admin/add-contact') ?>" class="btn btn-primary">Add Contact Info</a>
                    </div>
                <?php endif; ?>

                <table class="table table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Location</th>
                            <th>Open Hours</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($contact)): ?>
                            <tr>
                                <td><?= esc($contact['location']) ?></td>
                                <td><?= esc($contact['open_hours']) ?></td>
                                <td><?= esc($contact['email']) ?></td>
                                <td><?= esc($contact['phone']) ?></td>
                                <td>
                                    <a href="<?= base_url('admin/edit-contact/' . $contact['id']) ?>" class="btn btn-sm btn-success">Edit</a>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger delete-contact-btn" data-id="<?= $contact['id'] ?>">Delete</button>

                                </td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">No contact info found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </section>
</main>


<!-- Contact Delete JS -->
<script>
    $(document).on('click', '.delete-contact-btn', function (e) {
        e.preventDefault();
        const id = $(this).data('id');
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        if (confirm('Are you sure you want to delete this contact info?')) {
            $.ajax({
                url: '<?= base_url('admin/delete-contact') ?>/' + id,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (res) {
                    location.reload();
                },
                error: function (xhr) {
                    alert('Failed to delete contact.');
                    console.error(xhr.responseText);
                }
            });
        }
    });
</script>
