<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Historic Nerd</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css"/>
    <link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Pontano+Sans' rel='stylesheet' type='text/css'>
</head>
<body>

<!--[if lt IE 9]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->

<div id="banner">
    <a href="/"><h1>Historic Nerd</h1></a>

    <div id="nav-container">

        <div id="nav">
            <ul>
                <a href="/views/videolist.php">
                    <li class="button"><p>Videos</p></li>
                </a>
                <a href="/views/bloglist.php">
                    <li class="button"><p>Blog Posts</p></li>
                </a>
                <?php
                if (isset($_SESSION["user"])) {
                ?>
                <a href="/logout.php">
                    <li class="button"><p>Log Out</p></li>
                </a>
                <?php }
                else {
                ?>
                <a href="/login.php">
                    <li class="button"><p>Log In</p></li>
                </a>
                <?php } ?>
            </ul>
        </div>
        <?php if (isset($_SESSION['user'])) { ?>
            <div id="logged-in">
                <p>Logged in as <?php
                    if ($_SESSION['user'] == 'Admin') echo "<a href=\"/admin.php\">";
                    echo $_SESSION['user'];
                    if ($_SESSION['user'] == 'Admin') echo "</a>"; ?>
                </p>
            </div>
        <?php } ?>
    </div>

</div>