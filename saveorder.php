<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel='icon' href='uploads/favicon.ico' type='image/x-icon' sizes="16x16" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nama+Font&display=swap">

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-image: url('uploads/food_cover3.jpg');
            background-size: cover;
            /* untuk mengatur tampilan gambar latar belakang */
        }
    </style>
</head>

<body>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
</body>

</html>
<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "restaurant");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
if (isset($_POST['done'])) {
    header('location:food.php');
    exit;
}
date_default_timezone_set('Asia/Jakarta');

if (isset($_POST['place_order'])) {
    $table = $_POST['seat_id'];
    $user = $_SESSION['user_id'];
    $total = $_POST['cost'];
    $customer = htmlspecialchars($_POST['customer_name']);
    // -- ini untuk menghindari inputan user yang aneh seperti: 
    // <div style="position: absolute; top: 0; left: 0; right: 0; color: red; font-size: 100px;">
    //          HAYOO YAA!
    // </div>
    // untuk mengamankan data sebelum memasukkan ke dalam database (mysqli_real_escape_string) dan 
    // juga menghindari potensi serangan XSS (htmlspecialchars) saat menampilkannya di halaman web dapat melakukan perintah berikut:
    // jika digunakan secara bersamaan maka ditulis seperti ini: 
    // $customer = mysqli_real_escape_string($con, $_POST['customer']);
    // $customer = htmlspecialchars($customer, ENT_QUOTES, 'UTF-8');

    $orderDate = date('Y-m-d');
    $orderTime = date('h:i:s a');
    if ($total == 0) {
        $_SESSION['error_message'] = '<b>' . '<br><br>' . 'Please complete the order form!' . '</b>';
        header('location:food.php');
        exit;
    } else {
        $sql = "INSERT INTO `selling`(`tanggal`, `table_id`, `user_id`, `total`, `customer`, `Order_Time`, `status`) 
        VALUES ('$orderDate','$table','$user','$total','$customer','$orderTime','0')";
        $insertToSelling = mysqli_query($con, $sql);
        // -- untuk cek data berhasil ditambahkan atau tidak bisa menggunakan perintah berikut
        // vardump(mysqli_affected_rows()); hasilnya akan menghasilkan int(1):berhasil atau int(-1):tidak berhasil
        // if(mysqli_affected_rows($con) > 0) {
        //     echo "berhasil";
        // }
        // else {
        //     echo "gagal";
        // }
        ?>
        <script language="javascript">
            alert('Thank you, your orders will be processed immediately!');
        </script>
        <?php
        if (isset($insertToSelling) == true) {
            $selling_id = mysqli_insert_id($con);
            // untuk mendapatkan ID yang dihasilkan oleh operasi INSERT terakhir dalam 
            // koneksi database yang telah ditentukan. 
            $sql = "SELECT * FROM food";
            $foodResults = mysqli_query($con, $sql);
            while ($food = mysqli_fetch_assoc($foodResults)) {
                $qty = $_POST[$food['id']];
                $total_price_per_food = $qty * $food['sell_price'];
                if ($qty > 0) {
                    $sql = "INSERT INTO `selling_detail`(`selling_id`, `food_id`, `Qty`, `sell_price`) 
                    VALUES ('$selling_id','{$food['id']}','$qty','$total_price_per_food')";
                    $insertToSelling_Detail = mysqli_query($con, $sql);
                }
            }
            // -- ini kalau tanpa menampilkan order detail:
            // $_SESSION['place_order'] = '<b>' . '<br><br>' . 'The orders will be processed immediately!' . '</b>';
            // header('location:food.php');
            // exit;
            // -- ini untuk menampilkan order detail jika diperlukan:
            $sql = "SELECT f.name as food_name, sd.Qty as quantity, sd.sell_price as total_price 
            FROM selling_detail sd, food f WHERE sd.selling_id = " . $selling_id . " AND sd.food_id = f.id";
            $selling_detail_Results = mysqli_query($con, $sql);
            ?>
            <center>
                <div class="card"
                    style="text-align: center; padding: 15px; border-radius: 8px; border: 1px solid grey; box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.8); width: 40%; margin-top: 40px; margin-bottom: 40px;">
                    <h2 class="text-primary" style="font-weight: bold;">
                        Order Details
                    </h2>
                    <table class="table table-light table-striped table-hover table-responsive"
                        style="width: 100%; text-align: center;">
                        <tr>
                            <th>Food</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                        <?php
                        while ($detail = mysqli_fetch_assoc($selling_detail_Results)) {
                            ?>
                            <tr>
                                <td style="padding-left: 50px; padding-right: 50px;">
                                    <?php
                                    echo $detail['food_name'];
                                    ?>
                                </td>
                                <td style="padding-left: 40px; padding-right: 40px;">
                                    <?php
                                    echo $detail['quantity'];
                                    ?>
                                </td>
                                <td style="padding-left: 40px; padding-right: 40px;">
                                    <?php
                                    echo $detail['total_price'];
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <form action="" method="post">
                        <button type="submit" class="btn btn-primary" id="done" name="done" style="width: 100%;">Done</button>
                    </form>
                </div>
            </center>
            <?php
        }
    }
} elseif (isset($_POST['cancel'])) {
    $_SESSION['cancel_order'] = '<b>' . '<br><br>' . 'You have canceled your order!' . '</b>';
    header('location:food.php');
    exit;
}

mysqli_close($con);
?>