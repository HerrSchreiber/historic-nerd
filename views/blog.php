<?php
require "header.php";
?>

    <div id="container">
        <div id="main">
            <div id="post">
                <h1>POST TITLE</h1>

                <p></p>
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