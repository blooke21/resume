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
                        <input type="hidden" name="product_id" value="<?php echo $productList[$x]["product_id"]; ?>">
                        <img class="product-img" src="<?php echo $productList[$x]["img_path"] ?>.jpg"
                            alt="<?php echo $productList[$x]["alt"] ?>">
                        <button class="product-btn" type="submit"><?php echo $productList[$x]["name"] ?>
                            <div class="line"></div><?php echo $productList[$x]["category_name"] ?>
                            <div class="line"></div><?php echo $productList[$x]["size"] ?>
                            Count | $<?php echo $productList[$x]["price"] ?><div class="line"></div>View
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
                        <input type="text" name="page-number" value="<?php echo $currentPage ?>" class="search-input">
                        <input type="hidden" name="page" value="<?php echo $numPages ?>">
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