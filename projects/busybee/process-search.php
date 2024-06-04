<?php
if($_SERVER["REQUEST_METHOD"] == 'POST'){
    $input = $_POST["search"];
    setcookie("search", $input);
        ?>
<script>
window.location.replace("search.php")
</script>
<?php
}