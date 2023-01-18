<?php require('required/header.php'); ?><main>
    <div class='container-fluid' id='Sub_categoriesContainer'>
        <div class='row'>
            <div class='col-12'>
                <div class='card mainCard shadow-sm mb-3'>
                    <div class='container-fluid'>
                        <div class='card-header d-flex flex-column flex-md-row align-tiems-center justify-content-md-between'>
                            <h3 class='h1 mb-md-0 mb-sm-3 text-center'><a href='sub_categories' class='mr-3 btn btn-sm btn-sm btn-primary'><i class='fas fa-arrow-left'></i></a>Sub_categories</h3>
                            <div class='actions text-center' id='actions'></div>
                        </div>
                    </div>
                    <div class='card-body'>
                        <div class='row'>
                            <div class='container-fluid'>
                                <div class='col-12 px-0'>
                                    <div class='container-fluid'>
                                        <div class='row'>
                                            <div class='col-xl-10 col-lg-10 col-md-10 col-sm-12'>
                                                <div class='container-fluid'>
                                                    <div class='row'>
                                                        <div class='col-sm-12 col-md-6 col-lg-6 col-xl-6'>
                                                            <div class='border border-light p-2 profile-item'>
                                                                <div class='profile-item-label'>Main Category</div>
                                                                <div class='profile-item-value' id='viewMAIN_CATEGORY'></div>
                                                            </div>
                                                        </div>
                                                        <div class='col-sm-12 col-md-6 col-lg-6 col-xl-6'>
                                                            <div class='border border-light p-2 profile-item'>
                                                                <div class='profile-item-label'>Name</div>
                                                                <div class='profile-item-value' id='viewNAME'></div>
                                                            </div>
                                                        </div>
                                                        <div class='col-sm-12 col-md-6 col-lg-6 col-xl-6'>
                                                            <div class='border border-light p-2 profile-item'>
                                                                <div class='profile-item-label'>Created On</div>
                                                                <div class='profile-item-value' id='viewCREATED_ON'></div>
                                                            </div>
                                                        </div>
                                                        <div class='col-sm-12 col-md-6 col-lg-6 col-xl-6'>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><?php require('required/sub_categories-modals.php'); ?>
</main><?php require('required/footer.php'); ?>