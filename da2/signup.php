<?php require('php/session_users.php') ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Samridh Anand Paatni</title>
        <link rel="stylesheet" href="css/index.css" />
        <link rel="stylesheet" href="css/project-cards.css" />
        <link rel="stylesheet" href="css/skill-cards.css" />
        <script defer src="js/activeNavlink.js"></script>
        <script defer src="js/changeNavbar.js"></script>
    </head>
    <body>
        <nav id="navbar" class="at-the-top">
            <a id="navbar-title" class="navlink" href="index.html">
                Samridh Anand Paatni
            </a>
            <a class="navlink" href="login.php">Login</a>
        </nav>
        <main>
            <section style="font-size: 1.5rem">
            <h1>Signup</h1>
            <?php
                if (isset($_POST['name'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $name = $_POST['name'];
                    $phone = $_POST['phone'];
                    $email = $_POST['email'];

                    $_SESSION['users'][$username] = [
                        "password" => $password,
                        "name" => $name,
                        "email" => $email,
                        "phone" => $phone
                    ];
                    header('Location: login.php');
                } else {
            ?>
                <form method="POST">
                    <label for="name">Name: </label>
                    <input required name="name" />
                    <br />
                    <label for="email">Email: </label>
                    <input required name="email" type="email" />
                    <br />
                    <label for="phone">Phone Number: </label>
                    <input required name="phone" type="number" />
                    <br />
                    <label for="username">Username: </label>
                    <input required name="username" />
                    <br />
                    <label for="phone">Password: </label>
                    <input required name="password" type="password" pattern=".{8,}"/>
                    <br />
                    <button type="submit">Submit</button>
                    <button type="reset">Reset</button>
                </form>
            <?php } ?>
            The password should be minimum 8 characters long
            </section>
        </main>
        <footer>Made by Samridh<br />copyleft info<br />credits</footer>
    </body>
</html>

