<?php
session_start();

require_once "Dao.php";

define("NO_COMMENT_ENTERED", 1);
define("COMMENT_TOO_LONG", 2);

$_SESSION["status"] = 0;
$dao = new Dao();
if ($_POST['action']=='create') {
    if (isset ($_POST['ytid'])) {

        $comment = htmlspecialchars($_POST["comment"]);

        if (strlen($comment) > 500) {
            $_SESSION["status"] |= COMMENT_TOO_LONG;
        }

        if (strlen($comment) == 0 || $comment == "Enter comment here...") {
            $_SESSION["status"] |= NO_COMMENT_ENTERED;
        }

        if ($_SESSION["status"] == 0) {
            $dao->createVideoComment($_POST['ytid'], $_SESSION['user'], $comment);
            header("Location:/views/video.php?v=" . $_POST['ytid']);
        } else {
            header("Location:/views/video.php?v=" . $_POST['ytid']);
        }
    } else {
        $comment = htmlspecialchars($_POST["comment"]);

        if (strlen($comment) > 500) {
            $_SESSION["status"] |= COMMENT_TOO_LONG;
        }

        if (strlen($comment) == 0 || $comment == "Enter comment here...") {
            $_SESSION["status"] |= NO_COMMENT_ENTERED;
        }

        if ($_SESSION["status"] == 0) {
            $dao->createBlogComment($_POST['pid'], $_SESSION['user'], $comment);
            header("Location:/views/blog.php?p=" . $_POST['pid']);
        } else {
            header("Location:/views/blog.php?p=" . $_POST['pid']);
        }
    }
}
elseif ($_GET['action'] == 'delete') {
    $dao->deleteComment($_GET['id']);
    header("Location:/views/video.php?v=" . $_GET['ytid']);
    if (isset($_GET['ytid'])) {
        header("Location:/views/video.php?v=" . $_GET['ytid']);
    }
    elseif (isset($_GET['pid'])) {
        header("Location:/views/blog.php?p=" . $_GET['pid']);
    }
}
else {
    header("Location:/");
}