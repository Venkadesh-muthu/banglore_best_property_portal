<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav nav nav flex-column" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link <?= ($title == 'Dashboard') ? '' : 'collapsed' ?>"
                href="<?= base_url('admin/dashboard') ?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <li class="nav-heading">Properties</li>
        <!-- Overview -->
        <li class="nav-item">
            <a class="nav-link <?= ($title == 'Properties') ? '' : 'collapsed' ?>"
                href="<?= base_url('admin/properties') ?>">
                <!-- link to your Overview URL -->
                <i class="bi bi-building"></i>
                <span>Properties</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= ($title == 'Services') ? '' : 'collapsed' ?>"
                href="<?= base_url('admin/services') ?>">
                <i class="bi bi-ui-checks-grid"></i>
                <span>Services</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= in_array($title, ['About Us', 'Features', 'Team', 'Statistics']) ? '' : 'collapsed' ?>" data-bs-toggle="collapse" href="#aboutSubMenu" role="button" aria-expanded="false" aria-controls="aboutSubMenu">
                <i class="bi bi-info-circle"></i>
                <span>About Us</span>
            </a>
            <div class="collapse <?= in_array($title, ['About Us', 'Features', 'Team', 'Statistics']) ? 'show' : '' ?>" id="aboutSubMenu">
                <ul class="nav flex-column ps-3">
                    <li class="nav-item">
                        <a class="nav-link <?= ($title == 'About Us') ? 'active' : '' ?>" href="<?= base_url('admin/about') ?>">About Section</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($title == 'Features') ? 'active' : '' ?>" href="<?= base_url('admin/features') ?>">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($title == 'Team') ? 'active' : '' ?>" href="<?= base_url('admin/team') ?>">Team Members</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($title == 'Statistics') ? 'active' : '' ?>" href="<?= base_url('admin/statistics') ?>">Statistics</a>
                    </li>
                </ul>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link <?= ($title == 'Developers') ? '' : 'collapsed' ?>"
                href="<?= base_url('admin/developers') ?>">
                <i class="bi bi-people"></i>
                <span>Developers</span>
            </a>
        </li>


        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-contact.html">
                <i class="bi bi-envelope"></i>
                <span>Contact</span>
            </a>
        </li><!-- End Contact Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-register.html">
                <i class="bi bi-card-list"></i>
                <span>Register</span>
            </a>
        </li><!-- End Register Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-login.html">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Login</span>
            </a>
        </li><!-- End Login Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-error-404.html">
                <i class="bi bi-dash-circle"></i>
                <span>Error 404</span>
            </a>
        </li><!-- End Error 404 Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-blank.html">
                <i class="bi bi-file-earmark"></i>
                <span>Blank</span>
            </a>
        </li><!-- End Blank Page Nav -->

    </ul>

</aside><!-- End Sidebar-->