<?php
session_start();
//initializes number of items to be shown per page
if (!isset($_COOKIE["show"])) {
    setcookie("show", 12);
    refresh();
}
//initializes the current page cookie
if (!isset($_COOKIE["currentPage"])) {
    setcookie("currentPage", 1);
    refresh();
}
//initializes a display method
if (!isset($_COOKIE["sort"])) {
    setcookie("sort", "default");
    refresh();
}
//initializes a filter method
if (!isset($_COOKIE["filter"])) {
    setcookie("filter", "default");
    refresh();
}
//defines function to increase page number by one
function pageUp()
{
    setcookie("currentPage", ($_COOKIE["currentPage"] + 1));
    refresh();
}
//defines function to decrease page number by one
function pageDown()
{
    setcookie("currentPage", ($_COOKIE["currentPage"] - 1));
    refresh();
}
//defines function that refreshes the page
function refresh()
{
?>
<script>
window.location.replace("products.php")
</script>
<?php
}
//ensure pageUp and pageDown functions run on submits
if (array_key_exists('pageUp', $_POST)) {
    pageUp();
} elseif (array_key_exists('pageDown', $_POST)) {
    pageDown();
}

//connects to db
require_once("connect-db.php");
//builds query that selects all products
$sql = "select * from product inner join category on product.category_id = category.category_id";

//depending on filter method form query
switch ($_COOKIE["filter"]) {
    case "default":
        break;
    case "bar":
        $sql = $sql . " where product.category_id = 1";
        break;
    case "honey":
        $sql = $sql . " where product.category_id = 2 or honey = true";
        break;
    case "nut":
        $sql = $sql . " where product.category_id = 3";
        break;
    case "yogurt":
        $sql = $sql . " where product.category_id = 4";
        break;
    case "popsicle":
        $sql = $sql . " where product.category_id = 5";
        break;
}
//depending on sort method form query
switch ($_COOKIE["sort"]) {
    case "default":
        break;
    case "priceLowToHigh":
        $sql = $sql . " order by price";
        break;
    case "priceHighToLow":
        $sql = $sql . " order by price DESC";
        break;
    case "sizeLowToHigh":
        $sql = $sql . " order by size";
        break;
    case "sizeHighToLow":
        $sql = $sql . " order by size DESC";
        break;
}


//send query and retrieve data
$statement1 = $db->prepare($sql);
if ($statement1->execute()) {
    $productList = $statement1->fetchAll();
    $statement1->closeCursor();
} else {
    echo "Error finding products";
}

//puts page cookie into variable ?
$currentPage = $_COOKIE["currentPage"];

$filter = $_COOKIE["filter"];

$sort = $_COOKIE["sort"];



//when a form is php_self submitted ensure the correct form is processed
if (isset($_POST['form'])) {
    switch ($_POST['form']) {
        case "page-change":
            $pageNumber = $_POST["page-number"];
            $numPages = $_POST["page"];
           echo $pageNumber;
           echo $numPages;
            if ($pageNumber > 0 && $pageNumber <= $numPages) {
                setcookie("currentPage", $pageNumber);
            }
            refresh();
            break;
        case "sort-default":
            setcookie("sort", "default");
            refresh();
            break;
        case "sort-priceLowToHigh":
            setcookie("sort", "priceLowToHigh");
            refresh();
            break;
        case "sort-priceHighToLow":
            setcookie("sort", "priceHighToLow");
            refresh();
            break;
        case "sort-sizeLowToHigh":
            setcookie("sort", "sizeLowToHigh");
            refresh();
            break;
        case "sort-sizeHighToLow":
            setcookie("sort", "sizeHighToLow");
            refresh();
            break;
        case "filter-default":
            setcookie("filter", "default");
            setcookie("currentPage", 1);
            refresh();
            break;
        case "filter-bar":
            setcookie("filter", "bar");
            setcookie("currentPage", 1);
            refresh();
            break;
        case "filter-honey":
            setcookie("filter", "honey");
            setcookie("currentPage", 1);
            refresh();
            break;
        case "filter-nut":
            setcookie("filter", "nut");
            setcookie("currentPage", 1);
            refresh();
            break;
        case "filter-yogurt":
            setcookie("filter", "yogurt");
            setcookie("currentPage", 1);
            refresh();
            break;
        case "filter-popsicle":
            setcookie("filter", "popsicle");
            setcookie("currentPage", 1);
            refresh();
            break;

        default:
            $product_id = $_POST["product_id"];
            setcookie("product", $product_id);
            setcookie("view", 1);
            setcookie("quantity", 1);
            setcookie("info", "details");

header("Location:ind-product.php");


    }
}
$title = "All Products| Busy Bee Snacks- All of our products that we offer at Busy Bee Snacks";
$description = "All of the best products that we sell at Busy Bee Snacks. ";
include("header.php");
?>
<section>
    <article>
        <!-- white box here -->
    </article>
</section>
<section>
    <article>
        <div class="sort-selector">
            <!-- shows different sort methods -->
            <?php include("sort.php") ?>
        </div>
        <div class="filter-selector">
            <!-- shows different filter methods -->
            <?php include("filter.php") ?>
        </div>
        <?php include("product-container.php") ?>
    </article>
</section>
<br>
<?php include("footer.php"); ?>