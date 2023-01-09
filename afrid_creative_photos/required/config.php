<?php
// ------------ Start Session ------------
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();

require("server.php");
require("variables.php");
// require('vendor/autoload.php');


// ------------ MySQL Connection ------------
$mysqli = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
if ($mysqli->connect_errno)
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;

// ------------ Email Configuration ------------
define("Sbhect Of Email", "EMAIL@ADDRESS.COM");

// ------------ REQUEST_URL ------------
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $REQUEST_URL = "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
} else {
    $REQUEST_URL = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
}






function secure($data, $isWYSIWYG = false)
{
    global $mysqli;
    if (!is_array($data)) {
        if ($isWYSIWYG) {
            return mysqli_real_escape_string($mysqli, str_replace("<script>", "", str_replace("</script>", "", trim($data))));
        }
        return mysqli_real_escape_string($mysqli, stripslashes(htmlentities(trim(strip_tags($data)))));
    } else {
        $cleanArray = array();
        foreach ($data as $s) {
            if ($isWYSIWYG) {
                array_push($cleanArray, mysqli_real_escape_string($mysqli, str_replace("<script>", "", str_replace("</script>", "", trim($s)))));
            }
            array_push($cleanArray, mysqli_real_escape_string($mysqli, stripslashes(htmlentities(trim(strip_tags($s))))));
        }
        return $cleanArray;
    }
}

function strip_all_tags($array)
{
    $cleanArray = array();
    foreach ($array as $s) array_push($cleanArray, strip_tags($s));
    return $cleanArray;
}

function Encrypt($data)
{
    return md5(md5('AALAS') . secure($data) . md5('AWESOME'));
}

// LOGIN VERFIER STARTS
$logged_in_admin = new stdClass();
$logged_in_admin = false;
if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    $email = secure($_SESSION['email']);
    $password = secure($_SESSION['password']);
    $sql = "SELECT * FROM `admin` WHERE `email` = '$email' AND `password` = '$password'";
    $result = runQuery($sql);
    if ($result->num_rows > 0) {
        $logged_in_admin = $result->fetch_object();
    }
}
// LOGIN VERFIER ENDS


function stringGenerator($strength = 32)
{
    return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $strength);
}

function runQuery($sql, $printQuery = false, $addLog = true)
{
    global $mysqli, $accountID, $REQUEST_URL;
    if ((strpos($sql, "SELECT") >= 5) || (strpos($sql, "SELECT") === false)) {
        if ($addLog && (strpos($sql, "notifications") === false) && (strpos($sql, "chats") === false) && (strpos($sql, "login_activity") === false)) {
            $mysqli->query("INSERT INTO `query_logger` (`query`,`link`,`accountID`) VALUES ('" . mysqli_real_escape_string($mysqli, $sql) . "','$REQUEST_URL','$accountID')");
        }
        $result = $mysqli->query($sql);
    } else {
        $result = $mysqli->query($sql);
    }
    if ($printQuery) echo $sql;
    return $result;
}

// function redirect($redirectURL)
// {
//     if ($redirectURL == 0) $redirectURL = $_SERVER["HTTP_REFERER"];
//     header("Location:$redirectURL");
//     exit();
// }

function redirect($redirectURL)
{
    header("Location:$redirectURL");
    exit();
}


function basePageName()
{
    return str_replace('.php', '', basename($_SERVER['PHP_SELF']));
}

// function sendEmail()
// {
//     $mail = new PHPMailer(true);
//     $mail->SMTPDebug = 0;
//     $mail->isSMTP();
//     $mail->Host = 'smtp.hostinger.com';
//     $mail->SMTPAuth = true;
//     $mail->Username = "sender@emali";
//     $mail->Password = 'Sushil@1234';
//     $mail->SMTPSecure = 'tls';
//     $mail->Port = 587;
//     $mail->setFrom("sender@emali", "HEADER");
//     $mail->addAddress($to);

//     $mail->isHTML(true);
//     $mail->Subject = $subject;
//     $mail->Body = $content;
//     $mail->send();

//     return true;
// }


function formatDate($date)
{
    if (date('Y', strtotime($date)) != '-0001' && $date != NULL)
        return date('d M Y', strtotime($date));
    else
        return '-';
}
function phpDate($date)
{
    if (date('Y', strtotime($date)) != '-0001' && $date != NULL)
        return date('d-m-Y', strtotime($date));
    else
        return '-';
}
function formatMonth($date)
{
    if (date('Y', strtotime($date)) != '-0001' && $date != NULL)
        return date('M Y', strtotime($date));
    else
        return '-';
}

function formatDateTime($date)
{
    if (date('Y', strtotime($date)) != '-0001' && $date != NULL)
        return date('d M Y - h:i a', strtotime($date));
    else
        return '-';
}
function phpDateTime($date)
{
    if (date('Y', strtotime($date)) != '-0001' && $date != NULL)
        return date('d-m-Y h:i:s a', strtotime($date));
    else
        return '-';
}
function phpMonth($date)
{
    if (date('Y', strtotime($date)) != '-0001' && $date != NULL)
        return date('Y-m', strtotime($date));
    else
        return '-';
}
function phpTime($date)
{
    if (date('Y', strtotime($date)) != '-0001' && $date != NULL)
        return date('h:i:s a', strtotime($date));
    else
        return '-';
}
function formatColor($color)
{
    return "<i class='fas fa-circle' style='color:$color'></i> $color";
}

function formatTime($date)
{
    return date('h:i a', strtotime($date));
}


function print_a($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function gen_log($type, $msg)
{
    $_SESSION['notification'] = $type . "," . $msg;
}

function compress($source, $destination, $w, $h)
{
    list($width, $height) = getimagesize($source);
    $r = $width / $height;
    if ($width > 1000 && $height > 1000) $w = $h = 1000;
    if ($w / $h > $r) {
        $newWidth = $h * $r;
        $newHeight = $h;
    } else {
        $newHeight = $w / $r;
        $newWidth = $w;
    }
    $info = getimagesize($source);
    if ($info["mime"] == "image/jpeg") $image = imagecreatefromjpeg($source);
    elseif ($info["mime"] == "image/gif") $image = imagecreatefromgif($source);
    elseif ($info["mime"] == "image/png") $image = imagecreatefrompng($source);
    $im = imagecreatetruecolor($w, $h);
    imagefill($im, 0, 0, imagecolorallocate($im, 255, 255, 255));
    imagecopyresampled($im, $image, (($w - $newWidth) / 2), (($h - $newHeight) / 2), 0, 0, $newWidth, $newHeight, $width, $height);
    imagewebp($im, $destination, 80);
    imagewebp($im, str_replace(".webp", "_thumb.webp", $destination), 40);
    imagedestroy($im);
}
function getOnlyPageName($page = 0)
{
    if ($page == 0) $page = $_SERVER['PHP_SELF'];
    $page = str_replace('.php', '', $page);
    $page = explode('/', $page);
    $page = explode("?", end($page));
    return $page[0];
}

function slug($string)
{
    $string = str_replace("'", '', $string);
    $string = str_replace("&", '', $string);
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string);
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/'), '-', $string);
    return strtolower(trim($string, '-'));
}
function onlyForThisJson($string, $json = true)
{
    $string = "[$string]";
    $string = str_replace(":", '":"', $string);
    $string = str_replace(",", '","', $string);
    $string = str_replace("{", '{"', $string);
    $string = str_replace("}", '"}', $string);
    $string = str_replace('"}","{"', '"},{"', $string);
    return ($json ? json_decode($string) : $string);
}


if (isset($_SESSION["notification"])) {
    $notification = explode(",", $_SESSION["notification"]);
    echo "<div class='phpMsg  msgNotice z-depth-1 bg-$notification[0]'>$notification[1]</div>";
    unset($_SESSION["notification"]);
}


$__GETSCRIPT = null;
if (file_exists('assets/js/' . str_replace("-view", "", getOnlyPageName()) . '-crud.min.js')) {
    $__GETSCRIPT = "<script src='assets/js/" . str_replace("-view", "", getOnlyPageName()) . "-crud.min.js'></script>";
}
