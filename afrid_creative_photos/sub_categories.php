<?php require('required/header.php'); ?><main>
    <div class='container-fluid' id='Sub_categoriesContainer'>
        <div class='card shadow-sm mb-3 mainCard'>
            <div class='card-header d-flex flex-column flex-md-row align-items-center justify-content-md-between'>
                <h3 class='h1 mb-md-0 mb-sm-3 text-center mb-4'><?php if (isset($_GET["bin"])) { ?><a href="sub_categories" class="mr-3 btn btn-primary"><i class="fas fa-arrow-left"></i></a><?php } ?>Sub Categories <?= (isset($_GET["bin"])) ? "<small class='text-danger'>(Trash Box)</small>" : null ?></h3>
                <div class='actions text-center'><button type='button' class='btn btn-primary addSub_categories' data-id='0' data-modaltitle='Create Sub Categories'><i class='fas fa-plus'></i> Add Sub Categories</button><button class='btn btn-warning btn-special resetSearch text-white '>Reset <i class='fas fa-sync-alt'></i></button><button class='btn btn-success exportViewOnly'>Excel <i class='far fa-file-excel'></i></button><?php if (!isset($_GET["bin"])) { ?><a href="sub_categories?bin=true" class="btn btn-danger">Recycle Bin <i class="far fa-trash-alt"></i></a><?php } ?></div>
            </div>
            <div class='card-body px-4'>
                <table class='table w-100 table-striped table-bordered table-hover align-items-center table-sm listOfSub_categories dt-responsive data-feed-crud'>
                    <thead class='thead-light'>
                        <tr>
                            <th>Sr #</th>
                            <th>Main Category</th>
                            <th>Name</th>
                            <th>Created On</th>
                            <th>Updated On</th>
                        </tr>
                        <tr class='noExl'>
                            <td class='p-0 border-0' colspan='6'><input placeholder='&#x1F50D; Throughout Search' type='text' accesskey=0 autocomplete='off' class='form-control hitSearch ' id='throughOut'></th>
                            </td>
                        </tr>
                        <tr class='noExl'>
                            <th class='basic-headers noExl'>Sr #</th>
                            <th class='hasInput'> <input placeholder='&#x1F50D;  Main Category' type='text' accesskey=1 autocomplete='off' class='form-control hitSearch' id='searchCategory_name'></th>
                            <th class='hasInput'> <input placeholder='&#x1F50D;  Name' type='text' accesskey=2 autocomplete='off' class='form-control hitSearch' id='searchName'></th>
                            <th class='hasInput'> <input placeholder='&#x1F50D;  Created On' type='text' accesskey=4 autocomplete='off' class='form-control hitSearch date-time-range-picker' id='searchCreatedOn'></th>
                            <th class='hasInput'> <input placeholder='&#x1F50D;  Updated On' type='text' accesskey=5 autocomplete='off' class='form-control hitSearch date-time-range-picker' id='searchModifiedOn'></th>
                        </tr>
                    </thead>
                    <tfoot class='thead-light'>
                        <tr>
                            <th>Sr #</th>
                            <th>Main Category</th>
                            <th>Name</th>
                            <th>Created On</th>
                            <th>Updated On</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div><?php require('required/sub_categories-modals.php'); ?>
</main><?php require('required/footer.php'); ?>