<?php
session_start();
//initializes number of items to be shown per page
if (!isset($_COOKIE["show"])) {
    setcookie("show", 12);
}
//initializes the current page cookie
if (!isset($_COOKIE["currentPage"])) {
    setcookie("currentPage", 1);
}
//initializes a display method
if (!isset($_COOKIE["sort"])) {
    setcookie("sort", "default");
}
//initializes a filter method
if (!isset($_COOKIE["filter"])) {
    setcookie("filter", "default");
}
//initializes the current page cookie
if (!isset($_COOKIE["favPage"])) {
    setcookie("favPage", 1);
}
//initializes current page cookie
if (!isset($_COOKIE["categoryCurrentPage"])) {
    setcookie("categoryCurrentPage", 1);
}
//initializes a display method
if (!isset($_COOKIE["categorySort"])) {
    setcookie("categorySort", "default");
}
//initializes current page cookie
if (!isset($_COOKIE["searchCurrentPage"])) {
    setcookie("searchCurrentPage", 1);
}
//initializes number of items shown
if (!isset($_COOKIE["show"])) {
    setcookie("show", 12);
}
//initializes current page cookie
if (!isset($_COOKIE["specialsCurrentPage"])) {
    setcookie("specialsCurrentPage", 1);
}
//initializes a filter method
if (!isset($_COOKIE["specialFilter"])) {
    setcookie("specialFilter", "default");
}
if (!isset($_COOKIE["guest"])) {
    setcookie("guest", "");
}
//connects to db
require_once("connect-db.php");

//grabs all "must-have" products
$sqlProducts = "select * from product where
must_have = true";

//grabs all reviews marked to show on index
$sqlReviews = "select * from review
inner join product on review.product_id = product.product_id
inner join customer on review.customer_id = customer.customer_id
where show_on_index = true";

$statementProduct = $db->prepare($sqlProducts);
if ($statementProduct->execute()) {
    $productList = $statementProduct->fetchAll();
    $statementProduct->closeCursor();
} else {
    echo "Error finding products";
}

$statementReviews = $db->prepare($sqlReviews);
if ($statementReviews->execute()) {
    $reviewList = $statementReviews->fetchAll();
    $statementReviews->closeCursor();
} else {
    echo "Error finding products";
}

$title = "Busy Bee Snacks | Healthy Organic Snacks Made in the USA";
$description = "Shop for the best healthy organic snacks made in the USA! Made with no artificial ingredients.";
include("header.php")
?>
<div class="index-container">
    <section>
        <article>
            <h1>This is a class project and not an actual e-commerce site</h1>
            <img id="header-home" src="images/aboutusheader.png"
                alt="Image that reads Hello! We are Busy Bee Snacks and has honey combs filled with different kinds of nuts">

            <div class="icon-bar">

                <div class="individual-icon"><img src="images/icons/green-freeship-icon.png"
                        alt="Icon of shipping truck with the text free"><br>
                    <p>Free Shipping on Orders over $75</p>
                </div>
                <div class="individual-icon"><img src="images/icons/yellow-notest-icon.png"
                        alt="Picture of a rabbit in an octagon with a line through it"><br>
                    <p>All non-GMO Products!</p>
                </div>
                <div class="individual-icon"><img src="images/icons/green-health-icon.png"
                        alt="A picture of a leaf"><br>
                    <p>We Only Use Sustainable Packaging</p>
                </div>
                <div class="individual-icon"><img src="images/icons/yellow-honey-icon.png"
                        alt="A pciture of a honey pot"><br>
                    <p>Healthy Snacks That'll Fill All Your Cravings!</p>
                </div>
            </div>
            <div class="container">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="images/slide-one.png"
                                alt="Granola Bar with the text granol bars 50 percent off wth code: buzy bee">
                        </div>

                        <div class="item">
                            <img src="images/slide-two.png"
                                alt="Bananas, oranges, and strawberries with the text start a health life style">
                        </div>

                        <div class="item">
                            <img src="images/slide-three.png"
                                alt="Honey stick dripping with honey and text that says bring health to the hive with our snackzzz">
                        </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>

                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>

                    </a>
                </div>
            </div>

        </article>
        <article>
            <div class="query-index">
                <h1>OUR MUST HAVES</h1>
                <?php
                foreach ($productList as $p) {
                    //loops must have products
                ?>
                <form class="query-index-individual" action="product-redirect.php" method="get">
                    <input type="hidden" name="product_id" value="<?php echo $p["product_id"] ?>" />
                    <img class="product-img" src="<?php echo $p["img_path"] ?>.jpg" alt="<?php echo $p["alt"] ?>">
                    <p><?php echo $p["name"] ?></p>
                    <p>$<?php echo $p["price"] ?></p>
                    <button class="btn-primary" type="submit">Go to Product!</button>
                </form>
                <?php
                }
                ?>
            </div>
        </article>
        <article>
            <div class="sustainable-article">
                <div><img src="images/packaging.jpg" alt="A picture of busy bee cruchy honey's packaging"></div>
                <div>
                    <h1>Sustainable Packaging</h1>
                    <p>Busy Bee Snacks is not just dedicated to providing healthy food, we also ensure all our products
                        are packaged and shipped using 100% recyclable packaging</p>
                </div>
            </div>
        </article>
        <article class="index-review">
            <div class="query-index">
                <h1>REVIEWS</h1>
                <?php
                foreach ($reviewList as $r) {
                    //loops reviews
                ?>
                <form class="query-index-individual reviews" action="product-redirect.php" method="get">
                    <input type="hidden" name="product_id" value="<?php echo $r["product_id"] ?>" />
                    <img class="product-img" src="<?php echo $r["img_path"] ?>.jpg" alt="<?php echo $r["alt"] ?>">
                    <p id="review-name"><?php echo $r["name"] ?></p>
                    <p><?php echo $r["msg"] ?></p>
                    <p>-<?php echo $r["first"] ?> <?php echo $r["last"] ?></p>
                    <button class="btn-primary review" type="submit">Go to Product!</button>
                </form>
                <?php
                }
                ?>
            </div>
        </article>
    </section>
</div>
<?php include("footer.php") ?>

</html>