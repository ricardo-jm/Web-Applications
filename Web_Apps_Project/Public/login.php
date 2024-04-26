

<?php
session_start();
$user = null;

require "../src/functions.php";

if (isset($_POST['Submit'])) {

    validateLogin();
    /*try {
        require_once '../src/DBconnect.php';
        $password = escape($_POST['Password']);
        $username = strtolower(escape($_POST['Username']));
        $sql = "SELECT * FROM user WHERE username = :username";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $username, PDO::FETCH_ASSOC);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        #var_dump($user);

        if ($user && $statement->rowCount() > 0) {
            if (($user['username'] == $_POST['Username']) && ($user['pwd'] == $_POST['Password'])) {
                echo 'Username and Password are correct';

                $_SESSION['Username'] = $username; //store Username to the session
                $_SESSION['Active'] = true;
                header("location:index.php");
                exit; //we’ve just used header() to redirect to another page but we must terminate all current code so that it doesn’t run when we redirect
            } else echo 'Incorrect Username or Password';
        }else echo 'Incorrect Username or Password';
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }*/
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

