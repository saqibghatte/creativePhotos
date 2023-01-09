<?php require("required/config.php");
if (!$logged_in_admin) {
    redirect("login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= strtoupper(str_replace(".php", "", basename($_SERVER["PHP_SELF"]))) ?> PAGE </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-1.11.2/datatables.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.14.0/dist/sweetalert2.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/css/required.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">


</head>


<body>
    <?php if (isset($_SESSION["notification"])) {
        $notification = explode(",", $_SESSION["notification"]);
        echo "<div class='phpMsg  msgNotice z-depth-1 bg-$notification[0]'>$notification[1]</div>";
        unset($_SESSION["notification"]);
    } ?>
    <nav class="navbar bg-white fixed-left navbar-expand-xs navbar-light navbar-vertical sidenav" id=sidenav-main>
        <div class=scrollbar-inner>
            <div class=navbar-inner>
                <div class="collapse navbar-collapse" id=sidenav-collapse-main>
                    <ul class="navbar-nav">
                        <?php require('required/sidebar.php') ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class=main-content id=panel>
        <nav class="navbar bg-default border-bottom fixed-top navbar-dark navbar-expand navbar-top shadow-sm">
            <div class=container-fluid>
                <div class="collapse navbar-collapse" id=navbarSupportedContent>
                    <ul class="align-items-center navbar-nav">
                        <li class="nav-item align-items-center d-flex">
                            <div class=sidenav-toggler-dark>
                                <div class="pr-3 sidenav-toggler" data-action=sidenav-pin data-target=#sidenav-main>
                                    <div class=sidenav-toggler-inner><i class=sidenav-toggler-line></i> <i class=sidenav-toggler-line></i> <i class=sidenav-toggler-line></i></div>
                                </div>
                            </div><a class="navbar-brand pl-3" href='index'>
                                <h2 class="m-0 text-white">Afrid Creative Photos</h2>
                            </a>
                        </li>
                    </ul>
                    <ul class="align-items-center navbar-nav ml-auto">
                        <li class="nav-item dropdown"><a class="nav-link pr-0" href=# aria-expanded=false data-toggle=dropdown role=button aria-haspopup=true>
                                <div class="align-items-center media"><span class="avatar avatar-sm rounded-circle"><img src='assets/images/avatar.png'></span>
                                    <div class="d-lg-block d-none media-body ml-2"><span class="font-weight-bold mb-0 text-sm"><?= "$logged_in_admin->fname $logged_in_admin->lname"  ?></span></div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header noti-title">
                                    <h6 class="m-0 text-overflow">Welcome!</h6>
                                </div>
                                <a class=dropdown-item href='change-password'><i class="ni ni-single-02"></i><span>Change Password</span> </a>
                                <a class=dropdown-item href='logout'><i class="ni ni-user-run"></i> <span>Logout</span></a>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="page-content">