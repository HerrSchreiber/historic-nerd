<?php
session_start();
define("INVALID_USER_NAME_OR_PASSWORD", 1);
define("PASSWORDS_DO_NOT_MATCH", 2);
define("USERNAME_TOO_LONG", 4);
define("NOT_A_VALID_EMAIL", 8);
$_SESSION["status"] = 0;
if ($_POST["submit"] == "Login") {
    if ("admin@historicnerd.com" == $_POST["email"] &&
        "lollipop" == $_POST["password"]
    ) {
        $_SESSION["user"] = "admin";
        $_SESSION["privileges"] = 2;
        header("Location:/");

    } else {
        $_SESSION["status"] |= INVALID_USER_NAME_OR_PASSWORD;
        $_SESSION["email_login_preset"] = $_POST["email"];

        header("Location:/login.php");
    }
}
else if ($_POST["submit"] == "Register") {
    $_SESSION["email_preset"] = $_POST["email"];
    $_SESSION["user_preset"] = $_POST["user"];
    if ($_POST["password"] != $_POST["password2"]) {
        $_SESSION["status"] |= PASSWORDS_DO_NOT_MATCH;
    }
    if (strlen($_POST["user"]) > 35) {
        $_SESSION["status"] |= USERNAME_TOO_LONG;
    }

    if (preg_match("/^.+@.+\..{2,4}$/", $_POST["email"]) == 0) {
        $_SESSION["status"] |= NOT_A_VALID_EMAIL;
    }

    if ($_SESSION["status"] == 0) {
        $_SESSION["user"] = $_POST["user"];
        header("Location:/");
    }
    else {
        header("Location:/login.php");
    }
}