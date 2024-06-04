<?php
session_start();
//initializes number of items shown
if (!isset($_COOKIE["show"])) {
    setcookie("show", 12);
    refresh();
}
//initializes current page cookie
if (!isset($_COOKIE["searchCurrentPage"])) {
    setcookie("searchCurrentPage", 1);
    refresh();
}
//defines function to increase page number by one
function pageUp()
{
    setcookie("searchCurrentPage", ($_COOKIE["searchCurrentPage"] + 1));
    refresh();
}
//defines function to decrease page number by one
function pageDown()
{
    setcookie("searchCurrentPage", ($_COOKIE["searchCurrentPage"] - 1));
    refresh();
}
//defines function that refreshes the page
function refresh()
{
?>
<script>
window.location.replace("search.php")
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
$currentPage = $_COOKIE["searchCurrentPage"];
require_once("connect-db.php");
if (isset($_POST['form'])) {
    switch ($_POST['form']) {
        case "page-changer":
            $pageNumber = $_POST["page-number"];
            if ($pageNumber > 0 && $pageNumber <= $numPages) {
                setcookie("searchCurrentPage", $pageNumber);
            }
            refresh();
            break;
        case "product":
            $productID = $_POST["product_id"];
            setcookie("product", $productID);
            setcookie("view", 1);
            setcookie("quantity", 1);
            setcookie("info", "details");
    ?>
<script>
window.location.replace("ind-product.php")
</script>
<?php
            break;
    }
}



$input = ucfirst($_COOKIE["search"]);

$sqlTitle =  "select * from product
inner join category on product.category_id = category.category_id
where name like '%" . $input . "%'";

$sqlDesc =  "select * from product
inner join category on product.category_id = category.category_id
where description like '%" . $input . "%'";

//send two different queries 
$statement1 = $db->prepare($sqlTitle);
if ($statement1->execute()) {
    $searchResults = $statement1->fetchAll();
    $statement1->closeCursor();
} else {
    echo "Error finding products";
}
$statement2 = $db->prepare($sqlDesc);
if ($statement2->execute()) {
    $searchResults2 = $statement2->fetchAll();
    $statement2->closeCursor();
} else {
    echo "Error finding products";
}

//append the description return results to the end of title search results so title searches take priority.
$searchResults = array_merge($searchResults, $searchResults2);
//Calculates number of pages based off of number of products 
$numPages = (count($searchResults) / $_COOKIE["show"]);
if (is_float($numPages)) {
    //if the num doesn't divide by number of product round up
    $numPages = (ceil($numPages));
}
$title = "Search Results for " . $_COOKIE["search"] . " | Healthy Organic Snacks Made in the USA";
$description = "Shop for the best healthy organic snacks made in the USA! Made with no artificial ingredients.";
include("header.php");
?>
<section>
    <article>
        <h1>Search Results for: <?php echo $_COOKIE["search"] ?></h1>
        <div class="result-container">
            <?php
            for ($x = (($_COOKIE["searchCurrentPage"] * $_COOKIE["show"]) - $_COOKIE["show"]); $x <= (($_COOKIE["searchCurrentPage"] * $_COOKIE["show"]) - 1); $x++) {
                if ($x == count($searchResults)) {
                    break;
                }
            ?>
            <div class="search-results"
                onClick="document.forms['<?php echo $searchResults[$x]["name"] . $x   ?>'].submit();">
                <form name="<?php echo $searchResults[$x]["name"] . $x   ?>"
                    action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="hidden" name="form" value="product">
                    <input type="hidden" name="product_id" value="<?php echo $searchResults[$x]["product_id"]; ?>">
                    <h1><?php echo $searchResults[$x]["name"]; ?></h1>
                    <h2>$ <?php echo $searchResults[$x]["price"]; ?></h2>
                    <h3><?php echo $searchResults[$x]["size"]; ?> Count</h3>
                    <p><?php echo $searchResults[$x]["category_description"]; ?><?php echo $searchResults[$x]["description"]; ?>
                    </p>
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
            <form class="page-changer" name="page-change" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="search-bar tiny">
                    <input type="text" name="page-number" value="<?php echo $currentPage ?>" class="search-input">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <input type="hidden" name="form" value="page-change">
            </form>
        </div>
    </article>
</section>