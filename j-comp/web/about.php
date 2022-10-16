<?php
    $heading = 'About FitKart';
    $title = 'About FitKart';
    $path_to_public = '';
    $links = [
        ['title' => 'Home', 'href' => 'index.php'],
        ['title' => 'Login', 'href' => 'users/login.php'],
        ['title' => 'Register', 'href' => 'users/register.php']
    ];
    require 'templates/top.php';
?>

<article class="full">
    <div class="slogan">
        We are <span class="FitKart">FitKart</span>!!<br />
    </div>
    <img src="assets/images/box.jpg" class="sectionimage" />
    <div class="slogan">
        We are your one-stop-shop for selling and buying
        anything.<br />
    </div>
    <img src="assets/images/nike-shoe.jpg" class="sectionimage" />
    <div class="slogan">
        <span class="FitKart">FitKart</span> is global, we are
        available anywhere, everywhere, always.<br />
    </div>
    <img
        src="assets/images/shipping-warehouse.jpg"
        class="sectionimage"
    />
    <div class="slogan">
        The <span class="FitKart">FitKart</span> experience is
        seamless!
    </div>
</article>

<?php
    require 'templates/bottom.php';
?>