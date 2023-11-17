<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "restaurant");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
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

    <title>Update Food/Drink</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-image: url('uploads/food_cover3.jpg');
            background-size: cover;
        }

        img {
            width: 180px;
            height: 180px;
            border: 1px solid grey;
            border-radius: 5px;
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
                <center>
                    <div
                        style="padding: 10px; border-radius: 8px; border: 1px solid grey; box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.8); width: 30%; margin-top: 40px; margin-bottom: 40px; background-color: white;">
                        <h2 class="text-primary" style="font-weight: bold; margin-bottom: 10px;">
                            Update Food/Drink
                        </h2>
                        <?php
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM food WHERE id = " . $id;
                        $foodResults = mysqli_query($con, $sql);
                        $food = mysqli_fetch_assoc($foodResults);
                        ?>
                        <form action="update_food.php" method="post" enctype="multipart/form-data"
                            style="margin-top: 20px; margin-bottom: 15px;">
                            <!-- enctype untuk meng-handle file berupa gambar dan juga text biasa -->
                            <input type="hidden" name="foodDrink_old" value="<?php echo $food['image'] ?>">
                            <input type="hidden" name="id" value="<?php echo $food['id'] ?>">
                            <label for="food_drink" class="fw-bold">Food/Drink name: </label>

                            <input type="text" name="food_drink" id="food_drink" autocomplete="on" required
                                class="form-control text-center" style="width: 70%; margin-bottom: 15px;"
                                value="<?php echo $food['name'] ?>">

                            <label for="descriptions" class="fw-bold">Descriptions: </label>

                            <input type="text" name="descriptions" id="descriptions" autocomplete="on" required
                                class="form-control text-center" style="width: 70%; margin-bottom: 15px;"
                                value="<?php echo $food['descriptions'] ?>">

                            <label for="sell_price" class="fw-bold">Sell price: </label>

                            <input type="text" name="sell_price" id="sell_price" autocomplete="on" required
                                class="form-control text-center" style="width: 70%; margin-bottom: 15px;"
                                value="<?php echo $food['sell_price'] ?>">

                            <label for="buy_price" class="fw-bold">Buy price: </label>

                            <input type="text" name="buy_price" id="buy_price" autocomplete="on" required
                                class="form-control text-center" style="width: 70%; margin-bottom: 15px;"
                                value="<?php echo $food['buy_price'] ?>">

                            <label for="categories" class="fw-bold">Category: </label>

                            <select name="categories" id="categories" class="form-select"
                                style="text-align: center; width: 70%; margin-bottom: 15px;" required>
                                <?php
                                $sql = "SELECT * FROM categories";
                                $categoriesResults = mysqli_query($con, $sql);
                                while ($categories = mysqli_fetch_assoc($categoriesResults)) {
                                    ?>
                                    <?php
                                    if ($categories['id'] == $food['category_id']) {
                                        ?>
                                        <option selected value="<?php echo $categories['id'] ?>">
                                            <?php echo $categories['name'] ?>
                                        </option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?php echo $categories['id'] ?>">
                                            <?php echo $categories['name'] ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>

                            <label for="foodDrink" class="fw-bold mb-1">Select image to upload: </label>
                            <br>
                            <?php
                            echo '<img src="uploads/' . $food['image'] . '" alt="' . $food['image'] . '" style="margin-bottom: 15px;">';
                            ?>
                            <input type="file" class="form-control" name="foodDrink" id="foodDrink"
                                style="text-align: center; width: 70%; margin-bottom: 15px;">
                            <!-- input type (file) ini dapat digunakan/diakses dengan $_FILES, lawannya $_POST kalau $_POST untuk data berupa text saja. -->

                            <input type="submit" value="Submit" name="submit" class="btn btn-primary">
                            <br>
                            <div class="text-primary">
                                <?php
                                if (isset($_SESSION['fileIsImg']) == true) {
                                    echo $_SESSION['fileIsImg'];
                                    $_SESSION['fileIsImg'] = "";
                                }
                                ?>
                                <div style="color: red;">
                                    <?php
                                    if (isset($_SESSION['fileNotImg_error']) == true) {
                                        echo $_SESSION['fileNotImg_error'];
                                        $_SESSION['fileNotImg_error'] = "";
                                    }
                                    if (isset($_SESSION['fileExist_error']) == true) {
                                        echo $_SESSION['fileExist_error'];
                                        $_SESSION['fileExist_error'] = "";
                                    }
                                    if (isset($_SESSION['fileSize_error']) == true) {
                                        echo $_SESSION['fileSize_error'];
                                        $_SESSION['fileSize_error'] = "";
                                    }
                                    if (isset($_SESSION['fileType_error']) == true) {
                                        echo $_SESSION['fileType_error'];
                                        $_SESSION['fileType_error'] = "";
                                    }
                                    ?>
                                </div>
                            </div>
                        </form>
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
<?php
mysqli_close($con);
?>