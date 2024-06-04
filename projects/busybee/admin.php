<?php
session_start();
if ($_SESSION["admin-login"] != 'true') {
?>
    <script>
        window.location.replace("admin-login.php");
    </script>
<?php
}

include("header.php");
?>
<section>
    <?php include("admin-header.php") ?>
</section>
<br>
<?php include("footer.php") ?>