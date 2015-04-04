<?php
session_start();

define("VIDEO_TITLE_TOO_LONG", 1);
define("VIDEO_TAGS_TOO_LONG", 2);
define("VIDEO_NOT_A_VALID_YOUTUBE_ID", 4);
define("VIDEO_NO_TITLE_ENTERED", 8);
define("POST_TITLE_TOO_LONG", 16);
define("POST_TAGS_TOO_LONG", 32);
define("POST_NO_TITLE_ENTERED", 64);
define("POST_NO_CONTENT_ENTERED", 128);
define("POST_CONTENT_TOO_LONG", 256);

if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) header('Location:/');

$video_title = isset($_SESSION["video_title_preset"])?$_SESSION["video_title_preset"]:"";
$video_ytid = isset($_SESSION["video_ytid_preset"])?$_SESSION["video_ytid_preset"]:"";
$video_tags = isset($_SESSION["video_tags_preset"])?$_SESSION["video_tags_preset"]:"";

$post_title = isset($_SESSION["post_title_preset"])?$_SESSION["post_title_preset"]:"";
$post_tags = isset($_SESSION["post_tags_preset"])?$_SESSION["post_tags_preset"]:"";
$post_content = isset($_SESSION["post_content_preset"])?$_SESSION["post_content_preset"]:"Enter text here...";

require "/views/header.php";
?>
    <div id="container">
        <div id="control-panel">
            <?php if (!isset($_GET['action'])) { ?>
            <a href="admin.php?action=video"><h1>Add Video</h1></a>
            <a href="admin.php?action=post"><h1>Add Post</h1></a>
            <?php }
            else if ($_GET['action']=='video') {?>
            <h1>Add Video</h1>
            <?php
            if (isset($_SESSION['status']) && $_SESSION['status'] == 0) {?>
                <h4>Video added successfully!</h4>
            <?php } ?>
            <form action="/handlers/admin_handler.php" method="POST">
                <div>
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" value="<?php echo $video_title; ?>"/>
                </div>

                <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] & VIDEO_TITLE_TOO_LONG) === VIDEO_TITLE_TOO_LONG) { ?>
                    <div class="error-message">
                        <p>Title must be less than 100 characters</p>
                    </div>

                <?php }?>

                <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] & VIDEO_NO_TITLE_ENTERED) === VIDEO_NO_TITLE_ENTERED) { ?>
                    <div class="error-message">
                        <p>You must enter a title</p>
                    </div>

                <?php }?>

                <div>
                    <label for="ytid">YouTube ID</label>
                    <input type="text" name="ytid" id="ytid" value="<?php echo $video_ytid; ?>"/>
                </div>

                <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] & VIDEO_NOT_A_VALID_YOUTUBE_ID) === VIDEO_NOT_A_VALID_YOUTUBE_ID) { ?>
                    <div class="error-message">
                        <p>You must enter a valid YouTube Video ID</p>
                    </div>

                <?php }?>

                <div>
                    <label for="tags">Tags (Comma Separated)</label>
                    <input type="text" name="tags" id="tags" value="<?php echo $video_tags; ?>"/>
                </div>

                <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] & VIDEO_TAGS_TOO_LONG) === VIDEO_TAGS_TOO_LONG) { ?>
                    <div class="error-message">
                        <p>Tags must be less than 255 characters</p>
                    </div>

                <?php }?>


                <div>
                    <input type="submit" name="submit" value="Add Video"/>
                </div>
            </form>
                <p><a href="admin.php?action=post">Or add a blog post</a></p>
            <?php }
            else if ($_GET['action']=='post') { ?>
            <h1>Add Post</h1>
                <?php
                if (isset($_SESSION['status']) && $_SESSION['status'] == 0) {?>
                    <h4>Post added successfully!</h4>
                <?php } ?>
                <form action="/handlers/admin_handler.php" method="POST">
                    <div>
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" value="<?php echo $post_title; ?>"/>
                    </div>

                    <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] & POST_TITLE_TOO_LONG) === POST_TITLE_TOO_LONG) { ?>
                        <div class="error-message">
                            <p>Title must be less than 100 characters</p>
                        </div>

                    <?php }?>

                    <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] & POST_NO_TITLE_ENTERED) === POST_NO_TITLE_ENTERED) { ?>
                        <div class="error-message">
                            <p>You must enter a title</p>
                        </div>

                    <?php }?>

                    <div>
                        <label for="tags">Tags (Comma Separated)</label>
                        <input type="text" name="tags" id="tags" value="<?php echo $post_tags; ?>"/>
                    </div>

                    <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] & POST_TAGS_TOO_LONG) === POST_TAGS_TOO_LONG) { ?>
                        <div class="error-message">
                            <p>Tags must be less than 255 characters</p>
                        </div>

                    <?php }?>

                    <div>
                        <label for="post-content">Post Content</label>
                        <textarea name="post" id="post-content"><?php echo $post_content; ?></textarea>
                    </div>

                    <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] & POST_NO_CONTENT_ENTERED) === POST_NO_CONTENT_ENTERED) { ?>
                        <div class="error-message">
                            <p>You must enter post content</p>
                        </div>

                    <?php }?>

                    <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] & POST_CONTENT_TOO_LONG) === POST_CONTENT_TOO_LONG) { ?>
                        <div class="error-message">
                            <p>Your post must be less than 4000 characters</p>
                        </div>

                    <?php }?>

                    <div>
                        <input type="submit" name="submit" value="Add Post"/>
                    </div>
                </form>
                <p><a href="admin.php?action=video">Or add a video</a></p>
            <?php } ?>
        </div>
    </div>
<?php
require "/views/footer.php";
?>