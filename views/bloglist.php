<?php
require "header.php";
require_once "../handlers/Dao.php";
$dao = new Dao();
$page = (isset($_GET['p']) && is_numeric($_GET['p']))?$_GET['p']:1;
$posts = $dao->getRecentPosts();
if ($page > (count($posts) / 10) + 1) $page = floor(count($posts) / 10) + 1;
?>

    <div id="container">
        <?php
        for ($i = ($page - 1) * 10; $i < ($page - 1) * 10 + 10; $i++) {
            ?>
            <a href="/~rschreib/views/blog.php?p=<?php echo $posts[$i]['ID'] ?>"><div class="main-video"><h3><?php echo $posts[$i]['Title'] ?></h3></div></a>
            <?php
            if ($i >= count($posts) - 1) break;
        }
        ?>
        <p>
            <?php if ($page > 1) {?><a href="bloglist.php?p=<?php echo $page-1;?>">&lt;&lt;</a><?php }
            elseif ($page < floor(count($posts) / 10) + 1) {?><a href="videolist.php?p=<?php echo $page+1;?>">&gt;&gt;</a><?php }?>
        </p>
    </div>


<?php
require "footer.php";
?>