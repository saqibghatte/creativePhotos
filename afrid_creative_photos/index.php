<?php require('required/header.php') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm mb-3 mainCard">
                <div class="card-header d-flex flex-column flex-md-row align-items-center justify-content-md-between">
                    <h3 class="h1 mb-md-0 mb-sm-3 text-center mb-4">Dashboard</h3>

                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-right">
                                        <i class="fas fa-sitemap fa-4x text-success"></i>
                                    </div>
                                    <h1><?= $mysqli->query("SELECT count(*) FROM `categories` WHERE `isDeleted`=0")->fetch_row()[0]; ?></h1>
                                    <span class='text-success'>Categories</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-right">
                                        <i class="fas fa-sitemap fa-4x text-primary"></i>
                                    </div>
                                    <h1><?= $mysqli->query("SELECT count(*) FROM `sub_categories` WHERE `isDeleted`=0")->fetch_row()[0]; ?></h1>
                                    <span class='text-primary'>Sub-Categories</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-right">
                                        <i class="fas fa-images fa-4x text-danger"></i>
                                    </div>
                                    <h1><?= $mysqli->query("SELECT count(*) FROM `photos` WHERE `isDeleted`=0")->fetch_row()[0]; ?></h1>
                                    <span class='text-danger'>Photos</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-right">
                                        <i class="fab fa-youtube fa-4x text-warning"></i>
                                    </div>
                                    <h1><?= $mysqli->query("SELECT count(*) FROM `youtube_videos` WHERE `isDeleted`=0")->fetch_row()[0]; ?></h1>
                                    <span class='text-warning'>YouTube Videos</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-right">
                                        <i class="fas fa-glass-cheers fa-4x text-success"></i>
                                    </div>
                                    <h1><?= $mysqli->query("SELECT count(*) FROM `events` WHERE `isDeleted`=0")->fetch_row()[0]; ?></h1>
                                    <span class='text-success'>Events</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-right">
                                        <i class="fas fa-user-tie fa-4x text-info"></i>
                                    </div>
                                    <h1><?= $mysqli->query("SELECT count(*) FROM `admin` WHERE `isDeleted`=0")->fetch_row()[0]; ?></h1>
                                    <span class='text-info'>Admins</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require('required/footer.php') ?>