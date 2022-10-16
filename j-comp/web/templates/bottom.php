        </main>
        <nav class="bottom">
            <a class="navlink" href="#">Top</a>
        <?php
            if (!empty($links)) {
                echo ' | ';
                printNavs($path_to_public, $links);
            }
        ?>
        </nav>
        <footer>
            Made by Samridh Anand Paatni (20BCE1550), Kiran Manikandhan (20BCE1786), Aayush Jain, Priyansh
        </footer>
    </body>
</html>