<?php
session_start();
//connects to db
require_once("connect-db.php");
if ($_SESSION["admin-login"] != 'true') {
?>
    <script>
        window.location.replace("admin-login.php");
    </script>
<?php
}

$ID = $_GET["ID"];
$table = $_COOKIE["table"];
$colID = $table . "_id";

$sql = "select * from $table where $colID = $ID";
$statement1 = $db->prepare($sql);
if ($statement1->execute()) {
    $list = $statement1->fetchAll();
    $statement1->closeCursor();
} else {
    echo "Error finding item";
}

include("header.php");
?>
<section>
    <?php include("admin-header.php") ?>
    <article class="admin-edit">

    </article>
</section>
<br>
<?php include("footer.php") ?>