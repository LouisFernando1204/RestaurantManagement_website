<?php
session_start();
if (!$_SESSION['login']) {
    header('location:index.php');
    die();
}
$con = mysqli_connect('localhost', 'root', '', 'restaurant');
if (mysqli_connect_errno()) {
    echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
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

    <title>Food Menu</title>
    <style>
        img {
            width: 170px;
            height: 200px;
            border-radius: 20px;
            border: 3px solid black;
            box-shadow: 0px 5px 5px rgba(0, 0, 0, 0.4);
        }

        body {
            font-family: 'Montserrat', sans-serif;
        }

        h2 {
            font-weight: bold;
        }

        .food-name {
            font-size: 20px;
        }

        .food-price {
            font-size: 15px;
            font-style: italic;
            color: darkred;
        }

        .order-form {
            font-size: 18px;
        }
    </style>
    <?php
    $sql = "SELECT count(*) as amount FROM food";
    $rs = mysqli_query($con, $sql);
    $row_total = mysqli_fetch_array($rs, MYSQLI_ASSOC);
    ?>
    <script language="javascript">
        var data = new Array(<?php echo $row_total["amount"] + 1 ?>);
        function countTotal(id, price) {
            var qty = parseInt(document.getElementById(id).value);
            // -- dijadiin int dulu karena kuantitas ini adalah inputan user melalui input type jadi semuanya dianggap string
            data[id] = qty * price;
            var total_price = 0;
            for (a = 1; a <= <?php echo $row_total["amount"] ?>; a++)
            {
                if (data[a] > 0)
                    total_price = parseInt(total_price) + parseInt(data[a]);
            }
            document.getElementById("cost").value = total_price;
        }
        // -- ini function kerja nya satu" jadi per textbox number makanan diisi dia akan jalankan function ini terus dicari array ke sekian yang makanan itu ada isinya brti itu diproses dan ditampilkan
        // kalau pesan makanan lain baru diproses lagi kemudian ditambahkan ke dalam array data[id] dan dilooping lgi buat nampilin.
    </script>
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
        <form action="saveorder.php" method="post">
            <!-- -- ini pembuka form ditaruh awal seperti ini biar proses yang dijalankan di dalam bisa berjalan semua. -->
            <div class="row">
                <div class="col" style="padding-top: 20px; padding-left: 15px;">
                    <?php

                    $sql = 'SELECT * FROM categories';
                    $categoriesResults = mysqli_query($con, $sql);

                    while ($categories = mysqli_fetch_assoc($categoriesResults)) {
                        echo '<h2>' . $categories['name'] . '</h2>';
                        ?>
                        <table style="margin-bottom: 20px;">
                            <tr>
                                <?php
                                $sql = 'SELECT * FROM food WHERE category_id = ' . $categories['id'];
                                $foodResults = mysqli_query($con, $sql);
                                $counter = 0;
                                ?>
                                <?php
                                while ($food = mysqli_fetch_assoc($foodResults)) {
                                    ?>
                                    <td style="padding-bottom: 20px; padding-right: 35px;">
                                        <?php
                                        echo '<img src="uploads/' . $food['image'] . '"alt="' . $food['image'] . '" style="margin-bottom: 10px;" >' . '<br>';
                                        echo '<b class="food-name">' . $food['name'] . '</b>' . '<br>';
                                        echo '<b class="food-price">' . 'Price: ' . $food['sell_price'] . '</b>' . '<br>';
                                        echo '<input type="number" id="' . $food['id'] . '"name="' . $food['id'] . '"value="0" onBlur="countTotal( ' . $food['id'] . ',' . $food['sell_price'] . ')" style="width:50px;">';
                                        ?>
                                    </td>
                                    <?php
                                    $counter++;
                                    if ($counter % 4 == 0) {
                                        echo '</tr><tr>';
                                    }
                                    ?>
                                    <?php
                                }
                                ?>
                            </tr>
                        </table>
                    <?php } ?>
                </div>
                <div id="aside" style="margin-right: 70px; margin-top: 10px;">
                    <div style="width: 100%; border: 1px solid grey; border-radius: 10px; padding: 15px;">
                        <h5 style="text-align: center; font-style: italic">
                            <?php
                            if (isset($_SESSION['user_name']) == true) {
                                echo 'Welcome back, ' . $_SESSION['user_name'] . '!';
                            }
                            ?>
                        </h5>
                        <h3 class="mb-1" style="font-weight: bold; text-align: center;">
                            <b>Order Information</b>
                        </h3>
                        <img src="uploads/customer-eat.jpg" class="img-fluid" alt="Customer-Order-IMG"
                            style="width: 500px; border-radius: 0; border: 0px;">
                        <div class="mb-3 mt-2">
                            <b class="order-form">Customer Name</b>
                            <input type="text" class="form-control" placeholder="Masukkan nama Anda"
                                aria-label="Customer name" id="customer_name" name="customer_name" required
                                autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <b class="order-form">Seat</b>
                            <select class="form-select" aria-label="Default select example" id="seat_id" name="seat_id">
                                <?php
                                $sql = 'SELECT * FROM table_resto';
                                $tableResults = mysqli_query($con, $sql);
                                while ($tables = mysqli_fetch_assoc($tableResults)) {
                                    ?>
                                    <option value=" <?php echo $tables['id'] ?> "> <?php echo $tables['note'] ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <b class="order-form">Cost</b>
                            <input type="text" class="form-control" readonly value="0" id="cost" name="cost">
                        </div>
                        <input type="submit" class="btn btn-outline-primary" name="place_order" value="Place Order"
                            style="font-weight: bold;">
                        <input type="submit" class="btn btn-outline-danger" name="cancel" value="Cancel"
                            style="font-weight: bold;">
                        <?php
                        if (isset($_SESSION['error_message']) == true) {
                            echo $_SESSION['error_message'];
                            $_SESSION['error_message'] = "";
                        }
                        if (isset($_SESSION['cancel_order']) == true) {
                            echo $_SESSION['cancel_order'];
                            $_SESSION['cancel_order'] = "";
                        }
                        // if (isset($_SESSION['place_order']) == true) {
                        //     echo $_SESSION['place_order'];
                        //     $_SESSION['place_order'] = "";
                        // }
                        ?>
        </form>
    </div>
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