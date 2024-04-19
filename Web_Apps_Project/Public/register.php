<?php
include "templates/header_login.php";
require "../common.php";
if (isset($_POST['submit'])) {
    try {
        require_once '../src/DBconnect.php';
        echo "success";
        $new_user = array(
            "username" => strtolower(escape($_POST['username'])),
            "pwd" => escape($_POST['password']),
            "email" => escape($_POST['email']),
            "phone" => escape($_POST['phone'])
        );

        $sql = sprintf( "INSERT INTO %s (%s) values (%s)", "user", implode(", ",
            array_keys($new_user)), ":" . implode(", :", array_keys($new_user)) );
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
if (isset($_POST['submit']) && $statement)
{
    echo $new_user['username']. ' successfully added';
}
?>


    <!-- RegisterR -->
    <section class="pt-4 bg-secondary">
        <div class="container-fluid">
            <div class="row bg-secondary justify-content-center text-center align-items-center text-white">
                <div class="col-lg-6">
                    <img src="images/dice.jpeg" alt="immobilizer" class="img-fluid img-login">
                </div>
                <div class="col-lg-6 text-left">
                    <h2>Register User</h2>
                    <form method="post">
                        <div class="form-group">
                            <label for="Username">Username    </label>
                            <input type="text" name="username" id="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone number</label>
                            <input type="tel" name="phone" id="phone">
                        </div>
                        <input type="submit" name="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End of RegisterR -->

<?php include "templates/footer.php"; ?>