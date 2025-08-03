<main id="main" class="main">
    <div class="pagetitle">
        <h1>Team Members</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item active">Team</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Team Members</h5>

                <div class="mb-3 text-end">
                    <a href="<?= base_url('admin/add-team') ?>" class="btn btn-primary">Add Member</a>
                </div>

                <?= session()->getFlashdata('success') ? '<div class="alert alert-success">' . session()->getFlashdata('success') . '</div>' : '' ?>
                <?= session()->getFlashdata('error') ? '<div class="alert alert-danger">' . session()->getFlashdata('error') . '</div>' : '' ?>

                <table class="table table-bordered table-hover text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($team)): ?>
                            <?php foreach ($team as $i => $member): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= esc($member['name']) ?></td>
                                    <td><?= esc($member['designation']) ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/edit-team/' . $member['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                        <button data-id="<?= $member['id'] ?>" class="btn btn-sm btn-danger delete-team-btn">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4">No members found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>
<script>
    $(document).on('click', '.delete-team-btn', function () {
        const id = $(this).data('id');
        if (confirm("Delete this team member?")) {
            $.ajax({
                url: "<?= base_url('admin/delete-team/') ?>" + id,
                type: "POST",
                data: {
                    _method: 'DELETE',
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                },
                success: function () {
                    location.reload();
                },
                error: function () {
                    alert("Deletion failed.");
                }
            });
        }
    });
</script>