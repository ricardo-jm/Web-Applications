<?php //include "templates/header.php"; ?>

<?php
session_start();
require "../src/functions.php";
require_once '../src/DBconnect.php';

//$db_handle = new DBController();

if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "add":
            if(!empty($_POST["quantity"])) {

                try {
                    $sql = "SELECT * FROM product WHERE id = :id2";
                    $statement = $connection->prepare($sql);
                    $statement->bindParam(':id2', $_GET["code"], PDO::PARAM_STR);
                    $statement->execute();
                    $productByCode = $statement->fetch(PDO::FETCH_ASSOC);
                    //var_dump($productByCode);
                    //die();
                } catch(PDOException $error) {
                    echo $sql . "<br>" . $error->getMessage();
                }

                //$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
                $itemArray = array($productByCode["id"]=>array('name'=>$productByCode["prodname"], 'code'=>$productByCode["id"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode["price"], 'image'=>$productByCode["image"]));

                echo ' Before IF to add   ';
                //var_dump($_SESSION["cart_item"]);

                if(!empty($_SESSION["cart_item"])) {
                    if(in_array($productByCode["id"],array_keys($_SESSION["cart_item"]))) {
                        foreach($_SESSION["cart_item"] as $k => $v) {
                            if($productByCode["id"] == $k) {
                                if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                            }
                        }
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                        echo ' After else to add   ';
                        var_dump($_SESSION["cart_item"]);
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            break;
        case "remove":
            if(!empty($_SESSION["cart_item"])) {
                foreach($_SESSION["cart_item"] as $k => $v) {
                    echo ' Session CODE in remove block    ';
                    var_dump($_GET["code"]);
                    if($_GET["code"] == $k)
                        unset($_SESSION["cart_item"][$k]);
                        echo ' After remove   ';
                        var_dump($_SESSION["cart_item"]);
                    if(empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
}
?>

<BODY>
<div id="shopping-cart">
    <div class="txt-heading">Shopping Cart</div>

    <a id="btnEmpty" href="cart_test.php?action=empty">Empty Cart</a>
    <?php
    if(isset($_SESSION["cart_item"])){
        $total_quantity = 0;
        $total_price = 0;
        ?>
        <table class="tbl-cart" cellpadding="10" cellspacing="1">
            <tbody>
            <tr>
                <th style="text-align:left;">Name</th>
                <th style="text-align:left;">Code</th>
                <th style="text-align:right;" width="5%">Quantity</th>
                <th style="text-align:right;" width="10%">Unit Price</th>
                <th style="text-align:right;" width="10%">Price</th>
                <th style="text-align:center;" width="5%">Remove</th>
            </tr>
            <?php
            foreach ($_SESSION["cart_item"] as $item){
                $item_price = $item["quantity"]*$item["price"];
                ?>
                <tr>
                    <td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
                    <td><?php echo $item["code"]; ?></td>
                    <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                    <td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
                    <td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
                    <td style="text-align:center;"><a href="cart_test.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
                </tr>
                <?php
                $total_quantity += $item["quantity"];
                $total_price += ($item["price"]*$item["quantity"]);
                echo '  LIST SEssion  ';
                var_dump($_SESSION["cart_item"]);
            }
            ?>

            <tr>
                <td colspan="2" align="right">Total:</td>
                <td align="right"><?php echo $total_quantity; ?></td>
                <td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
                <td></td>
            </tr>
            </tbody>
        </table>
        <?php
    } else {
        ?>
        <div class="no-records">Your Cart is Empty</div>
        <?php
    }
    ?>
</div>

<div id="product-grid">
    <div class="txt-heading">Products</div>
    <?php

    try {
        $sql = "SELECT * FROM product";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $product_array = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

    //$product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
    if (!empty($product_array)) {
        foreach($product_array as $key=>$value){
            ?>
            <div class="product-item">
                <form method="post" action="cart_test.php?action=add&code=<?php echo $product_array[$key]["id"]; ?>">
                    <div class="product-image"><img src="/Web_Apps_Project/Public/imagessssss/<?php echo $product_array[$key]["image"]; ?>" class="img-rounded img-sales img-thumbnail"></div>
                    <div class="product-tile-footer">
                        <div class="product-title"><?php echo $product_array[$key]["prodname"]; ?></div>
                        <div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
                        <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
                    </div>
                </form>
            </div>
            <?php
        }
    }
    ?>
</div>
</BODY>
</HTML>