<?php
error_reporting(E_ALL);
ini_set('display_errors', '1'); 
session_start();
include_once("config.php");
include_once("functions.php");
include_once($global['root-url']."system/libraries/smtp/class.phpmailer.php");
?>