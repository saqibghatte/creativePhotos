<?php require("config.php");
if ($logged_in_admin) {
    if (isset($_POST["modifyingPhotos"])) {
        $id = secure($_POST["modifyingPhotos"]);
        $page = getOnlyPageName($_SERVER["HTTP_REFERER"]);
        $allowed_image_extension = ["png.jpg.webp.jpeg"];
        $photos_name = secure($_FILES["photos"]["name"]);
        $photos_tmp_name = $_FILES["photos"]["tmp_name"];
        $photos_extension = pathinfo($photos_name, PATHINFO_EXTENSION);
        if (!empty($photos_name)) {
            $photos = "photos-photos-" . time() . ".webp";
            compress($photos_tmp_name, "../../assets/images/photos/$photos", 800, 800);
        } else $photos = "NULL";
        if (!empty($_POST["heading"])) $heading = secure($_POST["heading"]);
        else {
            echo "Heading is missing";
            exit();
        }
        if (is_numeric($_POST["category"])) $category = secure($_POST["category"]);
        else {
            echo "Category is missing";
            exit();
        }
        if (is_numeric($_POST["subCategory"])) $subCategory = secure($_POST["subCategory"]);
        else {
            echo "Sub Category is missing";
            exit();
        }
        if (secure($_POST["modifyingPhotos"]) > 0) {
            $sql = "UPDATE `photos` SET " . (empty($photos_name) ? null : ",`photos`='$photos'") . "`heading`='$heading',`category`='$category',`subCategory`='$subCategory' WHERE `id` = $id";
            $result = runQuery($sql);
            $msg = "updated";
        } else {
            $sql = "INSERT INTO `photos` (`photos`,`heading`,`category`,`subCategory`) VALUES ('$photos','$heading','$category','$subCategory')";
            $result = runQuery($sql);
            $photos_id = $mysqli->insert_id;
            if ($page == "photos-view") $msg = $photos_id;
            else $msg = "created";
        }
        if ($result) {
            echo $msg;
        } else echo str_replace("for key", "column ", $mysqli->error);
        exit();
    } elseif (isset($_POST["detailsOf"]) && secure($_POST["detailsOf"]) == "photos") {
        $recycleBin = secure($_POST["recycleBin"]);
        $recycleBin = ($recycleBin == "true") ? 1 : 0;
        $searchThroughOut = secure($_POST["searchThroughOut"]);
        $searchPhotos = secure($_POST['searchPhotos']);
        $searchHeading = secure($_POST['searchHeading']);
        $searchCategory_name = secure($_POST["searchCategory_name"]);
        $searchSub_name = secure($_POST["searchSub_name"]);
        $searchCreatedOn = secure($_POST['searchCreatedOn']);
        $searchModifiedOn = secure($_POST['searchModifiedOn']);
        $searchPhotos = !empty($searchPhotos) ? "AND photos LIKE '%$searchPhotos%'" : '';
        $searchHeading = !empty($searchHeading) ? "AND heading LIKE '%$searchHeading%'" : '';
        $searchCategory_name = !empty($searchCategory_name) ? "AND (SELECT `name` FROM `categories` WHERE `id` = `photos`.`category`) LIKE '%$searchCategory_name%'" : '';
        $searchSub_name = !empty($searchSub_name) ? "AND (SELECT `name` FROM `sub_categories` WHERE `id` = `photos`.`subCategory`) LIKE '%$searchSub_name%'" : '';
        if (!empty($searchCreatedOn)) {
            $searchCreatedOn = explode('to', $searchCreatedOn);
            $searchCreatedOnEnd = date('Y-m-d h:i:s a', strtotime($searchCreatedOn[1]));
            $searchCreatedOnStart = date('Y-m-d h:i:s a', strtotime($searchCreatedOn[0]));
            $searchCreatedOn = "AND createdOn BETWEEN '$searchCreatedOnStart' AND '$searchCreatedOnEnd'";
        } else $searchCreatedOnStart = '';
        if (!empty($searchModifiedOn)) {
            $searchModifiedOn = explode('to', $searchModifiedOn);
            $searchModifiedOnEnd = date('Y-m-d h:i:s a', strtotime($searchModifiedOn[1]));
            $searchModifiedOnStart = date('Y-m-d h:i:s a', strtotime($searchModifiedOn[0]));
            $searchModifiedOn = "AND modifiedOn BETWEEN '$searchModifiedOnStart' AND '$searchModifiedOnEnd'";
        } else $searchModifiedOnStart = '';
        $searchThroughOut = !empty($searchThroughOut) ? "AND CONCAT_WS(' ',`photos`,`heading`,`categories`.`name`,`sub_categories`.`name`) LIKE '%$searchThroughOut%'" : '';
        $search_params = "$searchPhotos $searchHeading $searchCategory_name $searchSub_name $searchCreatedOn $searchModifiedOn $searchThroughOut";
        $fetchQuery = "SELECT `photos`.* ,(SELECT `name` FROM `categories` WHERE `id` = `photos`.`category`) AS `category_name`,(SELECT `name` FROM `sub_categories` WHERE `id` = `photos`.`subCategory`) AS `sub_name` FROM `photos` WHERE `photos`.`isDeleted` = $recycleBin $search_params";
        $data = array();
        $count = 0;
        $start = secure($_POST["start"]);
        $length = secure($_POST["length"]);
        $draw = secure($_POST["draw"]);
        $count_sql = "SELECT COUNT(`photos`.`id`) AS `total_count` FROM `photos` WHERE `photos`.`isDeleted` = $recycleBin $search_params";
        $totalCount = runQuery($count_sql)->fetch_assoc()["total_count"];
        $sql = "$fetchQuery ORDER BY `photos`.`id` LIMIT $start,$length";
        $result = runQuery($sql);
        while ($row = $result->fetch_object()) {
            $modifiers = "data-photos='$row->photos'data-heading='$row->heading'data-category='$row->category'data-subcategory='$row->subCategory' data-id='$row->id' ";
            $view = '<a class="p-1 mx-1 text-success" href="photos-view?photos_id=' . $row->id . '"><i class="far fa-file-alt"></i> View</a>';
            $edit = '<a data-modaltitle="Edit" ' . $modifiers . ' class="p-1 mx-1 text-primary editPhotos"><i class="fas fa-edit"></i> Edit</a>';
            $delete = '<a data-toggle="modal" data-target="#deletePhotos" data-id="' . $row->id . '" class="p-1 mx-1 text-danger deletePhotos"><i class="fas fa-trash-alt"></i> Delete </a>';
            $restore = '<a data-toggle="modal" data-target="#restorePhotos" data-id="' . $row->id . '" class="p-1 mx-1 Photos"><i class="fas fa-trash-restore"></i> Restore </a>';
            if (!$recycleBin) $actions = "$view$edit$delete";
            else $actions = "$view$restore";
            array_push($data, array('Photos' => "<a download>$row->photos</a>", 'Heading' => $row->heading, 'Category' => $row->category_name, 'Sub Category' => $row->sub_name, 'Created On' => formatDateTime($row->createdOn), 'Updated On' => formatDateTime($row->modifiedOn), "Sr #" => '<span class="btn-collection p-2 mt-n2">' . $actions . '</span>' . (++$count + $start),));
        }
        $results = array("draw" => $draw, "recordsTotal" => $totalCount, "recordsFiltered" => $totalCount, "aaData" => $data);
        echo json_encode($results);
    } elseif (isset($_POST["photos_id"])) {
        $data = array();
        $id = secure($_POST["photos_id"]);
        $photos = runQuery("SELECT `photos`.* ,(SELECT `name` FROM `categories` WHERE `id` = `photos`.`category`) AS `category_name`,(SELECT `name` FROM `sub_categories` WHERE `id` = `photos`.`subCategory`) AS `sub_name` FROM `photos` WHERE `photos`. `isDeleted` IN (0,1) AND `photos`.`id` = $id")->fetch_object();
        if (is_null($photos)) {
            echo "false";
        } else {
            $row = $photos;
            $modifiers = "data-photos='$row->photos'data-heading='$row->heading'data-category='$row->category'data-subcategory='$row->subCategory' data-id='$row->id'";
            $edit = "<a data-modaltitle='Edit' $modifiers class='btn btn-primary text-white editPhotos'><i class='fas fa-edit'></i> Edit</a>";
            $delete = "<a data-toggle='modal' data-target='#deletePhotos' data-id='$photos->id' class='btn btn-danger text-white deletePhotos'><i class='fas fa-trash-alt'></i> Delete </a>";
            $restore = "<a data-toggle='modal' data-target='#restorePhotos' data-id='$photos->id' class='btn btn-success text-white restorePhotos'><i class='fas fa-trash-restore'></i> Restore </a>";
            if ($row->isDeleted == 0) $actions = "$edit$delete";
            else $actions = "$restore";
            $data = array('PHOTOS' => $row->photos, 'HEADING' => $row->heading, 'CATEGORY' => $row->category_name, 'SUB_CATEGORY' => $row->sub_name, 'CREATED_ON' => formatDateTime($row->createdOn), 'UPDATED_ON' => formatDateTime($row->modifiedOn), "Actions" => "$actions");
            echo json_encode($data);
        }
    } elseif (isset($_POST["deletePhotos"])) {
        $id = secure($_POST["photosDeleteId"]);
        if (is_numeric($id)) {
            $sql = "UPDATE `photos` SET `isDeleted` =1 WHERE `id`=$id AND `isDeleted` = 0";
            if (runQuery($sql)) echo "true";
        } else echo "false";
        exit();
    } elseif (isset($_POST["restorePhotos"])) {
        $id = secure($_POST["photosRestoreId"]);
        if (is_numeric($id)) {
            $sql = "UPDATE `photos` SET `isDeleted` =0 WHERE `id`=$id AND `isDeleted` = 1";
            if (runQuery($sql)) echo "true";
        } else echo "false";
        exit();
    }
} else echo '403 Forbidden Access';
