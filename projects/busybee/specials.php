<?php
session_start();
//initializes number of items shown
if (!isset($_COOKIE["show"])) {
    setcookie("show", 12);
    refresh();
}
//initializes current page cookie
if (!isset($_COOKIE["specialsCurrentPage"])) {
    setcookie("specialsCurrentPage", 1);
    refresh();
}
//initializes a filter method
if (!isset($_COOKIE["specialFilter"])) {
    setcookie("specialFilter", "default");
    refresh();
}
//defines function to increase page number by one
function pageUp()
{
    setcookie("specialsCurrentPage", ($_COOKIE["specialsCurrentPage"] + 1));
    refresh();
}
//defines function to decrease page number by one
function pageDown()
{
    setcookie("specialsCurrentPage", ($_COOKIE["specialsCurrentPage"] - 1));
    refresh();
}
//defines function that refreshes the page
function refresh()
{
?>
<script>
window.location.replace("specials.php")
</script>
<?php
}
//ensure functions run on submits
if (array_key_exists('pageUp', $_POST)) {
    pageUp();
} elseif (array_key_exists('pageDown', $_POST)) {
    pageDown();
}

//connects to db
require_once("connect-db.php");

$sql = "select * from special inner join product on special.product_id = product.product_id inner join category on product.category_id = category.category_id";

//depending on filter method form query
switch ($_COOKIE["specialFilter"]) {
    case "default":
        break;
    case "bar":
        $sql = $sql . " where category_id = 1";
        break;
    case "honey":
        $sql = $sql . " where category_id = 2 or honey = true";
        break;
    case "nut":
        $sql = $sql . " where category_id = 3";
        break;
    case "yogurt":
        $sql = $sql . " where category_id = 4";
        break;
    case "popsicle":
        $sql = $sql . " where category_id = 5";
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
//puts cookies into variable ?
$currentPage = ($_COOKIE["specialsCurrentPage"]);

$filter = $_COOKIE["specialFilter"];

//when a form is php_self submitted ensure the correct form is processed
if (isset($_POST['form'])) {
    switch ($_POST['form']) {
        case "page-change":
            $pageNumber = $_POST["page-number"];
            if ($pageNumber > 0 && $pageNumber <= $numPages) {
                setcookie("specialsCurrentPage", $pageNumber);
            }
            refresh();
            break;
        case "filter-default":
            setcookie("specialFilter", "default");
            refresh();
            break;
        case "filter-bar":
            setcookie("specialFilter", "bar");
            refresh();
            break;
        case "filter-honey":
            setcookie("specialFilter", "honey");
            refresh();
            break;
        case "filter-nut":
            setcookie("specialFilter", "nut");
            refresh();
            break;
        case "filter-yogurt":
            setcookie("specialFilter", "yogurt");
            refresh();
            break;
        case "filter-popsicle":
            setcookie("specialFilter", "popsicle");
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
$title = "Specials | Busy Bee Snacks- Deals that will bring health to the hive ";
$description = "Shop our best deals for our delicious healthy snacks. ";
include("header.php");
?>
<section>
    <article>
        <!-- white box here -->
    </article>
</section>
<section>
    <article class="specials">
        <div class="filter-specials">
            <!-- shows different filter methods -->
            <?php include("filter.php") ?>
        </div>

        </div>
        <form class="search-container" action="search.php" method="post">
            <div class="search-bar big">
                <input type="text" name="search" placeholder="Search..." class="search-input">
                <button type="submit" class="search-btn">
                    Go
                </button>
            </div>
        </form>


        <?php
        //Calculates number of pages based off of number of products received from database
        $numPages = (count($productList) / $_COOKIE["show"]);
        if (is_float($numPages)) {
            //if the num doesn't divide by number of product, round up
            $numPages = (ceil($numPages));
        }
        ?>

        <div class="product-container">
            <?php
            $totalProducts = count($productList);
            if ($totalProducts % 4 == 2) {
                $hangingProduct = $totalProducts - 2;
            } elseif ($totalProducts % 4 == 1) {
                $hangingProduct = $totalProducts - 1;
            } else {
                $hangingProduct = $totalProducts;
            }
            for ($x = (($currentPage * $_COOKIE["show"]) - $_COOKIE["show"]); $x <= (($currentPage * $_COOKIE["show"]) - 1); $x++) {
                if ($x == $totalProducts) { //only display number of products per page depending on cookie show value
                    break;
                }
                if ($x >= $hangingProduct) {
                    if ($hangingProduct - $x == 0 && ($totalProducts - 1) != 0) { //first hang 
            ?>
            <div class="individual-product-container first"
                onClick="document.forms['<?php echo $productList[$x]["name"] . $x ?>'].submit();">
                <?php } elseif ($x - $hangingProduct == 1) { ?>
                <div class="individual-product-container second"
                    onClick="document.forms['<?php echo $productList[$x]["name"] . $x  ?>'].submit();">
                    <?php } else { //center 
                            ?>
                    <div class="individual-product-container center"
                        onClick="document.forms['<?php echo $productList[$x]["name"] . $x  ?>'].submit();">
                        <?php }
                        } else { ?>
                        <div class="individual-product-container"
                            onClick="document.forms['<?php echo $productList[$x]["name"] . $x  ?>'].submit();">
                            <?php  }
                                ?>
                            <form name="<?php echo $productList[$x]["name"] . $x  ?>"
                                action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <input type="hidden" name="form" value="product_id" />
                                <input type="hidden" name="product_id"
                                    value="<?php echo $productList[$x]["product_id"]; ?>">
                                <img class="product-img" src="<?php echo $productList[$x]["img_path"] ?>.jpg"
                                    alt="<?php echo $productList[$x]["alt"] ?>">
                                <button class="product-btn" type="submit"><?php echo $productList[$x]["name"] ?>
                                    <div class="line"></div><?php echo $productList[$x]["category_name"] ?>
                                    <div class="line"></div><?php echo $productList[$x]["size"] ?> Count
                                    <div class="line"></div>
                                    <span class="line-through">Price $<?php echo $productList[$x]["price"] + 1 ?></span>
                                    Sale Price $<?php echo $productList[$x]["new_price"] ?>
                                    <div class="line"></div>View
                                    Product
                                </button>
                            </form>
                        </div>
                        <?php
                        }
                            ?>


                    </div>
                    <div class="page-controller">
                        <!-- page selector form -->
                        <form method="post">
                            <?php
                                        //if the current page is one, the user is stopped from going to page zero
                                        if ($currentPage == 1) { ?>
                            <button type="submit" name="pageDown" disabled class="btn-backwards"><img
                                    src="images/icons/yellow-leftarrow-icon.png" alt=""></button>
                            <?php } else { ?>
                            <button type="submit" name="pageDown" class="btn-backwards"><img
                                    src="images/icons/green-leftarrow-icon.png" alt=""></button>
                            <?php } //if the current page is the last page the user is prevented from going to the next page
                                        if ($currentPage == $numPages) { ?>
                            <button type="submit" name="pageUp" disabled class="btn-forward"><img
                                    src="images/icons/yellow-rightarrow-icon.png" alt=""></button>
                            <?php } else { ?>
                            <button type="submit" name="pageUp" class="btn-forward"><img
                                    src="images/icons/green-rightarrow-icon.png" alt=""></button>
                            <?php } ?>
                        </form>
                        <!-- page number controller -->
                        <form class="page-changer" name="page-change" method="post"
                            action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="search-bar tiny">
                                <input type="text" name="page-number" value="<?php echo $currentPage ?>"
                                    class="search-input">
                                <button type="submit" class="search-btn">
                                    Go
                                </button>
                            </div>
                            <input type="hidden" name="form" value="page-change">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </article>
</section>
<?php include("footer.php"); ?>