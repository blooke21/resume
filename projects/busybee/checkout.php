<?php
session_start();
$title = "Checkout | Review or enter information and confirm your order";
$description = "Review or enter information and confirm your order.";
require("connect-db.php");
include("header.php");
if (!isset($_SESSION["user-login"]) || $_SESSION["user-login"] != 'true') {
    $stay = "3";
?>

<section>
    <article>
        <?php include("login-page.php"); ?>
        <div class="login-container guest">
            <h1>Checkout as Guest</h1>
            <form name="guest" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="hidden" name="hiddenVar" value="2">
                <input type="hidden" name="password" value="">
                <input type="hidden" name="email" value="">
                <button class="btn-primary guest">Continue as guest</button>
            </form>
        </div>
    </article>
</section>
<br>
<?php
} else {
?>
<script>
window.location.replace("information.php")
</script>
<?php
}

include("footer.php");