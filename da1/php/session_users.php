<?php
    session_start();
    if (!isset($_SESSION['users'])) {
        $_SESSION['users'] = [
            "admin" => [
                    "password" => "admin@123",
                    "name" => "Mr. Admin S. Traitor",
                    "email" => "admins.traitor2020@vitprofessor.ac.in",
                    "phone" => "100"
                ]
        ];
    }
?>
