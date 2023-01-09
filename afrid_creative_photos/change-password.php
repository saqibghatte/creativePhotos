<?php require("required/header.php"); ?>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm mb-3">
                    <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-md-between">
                        <h3 class="h1 mb-md-0 mb-sm-3 text-center mb-4">Change Password</h3>
                        <?php
                        if (isset($_POST['changePassword'])) {
                            $current_password = Encrypt(secure($_POST['current_password']));
                            $new_password = Encrypt(secure($_POST['new_password']));
                            $confirm_new_password = Encrypt(secure($_POST['confirm_new_password']));
                            if ($current_password === $new_password)
                                gen_log("danger", "Current Password &amp; New Password cannot be same");
                            if ($new_password === $confirm_new_password) {
                                if ($current_password === $logged_in_user->password) {
                                    $sql = "UPDATE `admin` SET `password` = '$new_password' WHERE `email`='$email'";
                                    $result = $mysqli->query($sql);
                                    if ($result) {
                                        gen_log("success", "Password successfully changed!");
                                    }
                                } else gen_log("danger", "Current Password is Incorrect. Please try again");
                            } else  gen_log("danger", "New Password does not match with Confirm Password. Please try again");
                            header("Location:change-password");
                            exit();
                        }
                        ?>

                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Current Password</label>
                                        <input class="form-control" type="password" placeholder="" name="current_password" id="current_password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="" class="form-control-label">New Password</label>
                                        <input class="form-control" type="password" placeholder="" name="new_password" id="new_password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="" class="form-control-label">Confirm New Password</label>
                                        <input class="form-control" type="password" placeholder="" name="confirm_new_password" id="confirm_new_password">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" name="changePassword"> Change Password </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require('required/footer.php'); ?>