<?php
session_start();
//initializes number of items shown
if (!isset($_COOKIE["category"])) {
?>
<script>
window.location.replace("category.php")
</script>
<?php
}
//initializes number of items shown
if (!isset($_COOKIE["show"])) {
    setcookie("show", 12);
    refresh();
}
//initializes current page cookie
if (!isset($_COOKIE["categoryCurrentPage"])) {
    setcookie("categoryCurrentPage", 1);
    refresh();
}
//initializes a display method
if (!isset($_COOKIE["categorySort"])) {
    setcookie("categorySort", "default");
    refresh();
}
//defines function to increase page number by one
function pageUp()
{
    setcookie("categoryCurrentPage", ($_COOKIE["categoryCurrentPage"] + 1));
    refresh();
}
//defines function to decrease page number by one
function pageDown()
{
    setcookie("categoryCurrentPage", ($_COOKIE["categoryCurrentPage"] - 1));
    refresh();
}
//defines function that refreshes the page
function refresh()
{
?>
<script>
window.location.replace("category-product.php")
</script>
<?php
}
if (array_key_exists('pageUp', $_POST)) {
    pageUp();
} elseif (array_key_exists('pageDown', $_POST)) {
    pageDown();
}
require_once("connect-db.php");

$sql = "select * from product where category_id = :category_id";
if ($_COOKIE["category"] == 2) {
    $sql = $sql . " OR honey = true";
}
switch ($_COOKIE["categorySort"]) {
    case "default":
        $order = "Default";
        break;
    case "priceLowToHigh":
        $sql = $sql . " order by price";
        $order = "Price: Low -> High";
        break;
    case "priceHighToLow":
        $sql = $sql .  " order by price DESC";
        $order = "Price: High -> Low";
        break;
    case "sizeLowToHigh":
        $sql = $sql .  " order by size";
        $order = "Size: Low -> High";
        break;
    case "sizeHighToLow":
        $sql = $sql . " order by size DESC";
        $order = "Size: High -> Low";
        break;
}
$statement1 = $db->prepare($sql);
$statement1->bindValue(":category_id", $_COOKIE["category"]);
if ($statement1->execute()) {
    $productList = $statement1->fetchAll();
    $statement1->closeCursor();
} else {
    echo "Error finding product information";
}

$currentPage = ($_COOKIE["categoryCurrentPage"]);

$sort = $_COOKIE["categorySort"];

if (isset($_POST['form'])) {
    switch ($_POST['form']) {
        case "page-change":
            $pageNumber = $_POST["page-number"];
            if ($pageNumber > 0 && $pageNumber <= $numPages) {
                setcookie("categoryCurrentPage", $pageNumber);
            }
            refresh();
            break;
        case "sort-default":
            setcookie("categorySort", "default");
            refresh();
            break;
        case "sort-priceLowToHigh":
            setcookie("categorySort", "priceLowToHigh");
            refresh();
            break;
        case "sort-priceHighToLow":
            setcookie("categorySort", "priceHighToLow");
            refresh();
            break;
        case "sort-sizeLowToHigh":
            setcookie("categorySort", "sizeLowToHigh");
            refresh();
            break;
        case "sort-sizeHighToLow":
            setcookie("categorySort", "sizeHighToLow");
            refresh();
            break;

        default:
            $product_id = $_POST["product_id"];
            setcookie("product", $product_id);
            setcookie("view", 1);
            setcookie("quantity", 1);
    ?>
<script>
window.location.replace("ind-product.php")
</script>
<?php
    }
}
switch($_COOKIE["category"]){
    case 1:
        $name = "Granola Barzzz";
        break;
    case 2: 
        $name = "Honey Products";
        break;
    case 3:
        $name = "Packaged Nutzzz";
        break;
    case 4:
        $name = "Yogurtzzz";
        break;
    case 5:
        $name = "Popsiclezzz";
        break;
}
$title = "All Product in " . $name .  " | Busy Bee Snacks- Shop all the categories that we have to offer ";
$description = "All of the best products that we sell at Busy Bee Snacks. ";
include("header.php");
?>
<section>
    <article>
        <div class="sort-selector">
            <?php include("sort.php") ?>
        </div>

        <?php include("product-container.php") ?>
    </article>
</section>
<br>
<?php include("footer.php") ?>