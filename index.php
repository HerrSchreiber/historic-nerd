<?php
require "views/header.php";
unset($_SESSION['status']);
require_once "handlers/Dao.php";
$dao = new Dao();
$videos = $dao->getRecentVideos();
$latestPosts = $dao->getRecentPosts();
$latestPost = $latestPosts[0];
?>

    <div id="container">
        <div id="main">
            <div id="carousel">
                <?php
                for ($i = 0; $i < 5; $i++) {
                    ?>
                    <a href="/~rschreib/views/video.php?v=<?php echo $videos[$i]['YouTubeVideoID'] ?>"><div><h3><?php echo $videos[$i]['Title'] ?></h3></div></a>
                <?php
                }
                ?>

            </div>
            <div class="main-label"><h3>Recent Videos</h3></div>
            <?php
            for ($i = 0; $i < 3; $i++) {
                ?>
                <a href="/~rschreib/views/video.php?v=<?php echo $videos[$i]['YouTubeVideoID'] ?>"><div class="main-video"><h3><?php echo $videos[$i]['Title'] ?></h3></div></a>
                <?php
            }
            ?>
        </div>

        <div id="sidebar">
            <div id="latest-post" class="side-chunk">
                <div class="side-label"><h3>Latest Post</h3></div>
                <a href="/~rschreib/views/blog.php?p=<?php echo $latestPost['ID'];?>"><div class="side-post"><h3><?php echo $latestPost['Title'];?></h3></div></a>
            </div>

            <div id="popular-videos" class="side-chunk">
                <div class="side-label"><h3>Popular Videos</h3></div>
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
require "views/footer.php";
?>
