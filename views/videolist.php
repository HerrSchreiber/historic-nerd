<?php
require "header.php";
require_once "../handlers/Dao.php";
$dao = new Dao();
$page = (isset($_GET['p']) && is_numeric($_GET['p']))?$_GET['p']:1;
$videos = $dao->getRecentVideos();
if ($page > (count($videos) / 10) + 1) $page = floor(count($videos) / 10) + 1;
?>

    <div id="container">
        <?php
        for ($i = ($page - 1) * 10; $i < ($page - 1) * 10 + 10; $i++) {
            ?>
            <a href="/views/video.php?v=<?php echo $videos[$i]['YouTubeVideoID'] ?>"><div class="main-video"><h3><?php echo $videos[$i]['Title'] ?></h3></div></a>
        <?php
            if ($i >= count($videos) - 1) break;
        }
        ?>
        <p>
            <?php if ($page > 1) {?><a href="videolist.php?p=<?php echo $page-1;?>">&lt;&lt;</a><?php }
            elseif ($page < floor(count($videos) / 10) + 1) {?><a href="videolist.php?p=<?php echo $page+1;?>">&gt;&gt;</a><?php }?>
        </p>
    </div>


<?php
require "footer.php";
?>