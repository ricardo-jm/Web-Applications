<?php

require "../src/functions.php";

if (isset($_POST['submit'])) {
    $result = search($connection);
}
?>

<?php include "templates/header.php"; ?>

<!-- Products Search Result -->
<section  class="pt-4 bg-secondary">
    <div class="container-fluid py-4">
        <div class="row bg-secondary justify-content-center text-center align-items-center text-white pt-3">
            <?php foreach ($result as $products) { ?>
                <div class="col-lg-4 col-sm-6">
                    <img src="/Web_Apps_Project/Public/images/<?php echo $products['image']; ?>" class="img-rounded img-sales img-thumbnail">
                    <h2>
                        <?php echo $products['prodname']; ?>
                    </h2>

                    <h5><?php echo $products['category']; ?></span></h5>
                    <h5><?php echo 'Description: '. $products['proddescription']; ?></h5>
                    <h5><?php echo 'Price: '. $products['price']; ?>€</h5>


                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- End of Products Search Result -->


<!-- Search products -->
<section class="pt-4 bg-secondary">
    <div class="container-fluid">
        <div class="row bg-secondary justify-content-center text-center align-items-center text-white">

            <div class="col-lg-6 text-left">
                <h2>Search Product by name</h2>
                <form method="post" class="form-signin">
                    <div class="form-group">
                        <label for="prodname">Product Name</label>
                        <input type="text" name="prodname" id="prodname" class="form-control" required>
                    </div>
                    <input type="submit" name="submit" value="View Results">
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End of Search products -->

<?php include "templates/footer.php"; ?>

