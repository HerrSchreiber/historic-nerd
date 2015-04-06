<?php
require "header.php";
require_once "../handlers/Dao.php";
$dao = new Dao();
$post = $dao->getPost($_GET['p']);
define("NO_COMMENT_ENTERED", 1);
define("COMMENT_TOO_LONG", 2);
?>

    <div id="container">
        <div id="main">
            <div id="post">
                <h1><?php echo $post['Title'];?></h1>

                <p><?php echo $post['Post'];?></p>
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
                    <form action="/handlers/comment_handler.php" method="POST">

                        <div>
                            <label for="comment">Comment</label>
                            <textarea name="comment" id="comment">Enter comment here...</textarea>
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
                            <input type="hidden" name="pid" value="<?php echo $_GET['p'];?>"/>
                            <input type="hidden" name="action" value="create">
                            <input type="submit" name="submit" value="Add Comment"/>
                        </div>
                    </form>
                <?php } ?>
                <?php
                $comments = $dao->getBlogComments($_GET['p']);
                foreach ($comments as $comment) {
                    ?>
                    <div>
                        <h4><?php echo $comment['UserName'] . " on " . $comment['DateCreated'];?>:</h4>
                        <p><?php echo $comment['Comment']." ";
                            if (isset ($_SESSION['user']) && ($comment['UserName']==$_SESSION['user'] || $_SESSION['user'] == "Admin")) { ?>
                                <a href="/handlers/comment_handler.php?action=delete&id=<?php echo $comment['ID'];?>&pid=<?php echo $_GET['p'];?>">(Delete)</a>
                            <?php } ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div id="sidebar">
            <div class="side-label"><p>Videos</p></div>
            <?php
            $videos = $dao->getRecentVideos();
            for ($i = 0; $i < 5; $i++) {
                ?>
                <a href="/views/video.php?v=<?php echo $videos[$i]['YouTubeVideoID'] ?>"><div class="side-video"><h3><?php echo $videos[$i]['Title'] ?></h3></div></a>
            <?php
            }
            ?>
        </div>
    </div>
<?php
require "footer.php";
?>