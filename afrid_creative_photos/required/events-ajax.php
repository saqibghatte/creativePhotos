<?php require("config.php"); if ($logged_in_admin) { if (isset($_POST["modifyingEvents"])) {$id = secure($_POST["modifyingEvents"]); $page = getOnlyPageName($_SERVER["HTTP_REFERER"]);if (!empty($_POST["name"])) $name = secure($_POST["name"]);else {echo "Name is missing";exit();}if (!empty($_POST["description"])) $description = secure($_POST["description"],true);else {echo "Description is missing";exit();}$allowed_image_extension = [""];$image_name = secure($_FILES["image"]["name"]);$image_tmp_name = $_FILES["image"]["tmp_name"];$image_extension = pathinfo($image_name, PATHINFO_EXTENSION);if(!empty($image_name)){ $image = "events-image-" . time() . ".webp";compress($image_tmp_name, "../../assets/images/events/$image", 800, 800);}else $image="NULL";if (secure($_POST["modifyingEvents"]) > 0) {$sql = "UPDATE `events` SET `name`='$name',`description`='$description'" . (empty($image_name) ? null : ",`image`='$image'") . " WHERE `id` = $id"; $result= runQuery($sql); $msg = "updated";} else { $sql = "INSERT INTO `events` (`name`,`description`,`image`) VALUES ('$name','$description','$image')";$result= runQuery($sql);$events_id = $mysqli->insert_id; if ($page == "events-view") $msg = $events_id; else $msg = "created";} if ($result) {echo $msg;}else echo str_replace("for key", "column ", $mysqli->error);exit();} elseif (isset($_POST["detailsOf"]) && secure($_POST["detailsOf"]) == "events") {$recycleBin = secure($_POST["recycleBin"]);$recycleBin = ($recycleBin == "true") ? 1 : 0;$searchThroughOut = secure($_POST["searchThroughOut"]);$searchName = secure($_POST['searchName']);$searchImage = secure($_POST['searchImage']);$searchCreatedOn = secure($_POST['searchCreatedOn']);$searchModifiedOn = secure($_POST['searchModifiedOn']);$searchName = !empty($searchName) ? "AND name LIKE '%$searchName%'" : '';$searchImage = !empty($searchImage) ? "AND image LIKE '%$searchImage%'" : '';if (!empty($searchCreatedOn)) {$searchCreatedOn = explode('to', $searchCreatedOn);$searchCreatedOnEnd = date('Y-m-d h:i:s a', strtotime($searchCreatedOn[1]));$searchCreatedOnStart = date('Y-m-d h:i:s a', strtotime($searchCreatedOn[0]));$searchCreatedOn = "AND createdOn BETWEEN '$searchCreatedOnStart' AND '$searchCreatedOnEnd'";} else $searchCreatedOnStart = '';if (!empty($searchModifiedOn)) {$searchModifiedOn = explode('to', $searchModifiedOn);$searchModifiedOnEnd = date('Y-m-d h:i:s a', strtotime($searchModifiedOn[1]));$searchModifiedOnStart = date('Y-m-d h:i:s a', strtotime($searchModifiedOn[0]));$searchModifiedOn = "AND modifiedOn BETWEEN '$searchModifiedOnStart' AND '$searchModifiedOnEnd'";} else $searchModifiedOnStart = ''; $searchThroughOut = !empty($searchThroughOut) ? "AND CONCAT_WS(' ',`name`,`description`,`image`) LIKE '%$searchThroughOut%'" : '';$search_params ="$searchName $searchImage $searchCreatedOn $searchModifiedOn $searchThroughOut";$fetchQuery = "SELECT `events`.* FROM `events` WHERE `events`.`isDeleted` = $recycleBin $search_params";$data = array();$count = 0;$start = secure($_POST["start"]);$length = secure($_POST["length"]);$draw = secure($_POST["draw"]);$count_sql = "SELECT COUNT(`events`.`id`) AS `total_count` FROM `events` WHERE `events`.`isDeleted` = $recycleBin $search_params";$totalCount = runQuery($count_sql)->fetch_assoc()["total_count"];$sql = "$fetchQuery ORDER BY `events`.`id` LIMIT $start,$length";$result = runQuery($sql);while ($row = $result->fetch_object()) {$modifiers = "data-name='$row->name'data-description='$row->description'data-image='$row->image' data-id='$row->id' ";$view='<a class="p-1 mx-1 text-success" href="events-view?events_id='.$row->id.'"><i class="far fa-file-alt"></i> View</a>';$edit='<a data-modaltitle="Edit" '.$modifiers.' class="p-1 mx-1 text-primary editEvents"><i class="fas fa-edit"></i> Edit</a>';$delete ='<a data-toggle="modal" data-target="#deleteEvents" data-id="'.$row->id.'" class="p-1 mx-1 text-danger deleteEvents"><i class="fas fa-trash-alt"></i> Delete </a>';$restore='<a data-toggle="modal" data-target="#restoreEvents" data-id="'.$row->id.'" class="p-1 mx-1 Events"><i class="fas fa-trash-restore"></i> Restore </a>';if(!$recycleBin)$actions="$view$edit$delete";else $actions="$view$restore";array_push($data, array('Name' => $row->name,'Image' => "<a download>$row->image</a>",'Created On' => formatDateTime($row->createdOn),'Updated On' => formatDateTime($row->modifiedOn),"Sr #" => '<span class="btn-collection p-2 mt-n2">'.$actions.'</span>' . (++$count + $start),));} $results = array("draw" => $draw, "recordsTotal" => $totalCount, "recordsFiltered" => $totalCount, "aaData" => $data);echo json_encode($results);} elseif (isset($_POST["events_id"])) {$data = array();$id = secure($_POST["events_id"]);$events = runQuery("SELECT `events`.* FROM `events` WHERE `events`. `isDeleted` IN (0,1) AND `events`.`id` = $id")->fetch_object();if (is_null($events)) {echo "false";}else{$row=$events;$modifiers = "data-name='$row->name'data-description='$row->description'data-image='$row->image' data-id='$row->id'"; $edit="<a data-modaltitle='Edit' $modifiers class='btn btn-primary text-white editEvents'><i class='fas fa-edit'></i> Edit</a>";$delete="<a data-toggle='modal' data-target='#deleteEvents' data-id='$events->id' class='btn btn-danger text-white deleteEvents'><i class='fas fa-trash-alt'></i> Delete </a>";$restore="<a data-toggle='modal' data-target='#restoreEvents' data-id='$events->id' class='btn btn-success text-white restoreEvents'><i class='fas fa-trash-restore'></i> Restore </a>";if ($row->isDeleted == 0) $actions = "$edit$delete"; else $actions = "$restore"; $data = array('NAME' => $row->name,'DESCRIPTION' => $row->description,'IMAGE' => $row->image,'CREATED_ON' => formatDateTime($row->createdOn),'UPDATED_ON' => formatDateTime($row->modifiedOn), "Actions" => "$actions");echo json_encode($data);}} elseif (isset($_POST["deleteEvents"])) {$id = secure($_POST["eventsDeleteId"]);if (is_numeric($id)) {$sql = "UPDATE `events` SET `isDeleted` =1 WHERE `id`=$id AND `isDeleted` = 0";if (runQuery($sql)) echo "true";} else echo "false";exit();} elseif (isset($_POST["restoreEvents"])) {$id = secure($_POST["eventsRestoreId"]);if (is_numeric($id)) {$sql = "UPDATE `events` SET `isDeleted` =0 WHERE `id`=$id AND `isDeleted` = 1";if (runQuery($sql)) echo "true";} else echo "false";exit();} } else echo '403 Forbidden Access';