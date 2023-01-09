<?php
include('required/config.php');
session_start();
session_destroy();
header('Location:login');
exit();
