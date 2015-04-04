<?php
require "views/header.php";
unset($_SESSION['status']);
require_once "handlers/Dao.php";
$dao = new Dao();
$videos = $dao->getRecentVideos();
$latestPost = $dao->getRecentPosts()[0];
?>

    <div id="container">
        <div id="main">
            <div id="carousel">
                <h1>CAROUSEL</h1>
            </div>
            <div class="main-label"><h3>Recent Videos</h3></div>
            <?php
            for ($i = 0; $i < 3; $i++) {
                ?>
                <a href="/views/video.php?v=<?php echo $videos[$i]['ID'] ?>"><div class="main-video"><h3><?php echo $videos[$i]['Title'] ?></h3></div></a>
                <?php
            }
            ?>
        </div>

        <div id="sidebar">
            <div id="latest-post" class="side-chunk">
                <div class="side-label"><h3>Latest Post</h3></div>
                <a href="/views/blog.php?p=<?php echo $latestPost['ID'];?>"><div class="side-post"><p><?php echo $latestPost['Title'];?></p></div></a>
            </div>

            <div id="popular-videos" class="side-chunk">
                <div class="side-label"><h3>Popular Videos</h3></div>
                <div class="side-video"><p>Video 4</p></div>
                <div class="side-video"><p>Video 5</p></div>
                <div class="side-video"><p>Video 6</p></div>
                <div class="side-video"><p>Video 7</p></div>
                <div class="side-video"><p>Video 8</p></div>
            </div>
        </div>
    </div>
<?php
require "views/footer.php";
?>