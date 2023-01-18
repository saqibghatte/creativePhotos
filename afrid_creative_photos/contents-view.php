<?php require('required/header.php'); ?><main>
    <div class='container-fluid' id='ContentsContainer'>
        <div class='row'>
            <div class='col-12'>
                <div class='card mainCard shadow-sm mb-3'>
                    <div class='container-fluid'>
                        <div class='card-header d-flex flex-column flex-md-row align-tiems-center justify-content-md-between'>
                            <h3 class='h1 mb-md-0 mb-sm-3 text-center'><a href='contents' class='mr-3 btn btn-sm btn-sm btn-primary'><i class='fas fa-arrow-left'></i></a>Contents</h3>
                            <div class='actions text-center' id='actions'></div>
                        </div>
                    </div>
                    <div class='card-body'>
                        <div class='row'>
                            <div class='col-sm-12 col-md-12 col-lg-12 col-xl-12'>
                                <div class='border border-light p-2 profile-item'>
                                    <div class='profile-item-label'>Title </div>
                                    <div class='profile-item-value' id='viewTITLE_'></div>
                                </div>
                            </div>
                            <div class='col-sm-12 col-md-12 col-lg-12 col-xl-12'>
                                <div class='border border-light p-2 profile-item'>
                                    <div class='profile-item-label'>Content </div>
                                    <div class='profile-item-value' id='viewCONTENT_'></div>
                                </div>
                            </div>
                            <div class='col-sm-12 col-md-4 col-lg-4 col-xl-4'>
                                <div class='border border-light p-2 profile-item'>
                                    <div class='profile-item-label'>Created On</div>
                                    <div class='profile-item-value' id='viewCREATED_ON'></div>
                                </div>
                            </div>
                            <div class='col-sm-12 col-md-4 col-lg-4 col-xl-4'>
                                <div class='border border-light p-2 profile-item'>
                                    <div class='profile-item-label'>Updated On</div>
                                    <div class='profile-item-value' id='viewUPDATED_ON'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><?php require('required/contents-modals.php'); ?>
</main><?php require('required/footer.php'); ?>