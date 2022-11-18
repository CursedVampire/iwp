<?php
    if (!array_key_exists('user_email_id', $_SESSION)) {
        // header('Location: '.$path_to_public.'users/login.php');
        // echo $path_to_public;
        die;
    }
?>