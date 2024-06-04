<?php
error_reporting(-1);
ini_set('display_errors', 'On');
session_start();
require_once("connect-db.php");
if (!isset($_SESSION["user-login"])) {
    $customer_id = 0;
} else {
    if ($_SESSION["user-login"] == 'true') {
        $customer_id = $_SESSION["user-id"];
    }
}
//initializes number of items to be shown per page
if (!isset($_COOKIE["review-rating"])) {
    setcookie("review-rating", "default");
    refresh();
}
if (isset($_GET["prodId"])) {
    $prodId = $_GET['prodId'];
    $qty = $_GET['qty'];

    if (!empty($_SESSION['cart'])) {
        //check if cart empty

        //get all product ids in an array
        $acol = array_column($_SESSION["cart"], 'prodId');

        //checks if added product already exists
        if (in_array($prodId, $acol)) {

            //if it does update quantity
            $_SESSION["cart"][$prodId]['qty'] += 1;
        } else {
            //else add the product to cart
            $item = [
                'prodId' => $_GET['prodId'],
                'qty' => $qty
            ];

            $_SESSION['cart'][$prodId] = $item;
        }
    } else {
        //if empty just add item
        $item = [
            'prodId' => $_GET['prodId'],
            'qty' => $qty
        ];

        $_SESSION['cart'][$prodId] = $item;
    }
}
//defines function that refreshes the page
function refresh()
{
?>
<script>
window.location.replace("ind-product.php")
</script>
<?php
}


if (isset($_POST['form'])) {
    switch ($_POST['form']) {
        case "viewUp":
            $view = $_COOKIE["view"];
            setcookie("view", ($view + 1));
            refresh();
            break;
        case "viewDown":
            $view = $_COOKIE["view"];
            setcookie("view", ($view - 1));
            refresh();
            break;
        case "view-one":
            setcookie("view", 1);
            refresh();
            break;
        case "view-two":
            setcookie("view", 2);
            refresh();
            break;
        case "view-three":
            setcookie("view", 3);
            refresh();
            break;
        case "view-four":
            setcookie("view", 4);
            refresh();
            break;
        case "view-five":
            setcookie("view", 5);
            refresh();
            break;
        case "qty-down":
            $qty = $_COOKIE['quantity'];
            if ($qty == 1) {
                refresh();
            } else {
                setcookie("quantity", ($qty - 1));
                refresh();
            }
            break;
        case "qty-up":
            $qty = $_COOKIE["quantity"];
            setcookie("quantity", ($qty + 1));
            refresh();
            break;
        case "details":
            setcookie("info", "details");
            refresh();
            break;
        case "nutrition":
            setcookie("info", "nutrition");
            refresh();
            break;
        case "ingredients":
            setcookie("info", "ingredients");
            refresh();
            break;
        case "green":
            $del = $_POST["fav_id"];
            $sqlG = "delete from fav_list where fav_id = $del";
            $statementG = $db->prepare($sqlG);
            if ($statementG->execute()) {
                $statementG->closeCursor();
            } else {
                $error = "Error finding Fav Item";
            }
            refresh();
            break;
        case "black":
            if (!isset($_SESSION["user-login"]) || $_SESSION["user-login"] != 'true') {
                break;
            }
            $product_id = $_POST["product_id"];
            $customer_id = $_POST["customer_id"];
            $sqlB = "insert into fav_list (customer_id, product_id) values (:customer_id, :product_id)";
            $statementB = $db->prepare($sqlB);
            $statementB->bindValue(":customer_id", $customer_id);
            $statementB->bindValue(":product_id", $product_id);
            if ($statementB->execute()) {
                $statementB->closeCursor();
                refresh();
                break;
            }
        case "review":
            $product_id = $_POST["product_id"];
            $customer_id = $_POST["customer_id"];
            $msg = $_POST["msg"];
            $review = (int)$_POST["review"];
            $sqlCR = "insert into review (customer_id, product_id, msg, stars) values (:customer_id, :product_id, :msg, :stars)";
            $statementCR = $db->prepare($sqlCR);
            $statementCR->bindValue(":customer_id", $customer_id);
            $statementCR->bindValue(":product_id", $product_id);
            $statementCR->bindValue(":msg", $msg);
            $statementCR->bindValue(":stars", $review);
            if ($statementCR->execute()) {
                $statementCR->closeCursor();
                refresh();
                break;
            }
        case "default-star":
            setcookie("review-rating", "default");
            refresh();
            break;
        default:
            $product_id = $_POST["product_id"];
            setcookie("product", $product_id);
            setcookie("view", 1);
            setcookie("quantity", 1);
            setcookie("info", "details");
            refresh();
            break;
    }
}

$productID = $_COOKIE["product"];
//queries all products information
$sql = "select * from product
        inner join category on product.category_id = category.category_id
        where product_id = :product_id";
$statement1 = $db->prepare($sql);
$statement1->bindValue(":product_id", $productID);
if ($statement1->execute()) {
    $product = $statement1->fetchAll();
    $statement1->closeCursor();
} else {
    echo "Error finding product information";
}
$title = $product[0]["page-title"];
$description = $product[0]["page-description"];
include("header.php");
?>
<section class="product-whole">
    <article class="product-main">

        <?php
        $sqlS = "select * from special inner join product on special.product_id = product.product_id";

        $statementS = $db->prepare($sqlS);
        if ($statementS->execute()) {
            $special = $statementS->fetchAll();
            $statementS->closeCursor();
        } else {
            echo "Error finding products";
        }

        $sqlF = "select * from fav_list where customer_id = :customer_id and product_id = :product_id";
        $statement3 = $db->prepare($sqlF);
        $statement3->bindValue(":customer_id", $customer_id);
        $statement3->bindValue(":product_id", $productID);
        if ($statement3->execute()) {
            $fav = $statement3->fetchAll();
            $statement3->closeCursor();
        } else {
            echo "Error finding review information";
        }
        //loops through the products information
        $category = $product[0]["category_id"];
        $sqlC = "select * from product where category_id = :category_id";
        $statement3 = $db->prepare($sqlC);
        $statement3->bindValue(":category_id", $category);
        if ($statement3->execute()) {
            $related = $statement3->fetchAll();
            $statement3->closeCursor();
        } else {
            echo "Error finding category information";
        }

        $sqlR = "select * from review 
inner join customer on review.customer_id = customer.customer_id
where product_id = :product_id";

        $statement2 = $db->prepare($sqlR);
        $statement2->bindValue(":product_id", $productID);
        if ($statement2->execute()) {
            $reviews = $statement2->fetchAll();
            $statement2->closeCursor();
        } else {
            echo "Error finding review information";
        }
        if ($category == 1) { ?>
        <div class="view-controller">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="hidden" name="form" value="viewDown" />
                <?php
                    //if the view is one, the user is stopped from going to view zero
                    if ($_COOKIE["view"] == 1) { ?>
                <button type="submit" name="viewDown" disabled class="view-down"><img
                        src="images/icons/yellow-leftarrow-icon.png" alt=""></button>
                <?php } else { ?>
                <button type="submit" name="viewDown" class="view-down"><img src="images/icons/green-leftarrow-icon.png"
                        alt=""></button>
                <?php } ?>
            </form>
            <!-- view controller -->
            <div class="<?php if ($_COOKIE["view"] == "1") { ?>
            active
            <?php } else { ?>
            non-active
            <?php } ?>
            " onClick="document.forms['view-one'].submit();">
                <form name="view-one" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="hidden" name="form" value="view-one" />
                    <img src="<?php echo $product[0]["img_path"] ?>.jpg" alt="<?php echo $product[0]["alt"] ?>">
                </form>
            </div>
            <!-- ------------------------------------------------- -->
            <div class="<?php if ($_COOKIE["view"] == "2") { ?>
                    active
                <?php } else { ?>
                        non-active
                <?php } ?>
                " onClick="document.forms['view-two'].submit();">
                <form name="view-two" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="hidden" name="form" value="view-two" />
                    <img src="<?php echo $product[0]["img_path"] ?>-front.jpg" alt="<?php echo $product[0]["alt"] ?>">
                </form>
            </div>
            <!-- ------------------------------------------------- -->
            <div class="<?php if ($_COOKIE["view"] == "3") { ?>
                    active
                <?php } else { ?>
                        non-active
                <?php } ?>
                " onClick="document.forms['view-three'].submit();">
                <form name="view-three" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="hidden" name="form" value="view-three" />
                    <img src="<?php echo $product[0]["img_path"] ?>-multi.jpg" alt="<?php echo $product[0]["alt"] ?>">
                </form>
            </div>
            <!-- ------------------------------------------------- -->
            <div class="<?php if ($_COOKIE["view"] == "4") { ?>
                    active
                <?php } else { ?>
                        non-active
                <?php } ?>
                " onClick="document.forms['view-four'].submit();">
                <form name="view-four" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="hidden" name="form" value="view-four" />
                    <?php if ($product[0]["size"] == 12 || $product[0]["size"] == 6 || $product[0]["size"] == 8 ||  $product[0]["size"] == 20) { ?>
                    <img src="<?php echo $product[0]["img_path"] ?>-box.jpg" alt="<?php echo $product[0]["alt"] ?>">
                    <?php } else { ?>
                    <img src="<?php echo $product[0]["img_path"] ?>-box2.jpg" alt="<?php echo $product[0]["alt"] ?>">
                    <?php } ?>
                </form>
            </div>
            <!-- ------------------------------------------------- -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="hidden" name="form" value="viewUp" />
                <?php
                    //if the view is one, the user is stopped from going to view zero
                    if ($_COOKIE["view"] == 4) { ?>
                <button type="submit" name="viewUp" disabled class="view-up"><img
                        src="images/icons/yellow-rightarrow-icon.png" alt=""></button>
                <?php } else { ?>
                <button type="submit" name="viewUp" class="view-up"><img src="images/icons/green-rightarrow-icon.png"
                        alt=""></button>
                <?php } ?>
            </form>
        </div>
        <?php } elseif ($product[0]["product_id"] == 40 || $product[0]["product_id"] == 6 || $product[0]["product_id"] == 10 || $product[0]["product_id"] == 28) { ?>

        <?php } else { ?>
        <div class="view-controller">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="hidden" name="form" value="viewDown" />
                <?php
                    //if the view is one, the user is stopped from going to view zero
                    if ($_COOKIE["view"] == 1) { ?>
                <button type="submit" name="viewDown" disabled class="view-down"><img
                        src="images/icons/yellow-leftarrow-icon.png" alt=""></button>
                <?php } else { ?>
                <button type="submit" name="viewDown" class="view-down"><img src="images/icons/green-leftarrow-icon.png"
                        alt=""></button>
                <?php } ?>
            </form>
            <!-- view controller -->
            <div class="<?php if ($_COOKIE["view"] == "1") { ?>
            active
            <?php } else { ?>
            non-active
            <?php } ?>
            " onClick="document.forms['view-one'].submit();">
                <form name="view-one" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="hidden" name="form" value="view-one" />
                    <img src="<?php echo $product[0]["img_path"] ?>.jpg" alt="<?php echo $product[0]["alt"] ?>">
                </form>
            </div>
            <!-- ------------------------------------------------- -->
            <div class="<?php if ($_COOKIE["view"] == "5") { ?>
                    active
                <?php } else { ?>
                        non-active
                <?php } ?>
                " onClick="document.forms['view-five'].submit();">
                <form name="view-five" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="hidden" name="form" value="view-five" />
                    <img src="<?php echo $product[0]["img_path"] ?><?php echo $product[0]["size"] ?>.jpg"
                        alt="<?php echo $product[0]["alt"] ?>">
                </form>
            </div>
            <!-- ------------------------------------------------- -->
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="hidden" name="form" value="viewUp" />
                <?php
                    //if the view is one, the user is stopped from going to view zero
                    if ($_COOKIE["view"] == 2) { ?>
                <button type="submit" name="viewUp" disabled class="view-up"><img
                        src="images/icons/yellow-rightarrow-icon.png" alt=""></button>
                <?php } else { ?>
                <button type="submit" name="viewUp" class="view-up"><img src="images/icons/green-rightarrow-icon.png"
                        alt=""></button>
                <?php } ?>
            </form>
        </div>
        <?php } ?>
        <div class="product-img">
            <?php if ($_COOKIE["view"] == "1") { ?>
            <img src="<?php echo $product[0]["img_path"] ?>.jpg" alt="<?php echo $product[0]["alt"] ?>">
            <?php } elseif ($_COOKIE["view"] == "2") { ?>
            <img src="<?php echo $product[0]["img_path"] ?>-front.jpg" alt="<?php echo $product[0]["alt"] ?>">
            <?php } elseif ($_COOKIE["view"] == "3") { ?>
            <img src="<?php echo $product[0]["img_path"] ?>-multi.jpg" alt="<?php echo $product[0]["alt"] ?>">
            <?php } elseif ($_COOKIE["view"] == "4") {
                if ($product[0]["size"] == 12 || $product[0]["size"] == 6 || $product[0]["size"] == 8 ||  $product[0]["size"] == 20) { ?>
            <img src="<?php echo $product[0]["img_path"] ?>-box.jpg" alt="<?php echo $product[0]["alt"] ?>">
            <?php } elseif ($_COOKIE["view"] == "4") { ?>
            <img src="<?php echo $product[0]["img_path"] ?>-box2.jpg" alt="<?php echo $product[0]["alt"] ?>">
            <?php }
            } elseif ($_COOKIE["view"] == "5") { ?>
            <img src="<?php echo $product[0]["img_path"] ?><?php echo $product[0]["size"] ?>.jpg"
                alt="<?php echo $product[0]["alt"] ?>">
            <?php } ?>
        </div>
        <div class="product-information">
            <p><?php echo $product[0]["name"] ?></p>
            <div class="line"></div>
            <p>$<?php echo $product[0]["price"] ?> USD</p>
            <?php if ($product[0]["ounces"] != null) {
            ?>
            <div class="line"></div>
            <p>Size <?php echo $product[0]["ounces"] ?></p>
            <?php
            } ?>
            <div class="line"></div>
            <p><?php echo $product[0]["size"] ?> Count</p>
            <div class="line"></div>
            <?php if (!empty($fav)) {
                foreach ($fav as $f) {
                    $fav_id = $f["fav_id"];
                } ?>
            <div onClick="document.forms['green'].submit();">
                <form name="green" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="hidden" name="form" value="green" />
                    <input type="hidden" name="fav_id" value="<?php echo $fav_id ?>">
                    <img src="images/icons/green-fave-icon.png" alt="">
                </form>
            </div>
            <?php } else { ?>
            <div onClick="document.forms['black'].submit();">
                <form name="black" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <img src="images/icons/black-heart.png" alt="">
                    <input type="hidden" name="form" value="black" />
                    <input type="hidden" name="product_id" value="<?php echo $productID ?>">
                    <input type="hidden" name="customer_id" value="<?php echo $customer_id ?>">
                </form>
            </div>
            <?php } ?>
            <div class=" line">
            </div>
            <p>Quantity </p>
            <div class="quantity-changer">
                <div class="qty-down" onClick="document.forms['qty-down'].submit();">
                    <form name="qty-down" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <img src="images/icons/minus-icon.png" alt="">
                        <input type="hidden" name="form" value="qty-down" />
                    </form>
                </div>
                <input class="quantity" type="text" name="qty" value="<?php echo $_COOKIE['quantity'] ?>">
                <div class="qty-up" onClick="document.forms['qty-up'].submit();">
                    <form name="qty-up" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <img src="images/icons/plus-icon.png" alt="">
                        <input type="hidden" name="form" value="qty-up" />
                    </form>
                </div>
            </div>
            <div>

            </div>
            <button class="btn-primary"><a
                    href="ind-product.php?prodId=<?php echo $product[0]["product_id"] ?>&qty=<?php echo $_COOKIE['quantity'] ?>">Add
                    to
                    Cart</a></button>
            <button class="btn-primary"><a href="cart.php">Proceed to Checkout</a></button>
        </div>

    </article>
    <article class="product-other">
        <div class="line"></div>

        <div class="product-extra">
            <div class="sort-selector other">
                <!-- ------------------------------------------------- -->
                <div class="<?php if ($_COOKIE["info"] == "details") { ?>
                    active
                <?php } else { ?>
                        non-active
                <?php } ?>
                " onClick="document.forms['details'].submit();">
                    <form name="details" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <h1>Product Details</h1>
                        <input type="hidden" name="form" value="details" />
                    </form>
                </div>
                <!-- ------------------------------------------------- -->
                <div class="<?php if ($_COOKIE["info"] == "nutrition") { ?>
                    active
                <?php } else { ?>
                    non-active
                <?php } ?>" onClick="document.forms['nutrition'].submit();">
                    <form name="nutrition" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <h1>Nutrition Facts</h1>
                        <input type="hidden" name="form" value="nutrition" />
                    </form>
                </div>
                <!-- ------------------------------------------------- -->
                <div class="<?php if ($_COOKIE["info"] == "ingredients") { ?>
                    active
                <?php } else { ?>
                    non-active
                <?php } ?>" onClick="document.forms['ingredients'].submit();">
                    <form name="ingredients" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <h1>Ingredients</h1>
                        <input type="hidden" name="form" value="ingredients" />
                    </form>
                </div>
            </div>
            <?php switch ($_COOKIE['info']) {
                case "details": ?>
            <div class="extra detail">
                <h1>Product Details</h1>
                <p><?php echo $product[0]["category_description"] ?><?php echo $product[0]["description"] ?></p>
            </div>
            <?php break;
                case "nutrition": ?>
            <div class="extra fact">
                <h1>Nutrition Facts</h1>
                <img src="images/nutr-facts.png" alt="">
            </div>
            <?php break;
                case "ingredients": ?>
            <div class="extra ingredients">
                <h1>Ingredients</h1>
                <p><?php echo $product[0]["ingredients"] ?></p>
            </div>
            <?php } ?>
        </div>
        <div class="line"></div>
        <div class="related">
            <h1>Related Products</h1>
            <?php
            shuffle($related);
            //if the category does not have four other items (not including itself) only show all
            if ((count($related) - 1) < 4) {
                $length = (count($related) - 1);
            } else {
                $length = 4;
            }
            for ($x = 0; $x < $length; $x++) {
                if ($related[$x]["product_id"] == $_COOKIE["product"]) {
                    array_splice($related, $x, 1);
                }
            ?>
            <div class="related-ind" onClick="document.forms['<?php echo $related[$x]["name"] ?>'].submit();">
                <form name="<?php echo $related[$x]["name"] ?>" action="<?php echo $_SERVER['PHP_SELF']; ?>"
                    method="post">
                    <input type="hidden" name="form" value="product_id" />
                    <input type="hidden" name="product_id" value="<?php echo $related[$x]["product_id"]; ?>">
                    <img class="product-img" src="<?php echo $related[$x]["img_path"] ?>.jpg"
                        alt="<?php echo $related[$x]["alt"] ?>">
                    <h1><?php echo $related[$x]["name"]; ?></h1>
                    <p><?php echo $related[$x]["size"]; ?> Count | $ <?php echo $related[$x]["price"]; ?></p>
                </form>
            </div>
            <?php } ?>
        </div>
        <div class="product-reviews">
            <h1 id="title">Reviews</h1>
            <?php if (!empty($reviews)) { ?>

            <?php foreach ($reviews as $r) { ?>
            <div class="ind-reviews">
                <h1><?php echo $r['first'] ?></h1>
                <?php for ($y = 0; $y < $r['stars']; $y++) { ?>
                <img src="images/icons/star-fill-icon.png" alt="">
                <?php  } ?>
                <?php for ($l = 0; $l <  (5 - $r['stars']); $l++) { ?>
                <img src="images/icons/start-outline-icon.png" alt="">
                <?php } ?>
                <p><?php echo $r["msg"] ?></p>
                <div class="line"></div>
            </div>
            <?php } ?>
            <?php } else { ?> <div class="review-extra">
                <h1>There aren't any reviews for this product yet?</h1>
                <?php if (!isset($_SESSION["user-login"]) || $_SESSION["user-login"] != 'true') { ?>
                <h2>Please Log in or create an account to leave a review</h2>
                <?php $stay = "2";
                        include("login-page.php") ?>
                <?php } else { ?>
                <h1>Want to be the first!</h1>

                <form class="review-post" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="product_id" value="<?php echo $productID ?>">
                    <input type="hidden" name="customer_id" value="<?php echo $customer_id ?>">
                    <div id="msg">
                        <p>Review:</p>
                        <br>
                        <textarea name="msg"></textarea>
                    </div>
                    <div id="rate">
                        <p>Rate the product!</p>
                        <input type="radio" id="one-star" name="review" value="1">
                        <label for="one-star">1 Star</label><br>
                        <input type="radio" id="two-star" name="review" value="2">
                        <label for="two-star">2 Star</label><br>
                        <input type="radio" id="three-star" name="review" value="3">
                        <label for="three-star">3 Star</label><br>
                        <input type="radio" id="four-star" name="review" value="4">
                        <label for="four-star">4 Star</label><br>
                        <input type="radio" id="five-star" name="review" value="5">
                        <label for="five-star">5 Star</label><br>
                    </div>
                    <input type="hidden" name="form" value="review" />
                    <button class="btn-primary" type="submit">Submit</button>
                </form>
                <?php  }
                } ?>
            </div>
        </div>
    </article>
</section>
<?php include("footer.php"); ?>