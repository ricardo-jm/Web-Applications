<?php

session_start();
if($_SESSION['Active'] == false){
    header("location:login.php");
    exit;
}

require "../src/functions.php";

if (isset($_POST['submit'])) {
    $statement = updateProductById($connection);
}

if (isset($_GET['id'])) {
    $product = queryProductById($connection);
} else {
    echo "Something went wrong!";
    exit;
}

?>
<?php $title = 'Edit product'; ?>
<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
    <?php echo escape($_POST['prodname']); ?> successfully updated.
<?php endif; ?>

<body>
    <!-- Edit Single Product -->
    <section class="pt-4 bg-secondary">
        <div class="container-fluid">
            <div class="row bg-secondary justify-content-center text-center align-items-center text-white">
                <div class="col-lg-6">
                    <img src="images/dice.jpeg" alt="immobilizer" class="img-fluid img-login">
                </div>
                <div class="col-lg-6 text-left">
                    <h2>Edit a product</h2>
                    <form action="" method="post" name="edit_product_Form" class="form-signin">
                        <?php foreach ($product as $key => $value) : ?>
                            <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
                            <input type="text" name="<?php echo $key; ?>" id="<?php echo $key;?> "value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?> class="form-control">
                        <?php endforeach; ?>
                        <input type="submit" name="submit" value="Edit" class="mt-2">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End of Edit Single  Product -->





<?php include "templates/footer.php"; ?>