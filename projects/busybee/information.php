<?php
error_reporting(-1);
ini_set('display_errors', 'On');
session_start();
require("connect-db.php");
$title = "Billing Info | Busy Bee Snacks- Login to your account for billing details.";
$description = "Enter your billing details and other billing information. Or checkout as a guest";
include("header.php");

$taxes = .05;

$sqlGrabID = "select * from purchase order by purchase_id desc";

$statement3 = $db->prepare($sqlGrabID);
if ($statement3->execute()) {
    $latestPurchase = $statement3->fetchAll();
    $statement3->closeCursor();
    list($bar) = array_slice($latestPurchase, 0, 1);
    $newPurchaseID = ($bar["purchase_id"] + 1);
}
if (!isset($_SESSION["user-login"]) || $_SESSION["user-login"] != 'true') {
    if (!isset($_COOKIE["guest"])) {
?>
<script>
window.location.replace("login.php");
</script>
<?php
    } else {
        $guest_id = rand();
        $customer_id = null;
        $sql = "select * from customer where customer_id = 5";

        $statement1 = $db->prepare($sql);

        if ($statement1->execute()) {
            $account = $statement1->fetchAll();
            $statement1->closeCursor();
        } else {
            echo "Error finding customers.";
        }
    }
} else {
    $customer_id = $_SESSION["user-id"];
    $guest_id = null;
    $sql = "select * from customer where customer_id = $customer_id";

    $statement1 = $db->prepare($sql);

    if ($statement1->execute()) {
        $account = $statement1->fetchAll();
        $statement1->closeCursor();
    } else {
        echo "Error finding customers.";
    }

    $sqlPayment = "select * from payment_method where customer_id = $customer_id";

    $statement1 = $db->prepare($sqlPayment);

    if ($statement1->execute()) {
        $payment = $statement1->fetchAll();
        $statement1->closeCursor();
    } else {
        echo "Error finding customers.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $cardNumber = $_POST['cardNumber'];
    $cardName = $_POST['cardName'];
    $exp_month = $_POST['month'];
    $exp_year = $_POST['year'];
    $cvv = $_POST['cvv'];
    $payment_id = $_POST["payment_id"];

    $sql = "insert into purchase (customer_id, guest_id, total, email, name, address, country, state, zip) values (:customer_id, :guest_id, :total, :email, :name, :address, :country, :state, :zip)";

    $statement1 = $db->prepare($sql);

    $statement1->bindValue(":customer_id", $customer_id);
    $statement1->bindValue(":guest_id", $guest_id);
    $statement1->bindValue(":total", (($_SESSION["total"] * $taxes) + $_SESSION["total"]));
    $statement1->bindValue(":email", $email);
    $statement1->bindValue(":name", $name);
    $statement1->bindValue(":address", $address);
    $statement1->bindValue(":country", $country);
    $statement1->bindValue(":state", $state);
    $statement1->bindValue(":zip", $zip);
    if ($statement1->execute()) {
        $statement1->closeCursor();


        //grab new purchase entry
        $sqlGrabID = "select * from purchase order by purchase_id desc";

        $statement2 = $db->prepare($sqlGrabID);
        if ($statement2->execute()) {
            $purchases = $statement2->fetchAll();
            $statement2->closeCursor();
            $newPurchase = $purchases[0];

            //add every item in cart to purchase detail table and link main purchase
            foreach ($_SESSION['cart'] as $cart) {

                $sql = "insert into purchase_details (purchase_id, product_id, quantity) values (:purchase_id, :product_id, :quantity)";

                $statement1 = $db->prepare($sql);

                $statement1->bindValue(":purchase_id", $newPurchase["purchase_id"]);
                $statement1->bindValue(":product_id", $cart['prodId']);
                $statement1->bindValue(":quantity", $cart['qty']);
                if ($statement1->execute()) {
                    $statement1->closeCursor();
                }
            }
        }
        if (isset($payment)) {
            if (empty($payment)) {
                $sql = "insert into payment_method (customer_id, num, name, exp_month, exp_year, CVV) values (:customer_id, :num, :name, :exp_month, :exp_year, :CVV)";

                $statement1 = $db->prepare($sql);

                $statement1->bindValue(":customer_id", $customer_id);
                $statement1->bindValue(":name", $cardName);
                $statement1->bindValue(":num", $cardNumber);
                $statement1->bindValue(":exp_month", $exp_month);
                $statement1->bindValue(":exp_year", $exp_year);
                $statement1->bindValue(":CVV", $cvv);
                if ($statement1->execute()) {
                    $statement1->closeCursor();
                }
            } else {
                $sql = "update payment_method set 
        customer_id = :customer_id,
        name = :name,
        num = :num,
        exp_month = :exp_month,
        exp_year = :exp_year,
        CVV = :CVV
        where payment_id = :payment_id";
                $statement1 = $db->prepare($sql);
                $statement1->bindValue(":payment_id", $payment_id);
                $statement1->bindValue(":customer_id", $customer_id);
                $statement1->bindValue(":name", $cardName);
                $statement1->bindValue(":num", $cardNumber);
                $statement1->bindValue(":exp_month", $exp_month);
                $statement1->bindValue(":exp_year", $exp_year);
                $statement1->bindValue(":CVV", $cvv);
                if ($statement1->execute()) {
                    $statement1->closeCursor();
                }
            }
        }
        $_SESSION["completedCart"] = $_SESSION["cart"];
        unset($_SESSION['cart']);
    ?>

<script>
setTimeout(function() {
    location.href = "confirmation.php"
});
</script>
<?php
    }
}
?>
<section class="information">
    <article class="information-article">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="side-total">
                <h1>Order Summary</h1>
                <h4>Purchase ID:</h4>
                <p><?php echo $newPurchaseID ?></p>
                <div class="space"></div>
                <div class="side-total-mini">
                    <span>
                        <h4>Subtotal</h4>
                        <p><?php echo $_SESSION["total"] ?></p>
                    </span>
                    <div class="space"></div>
                    <span>
                        <h4>Taxes</h4>
                        <p><?php echo round($_SESSION["total"] * $taxes, 2) ?></p>
                    </span>
                    <div class="space"></div>
                    <span>
                        <h4>Total</h4>
                        <p><?php echo round(($_SESSION["total"] * $taxes) + $_SESSION["total"], 2) ?></p>
                    </span>

                </div>
                <button class="btn-primary">Place Order</button>
            </div>
            <div class="delivery">
                <h1>Delivery/Shipping</h1>
                <?php foreach ($account as $a) { ?>
                <div id="country">
                    <label for="country">Country: </label>
                    <br><input type="text" name="country" required value="<?php echo $a["country"]; ?>">
                </div>
                <div id="state">
                    <label for="states">State: </label>
                    <br><input type="text" name="state" required value="<?php echo $a["state"]; ?>">
                </div>
                <div id="zip">
                    <label for="zip">Zip: </label>
                    <br><input type="text" name="zip" required value="<?php echo $a["zip"]; ?>">
                </div>
                <div id="address">
                    <label for="address">Address: </label>
                    <br><input type="text" name="address" required value="<?php echo $a["address"]; ?>">
                </div>
                <div class="name">
                    <label for="name">Full Name: </label>
                    <br><input type="text" name="name" required
                        value="<?php echo $a["first"]; ?> <?php echo $a["last"]; ?>">
                </div>
                <div id="phone">
                    <label for="phone">Phone Number: </label>
                    <br><input type="text" name="phone" required value="<?php echo $a["phone"]; ?>">
                </div>
                <div id="email">
                    <label for="email">Email: </label>
                    <br><input type="text" name="email" required value="<?php echo $a["email"]; ?>">
                </div>
            </div>
            <div class="space"></div>
            <div class="delivery">
                <h1>Payment Method</h1>
                <?php }
                if (!empty($payment)) { ?>
                <?php foreach ($payment as $p) { ?>
                <input type="hidden" name="payment_id" value="<?php echo $p["payment_id"] ?>">
                <div id="num">
                    <label for="num">Card Number: </label>
                    <br><input type="text" name="cardNumber" required value="<?php echo $p["num"]; ?>">
                </div>
                <div class="name">
                    <label for="cardName">Name on Card: </label>
                    <br><input type="text" name="cardName" required value="<?php echo $p["name"]; ?>">
                </div>
                <div id="month">
                    <label for="month">Exp Month: </label>
                    <br><input type="text" name="month" required value="<?php echo $p["exp_month"]; ?>">
                </div>
                <div id="year">
                    <label for="year">Exp Year: </label>
                    <br><input type="text" name="year" required value="<?php echo $p["exp_year"]; ?>">
                </div>
                <div id="cvv">
                    <label for="cvv">CVV: </label>
                    <br><input type="text" name="cvv" required value="<?php echo $p["CVV"]; ?>">
                </div>
                <?php }
                } else { ?>
                <input type="hidden" name="payment_id">
                <div id="num">
                    <label for="num">Card Number: </label>
                    <br><input type="text" name="cardNumber" required>
                </div>
                <div class="name">
                    <label for="cardName">Name on Card: </label>
                    <br><input type="text" name="cardName" required>
                </div>
                <div id="month">
                    <label for="month">Exp Month: </label>
                    <br><input type="text" name="month" required>
                </div>
                <div id="year">
                    <label for="year">Exp Year: </label>
                    <br><input type="text" name="year" required>
                </div>
                <div id="cvv">
                    <label for="cvv">CVV: </label>
                    <br><input type="text" name="cvv" required>
                </div>
                <?php } ?>
            </div>
            <div class="space"></div>
            <div class="information-product">
                <h1>Your Cart</h1>
                <?php foreach ($_SESSION['cart'] as $cart) {

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
                    foreach ($product as $p) { ?>
                <div class="information-ind">
                    <img class="cart-img" src="<?php echo $p["img_path"] ?>.jpg" alt="<?php echo $p["alt"] ?>">
                    <h2><?php echo $p["name"] ?></h2>
                    <p><?php echo $p["description"] ?></p>
                    <p>Quantity: <?php echo $cart['qty'] ?></p>
                    <p><?php echo $p["price"] * $cart['qty'] ?> USD</p>
                </div>
                <?php }
                } ?>
            </div>
            <button class="btn-primary">Place Order</button>
        </form>
    </article>
</section>
<br><br>
<?php include("footer.php"); ?>