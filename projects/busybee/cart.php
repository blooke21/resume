<?php
session_start();
$_SESSION["total"] = 0;
require("connect-db.php");
$title = "Cart | Busy Bee Snacks- Adding our products to your cart";
$description = "Checkout your items in your cart..";
include("header.php");
function qtyUp()
{
    $passed = $_POST["ID"];
    $_SESSION['cart'][$passed]['qty'] = ($_SESSION['cart'][$passed]['qty'] + 1);
    refresh();
}
function qtyDown()
{
    $passed = $_POST["ID"];
    $_SESSION['cart'][$passed]['qty'] = ($_SESSION['cart'][$passed]['qty'] - 1);
    refresh();
}
function refresh()
{
?>
<script>
window.location.replace("cart.php")
</script>
<?php
}
if (array_key_exists('qtyUp', $_POST)) {
    qtyUp();
} elseif (array_key_exists('qtyDown', $_POST)) {
    qtyDown();
}
?>

<section>
    <article>
        <div class="cart-container">
            <?php if (isset($_SESSION['cart'])) { ?>
            <h1>Your Cart</h1>
            <table id="cart-big">
                <thead>
                    <tr>
                        <th></th>
                        <th>Product Name:</th>
                        <th></th>
                        <th class="last-two-header">Quantity</th>
                        <th class="last-two-header">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                            $total = 0;
                            foreach ($_SESSION['cart'] as $cart) {
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
                                foreach ($product as $p) {
                                    $total = $total + ($p['price'] * $cart['qty']);
                            ?>
                        <td><img class="cart-img" src="<?php echo $p["img_path"] ?>.jpg" alt="<?php echo $p["alt"] ?>"></td>
                        <td><?php echo $p["name"] ?></td>
                        <td><?php echo $p["description"] ?></td>
                        <td class="last-two">
                            <div class="quantity-changer cart">
                                <form method="post">
                                    <input type="hidden" name="ID" value="<?php echo $ID ?>">
                                    <?php if ($cart['qty'] == 1) { ?>
                                    <button type="submit" name="qtyDown" class="qty-down" disabled>
                                        <?php } else { ?>
                                        <button type="submit" name="qtyDown" class="qty-down">
                                            <?php } ?>
                                            <p>-</p>
                                        </button>
                                        <input class="quantity" type="text" name="qty"
                                            value="<?php echo $cart['qty'] ?>">
                                        <button type="submit" name="qtyUp" class="qty-up">
                                            <p>+</p>
                                        </button>
                                </form>

                            </div>
                        </td>
                        <td class="last-two last"><?php echo $p["price"] * $cart['qty'] ?> USD</td>
                    </tr>
                    <?php }
                            }
                            $_SESSION["total"] = $total; ?>
                </tbody>
            </table>
            <div class="total-box">
                <p id="subtotal">Subtotal: <span id="number">$<?php echo $total ?></span></p>
                <p id="subtotal">Enter Discount Code: <input type="text"></p>
                <button class="btn-primary"><a href="checkout.php">Checkout</a></button>
                <br>
                <button class="btn-primary"><a href="products.php">Continue Shopping</a></button>
                <br>
                <button class="btn-primary"><a href="clear-cart.php"
                        Onclick="return confirm('Are you sure you want to clear the cart?')">Clear Cart</a></button>
            </div>
            <?php } else { //grabs all "must-have" products
                $sqlProducts = "select * from product where must_have = true";
                $statementProduct = $db->prepare($sqlProducts);
                if ($statementProduct->execute()) {
                    $productList = $statementProduct->fetchAll();
                    $statementProduct->closeCursor();
                } else {
                    echo "Error finding products";
                } ?>
            <div class="query-index">
                <h1>Your Cart Is Empty But Check Out These Hot Items</h1>
                <?php
                    foreach ($productList as $p) {
                        //loops must have products
                    ?>
                <form class="query-index-individual" action="product-redirect.php" method="get">
                    <input type="hidden" name="product_id" value="<?php echo $p["product_id"] ?>" />
                    <img src="<?php echo $p["img_path"] ?>.jpg" alt="<?php echo $p["alt"] ?>">
                    <p><?php echo $p["name"] ?></p>
                    <p>$<?php echo $p["price"] ?></p>
                    <button class="btn-primary" type="submit">Go to Product!</button>
                </form>
                <?php
                    }
                    ?>
            </div>

            <?php } ?>

        </div>
    </article>
</section>
<br>
<?php include("footer.php")?>