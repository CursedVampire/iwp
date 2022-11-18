<?php
    session_start();
    $path_to_public = '../';
    require('../templates/shouldBeLoggedIn.php');
    require '../static/database_connection.php';

    $get_name = "SELECT first_name
        FROM PersonalDetails
        WHERE email_id = '".$_SESSION['user_email_id'].
        "';";
    $result = mysqli_fetch_assoc(mysqli_query($con, $get_name));

    $heading = "Welcome back " . $result['first_name'];
    $title = 'FitKart Shopping';
    $links = [
        ["title" => "Logout", "href" => "users/logoutAction.php"],
    ];
    require '../templates/top.php';

    // generating recommendations
    require('../recommendation-engine.php');
    $target=$_SESSION['user_email_id'];
    $preds = getRecommendation($reviews, $target);
?>
<main>
    <article>
        <section>
                <h2 id="Search">Search</h2>
            <input
                class="text"
                placeholder="From over num items"
                style="width: 85%"
                type="search"
            /><button style="width: 15%">Search</button>
        </section>
        <section>
            <h2 id="Recommendations">Recommendations</h2>
            <div class="prod-cards">
                <?php
                $i = 0;
                foreach ($preds as $product => $rank) {
                    if ($i > 10) break;
                    $prod = mysqli_fetch_assoc(mysqli_query($con, "
                        SELECT
                            product_code,
                            name,
                            description,
                            price_in_paisa
                        FROM Products
                        WHERE product_code = ".$product.";
                    "));
                    echo "<div class='prod-card'>
                            <a href='".$path_to_public."product.php?id=".$prod['product_code']."'>
                                ".$prod['name']."
                            </a> | ".($prod['price_in_paisa']/100)."Rs.
                            <hr />
                            ".$prod['description']."
                        </div>";
                    $i++;
                }
                ?>
            </div>
        </section>
                <section>
            <h2 id="Cart">Cart</h2>
            <ul>
                <li></li>
            </ul>
        </section>
        <section>
            <h2 id="Products">Product</h2>
            <div class="prod-cards">
                <?php
                    $result = mysqli_query($con, "
                         SELECT
                            product_code,
                            name,
                            description,
                            price_in_paisa
                        FROM
                            Products
                        ;
                    ");
                    for ($j = 0; $j < mysqli_num_rows($result); $j++) {
                        $row = mysqli_fetch_row($result);
                        echo "<div class='prod-card'>
                            <a href='".$path_to_public."product.php?id=".$row[0]."'>
                                ".$row[1]."
                            </a> | ".($row[3]/100)."Rs.
                            <hr />
                            ".$row[2]."
                        </div>";
                    }
                ?>
            </ul>
        </section>
    </article>
    <aside id="aside">
        <a class="navlink" href="#Search">Search</a><br />
        <hr />
        <a class="navlink" href="#Recommendations">Recommendations</a><br />
        <hr />
        <a class="navlink" href="#Products">Products</a><br />
        <hr />
        <a class="navlink" href="#Your Reviews">Your Reviews</a><br />
        <hr />
    </aside>
</main>
<?php require '../templates/bottom.php'; ?>