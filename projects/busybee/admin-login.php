<?php
session_start();

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
    $email = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);

    $sql = "select * from  admin";

    $statement1 = $db->prepare($sql);
    if ($statement1->execute()) {
        $admin = $statement1->fetchAll();
        $statement1->closeCursor();
    } else {
        echo "<h4>Error finding account information</h4>";
    }

    foreach ($admin as $a) {
        if ($email == $a["username"] && $password == $a["password"]) {
            $_SESSION['admin-login'] = 'true';
            $_SESSION['admin-id'] = $a['admin_id'];
?>
            <script>
                setTimeout(function() {
                    location.href = "admin.php"
                });
            </script>
    <?php
            break;
        }
    }
    ?>
    <section>
        <article>
            <h1 class="login-incorrect">Incorrect Information</h1>
        </article>
    </section>
<?php
}
include("header.php");
?>
<section>
    <article>
        <div class="login-page admin">
            <div class="login-container">
                <h1>Login</h1>
                <form name="login" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <label for="username">Username</label>
                    <br>
                    <input type="text" name="username" required>
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
    </article>
</section>
<br>
<?php include("footer.php") ?>