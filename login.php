<?php
require "/views/header.php";
define("INVALID_USER_NAME_OR_PASSWORD", 1);
define("PASSWORDS_DO_NOT_MATCH", 2);
define("USERNAME_TOO_LONG", 4);
define("NOT_A_VALID_EMAIL", 8);
define("USERNAME_ALREADY_TAKEN", 16);
define("EMAIL_ALREADY_IN_USE", 32);
define("NO_USERNAME_ENTERED", 64);
define("NO_EMAIL_ENTERED", 128);
define("NO_PASSWORD_ENTERED", 256);
define("LOW_QUALITY_PASSWORD", 512);

$loginEmail = isset($_SESSION["email_login_preset"])?$_SESSION["email_login_preset"]:"";
$email = isset($_SESSION["email_preset"])?$_SESSION["email_preset"]:"";
$user = isset($_SESSION["user_preset"])?$_SESSION["user_preset"]:"";
?>

    <div id="container">
        <div id="log-in"><h2>Log In</h2>
            <form action="/handlers/login_handler.php" method="POST">
                <div>
                    <label for="login-email">Email</label>
                    <input type="text" name="login-email" id="login-email" value="<?php echo $loginEmail; ?>"/>
                </div>
                <div>
                    <label for="login-password">Password</label>
                    <input type="password" name="login-password" id="login-password" value=""/>
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
                <?php $userError = (isset($_SESSION["status"]) && ($_SESSION["status"] & USERNAME_TOO_LONG) === USERNAME_TOO_LONG) ||
                                   (isset($_SESSION["status"]) && ($_SESSION["status"] & USERNAME_ALREADY_TAKEN) === USERNAME_ALREADY_TAKEN) ||
                                   (isset($_SESSION["status"]) && ($_SESSION["status"] & NO_USERNAME_ENTERED) === NO_USERNAME_ENTERED); ?>
                <div>
                    <label for="user">User Name</label>
                    <input type="text" name="user" id="user" value="<?php echo $user; ?>" <?php if ($userError) echo "class=\"error\"";?>/>
                </div>
                <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] & USERNAME_TOO_LONG) === USERNAME_TOO_LONG) { ?>
                    <div class="error-message">
                        <p>User name is too long</p>
                    </div>
                <?php }?>
                <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] & USERNAME_ALREADY_TAKEN) === USERNAME_ALREADY_TAKEN) { ?>
                    <div class="error-message">
                        <p>User name is already taken</p>
                    </div>
                <?php }?>
                <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] & NO_USERNAME_ENTERED) === NO_USERNAME_ENTERED) { ?>
                    <div class="error-message">
                        <p>You must enter a user name</p>
                    </div>
                <?php }?>
                <?php $emailError = (isset($_SESSION["status"]) && ($_SESSION["status"] & NOT_A_VALID_EMAIL) === NOT_A_VALID_EMAIL) ||
                                    (isset($_SESSION["status"]) && ($_SESSION["status"] & EMAIL_ALREADY_IN_USE) === EMAIL_ALREADY_IN_USE) ||
                                    (isset($_SESSION["status"]) && ($_SESSION["status"] & NO_EMAIL_ENTERED) === NO_EMAIL_ENTERED); ?>
                <div>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $email; ?>" <?php if($emailError) echo "class=\"error\""; ?>/>
                </div>
                <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] & NOT_A_VALID_EMAIL) === NOT_A_VALID_EMAIL) { ?>
                    <div class="error-message">
                        <p>Email is not valid</p>
                    </div>
                <?php }?>
                <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] & EMAIL_ALREADY_IN_USE) === EMAIL_ALREADY_IN_USE) { ?>
                    <div class="error-message">
                        <p>Email is already in use</p>
                    </div>
                <?php }?>
                <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] & NO_EMAIL_ENTERED) === NO_EMAIL_ENTERED) { ?>
                    <div class="error-message">
                        <p>You must enter an email</p>
                    </div>
                <?php }?>
                <?php $passwordError = (isset($_SESSION["status"]) && ($_SESSION["status"] & PASSWORDS_DO_NOT_MATCH) === PASSWORDS_DO_NOT_MATCH) ||
                                       (isset($_SESSION["status"]) && ($_SESSION["status"] & NO_PASSWORD_ENTERED) === NO_PASSWORD_ENTERED) ||
                                       (isset($_SESSION["status"]) && ($_SESSION["status"] & LOW_QUALITY_PASSWORD) === LOW_QUALITY_PASSWORD); ?>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value="" <?php if($passwordError) echo "class=\"error\"";?>/>
                </div>
                <div>
                    <label for="password2">Confirm Password</label>
                    <input type="password" name="password2" id="password2" value="" <?php if($passwordError) echo "class=\"error\"";?>/>
                    <p>Passwords must be at least 8 characters<br>and contain at least 1 capital, 1 number, and 1 punctuation</p>
                </div>
                <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] & PASSWORDS_DO_NOT_MATCH) === PASSWORDS_DO_NOT_MATCH) { ?>
                    <div class="error-message">
                        <p>Passwords do not match</p>
                    </div>
                <?php }?>
                <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] & NO_PASSWORD_ENTERED) === NO_PASSWORD_ENTERED) { ?>
                    <div class="error-message">
                        <p>You must enter a password</p>
                    </div>
                <?php }?>
                <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] & LOW_QUALITY_PASSWORD) === LOW_QUALITY_PASSWORD) { ?>
                    <div class="error-message">
                        <p>Your password must match the complexity rules</p>
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