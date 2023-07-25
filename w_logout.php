<?php
    unset($_COOKIE['username']);
    setcookie('username', '',time()-3600);
    header("Location: login_writer.php");
?>