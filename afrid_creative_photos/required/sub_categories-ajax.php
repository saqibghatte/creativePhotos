<?php require("config.php");
if ($logged_in_admin) {
    if (isset($_POST["modifyingSub_categories"])) {
        $id = secure($_POST["modifyingSub_categories"]);
        $page = getOnlyPageName($_SERVER["HTTP_REFERER"]);
        if (is_numeric($_POST["category_id"])) $category_id = secure($_POST["category_id"]);
        else {
            echo "Main Category is missing";
            exit();
        }
        if (!empty($_POST["name"])) $name = secure($_POST["name"]);
        else {
            echo "Name is missing";
            exit();
        }
        if (secure($_POST["modifyingSub_categories"]) > 0) {
            $sql = "UPDATE `sub_categories` SET `category_id`='$category_id',`name`='$name' WHERE `id` = $id";
            $result = runQuery($sql);
            $msg = "updated";
        } else {
            $sql = "INSERT INTO `sub_categories` (`category_id`,`name`) VALUES ('$category_id','$name')";
            $result = runQuery($sql);
            $sub_categories_id = $mysqli->insert_id;
            if ($page == "sub_categories-view") $msg = $sub_categories_id;
            else $msg = "created";
        }
        if ($result) {
            echo $msg;
        } else echo str_replace("for key", "column ", $mysqli->error);
        exit();
    } elseif (isset($_POST["detailsOf"]) && secure($_POST["detailsOf"]) == "sub_categories") {
        $recycleBin = secure($_POST["recycleBin"]);
        $recycleBin = ($recycleBin == "true") ? 1 : 0;
        $searchThroughOut = secure($_POST["searchThroughOut"]);
        $searchCategory_name = secure($_POST["searchCategory_name"]);
        $searchName = secure($_POST['searchName']);
        $searchCreatedOn = secure($_POST['searchCreatedOn']);
        $searchModifiedOn = secure($_POST['searchModifiedOn']);
        $searchCategory_name = !empty($searchCategory_name) ? "AND (SELECT `name` FROM `categories` WHERE `id` = `sub_categories`.`category_id`) LIKE '%$searchCategory_name%'" : '';
        $searchName = !empty($searchName) ? "AND name LIKE '%$searchName%'" : '';
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
        $searchThroughOut = !empty($searchThroughOut) ? "AND CONCAT_WS(' ',`categories`.`name`,`name`) LIKE '%$searchThroughOut%'" : '';
        $search_params = "$searchCategory_name $searchName $searchCreatedOn $searchModifiedOn $searchThroughOut";
        $fetchQuery = "SELECT `sub_categories`.* ,(SELECT `name` FROM `categories` WHERE `id` = `sub_categories`.`category_id`) AS `category_name` FROM `sub_categories` WHERE `sub_categories`.`isDeleted` = $recycleBin $search_params";
        $data = array();
        $count = 0;
        $start = secure($_POST["start"]);
        $length = secure($_POST["length"]);
        $draw = secure($_POST["draw"]);
        $count_sql = "SELECT COUNT(`sub_categories`.`id`) AS `total_count` FROM `sub_categories` WHERE `sub_categories`.`isDeleted` = $recycleBin $search_params";
        $totalCount = runQuery($count_sql)->fetch_assoc()["total_count"];
        $sql = "$fetchQuery ORDER BY `sub_categories`.`id` LIMIT $start,$length";
        $result = runQuery($sql);
        while ($row = $result->fetch_object()) {
            $modifiers = "data-category_id='$row->category_id'data-name='$row->name' data-id='$row->id' ";
            $view = '<a class="p-1 mx-1 text-success" href="sub_categories-view?sub_categories_id=' . $row->id . '"><i class="far fa-file-alt"></i> View</a>';
            $edit = '<a data-modaltitle="Edit" ' . $modifiers . ' class="p-1 mx-1 text-primary editSub_categories"><i class="fas fa-edit"></i> Edit</a>';
            $delete = '<a data-toggle="modal" data-target="#deleteSub_categories" data-id="' . $row->id . '" class="p-1 mx-1 text-danger deleteSub_categories"><i class="fas fa-trash-alt"></i> Delete </a>';
            $restore = '<a data-toggle="modal" data-target="#restoreSub_categories" data-id="' . $row->id . '" class="p-1 mx-1 Sub_categories"><i class="fas fa-trash-restore"></i> Restore </a>';
            if (!$recycleBin) $actions = "$view$edit$delete";
            else $actions = "$view$restore";
            array_push($data, array('Main Category' => $row->category_name, 'Name' => $row->name, 'Created On' => formatDateTime($row->createdOn), 'Updated On' => formatDateTime($row->modifiedOn), "Sr #" => '<span class="btn-collection p-2 mt-n2">' . $actions . '</span>' . (++$count + $start),));
        }
        $results = array("draw" => $draw, "recordsTotal" => $totalCount, "recordsFiltered" => $totalCount, "aaData" => $data);
        echo json_encode($results);
    } elseif (isset($_POST["sub_categories_id"])) {
        $data = array();
        $id = secure($_POST["sub_categories_id"]);
        $sub_categories = runQuery("SELECT `sub_categories`.* ,(SELECT `name` FROM `categories` WHERE `id` = `sub_categories`.`category_id`) AS `category_name` FROM `sub_categories` WHERE `sub_categories`. `isDeleted` IN (0,1) AND `sub_categories`.`id` = $id")->fetch_object();
        if (is_null($sub_categories)) {
            echo "false";
        } else {
            $row = $sub_categories;
            $modifiers = "data-category_id='$row->category_id'data-name='$row->name' data-id='$row->id'";
            $edit = "<a data-modaltitle='Edit' $modifiers class='btn btn-primary text-white editSub_categories'><i class='fas fa-edit'></i> Edit</a>";
            $delete = "<a data-toggle='modal' data-target='#deleteSub_categories' data-id='$sub_categories->id' class='btn btn-danger text-white deleteSub_categories'><i class='fas fa-trash-alt'></i> Delete </a>";
            $restore = "<a data-toggle='modal' data-target='#restoreSub_categories' data-id='$sub_categories->id' class='btn btn-success text-white restoreSub_categories'><i class='fas fa-trash-restore'></i> Restore </a>";
            if ($row->isDeleted == 0) $actions = "$edit$delete";
            else $actions = "$restore";
            $data = array('MAIN_CATEGORY' => $row->category_name, 'NAME' => $row->name, 'CREATED_ON' => formatDateTime($row->createdOn), 'UPDATED_ON' => formatDateTime($row->modifiedOn), "Actions" => "$actions");
            echo json_encode($data);
        }
    } elseif (isset($_POST["deleteSub_categories"])) {
        $id = secure($_POST["sub_categoriesDeleteId"]);
        if (is_numeric($id)) {
            $sql = "UPDATE `sub_categories` SET `isDeleted` =1 WHERE `id`=$id AND `isDeleted` = 0";
            if (runQuery($sql)) echo "true";
        } else echo "false";
        exit();
    } elseif (isset($_POST["restoreSub_categories"])) {
        $id = secure($_POST["sub_categoriesRestoreId"]);
        if (is_numeric($id)) {
            $sql = "UPDATE `sub_categories` SET `isDeleted` =0 WHERE `id`=$id AND `isDeleted` = 1";
            if (runQuery($sql)) echo "true";
        } else echo "false";
        exit();
    }
} else echo '403 Forbidden Access';
