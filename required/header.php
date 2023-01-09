<?php
// CONNECTION TO DATABASE
$mysqli = new mysqli("localhost", "root", "", "creative_photos");
// echo $mysqli ? "connected" : "not connected";
// CONNECTION TO DATABASE
ob_start();
?>
<!doctype html>
<html lang="en" class="no-js">

<head>
    <title>Creative Photos</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- FAVICON -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico?">
    <!-- MDB 5 START -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive -->
    <link rel="stylesheet" href="css/media.css">
    <!-- <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/media.css"> -->
    <!-- OWL CAROUSEL 2 START (Ver 2.3.4) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <!-- OWL CAROUSEL 2 END (Ver 2.3.4) -->
</head>

<body>

    <!-- PRE LOADER START -->
    <div class="flipping">
        <div class="hypnotic"></div>
    </div>
    <!-- PRE LOADER END -->

    <!-- Container -->
    <div id="container">
        <!-- Start Header -->
        <header class="clearfix center-menu">
            <nav class="navbar navbar-expand-lg navbar-light p-0 w-100">
                <!-- Container wrapper -->
                <div class="container">
                    <!-- Navbar brand -->
                    <a class="navbar-brand me-2" href="index.php">
                        <img src="assets/img/navbar/logo.png" class="" height="50" alt="Logo" loading="lazy" />
                    </a>

                    <!-- Toggle button -->
                    <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>

                    <!-- Collapsible wrapper -->
                    <div class="collapse navbar-collapse" id="navbarButtonsExample">
                        <!-- Left links -->
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100 d-flex justify-content-end navbarNav" id="navbar-bg">
                            <li class="nav-item px-1">
                                <a class="nav-link text-white fw-bold" href="index.php">Home</a>
                            </li>
                            <li class="nav-item px-1">
                                <a class="nav-link text-white fw-bold" href="about.php">About</a>
                            </li>
                            <li class="nav-item px-1">
                                <a class="nav-link text-white fw-bold" href="events.php">Recent Events</a>
                            </li>
                            <li class="nav-item px-1">
                                <a class="nav-link text-white fw-bold" href="album.php">Albums</a>
                            </li>
                            <li class="nav-item px-1">
                                <a class="nav-link text-white fw-bold" href="contact.php">Contact</a>
                            </li>
                        </ul>

                        <div class="d-flex align-items-center justify-content-end w-100">
                            <ul class="d-flex my-auto">
                                <li class="list-unstyled mx-2">
                                    <!-- Whatsapp -->
                                    <a class="btn btn-outline-white
                                     btn-floating m-1" target="_blank" href="https://wa.me/+123456789" role="button"><i class="fab fa-whatsapp icon_zoom"></i></a>
                                </li>
                                <li class="list-unstyled mx-2">
                                    <!-- Facebook -->
                                    <a class="btn btn-outline-white
                                     btn-floating m-1" target="_blank" href="https://www.facebook.com/linkhere" role="button"><i class="fab fa-facebook-f icon_zoom"></i></a>
                                </li>
                                <li class="list-unstyled mx-2">
                                    <!-- Instagram -->
                                    <a class="btn btn-outline-white
                                     btn-floating m-1" target="_blank" href="https://www.instagram.com/linkhere" role="button"><i class="fab fa-instagram icon_zoom"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Collapsible wrapper -->
                </div>
                <!-- Container wrapper -->
            </nav>

        </header>




        <!-- End Header -->