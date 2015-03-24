<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) header('Location:/');
require "/views/header.php";
?>
    <div id="container">
        <div id="control-panel">
            <?php if (!isset($_GET['action'])) { ?>
            <a href="admin.php?action=video"><h1>Add Video</h1></a>
            <a href="admin.php?action=post"><h1>Add Post</h1></a>
            <?php }
            else if ($_GET['action']=='video') {?>
            <h1>Add Video</h1>
            <form action="/handlers/admin_handler.php" method="POST">
                <div>
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" value=""/>
                </div>

                <div>
                    <label for="ytid">YouTube ID</label>
                    <input type="text" name="ytid" id="ytid" value=""/>
                </div>

                <div>
                    <label for="tags">Tags (Comma Separated)</label>
                    <input type="text" name="tags" id="tags" value=""/>
                </div>

                <div>
                    <input type="submit" name="submit" value="Add Video"/>
                </div>
            </form>
            <?php }
            else if ($_GET['action']=='post') { ?>
            <h1>Add Post</h1>
                <form action="/handlers/admin_handler.php" method="POST">
                    <div>
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" value=""/>
                    </div>

                    <div>
                        <label for="tags">Tags (Comma Separated)</label>
                        <input type="text" name="tags" id="tags" value=""/>
                    </div>

                    <div>
                        <label for="post-content">Post Content</label>
                        <textarea name="post" id="post-content">Enter text here...</textarea>
                    </div>

                    <div>
                        <input type="submit" name="submit" value="Add Post"/>
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
<?php
require "/views/footer.php";
?>