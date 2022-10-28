<?php
    session_start();
    $username = $_SESSION['username'];
    setcookie("username", $username, time() + (86400 * 30), "/");
    setcookie("start_time", time(), time() + (86400 * 30), "/");
?>

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
            <h1>Hello <?php echo $username; ?></h1>
            <form
                method="POST"
                action="php/mail.php"
                enctype="multipart/form-data"
            >
                <label for='to'>To: </label>
                <input required type="email" name="to" />
                <br />

                <label required for='subject'>Subject:</label>
                <input required type="text" name="subject" />
                <br />

                <label required for='message'>Message:</label>
                <textarea name="message"></textarea>
                <br />

                <label for='uploaded_file'>Attachement:</label>
                <input type="file" name="uploaded_file" />
                <br />

                <button type="submit">Submit</button>
                <button type="reset">Reset</button>
            </form>
            <a href="php/logout.php">
                <button>Logout</button>
            </a>
            </section>
        </main>
        <footer>Made by Samridh<br />copyleft info<br />credits</footer>
    </body>
</html>

