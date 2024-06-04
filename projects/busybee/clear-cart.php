<?php
session_start();
unset($_SESSION['cart']);
?>
<script>
setTimeout(() => {
    location.href = "index.php"
}, 0000);
</script>