<?php
    $server = "localhost";
    $database_username = "root";
    $database_password = "";
    $database_name = "CSE3002";

    $con = new mysqli($server, $database_username, $database_password, $database_name);
    if ($con->connect_errno) die("failed to connect");

    function add_user($con, $u, $p, $n, $e, $ph) {
        $add_query = "INSERT INTO Person_Details VALUES ('$u', '$p', '$n', '$e', '$ph');";
        var_dump($add_query);
        if ($result = $con->query($add_query)) {
            echo $result->num_rows . "<br />";
            $result->free_result();
        }
    }

    function is_valid_username_password($con, $u, $p) {
        $get_query = "
            SELECT
                username,
                password
            FROM Person_Details
            WHERE
                username='$u'
                AND password='$p'
            ;
        ";
        if ($result = $con->query($get_query)) {
            if ($result->num_rows > 0) return true;
        }
        return false;
    }
?>