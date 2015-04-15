<?php
session_start();

require_once "Dao.php";

define("VIDEO_TITLE_TOO_LONG", 1);
define("VIDEO_TAGS_TOO_LONG", 2);
define("VIDEO_NOT_A_VALID_YOUTUBE_ID", 4);
define("VIDEO_NO_TITLE_ENTERED", 8);
define("POST_TITLE_TOO_LONG", 16);
define("POST_TAGS_TOO_LONG", 32);
define("POST_NO_TITLE_ENTERED", 64);
define("POST_NO_CONTENT_ENTERED", 128);
define("POST_CONTENT_TOO_LONG", 256);

$_SESSION["status"] = 0;
$dao = new Dao();

if ($_POST["submit"] == "Add Video") {

    $title = htmlspecialchars($_POST["title"]);
    $tags = htmlspecialchars($_POST["tags"]);
    $ytid = htmlspecialchars($_POST["ytid"]);

    $_SESSION["video_title_preset"] = $title;
    $_SESSION["video_ytid_preset"] = $ytid;
    $_SESSION["video_tags_preset"] = $tags;

    if (strlen($title) > 100) {
        $_SESSION["status"] |= VIDEO_TITLE_TOO_LONG;
    }

    if (strlen($title) == 0) {
        $_SESSION["status"] |= VIDEO_NO_TITLE_ENTERED;
    }

    if (strlen($tags) > 255) {
        $_SESSION["status"] |= VIDEO_TAGS_TOO_LONG;
    }

    if (strlen($ytid) != 11) {
        $_SESSION["status"] |= VIDEO_NOT_A_VALID_YOUTUBE_ID;
    }

    if ($_SESSION["status"] == 0) {
        $dao->createVideo($title, $ytid, $tags);
        unset($_SESSION["video_title_preset"]);
        unset($_SESSION["video_ytid_preset"]);
        unset($_SESSION["video_tags_preset"]);
        header("Location:/~rschreib/admin.php?action=video");
    }
    else {
        header("Location:/~rschreib/admin.php?action=video");
    }
}
else if ($_POST["submit"] == "Add Post") {
    $title = htmlspecialchars($_POST["title"]);
    $tags = htmlspecialchars($_POST["tags"]);
    $post = htmlspecialchars($_POST["post"]);

    $_SESSION["post_title_preset"] = $title;
    $_SESSION["post_content_preset"] = $post;
    $_SESSION["post_tags_preset"] = $tags;

    if (strlen($title) > 100) {
        $_SESSION["status"] |= POST_TITLE_TOO_LONG;
    }

    if (strlen($title) == 0) {
        $_SESSION["status"] |= POST_NO_TITLE_ENTERED;
    }

    if (strlen($tags) > 255) {
        $_SESSION["status"] |= POST_TAGS_TOO_LONG;
    }

    if (strlen($post) == 0 || ($post == "Enter text here...")) {
        $_SESSION["status"] |= POST_NO_CONTENT_ENTERED;
    }

    if (strlen($tags) > 4000) {
        $_SESSION["status"] |= POST_CONTENT_TOO_LONG;
    }

    if ($_SESSION["status"] == 0) {
        $dao->createPost($title, $tags, $post);
        unset($_SESSION["post_title_preset"]);
        unset($_SESSION["post_content_preset"]);
        unset($_SESSION["post_tags_preset"]);
        header("Location:/~rschreib/admin.php?action=post");
    }
    else {
        header("Location:/~rschreib/admin.php?action=post");
    }
}