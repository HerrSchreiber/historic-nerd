<?php
session_start();

require_once "Dao.php";

define("TITLE_TOO_LONG", 1);
define("TAGS_TOO_LONG", 2);
define("NOT_A_VALID_YOUTUBE_ID", 4);

$_SESSION["status"] = 0;
$dao = new Dao();

if ($_POST["submit"] == "Add Video") {
    /*$email = htmlspecialchars($_POST["login-email"]);

    if ($dao->checkPassword($email, $_POST["login-password"])) {
        $user = $dao->getUser($email);
        $_SESSION["user"] = $user["UserName"];
        $_SESSION["admin"] = $user["Admin"];

        header ("Location:/");
    }
    else {
        $_SESSION["status"] |= INVALID_USER_NAME_OR_PASSWORD;
        $_SESSION["email_login_preset"] = $_POST["login-email"];

        header("Location:/login.php");
    }*/
}
else if ($_POST["submit"] == "Add Post") {
    /*$email = htmlspecialchars($_POST["email"]);
    $userName = htmlspecialchars($_POST["user"]);
    $_SESSION["email_preset"] = $email;
    $_SESSION["user_preset"] = $userName;
    if ($_POST["password"] != $_POST["password2"]) {
        $_SESSION["status"] |= PASSWORDS_DO_NOT_MATCH;
    }
    if (strlen($userName) > 35) {
        $_SESSION["status"] |= USERNAME_TOO_LONG;
    }

    if (preg_match("/^.+@.+\..{2,4}$/", $_POST["email"]) == 0) {
        $_SESSION["status"] |= NOT_A_VALID_EMAIL;
    }

    if ($_SESSION["status"] == 0) {
        $_SESSION["user"] = $userName;
        $_SESSION["admin"] = 0;
        $dao->createUser($email, $userName, $_POST["password"]);
        header("Location:/");
    }
    else {
        header("Location:/login.php");
    }*/
}