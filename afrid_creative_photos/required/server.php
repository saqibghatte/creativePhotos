<?php
date_default_timezone_set('Asia/Kolkata');
$server = array('');

//  -------------- DATABASE CONFIGURATIONS (SERVER) -------------- 
if (in_array($_SERVER['SERVER_ADDR'], $server)) {
    define("SERVER", 'localhost');
    define("USERNAME", '');
    define("PASSWORD", '');
    define("DATABASE", '');
    define("BASE_URL", '');
} else {
    define("SERVER", 'localhost');
    define("USERNAME", 'root');
    define("PASSWORD", '');
    define("DATABASE", 'creative_photos');
    define("BASE_URL", "http://localhost/creativePhotos/admin/");
}
