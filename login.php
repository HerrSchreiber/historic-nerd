<?php
require "/views/header.php";
define("INVALID_USER_NAME_OR_PASSWORD", 1);
define("PASSWORDS_DO_NOT_MATCH", 2);
define("USERNAME_TOO_LONG", 4);
define("NOT_A_VALID_EMAIL", 8);

$loginEmail = isset($_SESSION["email_login_preset"])?$_SESSION["email_login_preset"]:"";
$email = isset($_SESSION["email_preset"])?$_SESSION["email_preset"]:"";
$user = isset($_SESSION["user_preset"])?$_SESSION["user_preset"]:"";
?>

    <div id="container">
        <div id="log-in"><h2>Log In</h2>
            <form action="/handlers/login_handler.php" method="POST">
                <div>
                    <label for="login-email">Email</label>
                    <input type="text" name="email" id="login-email" value="<?php echo $loginEmail; ?>"/>
                </div>
                <div>
                    <label for="login-password">Password</label>
                    <input type="password" name="password" id="login-password" value=""/>
                </div>
                <?php if (isset($_SESSION["status"]) && $_SESSION["status"] & INVALID_USER_NAME_OR_PASSWORD === INVALID_USER_NAME_OR_PASSWORD) { ?>
                <div class="error-message">
                    <p>Invalid username or password</p>
                </div>

                <?php }?>
                <div>
                    <input type="submit" name="submit" value="Login"/>
                </div>
            </form>
        </div>

        <div id="register"><h2>Register</h2>
            <form action="/handlers/login_handler.php" method="POST">
                <div>
                    <label for="user">User Name</label>
                    <input type="text" name="user" id="user" value="<?php echo $user; ?>"/>
                </div>
                <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] & USERNAME_TOO_LONG) === USERNAME_TOO_LONG) { ?>
                    <div class="error-message">
                        <p>User name is too long</p>
                    </div>
                <?php }?>
                <div>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $email; ?>"/>
                </div>
                <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] & NOT_A_VALID_EMAIL) === NOT_A_VALID_EMAIL) { ?>
                    <div class="error-message">
                        <p>Email is not valid</p>
                    </div>
                <?php }?>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value=""/>
                </div>
                <div>
                    <label for="password2">Confirm Password</label>
                    <input type="password" name="password2" id="password2" value=""/>
                </div>
                <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] & PASSWORDS_DO_NOT_MATCH) === PASSWORDS_DO_NOT_MATCH) { ?>
                    <div class="error-message">
                        <p>Passwords do not match</p>
                    </div>
                <?php }?>
                <div>
                    <input type="submit" name="submit" value="Register"/>
                </div>
            </form>
        </div>
    </div>


<?php
require "/views/footer.php";
?>