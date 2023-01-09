<!-- HEADER START -->
<?php require "./required/header.php" ?>
<!-- HEADER END -->


<section class="mt-3 pt-5">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <!-- <div class="col-lg-12 login-p-container">

                <div class="login-container ">
                    <div class="img pb-5 text-center">
                        <img src="assets/img/navbar/logo.png" class="img-fluid" alt="Logo">
                        <p class="my-3 fa-lg fw-bold">Enter a password</p>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cupiditate eius quo doloribus adipisci autem nesciunt quos?</p>
                    </div>

                    <div class="">
                        <div class="form-group text-start py-2">
                            <label for="password" class="fa-lg fw-bold w-50">Enter Password</label>
                            <input type="password" class="form-control w-50" name="password">
                        </div>

                        <div class="">
                            <button type="button" class="btn btn-secondary btn-rounded w-50">Done</button>
                        </div>
                    </div>
                </div>

            </div> -->




            <div class="col-lg-6 login-p-container">

                <div class="bg-white p-5 rounded text-center position-relative">

                    <!-- <div class="text-center m-0">
                        <a href="index.php"><i class="fas fa-long-arrow-alt-left fa-2x position-absolute top-0 text-dark"></i></a>
                    </div> -->

                    <div class="">
                        <img src="assets/img/navbar/logo.png" alt="logo">
                    </div>
                    <div class="my-5">
                        <h3>Enter a Password</h3>
                        <p>Enter your password to see the photos</p>
                    </div>
                    <div class="">
                        <label for="password" class="fa-lg fw-bold">Enter Password</label>

                        <div class="d-flex bg-white border border-2 rounded my-2">
                            <input type="password" class="form-control w-100" id="password-field" name="password">
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password my-auto pe-2"></span>
                        </div>

                        <button type="button" class="btn btn-secondary btn-rounded mt-2 w-100">Done</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<!-- FOOTER START -->
<?php require "./required/footer.php" ?>
<!-- FOOTER END -->