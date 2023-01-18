<?php require('required/header.php'); ?><main>
    <div class='container-fluid' id='ContentsContainer'>
        <div class='card shadow-sm mb-3 mainCard'>
            <div class='card-header d-flex flex-column flex-md-row align-items-center justify-content-md-between'>
                <h3 class='h1 mb-md-0 mb-sm-3 text-center mb-4'>Contents </h3>
            </div>
            <div class='card-body px-4'>
                <table class='table w-100 table-striped table-bordered table-hover align-items-center table-sm listOfContents dt-responsive data-feed-crud'>
                    <thead class='thead-light'>
                        <tr>
                            <th>Sr #</th>
                            <th>Title </th>
                            <th>Created On</th>
                            <th>Updated On</th>
                        </tr>
                        <tr class='noExl'>
                            <th class='basic-headers noExl'>Sr #</th>
                            <th class='hasInput'> <input placeholder='&#x1F50D;  Title ' type='text' accesskey=1 autocomplete='off' class='form-control hitSearch' id='searchTitle'></th>
                            <th class='hasInput'> <input placeholder='&#x1F50D;  Created On' type='text' accesskey=2 autocomplete='off' class='form-control hitSearch date-time-range-picker' id='searchCreatedOn'></th>
                            <th class='hasInput'> <input placeholder='&#x1F50D;  Updated On' type='text' accesskey=3 autocomplete='off' class='form-control hitSearch date-time-range-picker' id='searchModifiedOn'></th>
                        </tr>
                    </thead>
                    <tfoot class='thead-light'>
                        <tr>
                            <th>Sr #</th>
                            <th>Title </th>
                            <th>Created On</th>
                            <th>Updated On</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div><?php require('required/contents-modals.php'); ?>
</main><?php require('required/footer.php'); ?>