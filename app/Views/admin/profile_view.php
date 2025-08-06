<main id="main" class="main">
    <div class="pagetitle">
        <h1>Admin Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row justify-content-center">
            <div class="col-lg-6">

                <div class="card shadow-sm border-0">
                    <div class="card-body text-center py-5">

                        <?php if (!empty($admin['images'])): ?>
                            <img src="<?= base_url('uploads/' . $admin['images']) ?>" alt="Profile" class="rounded-circle mb-3" width="120" height="120">
                        <?php else: ?>
                            <img src="<?= base_url('assets/img/default-profile.png') ?>" alt="Profile" class="rounded-circle mb-3" width="120" height="120">
                        <?php endif; ?>

                        <h4 class="mb-0"><?= esc($admin['username']) ?></h4>
                        <p class="text-muted mb-1"><?= esc($admin['email']) ?></p>
                        <p class="text-muted small mb-2"><?= esc(ucfirst($admin['role'])) ?></p>

                        <span class="badge <?= $admin['status'] == 1 ? 'bg-success' : 'bg-secondary' ?>">
                            <?= $admin['status'] == 1 ? 'Active' : 'Inactive' ?>
                        </span>

                    </div>
                </div>

            </div>
        </div>
    </section>
</main>
