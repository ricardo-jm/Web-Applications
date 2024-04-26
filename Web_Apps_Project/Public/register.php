<?php

require "../src/functions.php";
if (isset($_POST['submit'])) {
    register($connection);
}

include "templates/header_login.php";
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
                    <form method="post" class="form-signin">
                        <div class="form-group">
                            <label for="Username">Username    </label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone number</label>
                            <input type="tel" name="phone" id="phone" class="form-control">
                        </div>
                        <input type="submit" name="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End of RegisterR -->

<?php include "templates/footer.php"; ?>