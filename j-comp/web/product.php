<?php
    session_start();
    $path_to_public = './';
    require('./static/database_connection.php');

    $title = 'FitKart Shopping';
    $links = [
        ["title" => "Profile", "href" => "users/customer.php"],
        ["title" => "Logout", "href" => "users/logoutAction.php"],
    ];
    require('./templates/top.php');
    
    $product_id = $_GET['id'];
    $product = mysqli_fetch_assoc(mysqli_query($con, "
        SELECT
            name,
            description,
            price_in_paisa,
            seller_email_id,
            inventory_size
        FROM Products
        WHERE product_code = ".$product_id.";
    "));

    $seller = mysqli_fetch_assoc((mysqli_query($con,"
        SELECT
            first_name,
            middle_name,
            last_name
        FROM PersonalDetails
        WHERE email_id='".$product['seller_email_id']."';
    ")));

    $reviews = (mysqli_query($con,"
        SELECT
            first_name,
            middle_name,
            last_name,
            review_date,
            review_time,
            review_title,
            review_text,
            rating_out_of_five
        FROM
            ProductReviews
            JOIN PersonalDetails
            ON ProductReviews.reviewer_email_id = PersonalDetails.email_id
        WHERE product_code = '".$product_id."';
    "));
?>
<main>
    <article class = "full">
        <section>
            <h1><?php echo $product["name"]." | ".($product["price_in_paisa"]/100); ?>Rs.</h1>
            <b>Sold by
                <a href='<?php echo "#"; ?>'>
                    <?php
                        echo $seller["first_name"]
                            ." ".$seller["middle_name"]
                            ." ".$seller["last_name"];
                    ?>
                </a>
            </b>
            <p>
                <?php echo $product["description"]; ?>
            </p>
        </section>
        <section>
            <h2>Reviews</h2>
            <dl>
                <?php
                    for ($i = 0; $i < mysqli_num_rows($reviews); $i++) {
                        $review = mysqli_fetch_assoc($reviews);
                        echo "
                            <dt>
                                ".$review['first_name']." on ".$review['review_time']." ".$review['review_date'].": <b>".$review['review_title']."</b>
                                ".str_repeat("⭐", $review['rating_out_of_five'])."
                            </dt>
                            <dd>".$review['review_text']."</dd>
                        ";
                    }
                ?>
            </dl>
        </section>
    </article>
</main>
<?php require('./templates/bottom.php'); ?>
