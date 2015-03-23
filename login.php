<?php
require "/views/header.php";

$email = isset($_SESSION["email_preset"])?$_SESSION["email_preset"]:"";
?>

    <div id="container">
        <div id="log-in"><h2>Log In</h2>
            <form action="/handlers/login_handler.php" method="POST">
                <div>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $email; ?>"/>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value=""/>
                </div>
                <?php if (isset($_SESSION["status"])) { ?>
                <div class="error">
                    <p><?php echo $_SESSION["status"]?></p>
                </div>

                <?php }?>
                <div>
                    <input type="submit" name="submit" id="login" value="Login"/>
                </div>
            </form>
        </div>

        <div id="register"><h2>Register</h2>

        </div>
    </div>


<?php
require "/views/footer.php";
?>