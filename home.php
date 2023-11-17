<?php
session_start();
if (isset($_SESSION['login']) == false) {
    header('location:index.php');
    exit;
}
?>

<html>

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel='icon' href='uploads/favicon.ico' type='image/x-icon' sizes="16x16" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nama+Font&display=swap">

    <title>Home</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col" style="padding: 0px;">
                <?php
                include('navigation.php');
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col" style="padding: 0px;">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></li>
                        <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></li>
                        <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="uploads/food_cover1.jpg" class="d-block w-100" alt="Healthy Food">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Reward Your Body </h5>
                                <p>With Precious Healthy Food</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="uploads/food_cover2.jpg" class="d-block w-100" alt="Meat and Egg">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Meat and Egg</h5>
                                <p>Yummy Your Tongue </p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="uploads/food_cover3.jpg" class="d-block w-100" alt="Roasted Meat">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Delicious Food</h5>
                                <p>We Deliver Delicious Food For You</p>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
                <Br>
                <center>
                    <div style="width: 50%;">
                        <h2>
                            Your Body Deserve Healthy Food
                        </h2>
                        <p>
                            Bon appetit, enjoy your food and beverage with us. Reward your body with a great and healthy
                            food
                            from our restaurant. You are the king and queen at our place. It's a honor to serve you.
                            Stay
                            healthy, stay hungry.
                        </p>
                    </div>
                </center>
            </div>
        </div>
        <div class="row bg-dark">
            <div class="col" style="padding: 0px;">
                <div id="footer bg-dark" style="color: white; padding: 20px; text-align: right">
                    Copyright © Puede Resto
                </div>
            </div>
        </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
</body>

</html>