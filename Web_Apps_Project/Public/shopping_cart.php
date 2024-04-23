<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/title-img.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>SVDNS</title>
</head>

<?php

session_start();
if($_SESSION['Active'] == false){
    header("location:login.php");
    exit;
}else {
    $hidden_when_login = 'd-none';
    if($_SESSION['Username'] != 'admin') {
        $hidden_when_not_admin = 'd-none';
    }
}

require "../src/functions.php";

$total = 0;

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id');
    addItemToCart($id);
    var_dump($_SESSION['cart']);
}

/*try {
    require "../common.php";
    require_once '../src/DBconnect.php';
    $sql = "SELECT * FROM product";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
echo '   VARDUMP Result *******:    ', "\n";
var_dump($result[6][0]);
*/
$cartItems = getShoppingCart();

foreach($cartItems as $id => $quantity):

    try {
        require "../common.php";
        require_once '../src/DBconnect.php';
        $sql = "SELECT * FROM product WHERE id = :id2";
        $id2 = $id +1 ;
        $statement = $connection->prepare($sql);
        $statement->bindParam(':id2', $id2, PDO::PARAM_STR);
        $statement->execute();
        $result2 = $statement->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

    var_dump($id2);

    $product = $result2;


    echo '   VARDUMP Result22222222***:    ', "\n";
    var_dump($product);

    $price = $product['price'];
    $subtotal = $quantity * $price;
    // update total
    $total += $subtotal;
    // format prices to 2 d.p.
    $price = number_format($price, 2);
    $subtotal = number_format($subtotal, 2);
?>

    <div class="row border-top">
        <div class="col product text-center">
            <img src="/Web_Apps_Project/Public/images/<?= $product['image'] ?>" alt="<?= $product['image'] ?>" class="img-rounded img-sales img-thumbnail">
        </div>
        <div class="col">
            <h4><?= $product['prodname'] ?></h4>
            <?= $product['proddescription'] ?>
        </div>
        <div class="col price text-right align-self-center">
            $ <?= $price ?>
        </div>
        <div class="col text-center align-self-center">
            <form action="/?action=changeCartQuantity&id=<?= $id ?>" method="post">
                <button type="submit" name="amount" value="reduce"
                          class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-minus"></span>
                </button>
                <?= $quantity ?>
                <button type="submit" name="amount" value="increase"
                        class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </form>
        </div>
        <div class="col price text-right align-self-center">
            $ <?= $subtotal ?>
        </div>
        <div class="col align-self-center">
            <form action="/?action=removeFromCart&id=<?= $id ?>" method="post">
                <button class="btn btn-danger btn-sm">
                    <span class="glyphicon glyphicon-remove"></span>
                    Remove
                </button>
            </form>
        </div>
    </div>
<?php endforeach; ?>

<div class="row border-top">
    <div class="col-10 price text-right">
        <?php
        $total = number_format($total, 2);
        ?>
        $ <?= $total ?>
    </div>
    <div class="col font-weight-bold ">
        Total
    </div>
</div>
</body>
</html>
