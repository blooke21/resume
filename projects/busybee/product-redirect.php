<?php
error_reporting(-1);
ini_set('display_errors', 'On');
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $product_id = $_GET["product_id"];
    setcookie("product", $product_id);
    setcookie("view", 1);
    setcookie("quantity", 1);
    setcookie("info", "details");
?>
<script>
window.location.replace("ind-product.php")
</script>
<?php
}