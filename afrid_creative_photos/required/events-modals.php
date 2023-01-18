<?php if (strpos($_SERVER["PHP_SELF"], basename(__FILE__)) > 0) header("location:" . $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"]); ?><div class='container-fluid'>
    <div class='row'>
        <div class='col-12'>
            <div class='card shadow-sm mb-3'>
                <div class='modal fade' id='deleteEvents' tabindex='-1'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-body'><a class='close float-right' data-dismiss='modal' aria-label='Close'><i class='far fa-times-circle text-danger fa-2x'></i></a>
                                <div class='text-center pt-5 text-danger'><i class='fas fa-trash-alt fa-5x '></i>
                                    <h1 class='w-100 text-danger'>Are you sure?</h1>
                                    <p class='mt-3'>Once Deleted this Entry is available in Recycle Bin and can be restored back if need be.</p><input type='hidden' name='eventsDeleteId'>
                                    <div class='text-center mt-3'><a data-dismiss='modal' class='btn btn-sm btn-white text-danger'><i class='fas fa-times'></i> I Changed My Mind!</a><button class='btn btn-sm btn-danger' name='deleteEvents'><i class='fas fa-check'></i> Yes, Delete It.</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='modal fade' id='restoreEvents' tabindex='-1'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-body'><a class='close float-right' data-dismiss='modal' aria-label='Close'><i class='far fa-times-circle text-success fa-2x'></i></a>
                                <div class='text-center pt-5 text-success'><i class='fas fa-trash-restore fa-5x '></i>
                                    <h1 class='w-100 text-success'>Are you sure?</h1>
                                    <p class='mt-3'>Once Restored this entry can be found in main table.</p><input type='hidden' name='eventsRestoreId'>
                                    <div class='text-center mt-3'><a data-dismiss='modal' class='btn btn-sm btn-white text-success'><i class='fas fa-times'></i> I Changed My Mind!</a><button class='btn btn-sm btn-success' name='restoreEvents'><i class='fas fa-check'></i> Yes, Restore It.</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id='manageEvents' style='display: none'>
                    <div class='container-fluid'>
                        <div class='row my-3'>
                            <div class='col-12'>
                                <h3 class='h3'>
                                    <modalTitle class='h1 mb-md-0 mb-sm-3 text-center mb-4'> </modalTitle> <a class='closeManageEvents float-right'><i class='far fa-times-circle fa-2x'></i></a>
                                </h3>
                                <hr class='w-100 mt-4'>
                            </div>
                            <div class='col-12'>
                                <form method='POST' class='container-fluid complete-form-package' enctype='multipart/form-data' id='manageEventsForm'>
                                    <div class='row'><input type='hidden' name='modifyingEvents'>
                                        <div class='col-sm-12 col-md-4 col-lg-4 col-xl-4'><label class='form-control-label' for='image'>Image <sup class='text-small'><i class='text-danger fas fa-star-of-life'></i></sup></label>
                                            <div class='imageUploadContainer'><img onerror="this.onerror=null;this.src='assets/images/not-found.svg'" class='img-fluid'>
                                                <div class='input-group'>
                                                    <div class='input-group-prepend'><span class='input-group-text' id='image'>Image</span></div>
                                                    <div class='custom-file'><input required data-max-size='0' accept='jpeg,pdf,jpg' type='file' class='custom-file-input imageUploader' id='image' name='image'><label class='custom-file-label' for='image'>Image</label></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='col-sm-12 col-md-8 col-lg-8 col-xl-8'>
                                            <div class='md-form '><label class='form-control-label' for='name'>Name <sup class='text-small'><i class='text-danger fas fa-star-of-life'></i></sup></label><input id='name' type='text' name='name' required class=' form-control validate'></div>
                                        </div>
                                        <div class='col-sm-12 col-md-12 col-lg-12 col-xl-12'>
                                            <div class=''><label class='form-control-label' for='description'>Description <sup class='text-small'><i class='text-danger fas fa-star-of-life'></i></sup></label><textarea id='description' required class='md-textarea form-control ckeditor' rows='4' name='description'></textarea></div>
                                        </div>
                                        <div class='col-lg-12'><button class='btn btn-lg btn-primary btn-block mt-4' name='manageEvents' type='submit'></button></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>