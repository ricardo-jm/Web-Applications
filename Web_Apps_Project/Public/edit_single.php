<?php

session_start();
if($_SESSION['Active'] == false){
    header("location:login.php");
    exit;
}

require "../common.php";

if (isset($_POST['submit'])) {
    try {
        require_once '../src/DBconnect.php';
        $product =[
            "id" => escape($_POST['id']),
            "prodname" => escape($_POST['prodname']),
            "category" => escape($_POST['category']),
            "proddescription" => escape($_POST['proddescription']),
            "price" => escape($_POST['price']),
            "image" => escape($_POST['image'])
        ];
        $sql = "UPDATE product
                SET id = :id,
                prodname = :prodname,
                category = :category,
                proddescription = :proddescription,
                price = :price,
                image = :image
            WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->execute($product);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

if (isset($_GET['id'])) {
    try {
        require_once '../src/DBconnect.php';
        $id = $_GET['id'];
        $sql = "SELECT * FROM product WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $product = $statement->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    echo "Something went wrong!";
    exit;
}

?>

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
                        <input type="submit" name="submit" value="Edit">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End of Edit Single  Product -->





<?php include "templates/footer.php"; ?>