<?php
require_once 'vendor/autoload.php';



ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
ini_set('log_errors', TRUE);
ini_set('error_log', './logs/php-errors.log');




$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

