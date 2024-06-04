<?php
session_start();
unset($_SESSION['user-login']);
?>
<script>
setTimeout(() => {
    location.href = "login.php"
}, 0000);
</script>