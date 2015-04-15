<?php
session_start();

require_once "Dao.php";

define("INVALID_USER_NAME_OR_PASSWORD", 1);
define("PASSWORDS_DO_NOT_MATCH", 2);
define("USERNAME_TOO_LONG", 4);
define("NOT_A_VALID_EMAIL", 8);
define("USERNAME_ALREADY_TAKEN", 16);
define("EMAIL_ALREADY_IN_USE", 32);
define("NO_USERNAME_ENTERED", 64);
define("NO_EMAIL_ENTERED", 128);
define("NO_PASSWORD_ENTERED", 256);
define("LOW_QUALITY_PASSWORD", 512);

$_SESSION["status"] = 0;
$dao = new Dao();

if ($_POST["submit"] == "Login") {
    $email = strtolower(htmlspecialchars($_POST["login-email"]));

    if ($dao->checkPassword($email, $_POST["login-password"])) {
        $user = $dao->getUser($email);
        $_SESSION["user"] = $user["UserName"];
        $_SESSION["admin"] = $user["Admin"];

        header ("Location:/~rschreib/");
    }
    else {
        $_SESSION["status"] |= INVALID_USER_NAME_OR_PASSWORD;
        $_SESSION["email_login_preset"] = $_POST["login-email"];

        header("Location:/~rschreib/login.php");
    }
}
else if ($_POST["submit"] == "Register") {
    $email = strtolower(htmlspecialchars($_POST["email"]));
    $userName = htmlspecialchars($_POST["user"]);
    $_SESSION["email_preset"] = $email;
    $_SESSION["user_preset"] = $userName;
    if ($_POST["password"] != $_POST["password2"]) {
        $_SESSION["status"] |= PASSWORDS_DO_NOT_MATCH;
    }
    if (strlen($userName) > 35) {
        $_SESSION["status"] |= USERNAME_TOO_LONG;
    }

    if (strlen($userName) == 0) {
        $_SESSION["status"] |= NO_USERNAME_ENTERED;
    }

    if (strlen($email) == 0) {
        $_SESSION["status"] |= NO_EMAIL_ENTERED;
    }

    if (strlen($_POST["password"]) == 0) {
        $_SESSION["status"] |= NO_PASSWORD_ENTERED;
    }

    if (preg_match("/^.+@.+\\..{2,4}$/", $_POST["email"]) == 0) {
        $_SESSION["status"] |= NOT_A_VALID_EMAIL;
    }

    $resultsByName = $dao->getUsersByName($userName);
    if ($resultsByName) {
        $_SESSION["status"] |= USERNAME_ALREADY_TAKEN;
    }

    $resultsByEmail = $dao->getUser($email);
    if ($resultsByEmail) {
        $_SESSION["status"] |= EMAIL_ALREADY_IN_USE;
    }

    if (preg_match("/[a-z]/", $_POST["password"])==0 ||
        preg_match("/[A-Z]/", $_POST["password"])==0 ||
        preg_match("/\\d/", $_POST["password"])==0 ||
        preg_match("/[^a-zA-Z\\d\\s:]/", $_POST["password"])==0) {
        $_SESSION["status"] |= LOW_QUALITY_PASSWORD;
    }

    if ($_SESSION["status"] == 0) {
        $_SESSION["user"] = $userName;
        $_SESSION["admin"] = 0;
        $dao->createUser($email, $userName, $_POST["password"]);
        header("Location:/~rschreib/");
    }
    else {
        header("Location:/~rschreib/login.php");
    }
}