<?php require("config.php");
if ($logged_in_admin) {
    if (isset($_POST["modifyingAdmin"])) {
        $id = secure($_POST["modifyingAdmin"]);
        $page = getOnlyPageName($_SERVER["HTTP_REFERER"]);
        if (!empty($_POST["fname"])) $fname = secure($_POST["fname"]);
        else {
            echo "First Name is missing";
            exit();
        }
        if (!empty($_POST["lname"])) $lname = secure($_POST["lname"]);
        else {
            echo "Last Name is missing";
            exit();
        }
        if (!empty($_POST["email"])) $email = secure($_POST["email"]);
        else {
            echo "Email is missing";
            exit();
        }
        if (!empty($_POST["password"])) $password = secure($_POST["password"]);
        else {
            if ($id < 1) {
                echo "Password is missing";
                exit();
            }
        }
        if (secure($_POST["modifyingAdmin"]) > 0) {
            $sql = "UPDATE `admin` SET `fname`='$fname',`lname`='$lname',`email`='$email'," . (empty($password) ? null : "`password`='" . Encrypt($password) . "'") . " WHERE `id` = $id";
            $result = runQuery($sql);
            $msg = "updated";
        } else {
            $sql = "INSERT INTO `admin` (`fname`,`lname`,`email`,`password`) VALUES ('$fname','$lname','$email'," . "'" . Encrypt($password) . "'" . ")";
            $result = runQuery($sql);
            $admin_id = $mysqli->insert_id;
            if ($page == "admin-view") $msg = $admin_id;
            else $msg = "created";
        }
        if ($result) {
            echo $msg;
        } else echo str_replace("for key", "column ", $mysqli->error);
        exit();
    } elseif (isset($_POST["detailsOf"]) && secure($_POST["detailsOf"]) == "admin") {
        $recycleBin = secure($_POST["recycleBin"]);
        $recycleBin = ($recycleBin == "true") ? 1 : 0;
        $searchThroughOut = secure($_POST["searchThroughOut"]);
        $searchFname = secure($_POST['searchFname']);
        $searchLname = secure($_POST['searchLname']);
        $searchEmail = secure($_POST['searchEmail']);
        $searchCreatedOn = secure($_POST['searchCreatedOn']);
        $searchModifiedOn = secure($_POST['searchModifiedOn']);
        $searchFname = !empty($searchFname) ? "AND fname LIKE '%$searchFname%'" : '';
        $searchLname = !empty($searchLname) ? "AND lname LIKE '%$searchLname%'" : '';
        $searchEmail = !empty($searchEmail) ? "AND email LIKE '%$searchEmail%'" : '';
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
        $searchThroughOut = !empty($searchThroughOut) ? "AND CONCAT_WS(' ',`fname`,`lname`,`email`) LIKE '%$searchThroughOut%'" : '';
        $search_params = "$searchFname $searchLname $searchEmail $searchCreatedOn $searchModifiedOn $searchThroughOut";
        $fetchQuery = "SELECT `admin`.* FROM `admin` WHERE `admin`.`isDeleted` = $recycleBin $search_params";
        $data = array();
        $count = 0;
        $start = secure($_POST["start"]);
        $length = secure($_POST["length"]);
        $draw = secure($_POST["draw"]);
        $count_sql = "SELECT COUNT(`admin`.`id`) AS `total_count` FROM `admin` WHERE `admin`.`isDeleted` = $recycleBin $search_params";
        $totalCount = runQuery($count_sql)->fetch_assoc()["total_count"];
        $sql = "$fetchQuery ORDER BY `admin`.`id` LIMIT $start,$length";
        $result = runQuery($sql);
        while ($row = $result->fetch_object()) {
            $modifiers = "data-fname='$row->fname'data-lname='$row->lname'data-email='$row->email' data-id='$row->id' ";
            $view = '<a class="p-1 mx-1 text-success" href="admin-view?admin_id=' . $row->id . '"><i class="far fa-file-alt"></i> View</a>';
            $edit = '<a data-modaltitle="Edit" ' . $modifiers . ' class="p-1 mx-1 text-primary editAdmin"><i class="fas fa-edit"></i> Edit</a>';
            $delete = '<a data-toggle="modal" data-target="#deleteAdmin" data-id="' . $row->id . '" class="p-1 mx-1 text-danger deleteAdmin"><i class="fas fa-trash-alt"></i> Delete </a>';
            $restore = '<a data-toggle="modal" data-target="#restoreAdmin" data-id="' . $row->id . '" class="p-1 mx-1 Admin"><i class="fas fa-trash-restore"></i> Restore </a>';
            if (!$recycleBin) $actions = "$view$edit$delete";
            else $actions = "$view$restore";
            array_push($data, array('First Name' => $row->fname, 'Last Name' => $row->lname, 'Email' => $row->email, 'Created On' => formatDateTime($row->createdOn), 'Updated On' => formatDateTime($row->modifiedOn), "Sr #" => '<span class="btn-collection p-2 mt-n2">' . $actions . '</span>' . (++$count + $start),));
        }
        $results = array("draw" => $draw, "recordsTotal" => $totalCount, "recordsFiltered" => $totalCount, "aaData" => $data);
        echo json_encode($results);
    } elseif (isset($_POST["admin_id"])) {
        $data = array();
        $id = secure($_POST["admin_id"]);
        $admin = runQuery("SELECT `admin`.* FROM `admin` WHERE `admin`. `isDeleted` IN (0,1) AND `admin`.`id` = $id")->fetch_object();
        if (is_null($admin)) {
            echo "false";
        } else {
            $row = $admin;
            $modifiers = "data-fname='$row->fname'data-lname='$row->lname'data-email='$row->email' data-id='$row->id'";
            $edit = "<a data-modaltitle='Edit' $modifiers class='btn btn-primary text-white editAdmin'><i class='fas fa-edit'></i> Edit</a>";
            $delete = "<a data-toggle='modal' data-target='#deleteAdmin' data-id='$admin->id' class='btn btn-danger text-white deleteAdmin'><i class='fas fa-trash-alt'></i> Delete </a>";
            $restore = "<a data-toggle='modal' data-target='#restoreAdmin' data-id='$admin->id' class='btn btn-success text-white restoreAdmin'><i class='fas fa-trash-restore'></i> Restore </a>";
            if ($row->isDeleted == 0) $actions = "$edit$delete";
            else $actions = "$restore";
            $data = array('FIRST_NAME' => $row->fname, 'LAST_NAME' => $row->lname, 'EMAIL' => $row->email, 'CREATED_ON' => formatDateTime($row->createdOn), 'UPDATED_ON' => formatDateTime($row->modifiedOn), "Actions" => "$actions");
            echo json_encode($data);
        }
    } elseif (isset($_POST["deleteAdmin"])) {
        $id = secure($_POST["adminDeleteId"]);
        if (is_numeric($id)) {
            $sql = "UPDATE `admin` SET `isDeleted` =1 WHERE `id`=$id AND `isDeleted` = 0";
            if (runQuery($sql)) echo "true";
        } else echo "false";
        exit();
    } elseif (isset($_POST["restoreAdmin"])) {
        $id = secure($_POST["adminRestoreId"]);
        if (is_numeric($id)) {
            $sql = "UPDATE `admin` SET `isDeleted` =0 WHERE `id`=$id AND `isDeleted` = 1";
            if (runQuery($sql)) echo "true";
        } else echo "false";
        exit();
    }
} else echo '403 Forbidden Access';
