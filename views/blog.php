<?php
require "header.php";
require_once "../handlers/Dao.php";
$dao = new Dao();
$post = $dao->getPost($_GET['p']);
?>

    <div id="container">
        <div id="main">
            <div id="post">
                <h1><?php echo $post['Title'];?></h1>

                <p><?php echo $post['Post'];?></p>
            </div>
            <div class="main-label"><h3>Comments</h3></div>
            <div id="comments">
                <h1>COMMENTS</h1>
            </div>
        </div>

        <div id="sidebar">
            <div id="related-posts" class="side-chunk">
                <div class="side-label"><p>Related Posts</p></div>
                <div class="side-post"><p>Post 1</p></div>
                <div class="side-post"><p>Post 2</p></div>
                <div class="side-post"><p>Post 3</p></div>
            </div>

            <div id="popular-videos" class="side-chunk">
                <div class="side-label"><p>Popular Videos</p></div>
                <div class="side-video"><p>Video 1</p></div>
                <div class="side-video"><p>Video 2</p></div>
                <div class="side-video"><p>Video 3</p></div>
                <div class="side-video"><p>Video 4</p></div>
            </div>
        </div>
    </div>
<?php
require "footer.php";
?>