<?php
require "views/header.php";
unset($_SESSION['status']);
?>

    <div id="container">
        <div id="main">
            <div id="carousel">
                <h1>CAROUSEL</h1>
            </div>
            <div class="main-label"><h3>Recent Videos</h3></div>
            <div class="main-video"><p>Video 1</p></div>
            <div class="main-video"><p>Video 2</p></div>
            <div class="main-video"><p>Video 3</p></div>
        </div>

        <div id="sidebar">
            <div id="latest-post" class="side-chunk">
                <div class="side-label"><h3>Latest Post</h3></div>
                <div class="side-post"><p>Post 1</p></div>
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