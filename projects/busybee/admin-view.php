<?php
error_reporting(-1);
ini_set('display_errors', 'On');
session_start();
if ($_SESSION["admin-login"] != 'true') {
?>
    <script>
        window.location.replace("admin-login.php");
    </script>
<?php
}
//connects to db
require_once("connect-db.php");
$table = $_COOKIE["table"];
if (isset($_COOKIE["inner"])) {
    $inner = $_COOKIE["inner"];
    $target = $_COOKIE["inner-target"];
    $replacer = $_COOKIE["inner-replacer"];
    $replaceCounter = 0;
    $sql = "select * from $table
    " . $inner;
} else {
    $target = "";
    $replacer = "";
    $replaceCounter = -1;
    $sql = "select * from $table";
}
$statement1 = $db->prepare($sql);
if ($statement1->execute()) {
    $list = $statement1->fetchAll();
    $statement1->closeCursor();
} else {
    echo "Error finding item";
}

$titleTable = $db->query("SHOW COLUMNS from $table");
$colCounter = 0;

$title = "Admin View of Tables";
$description = "";
include("header.php");
?>

<section>
    <?php include("admin-header.php") ?>
    <article class="admin-view">
        <h1><?php echo $table ?> table</h1>
        <table class="admin-table">
            <tr>
                <?php foreach ($titleTable as $t) {
                    $colCounter++;
                    if ($t[0] == $target) {
                        $replaceCounter = $colCounter - 1; ?>
                        <th><?php echo $replacer ?></th>
                    <?php } else { ?>
                        <th><?php echo $t[0] ?></th>
                <?php }
                } ?>
                
            </tr>

            
              <?php  foreach ($list as $l) { ?>
                    <tr>
                        <?php
                        $ID = $l[0];
                        for ($x = 0; $x < $colCounter; $x++) {
                            if ($x == $replaceCounter) { ?>
                                <td><?php echo $l[$replacer] ?></td>
                            <?php } else { ?>
                                <td><?php echo $l[$x] ?></td>
                        <?php }
                        } ?>
                        
                    </tr> 
                <?php }?>
            


        </table>
    </article>
</section>
<br>
<?php include("footer.php") ?>