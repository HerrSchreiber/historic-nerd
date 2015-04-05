<?php
require "header.php";
?>

    <div id="container">
        <div id="main">
            <div id="video">
                <iframe width="630" height="354" src="https://www.youtube.com/embed/<?php echo $_GET['v'];?>" frameborder="0" allowfullscreen></iframe>
            </div>
            <div id="video-thumb">
                <h1>VIDEO THUMBNAIL</h1>
            </div>
            <div class="main-label"><h3>Comments</h3></div>
            <div id="comments">
                <h1>COMMENTS</h1>
            </div>
        </div>

        <div id="sidebar">
            <div id="related-videos" class="side-chunk">
                <div class="side-label"><p>Related Videos</p></div>
                <div class="side-video"><p>Video 1</p></div>
                <div class="side-video"><p>Video 2</p></div>
                <div class="side-video"><p>Video 3</p></div>
            </div>

            <div id="popular-videos" class="side-chunk">
                <div class="side-label"><p>Popular Videos</p></div>
                <div class="side-video"><p>Video 4</p></div>
                <div class="side-video"><p>Video 5</p></div>
                <div class="side-video"><p>Video 6</p></div>
                <div class="side-video"><p>Video 7</p></div>
            </div>
        </div>
    </div>
<?php
require "footer.php";
?>