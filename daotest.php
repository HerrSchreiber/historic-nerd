<?php
session_start();
require_once "/handlers/Dao.php";
echo "<pre>";
var_dump($_SESSION['error']);
echo "</pre>";