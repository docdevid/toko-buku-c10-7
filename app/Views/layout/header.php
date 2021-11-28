<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap css -->
    <link rel="stylesheet" href="<?= base_url('/node_modules/bootstrap/dist/css/bootstrap.min.css') ?>">
    <script src="<?= base_url('/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <script src="<?= base_url("node_modules/sweetalert2/dist/sweetalert2.min.js") ?>"></script>
    <link rel="stylesheet" href="<?= base_url("node_modules/sweetalert2/dist/sweetalert2.min.css") ?>">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script src="<?= base_url("node_modules/leaflet-geometryutil/") ?>/src/leaflet.geometryutil.js"></script>
    <script src="<?= base_url("node_modules/leaflet-arrowheads/") ?>/src/leaflet-arrowheads.js"></script>
    <?= $this->renderSection('head') ?>
    <title><?= $title ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark border-bottom bg-primary py-2 mb-5">
        <div class="container container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand px-0 px-sm-4" href="#">
                <img src="<?= base_url('/image/logo/logo.svg') ?>" />
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if (!isLoggedIn() || isAdminRole('MEMBER')) : ?>
                        <li class="nav-item">
                            <a class="nav-link<?= url_is('/') || url_is('home*') ? ' active ' : ' ' ?> aria-current=" page" href="<?= base_url('home') ?>">Home</a>
                        </li>
                        <?php
                        $kategoriModel = model('KategoriModel')
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Kategori
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="<?= site_url('iklan') ?>">Semua Kategori</a></li>
                                <?php foreach ($kategoriModel->find() as $kategori) : ?>
                                    <li><a class="dropdown-item" href="<?= site_url('iklan/kategori/' . $kategori->id) ?>"><?= $kategori->kategori ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= url_is('/member') || url_is('member/iklan*') ? ' active ' : ' ' ?> aria-current=" page" href="<?= base_url('member/iklan') ?>">Iklan</a>
                        </li>
                    <?php endif; ?>
                    <?php if (isAdminRole('ADMIN')) : ?>
                        <li class="nav-item">
                            <a class="nav-link<?= url_is(session()->get('userdata')->role . '/dashboard') ? ' active ' : ' ' ?> <?= isLoggedIn() ?: 'disabled' ?>" aria-current="page" href="<?= base_url('admin/dashboard') ?>">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= url_is(session()->get('userdata')->role . '/iklan') ? ' active ' : ' ' ?> <?= isLoggedIn() ?: 'disabled' ?>" aria-current="page" href="<?= base_url('admin/iklan') ?>">Iklan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= url_is(session()->get('userdata')->role . '/penerbit') ? ' active ' : ' ' ?> <?= isLoggedIn() ?: 'disabled' ?>" aria-current="page" href="<?= base_url('admin/penerbit') ?>">Penerbit</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= url_is(session()->get('userdata')->role . '/kategori') ? ' active ' : ' ' ?> <?= isLoggedIn() ?: 'disabled' ?>" aria-current="page" href="<?= base_url('admin/kategori') ?>">Kategori</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= url_is('admin/user*') ? ' active ' : ' ' ?> <?= isLoggedIn() ?: 'disabled' ?>" aria-current="page" href="<?= base_url('admin/user') ?>">Pengguna </a>
                        </li>
                    <?php endif; ?>
                </ul>
                <?php if (isAdminRole('MEMBER')) : ?>
                    <form method="GET" action="<?= current_url() ?>" class="d-flex">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search" value="<?= $_GET['search'] ?? null ?>" aria-label="Search">
                        <button class="btn btn-outline-light" type="submit">Search</button>
                    </form>
                <?php endif; ?>
                <?php if (!isLoggedIn()) : ?>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link<?= url_is('login*') ? ' active' : '' ?>" aria-current="page" href="<?= base_url('login') ?>">Login</a>
                        </li>
                    </ul>
                <?php else : ?>
                    <ul class="navbar-nav mb-2 mb-lg-0 me-0 me-sm-3">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @<?= session()->get('userdata')->username ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li class="d-none"><a class="dropdown-item" href="#">Pengaturan</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php endif; ?>

            </div>
        </div>
    </nav>