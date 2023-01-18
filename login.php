<!-- HEADER START -->
<?php require "./required/header.php" ?>
<!-- HEADER END -->


<section class="mt-3 pt-5">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 login-p-container">
                <div class="p-5 rounded text-center position-relative">
                    <div class="">
                        <img src="assets/img/navbar/logo.svg" alt="logo">
                    </div>
                    <div class="my-5">
                        <h3 class="text-primary">Enter a Password</h3>
                        <p>Enter your password to see the photos.</p>
                    </div>
                    <div class="">
                        <label for="password" class="fa-lg fw-bold text-primary">Enter Password</label>
                        <div class="d-flex bg-white border border-2 rounded my-2">
                            <input type="password" class="form-control w-100" id="password-field" name="password">
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password my-auto pe-2 text-primary"></span>
                        </div>
                        <button type="button" class="btn btn-rounded mt-2 w-100 text-primary fw-bold" style="background: #f4d6cc;">Done</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- FOOTER START -->
<?php require "./required/footer.php" ?>
<!-- FOOTER END -->