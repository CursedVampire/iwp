<?php

$reviews_query = mysqli_query($con,"
    SELECT
        product_code,
        reviewer_email_id,
        rating_out_of_five
    FROM ProductReviews;
");

$reviews = [];
while ($review=mysqli_fetch_assoc($reviews_query)) {
    $user = $review['reviewer_email_id'];
    $product = $review['product_code'];
    $reviews[$user][$product] = $review['rating_out_of_five'];
}
// echo "reviews:<pre>".print_r($reviews, true)."</pre><hr>";

function getSimilarityDistance($reviews, $target, $other) {
    $similar = 0;
    foreach($reviews[$target] as $product => $rating) {
        if (array_key_exists($product, $reviews[$other])) {
            $similar++;
        }
    }
    // if there are no common reviews
    if($similar == 0) {
        return 0;
    } else {
        $sum = 0;
        foreach($reviews[$target] as $product => $rating) {
            if (array_key_exists($product, $reviews[$other])) {
                $sum = $sum + pow(
                    $rating - $reviews[$other][$product],
                    2
                );
            }
        }
        // euclidian distance
        return 1/(1+sqrt($sum));
    }
}

function getRecommendation($reviews, $target) {
    $total=[];
    $simSums=[];
    $ranks=[];
    foreach($reviews as $other=>$revs) {
        // for each user other than the target
        if ($other != $target) {
            // get how similar the other user and the target are
            $sim = getSimilarityDistance($reviews, $target, $other);
            // echo $other."->".$target.": ".$sim."<br>";
            // for each product that the other user has reviewed:
            foreach($reviews[$other] as $product => $rating) {
                // only predict if the target has not reviewed the product
                if (!array_key_exists($product, $reviews[$target])) {
                    // the numerator part
                    if (!array_key_exists($product, $total)) {
                        $total[$product] = 0;
                    }
                    /*
                    * summing the product of the other users' rating
                    * for the product with their similarities with
                    * the target
                    */
                    $total[$product] += $reviews[$other][$product]*$sim;
                    
                    // the denominator part
                    if (!array_key_exists($product, $simSums)) {
                        $simSums[$product] = 0;
                    }
                    $simSums[$product] += $product;
                }
            }
        }
    }
    // echo "total:<pre>".print_r($total, true)."</pre>";
    // echo "simSums:<pre>".print_r($simSums, true)."</pre>";

    foreach($total as $product => $val) {
        $ranks[$product] = $val/$simSums[$product];
    }
    // echo "ranks:<pre>".print_r($ranks, true)."</pre>";
    uasort($ranks, function ($a, $b) {
        return $a == $b ? 0 : ($a > $b ? -1 : 1);
    });
    return $ranks;
}
?>

<?php
/*
$reviews = (mysqli_query($con,"
    SELECT
        product_code,
        reviewer_email_id,
        rating_out_of_five
    FROM ProductReviews
    WHERE reviewer_email_id != '".$_SESSION['user_email_id']."';
"));

$user_reviews = (mysqli_query($con,"
    SELECT
        product_code,
        reviewer_email_id,
        rating_out_of_five
    FROM ProductReviews
    WHERE reviewer_email_id = '".$_SESSION['user_email_id']."';
"));
*/
?>