<?php
session_start();
require("connect-db.php");
$title = "Order Confirmation | Busy Bee Snacks- Order Confirmation for your item. ";
$description = "Order Confirmation will be sent to your email for a record of your purchase. .";
include("header.php");
?>
<section>
    <article class="confirmation">
        <h1>Thank You!</h1>
        <div class="confirmation-product">
            <?php foreach ($_SESSION['completedCart'] as $cart) {

                $ID = $cart['prodId'];
                $sql = "select * from product where product_id = $ID";

                //send query and retrieve data
                $statement1 = $db->prepare($sql);
                if ($statement1->execute()) {
                    $product = $statement1->fetchAll();
                    $statement1->closeCursor();
                } else {
                    echo "Error finding products";
                }
                foreach ($product as $p) { ?>
            <div class="confirmation-ind">
                <img class="cart-img" src="<?php echo $p["img_path"] ?>.jpg" alt="<?php echo $p["alt"] ?>">
                <span>
                    <h2><?php echo $p["name"] ?></h2>
                    <p><?php echo $p["description"] ?></p>
                    <p>Quantity: <?php echo $cart['qty'] ?></p>
                    <p><?php echo $p["price"] * $cart['qty'] ?> USD</p>
                </span>
            </div>
            <?php }
            }
            ?>
            <button class="btn-primary guest"><a href="products.php">Continue Shopping</a></button>
        </div>
    </article>
</section>
<?
include("footer.php");
?>