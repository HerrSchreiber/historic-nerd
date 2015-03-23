<?php
session_start();
if ("admin@historicnerd.com" == $_POST["email"] &&
    "lollipop" == $_POST["password"]) {
    $_SESSION["user"] = "admin";
    $_SESSION["privileges"] = 2;
    header("Location:/");

} else {
    $status = "Invalid username or password";
    $_SESSION["status"] = $status;
    $_SESSION["email_preset"] = $_POST["email"];

    header("Location:/login.php");
}