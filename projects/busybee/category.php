<?php
session_start();
//initializes number of items to be shown per page
if (!isset($_COOKIE["show"])) {
    setcookie("show", 12);
    refresh();
}
setcookie("catCurrentPage", 1);
setcookie("categoryCurrentPage", 1);
//defines function that refreshes the page
function refresh()
{
?>
<script>
window.location.replace("category.php")
</script>
<?php
}
require_once("connect-db.php");
//queries all categories
$sql = "select * from category";
$statement1 = $db->prepare($sql);
if ($statement1->execute()) {
    $category = $statement1->fetchAll();
    $statement1->closeCursor();
} else {
    echo "Error finding categories.";
}
//Calculates number of pages based off of number of products received from database
$numPages = (count($category) / $_COOKIE["show"]);
if (is_float($numPages)) {
    //if the num doesn't divide by number of product, round up
    $numPages = (ceil($numPages));
}
$currentPage = $_COOKIE["catCurrentPage"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST["category_id"];
    setcookie("category", $category);
?>
<script>
window.location.replace("category-product.php")
</script>
<?php
}
$title = "All Categories | Busy Bee Snacks- Shop all the categories that we have to offer ";
$description = "All of the best products that we sell at Busy Bee Snacks. ";
include("header.php");
?>
<section>
    <article>
        <div class="product-container">
            <?php
            $totalProducts = count($category);
            $hitHanging = false;
            if ($totalProducts % 3 == 2) {
                $hangingProduct = $totalProducts - 2;
            } elseif ($totalProducts % 3 == 1) {
                $hangingProduct = $totalProducts - 1;
            } else {
                $hangingProduct = $totalProducts;
            }
            for ($x = (($currentPage * $_COOKIE["show"]) - $_COOKIE["show"]); $x <= (($currentPage * $_COOKIE["show"]) - 1); $x++) {
                if ($x == $totalProducts) { //only display number of products per page depending on cookie show value
                    break;
                }
                if ($x >= $hangingProduct) {
                    if ($hangingProduct - $x == 0) { //first hang 
            ?>
            <div class="individual-product-container category first"
                onClick="document.forms['<?php echo $category[$x]["category_name"] ?>'].submit();">
                <?php } elseif ($x - $hangingProduct == 1) { ?>
                <div class="individual-product-container category second"
                    onClick="document.forms['<?php echo $category[$x]["category_name"] ?>'].submit();">
                    <?php } else { //center 
                            ?>
                    <div class="individual-product-container category center"
                        onClick="document.forms['<?php echo $category[$x]["category_name"] ?>'].submit();">
                        <?php }
                        } else { ?>
                        <div class="individual-product-container category"
                            onClick="document.forms['<?php echo $category[$x]["category_name"] ?>'].submit();">
                            <?php  }
                                ?>
                            <form class="category-container" name="<?php echo $category[$x]["category_name"] ?>"
                                action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <img class="<?php echo $category[$x]["category_name"] ?>"
                                    src="images/icons/<?php echo $category[$x]["category_img_path"] ?>.png" alt="<?php echo $category[$x]["category_alt"] ?>">
                                <h1><?php echo $category[$x]["category_name"] ?></h1>
                                <input type="hidden" name="category_id"
                                    value="<?php echo $category[$x]["category_id"]; ?>">
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
                                        if ($_COOKIE["catCurrentPage"] == 1) { ?>
                            <button type="submit" name="pageDown" disabled class="btn-backwards"><img
                                    src="images/icons/yellow-leftarrow-icon.png" alt="Icon of a left arrow"></button>
                            <?php } else { ?>
                            <button type="submit" name="pageDown" class="btn-backwards"><img
                                    src="images/icons/green-leftarrow-icon.png" alt="Icon of a left arrow"></button>
                            <?php } //if the current page is the last page the user is prevented from going to the next page
                                        if ($_COOKIE["catCurrentPage"] == $numPages) { ?>
                            <button type="submit" name="pageUp" disabled class="btn-forward"><img
                                    src="images/icons/yellow-rightarrow-icon.png" alt="Icon of a right arrow"></button>
                            <?php } else { ?>
                            <button type="submit" name="pageUp" class="btn-forward"><img
                                    src="images/icons/green-rightarrow-icon.png" alt="Icon of a right arrow"></button>
                            <?php } ?>
                        </form>
                        <!-- page number controller -->
                        <form class="page-changer" name="page-change" method="post"
                            action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="search-bar tiny">
                                <input type="text" name="page-number" value="<?php echo $_COOKIE["catCurrentPage"] ?>"
                                    class="search-input">
                                <button type="submit" class="search-btn">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <input type="hidden" name="form" value="page-change">
                        </form>
                    </div>
    </article>
</section>
<?php include("footer.php"); ?>