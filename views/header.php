<?php
if (session_id() === '') {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Historic Nerd</title>
    <link rel="stylesheet" type="text/css" href="/~rschreib/css/style.css"/>
    <link rel="shortcut icon" href="/~rschreib/favicon.ico"/>
    <link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Pontano+Sans' rel='stylesheet' type='text/css'>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
<!--[if lt IE 9]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->

<div id="banner">
    <a href="/~rschreib/"><h1>Historic Nerd</h1></a>

    <div id="nav-container">

        <div id="nav">
            <ul>
                <a href="/~rschreib/views/videolist.php">
                    <li class="button"><p>Videos</p></li>
                </a>
                <a href="/~rschreib/views/bloglist.php">
                    <li class="button"><p>Blog Posts</p></li>
                </a>
                <?php
                if (isset($_SESSION["user"])) {
                ?>
                <a href="/~rschreib/logout.php">
                    <li class="button"><p>Log Out</p></li>
                </a>
                <?php }
                else {
                ?>
                <a href="/~rschreib/login.php">
                    <li class="button"><p>Log In</p></li>
                </a>
                <?php } ?>
            </ul>
        </div>
        <?php if (isset($_SESSION['user'])) { ?>
            <div id="logged-in">
                <p>Logged in as <?php
                    echo $_SESSION['user'];
                    if ($_SESSION['user'] == 'Admin') echo " <a href=\"/~rschreib/admin.php\">(Control Panel)</a>"; ?>
                </p>
            </div>
        <?php } ?>
    </div>

</div>
