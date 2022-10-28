<?php
    session_start();
    require('database.php');

    $to = $_POST['to'];
    $message = $_POST['message'];
    $subject = $_POST['subject'];
    $username = $_SESSION['username'];
    $from = get_email($con, $username);

    if (!is_uploaded_file($_FILES['uploaded_file']['tmp_name'])) {
        $headers = "From: ".$from;
        mail($to, $subject, $message, $headers);
        echo "mail sent";
    } else {
        $file = $_FILES['uploaded_file'];
        $headers = "From: ".$from;
        mail($to, $subject, $message, $headers);
        echo "mail sent with attachemnt:" . $file['name'];
    }
?>