<?php
    session_start();
    session_destroy();
    $_COOKIE['username'] = '';
    $_COOKIE['start_time'] = '';
    header("Location: ../login.php");
?>