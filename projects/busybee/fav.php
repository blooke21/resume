<?php
session_start();
//initializes number of items to be shown per page
if (!isset($_COOKIE["show"])) {
    setcookie("show", 12);
    refresh();
}
//initializes the current page cookie
if (!isset($_COOKIE["favPage"])) {
    setcookie("favPage", 1);
    refresh();
}
function refresh()
{
?>
<script>
window.location.replace("fav.php")
</script>
<?php
}
require_once("connect-db.php");
if (!isset($_SESSION["user-login"]) || $_SESSION["user-login"] != 'true') {
?>
<script>
window.location.replace("login.php");
</script>
<?php
} else {
    $customer_id = $_SESSION["user-id"];

    $sql = "select * from fav_list
    inner join product on fav_list.product_id = product.product_id
    where customer_id = $customer_id";

    $statement1 = $db->prepare($sql);

    if ($statement1->execute()) {
        $productList = $statement1->fetchAll();
        $statement1->closeCursor();
    } else {
        echo "Error finding customers.";
    }
}
if (isset($_POST['form'])) {
    switch ($_POST['form']) {
        default:
            $product_id = $_POST["product_id"];
            setcookie("product", $product_id);
            setcookie("view", 1);
            setcookie("quantity", 1);
            setcookie("info", "details");
    ?>
<script>
window.location.replace("ind-product.php")
</script>
<?php
    }
}
$title = "Favorite List | View all your favorite items!";
$description = "View the products you found so delicous you wanted to save them for later.";
include("header.php");

$currentPage = $_COOKIE["favPage"];
?>
<section>
    <article class="fav-list">
        <h1>Your Favored Items</h1>
        <?php
        if (!empty($productList)) {
            include("product-container.php");
        } else {
            $sqlProducts = "select * from product where must_have = true";
            $statementProduct = $db->prepare($sqlProducts);
            if ($statementProduct->execute()) {
                $mustHave = $statementProduct->fetchAll();
                $statementProduct->closeCursor();
            } else {
                echo "Error finding products";
            } ?>
        <div class="query-index">
            <h1>Your Favorite List Is Empty But Check Out These Hot Items</h1>
            <?php
                foreach ($mustHave as $p) {
                    //loops must have products
                ?>
            <form class="query-index-individual" action="ind-product.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo $p["product_id"] ?>" />
                <img src="<?php echo $p["img_path"] ?>.jpg" alt="<?php echo $p["alt"] ?>">
                <p><?php echo $p["name"] ?></p>
                <p>$<?php echo $p["price"] ?></p>
                <button class="btn-primary" type="submit">Go to Product!</button>
            </form>
            <?php }
            } ?>
    </article>
</section>
<br>
<br>
<?php include("footer.php") ?>