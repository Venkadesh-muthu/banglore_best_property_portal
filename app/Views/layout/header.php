<!-- /*
* Template Name: Property
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Untree.co" />
    <link rel="shortcut icon" href="<?= base_url('favicon.png') ?>" />

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="<?= base_url('fonts/icomoon/style.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('fonts/flaticon/font/flaticon.css') ?>" />

    <link rel="stylesheet" href="<?= base_url('css/tiny-slider.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('css/aos.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <title>
        Banglore's &mdash; Best Property portal
    </title>
</head>
<style>
    #map {
        height: 400px;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .list-group {
        max-height: 300px;
        overflow-y: auto;
        padding-right: 10px;
    }

    .list-group::-webkit-scrollbar {
        width: 6px;
    }

    .list-group::-webkit-scrollbar-thumb {
        background-color: #cccccc;
        border-radius: 3px;
    }

    .lightbox {
        display: none;
        position: fixed;
        z-index: 1050;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.85);
        justify-content: center;
        align-items: center;
    }

    .lightbox img {
        max-width: 90%;
        max-height: 90%;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
    }

    .lightbox-close {
        position: absolute;
        top: 20px;
        right: 30px;
        font-size: 36px;
        color: #fff;
        cursor: pointer;
        z-index: 1100;
    }
</style>

<body>
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close">
                <span class="icofont-close js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    <nav class="site-nav">
        <div class="container">
            <div class="menu-bg-wrap">
                <div class="site-navigation">
                    <a href="<?php echo base_url() ?>" class="logo m-0 float-start">Property</a>

                    <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
                        <li class="active"><a href="<?php echo base_url() ?>">Home</a></li>
                        <li class="has-children">
                            <a href="<?php echo base_url() ?>properties">Properties</a>
                            <ul class="dropdown">
                                <li><a href="<?php echo base_url() ?>properties">Search & filter Properties</a></li>
                                <li><a href="<?php echo base_url() ?>compare_properties">compare properties  </a></li>
                                <!-- <li class="has-children">
                                    <a href="#">Dropdown</a>
                                    <ul class="dropdown">
                                        <li><a href="#">Sub Menu One</a></li>
                                        <li><a href="#">Sub Menu Two</a></li>
                                        <li><a href="#">Sub Menu Three</a></li>
                                    </ul>
                                </li> -->
                            </ul>
                        </li>
                        <li class="has-children">
                            <a class="nav-link" href="#">Services</a>
                            <ul class="dropdown">
                                <?php if (!empty($services)): ?>
                                    <?php foreach ($services as $service): ?>
                                        <li>
                                            <a class="dropdown-item" href="<?= base_url('services/' . esc($service['slug'])) ?>">
                                                <i class="<?= esc($service['icon']) ?> me-1"></i> <?= esc($service['title']) ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <li class="has-children">
                            <a class="nav-link" href="#">Resources</a>
                            <ul class="dropdown">
                                <?php if (!empty($resources)): ?>
                                    <?php foreach ($resources as $resource): ?>
                                        <li>
                                            <a class="dropdown-item" href="<?= base_url('resources/' . esc($resource['category'])) ?>">
                                                <i class="bi bi-book me-1"></i> <?= esc($resource['category']) ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </li>

                        <li><a href="<?php echo base_url() ?>about">About</a></li>
                        <li><a href="<?php echo base_url() ?>contact_us">Contact Us</a></li>
                    </ul>

                    <a href="#"
                        class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none"
                        data-toggle="collapse" data-target="#main-navbar">
                        <span></span>
                    </a>
                </div>
            </div>
        </div>
    </nav>