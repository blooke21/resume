<?php
//connects to db
require_once("connect-db.php");
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hiddenVar = $_POST["hiddenVar"];
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);


    $sql = "select * from  customer";

    $statement1 = $db->prepare($sql);
    if ($statement1->execute()) {
        $account = $statement1->fetchAll();
        $statement1->closeCursor();
    } else {
        echo "<h4>Error finding account information</h4>";
    }

    if ($hiddenVar == 0) {
        foreach ($account as $a) {
            if ($email == $a["email"] && $password == $a["password"]) {
                $_SESSION['user-login'] = 'true';
                $_SESSION['user-id'] = $a['customer_id'];
                //1 = redirect to account, 2 = redirect to ind-product
                switch ($stay) {
                    case "1":


?>
<script>
setTimeout(function() {
    location.href = "account.php"
});
</script>
<?php
                        break;
                    case "2":
                    ?>
<script>
setTimeout(function() {
    location.href = "ind-product.php"
});
</script>
<?php
                        break;
                    case "3":
                    ?>
<script>
setTimeout(function() {
    location.href = "checkout.php"
});
</script>
<?php
                        break;
                }
            }
        }
        ?>
<section>
    <article>
        <h1 class="login-incorrect">Incorrect Information</h1>
    </article>
</section>
<?php
    } elseif ($hiddenVar == 1) {
        $sqlInsert = "insert into customer (email, password) VALUES (:email, :password)";

        $statement2 = $db->prepare($sqlInsert);

        $statement2->bindValue(":email", $email);
        $statement2->bindValue(":password", $password);
        if ($statement2->execute()) {
            $statement2->closeCursor();
            $_SESSION['user-login'] = 'true';

            $sqlGrabID = "select * from customer order by customer_id desc";

            $statement3 = $db->prepare($sqlGrabID);
            if ($statement3->execute()) {
                $customer = $statement3->fetchAll();
                $statement3->closeCursor();
                $newCustomer = $customer[0];
                $_SESSION['user-id'] = $newCustomer["customer_id"];
                switch ($stay) {
                    case "1":


        ?>
<script>
setTimeout(function() {
    location.href = "account.php"
});
</script>
<?php
                        break;
                    case "2":
                    ?>
<script>
setTimeout(function() {
    location.href = "ind-product.php"
});
</script>
<?php
                        break;
                    case "3":
                    ?>
<script>
setTimeout(function() {
    location.href = "checkout.php"
});
</script>
<?php
                        break;
                }
            } else {
                echo "<h4>Error finding account information</h4>";
            }
        } else {
            echo "<h1>Error adding customers information.</h1>";
        }
    } else {
        setcookie("guest", " ");
        ?>
<script>
setTimeout(function() {
    location.href = "information.php"
});
</script>
<?php
    }
}

?>
<div class="login-page">
    <div class="login-container">
        <h1>Login</h1>
        <form name="login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="hiddenVar" value="0">
            <input type="hidden" name="stay" value="1">
            <label for="email">Email Address</label>
            <br>
            <input type="text" name="email" required>
            <br>
            <label for="password">Password</label>
            <br>
            <input type="text" name="password" required>
            <br>
            <a href="#">Forgot Your Password?</a>
            <br>
            <button class="btn-primary" id="btn-login">Sign In</button>
        </form>
    </div>
    <div class="login-container">
        <h1>Sign-Up</h1>
        <form name="sign-up" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="hidden" name="hiddenVar" value="1">
            <input type="hidden" name="stay" value="1">
            <label for="email">Email Address</label>
            <br>
            <input type="text" name="email" required>
            <br>
            <label for="password">Password</label>
            <br>
            <input type="text" name="password" required>
            <br>
            <button class="btn-primary">Sign Up</button>
        </form>
    </div>
</div>

<br>