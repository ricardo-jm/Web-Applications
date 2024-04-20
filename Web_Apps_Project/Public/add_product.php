<?php
session_start();
if($_SESSION['Active'] == false){
    header("location:login.php");
    exit;
}

include "templates/header.php";

require "../common.php";

if (isset($_POST['submit'])) {
    try {
        require_once '../src/DBconnect.php';
        echo "success";
        $new_product = array(
            "prodname" => escape($_POST['prodname']),
            "category" => escape($_POST['category']),
            "proddescription" => escape($_POST['proddescription']),
            "price" => escape($_POST['price']),
            "image" => escape($_POST['image'])
        );

        $sql = sprintf( "INSERT INTO %s (%s) values (%s)", "product", implode(", ",
            array_keys($new_product)), ":" . implode(", :", array_keys($new_product)) );
        $statement = $connection->prepare($sql);
        $statement->execute($new_product);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
if (isset($_POST['submit']) && $statement)
{
    echo $new_product['prodname']. ' successfully added';
}
?>

    <body>
    <!-- Add Product -->
    <section class="pt-4 bg-secondary">
        <div class="container-fluid">
            <div class="row bg-secondary justify-content-center text-center align-items-center text-white">
                <div class="col-lg-6">
                    <img src="images/dice.jpeg" alt="immobilizer" class="img-fluid img-login">
                </div>
                <div class="col-lg-6 text-left">
                    <h2>Add a product</h2>
                    <form action="" method="post" name="add_product_Form" class="form-signin">
                        <label for="prodname" >Product Name</label>
                        <input name="prodname" type="text" id="prodname" class="form-control" placeholder="Product Name" required autofocus>
                        <label for="category" >Category</label>
                        <input name="category" type="text" id="category" class="form-control" placeholder="Category" required>
                        <label for="proddescription" >Product Description</label>
                        <input name="proddescription" type="text" id="proddescription" class="form-control" placeholder="Product Description" required>
                        <label for="price" >Price</label>
                        <input name="price" type="number" id="price" class="form-control" placeholder="Price" required>
                        <label for="image" >Image</label>
                        <input name="image" type="text" id="image" class="form-control" placeholder="Image" required>
                        <input type="submit" name="submit" value="Add" class="mt-2">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End of Add Product -->





<?php include "templates/footer.php"; ?>