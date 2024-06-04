<?php
session_start();
$title = "Login | Busy Bee Snacks- Login to your account to start shopping. ";
$description = "Login to your account or create one to take advantage of everything Busy Bee Snacks has to offer.";
include("header.php");
$stay = "1";
?>

<section>
    <article>
        <?php include("login-page.php"); ?>
    </article>
</section>
<?php
include("footer.php");