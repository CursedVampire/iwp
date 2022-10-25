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
            <a class="navlink" href="signup.php">Signup</a>
        </nav>
        <main>
            <section style="font-size: 1.5rem">
            <h1>Login</h1>
            <?php
                $show_form = true;
                $valid = false;
                if (isset($_POST['username'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    foreach ($_SESSION['users'] as $uname => $details) {
                        $valid = ($username == $uname && $details['password'] == $password);
                        if ($valid) break;
                    }
                    if ($valid) {
                        $show_form = false;
                        echo "Logged in as $username";
                        echo "<br /><form method='GET'><button>Logout</button></form>";
                    } else {
                        echo "Wrong Password";
                    }
                }
            ?>
            <?php if ($show_form) { ?>
                <form method="POST">
                    <label for="username">Username: </label><input required name="username" /><br />
                    <label for="phone">Password: </label><input required name="password" type="password" /><br />
                    <button type="submit">Submit</button>
                    <button type="reset">Reset</button>
                </form>
            <?php } ?>
            </section>
        </main>
        <footer>Made by Samridh<br />copyleft info<br />credits</footer>
    </body>
</html>

