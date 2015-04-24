<?php
session_start();
if (!isset($_GET['v'])) header("Location:/~rschreib/");
require "header.php";
require_once "../handlers/Dao.php";

define("NO_COMMENT_ENTERED", 1);
define("COMMENT_TOO_LONG", 2);
$dao = new Dao();
$videos = $dao->getRecentVideos();
?>

    <div id="container">
        <div id="main">
            <div id="video">
                <iframe width="630" height="354" src="https://www.youtube.com/embed/<?php echo $_GET['v'];?>" frameborder="0" allowfullscreen></iframe>
            </div>
            <div id="video-thumb">
                <a href="https://www.youtube.com/watch?v=<?php echo $_GET['v'];?>"><h1>VIDEO THUMBNAIL</h1></a>
            </div>
            <div class="main-label"><h3>Comments</h3></div>
            <div id="comments">
                <?php
                if(isset($_SESSION['user'])) {
                ?>
                    <?php
                    if (isset($_SESSION['status']) && $_SESSION['status'] == 0) {?>
                        <h4>Post added successfully!</h4>
                    <?php } ?>
                    <form id="comments-form" <!--action="/~rschreib/handlers/comment_handler.php" method="POST"-->>

                        <div>
                            <label for="comment">Comment</label>
                            <textarea name="comment" id="comment" rows="4" cols="50">Enter comment here...</textarea>
                        </div>

                        <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] & NO_COMMENT_ENTERED) === NO_COMMENT_ENTERED) { ?>
                            <div class="error-message">
                                <p>You must enter a comment to post a comment</p>
                            </div>

                        <?php }?>

                        <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] & COMMENT_TOO_LONG) === COMMENT_TOO_LONG) { ?>
                            <div class="error-message">
                                <p>Your comment must be less than 500 characters</p>
                            </div>

                        <?php }?>

                        <div>
                            <input type="hidden" name="ytid" value="<?php echo $_GET['v'];?>"/>
                            <input type="hidden" name="action" value="create">
                            <input type="submit" name="submit" value="Add Comment"/>
                        </div>
                    </form>
                <?php } ?>
                <?php
                $comments = $dao->getVideoComments($_GET['v']);
                foreach ($comments as $comment) {
                ?>
                    <div>
                        <h4><?php echo $comment['UserName'] . " on " . $comment['DateCreated'];?>:</h4>
                        <p><?php echo $comment['Comment']." ";
                            if (isset ($_SESSION['user']) && ($comment['UserName']==$_SESSION['user'] || $_SESSION['user'] == "Admin")) { ?>
                                <a href="/~rschreib/handlers/comment_handler.php?action=delete&id=<?php echo $comment['ID'];?>&ytid=<?php echo $_GET['v'];?>">(Delete)</a>
                            <?php } ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div id="sidebar">
            <div id="related-videos" class="side-chunk">
                <div class="side-label"><p>Other Videos</p></div>
                <?php
                for ($i = 0; $i < 5; $i++) {
                    ?>
                    <a href="/~rschreib/views/video.php?v=<?php echo $videos[$i]['YouTubeVideoID'] ?>"><div class="side-video"><h3><?php echo $videos[$i]['Title'] ?></h3></div></a>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
<?php
require "footer.php";
?>