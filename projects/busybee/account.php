<?php
session_start();
?> <script>
function toaster() {
    // Get the snackbar DIV
    var x = document.getElementById("snackbar");

    // Add the "show" class to DIV
    x.className = "show";

    // After 3 seconds, remove the show class from DIV
    setTimeout(function() {
        x.className = x.className.replace("show", "");
    }, 3000);
}
</script>
<?php if (isset($_COOKIE["toaster"])) { ?>

<script type="text/javascript">
setTimeout(function() {
    toaster();
}, 0);
</script>

<?php setcookie("toaster", "value", time() - 3600);
}
require_once("connect-db.php");
if (!isset($_SESSION["user-login"]) || $_SESSION["user-login"] != 'true') { ?>
<script>
window.location.replace("login.php");
</script>
<?php } else {
    $customer_id = $_SESSION["user-id"];
    if ($customer_id == 420) { ?>
<script>
window.location.replace("logout.php");
</script>
<?php
    }
    $previousNum = 0;
    $sql = "select * from customer where customer_id = $customer_id";

    $statement1 = $db->prepare($sql);

    if ($statement1->execute()) {
        $account = $statement1->fetchAll();
        $statement1->closeCursor();
    } else {
        echo "Error finding customers.";
    }

    $SQLpurchase = "select * from purchase_details 
    inner join purchase on purchase_details.purchase_id = purchase.purchase_id
    inner join product on purchase_details.product_id = product.product_id
    where customer_id = $customer_id";

    $statement1 = $db->prepare($SQLpurchase);

    if ($statement1->execute()) {
        $purchase = $statement1->fetchAll();
        $statement1->closeCursor();
    } else {
        echo "Error finding customers.";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $first = $_POST['first'];
    $last = $_POST['last'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $phone = $_POST['phone'];

    $sql = "update customer set 
    email = :email,
    password = :password,
    first = :first,
    last = :last,
    address = :address,
    country = :country,
    state = :state,
    zip = :zip,
    phone = :phone
    where customer_id = :customer_id";

    $statement1 = $db->prepare($sql);

    $statement1->bindValue(':customer_id', $customer_id);
    $statement1->bindValue(':email', $email);
    $statement1->bindValue(':password', $password);
    $statement1->bindValue(':first', $first);
    $statement1->bindValue(':last', $last);
    $statement1->bindValue(':address', $address);
    $statement1->bindValue(':country', $country);
    $statement1->bindValue(':state', $state);
    $statement1->bindValue(':zip', $zip);
    $statement1->bindValue(':phone', $phone);



    if ($statement1->execute()) {
        $statement1->closeCursor();
        $success = "Account Uploaded Successfully";
        setcookie("toaster", 1);
    ?>
<script>
window.location.replace("account.php");
</script>
<?php
    } else {
        $error = "Error Uploading";
    }
}
$title = "Account | Busy Bee Snacks- Edit your account or view previous orders. ";
$description = "Edit your account or view previous orders.";
include("header.php");
?>
<section>
    <article>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="account">
                <h1>Update Account Information</h1>
                <?php foreach ($account as $a) : ?>
                <label for="email">Email: </label>
                <br><input type="text" name="email" required value="<?php echo $a["email"]; ?>">
                <br>
                <label for="password">Password: </label>
                <br><input type="text" name="password" required value="<?php echo $a["password"]; ?>">
                <br>
                <label for="first">First Name: </label>
                <br><input type="text" name="first" value="<?php echo $a["first"]; ?>">
                <br>
                <label for="last">Last Name: </label>
                <br><input type="text" name="last" value="<?php echo $a["last"]; ?>">
                <br>
                <label for="address">Address: </label>
                <br><input type="text" name="address" value="<?php echo $a["address"]; ?>">
                <br>
                <label for="country">Country: </label>
                <br><input type="text" name="country" value="<?php echo $a["country"]; ?>">
                <br>
                <label for="state">State: </label>
                <br><input type="text" name="state" value="<?php echo $a["state"]; ?>">
                <br>
                <label for="zip">Zip: </label>
                <br><input type="text" name="zip" value="<?php echo $a["zip"]; ?>">
                <br>
                <label for="phone">Phone: </label>
                <br><input type="tel" name="phone" value="<?php echo $a["phone"]; ?>">
                <br>
                <input type="hidden" name="customer_id" value="<?php echo $a["customer_id"]; ?>">
                <?php endforeach; ?>
                <button class="btn-primary" value="submit">Update</button><br>
                <button class="btn-primary"><a href="logout.php"
                        onclick="return confirm('Are you sure you want to logout?')">Logout</a></button>
            </div>
        </form>
        <?php
        if (!empty($purchase)) { ?>
        <h1 id="previous-title">Previous Orders</h1>
        <table class="previous-purchases">
            <tr>
                <th>Purchase ID:</th>
                <th>Product Name:</th>
                <th>Quantity:</th>
            </tr>
            <?php foreach ($purchase as $p) :
                    if ($previousNum != $p["purchase_id"]) { ?>
            <tr class="tableLine">
                <?php } else { ?>
            <tr>
                <?php } ?>
                <td><?php echo $p["purchase_id"]; ?></td>
                <td><?php echo $p["name"]; ?></td>
                <td><?php echo $p["quantity"]; ?></td>
            </tr>
            <?php
                    $previousNum = $p["purchase_id"];
                endforeach; ?>
        </table>
        <?php } ?>
    </article>
</section>
<div id="snackbar">Account Successfully Updated</div>
<br>
<br>
<?php include("footer.php") ?>