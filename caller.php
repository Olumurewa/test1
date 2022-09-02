<?php
session_start();
define('BASEPATH', true);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'controller/dbFunctions.php';
require 'index.view.php';



?>