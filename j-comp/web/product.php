<?php
    session_start();
    $path_to_public = './';
    require('./static/database_connection.php');

    $title = 'FitKart Shopping';
    $links = [
        ["title" => "Profile(".$_SESSION['user_email_id'].")", "href" => "users/customer.php"],
        ["title" => "Logout", "href" => "users/logoutAction.php"],
    ];
    
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
    $heading = $product['name'];

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
            rating_out_of_five,
            reviewer_email_id
        FROM
            ProductReviews
            JOIN PersonalDetails
            ON ProductReviews.reviewer_email_id = PersonalDetails.email_id
        WHERE product_code = '".$product_id."';
    "));

    // submitting the review (if it is there and the user hasn't already submitted)
    if (isset($_POST['send_review'])) {
        // check if review exists
        if (true) {
            mysqli_query($con,"
                INSERT
                    INTO ProductReviews (
                        product_code,
                        reviewer_email_id,
                        review_date,
                        review_time,
                        review_title,
                        review_text,
                        rating_out_of_five
                    ) VALUES (
                        ".$_POST['product_id'].",
                        '".$_POST['email_id']."',
                        DATE(SYSDATE()),
                        TIME(SYSDATE()),
                        '".$_POST['title']."',
                        '".$_POST['description']."',
                        ".$_POST['rating']."
                    );
            ");
            // $show_form=false;
        }
    }

    $show_form = true;
    require('./templates/top.php');

?>
<main>
    <article class = "full">
        <section>
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
                        if ($review['reviewer_email_id'] == $_SESSION['user_email_id'])
                            $show_form = false;
                        echo "
                            <dt>
                                ".$review['first_name']."(".$review['reviewer_email_id'].") on ".$review['review_time']." ".$review['review_date'].": <b>".$review['review_title']."</b>
                                ".str_repeat("⭐", $review['rating_out_of_five'])."
                            </dt>
                            <dd>".$review['review_text']."</dd>
                        ";
                    }
                ?>
            </dl>
        </section>
            <?php
                if ($show_form) {
            ?>
            <section>
            <h2>Give Your Review</h2>
            <form
                method="POST"
                style="
                    display: grid;
                    grid-template-columns: 1fr 3fr;
                    row-gap: 10px;
                "
            >
                <input hidden name="product_id" value="<?php echo $product_id?>" />
                <input hidden name="email_id" value="<?php echo $_SESSION['user_email_id']; ?>" />
                <label>Review Title:</label><input required type="text" name="title" />
                <label>Review:</label><textarea required name="description" ></textarea>
                <label>Rating:</label><input type="range" min="1" max="5" value="3" name="rating"/>
                <br />
                <input type="submit" name="send_review"/>
            </form>
            <?php } ?>
        </section>
    </article>
</main>
<?php require('./templates/bottom.php'); ?>
