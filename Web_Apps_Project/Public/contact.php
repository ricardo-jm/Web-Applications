<?php include "templates/header.php";?>

<!-- Contact -->
<section class="pt-4 bg-secondary">
    <div class="container-fluid">
        <div class="row bg-secondary justify-content-center text-center align-items-center text-white">
            <div class="col-lg-6">
                <img src="images/dialogue.png" alt="Moose logo" class="img-fluid img-about">
            </div>
            <div class="col-lg-6 text-left">
                <h2>Contact Us</h2>
                <form class="text-muted">
                    <div class="form-group">
                        <input type="text" class="form-control mb-3" id="name" placeholder="Name">
                        <input type="text" class="form-control" id="surname" placeholder="Surname">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="message" cols="30" rows="3" placeholder="Message"></textarea>
                    </div>
                    <button class="btn btn-warning btn-lg text-white" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End of Contact -->


<?php include "templates/footer.php"; ?>
