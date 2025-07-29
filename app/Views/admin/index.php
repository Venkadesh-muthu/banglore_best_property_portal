<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Banglore property portal</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?php echo base_url() ?>admin-template/assets/img/favicon.png" rel="icon">
    <link href="<?php echo base_url() ?>admin-template/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!-- Vendor CSS Files -->

    <link href="<?php echo base_url() ?>admin-template/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>admin-template/assets/vendor/bootstrap-icons/bootstrap-icons.css"
        rel="stylesheet">
    <link href="<?php echo base_url() ?>admin-template/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>admin-template/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>admin-template/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>admin-template/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>admin-template/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?php echo base_url() ?>admin-template/assets/css/style.css" rel="stylesheet">
    <!-- CDN for ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div class=" position-relative overflow-hidden text-bg-light min-vh-100 d-flex align-items-center
    justify-content-center" style="background-image: url('<?= base_url('admin-template/assets/img/big-city.jpg') ?>');
               background-size: cover;
               background-repeat: no-repeat;
               background-position: center;">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0" style="background-color: #f3f9ff75 !important;">
                            <div class="card-body">
                                <a href="./index.html" class="text-nowrap logo-img text-center d-block w-100">
                                    <img src="<?= base_url('admin-template/assets/img/ChatGPT_Image_Jun_3__2025__04_05_55_PM-removebg-preview.png') ?>"
                                        alt="Logo" class="img-fluid mx-auto d-block"
                                        style="max-width: 200px; height: auto;">
                                </a>
                                <h3 class="text-center" style="font-family: initial;">Admin</h3>
                                <!-- <p class="text-center" style="color: black;">Bangalore's best property portal</p> -->
                                <form action="<?= site_url('admin/login') ?>" method="post">
                                    <?= csrf_field() ?>

                                    <?php if (session('error')): ?>
                                        <div class="alert alert-danger"><?= session('error') ?></div>
                                    <?php endif; ?>

                                    <div class="mb-3">
                                        <label for="username" class="form-label" style="color: black;">Username</label>
                                        <input type="text" class="form-control" id="username" name="username"
                                            style="color: black;" required>
                                    </div>

                                    <div class="mb-4">
                                        <label for="password" class="form-label" style="color: black;">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            style="color: black;" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100 py-2 fs-5 mb-4">Sign In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <link href="<?php echo base_url() ?>admin-template/assets/vendor/apexcharts/apexcharts.min.js">
    </script>
    <link href="<?php echo base_url() ?>admin-template/assets/vendor/bootstrap/js/bootstrap.bundle.min.js">
    </script>
    <link href="<?php echo base_url() ?>admin-template/assets/vendor/chart.js/chart.umd.js">
    </script>
    <link href="<?php echo base_url() ?>admin-template/assets/vendor/echarts/echarts.min.js">
    </script>
    <link href="<?php echo base_url() ?>admin-template/assets/vendor/quill/quill.js">
    </script>
    <link href="<?php echo base_url() ?>admin-template/assets/vendor/simple-datatables/simple-datatables.js">
    </script>
    <link href="<?php echo base_url() ?>admin-template/assets/vendor/tinymce/tinymce.min.js">
    </script>
    <link href="<?php echo base_url() ?>admin-template/assets/vendor/php-email-form/validate.js">
    </script>

    <!-- Template Main JS File -->
    <link href="<?php echo base_url() ?>admin-template/assets/js/main.js">
    </script>
    <!-- ECharts CDN -->
    <script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
    <!-- Bootstrap 5 JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>