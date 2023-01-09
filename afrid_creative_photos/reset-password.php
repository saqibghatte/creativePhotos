<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Afrid Creative Photos - Reset Password</title>
    <link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicon/apple-touch-icon.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/dashboard.css" type="text/css">
</head>

<body class="bg-white">
    <?php
    require("includes/config.php");
    if ($logged_in_admin) {
        header("location:index");
    }

    if (isset($_GET['data'])) {
        $randomString = secure($_GET['data']);
        $sql = "SELECT * FROM `admin` WHERE `randomString`=\"$randomString\"";
        $res = $mysqli->query($sql);
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $email_data = $row['email'];
            $name_date = $row['fname'] . " " . $row['lname'];
        } else {
            gen_log("warning", "Link Incorrect or Expired. Please try again.");
            header("Location:login");
            exit();
        }
    } else {
        gen_log("danger", "Incorrect Link. Please try login or <a href='forgot-password'>Forgot Password</a>");
        header("Location:login");
        exit();
    }
    if (isset($_POST['resetPassword']) && isset($_GET['data'])) {
        $newpassword = secure($_POST['newpassword']);
        $cnewpassword = secure($_POST['cnewpassword']);
        $randomString = secure($_GET['data']);
        if ($newpassword == $cnewpassword) {
            $newpassword = Encrypt($newpassword);
            $sql = "UPDATE `admin` SET `password`='$newpassword',`randomString`='' WHERE `randomString`='$randomString'";
            $result = $mysqli->query($sql);
            if ($mysqli->affected_rows > 0) {
                $subject = "Password Changed";
                $message = "Dear <b>" . $row['fname'] . " " . $row['lname']  . "</b>, <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The password for your Impact Dashboard Account $email_data was changed. If you didn't change it, kindly write us on " . $notificationEmail;
                // mailSender($email, notificationEmail, $subject, $message);
                gen_log("success", "Password Changed Successfully! Please login to continue.");
                header("Location:login");
                exit();
            } else {
                gen_log("warning", "Oops! Something went wrong. Please try again");
                header('location:' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        } else {
            gen_log("warning", "Passwords does not match. Please try again");
            header('location:' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
    ?>
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-4 py-lg-4 pt-lg-4">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-12 p-5">
                            <h1 class="text-white">Welcome!</h1>
                            <p class="text-lead text-white">Please Enter your New Password.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--9 pb-5 text-gray">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-7 col-sm-12">
                    <div class="card  border border-soft mb-0">
                        <div class="card-header bg-transparent">
                            <div class="text-center mt-2 mb-3">
                                <h1>Change Password</h1>
                            </div>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                            <form method="post">
                                <?php require("includes/alerts.php"); ?>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-asterisk"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="New Password" name="newpassword" type="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-asterisk"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Confirm New Password" name="cnewpassword" type="password">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="resetPassword" class="btn btn-primary btn-block my-4">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="py-5" id="footer-main">
        <div class="container">
            <div class="row align-items-center justify-content-xl-between">
                <div class="col-xl-12 text-center">
                    <div class="copyright text-muted">
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>