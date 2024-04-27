

<?php
session_start();
$user = null;

require "../src/functions.php";

if (isset($_POST['Submit'])) {

    validateLogin($connection);
}
?>

<?php include "templates/header_login.php"; ?>

<!-- Login -->
<section class="pt-4 bg-secondary">
    <div class="container-fluid">
        <div class="row bg-secondary justify-content-center text-center align-items-center text-white">
            <div class="col-lg-6">
                <img src="images/dice.jpeg" alt="immobilizer" class="img-fluid img-rentals">
            </div>
            <div class="col-lg-6 text-left">
                <form action="" method="post" name="Login_Form" class="form-signin">
                    <h2 class="form-signin-heading">Please sign in</h2>
                    <label for="inputUsername" >Username</label>
                    <input name="Username" type="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
                    <label for="inputPassword">Password</label>
                    <input name="Password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <button name="Submit" value="Login" class="button" type="submit">Sign in</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End of Login -->

<?php include "templates/footer.php"; ?>

