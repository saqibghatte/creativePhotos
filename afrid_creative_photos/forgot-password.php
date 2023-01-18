<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Kreative Fotos - Forgot Password</title>
  <link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicon/apple-touch-icon.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <link rel="stylesheet" href="assets/css/dashboard.css" type="text/css">
</head>

<body class="bg-white">
  <?php
  require("required/config.php");
  if ($logged_in_admin)  header("location:index");

  if (isset($_POST['submit'])) {
    $email = secure($_POST['email']);
    $verficationCode = stringGenerator();
    $sql = "SELECT * FROM `admin` WHERE `email`='$email'";
    $result = $mysqli->query($sql);
    if ($row = $result->fetch_assoc() && $result->num_rows > 0) {
      $sql = "UPDATE `admin` set `randomString`='$verficationCode' WHERE `email`='$email'";
      $result = $mysqli->query($sql);
      $subject = "Reset Account Password";
      $message = "Dear <b>" . $row['fname'] . " " . $row['lname']  . "</b>, <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We are sorry to hear that you lossed your account password. But we are always here to help you! Kindly reset your Password to get account access. Click the link below or copy the link and open in new tab.<br><br><a href='" . BASE_URL . "/reset-password?data=$verficationCode'>" . BASE_URL . "reset-password?data=$verficationCode</a>";
      // mailSender($email, notificationEmail, $subject, $message);
      gen_log("success", "Mail sent at $email. Please check your email to reset password.");
    } else {
      gen_log("warning", "\"$email\" not found.");
    }
    header("Location:forgot-password");
    exit();
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
              <p class="text-lead text-white">Please Enter Email to Recover Password.</p>
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
                <h1>Forgot Password</h1>
              </div>
            </div>
            <div class="card-body px-lg-5 py-lg-5">
              <form method="post">
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" type="email" name="email">
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" name="submit" class="btn btn-primary btn-block my-4">Recover Password</button>
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