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
if (isset($_POST['done']) == true) {
    header('location:home.php');
    exit;
}
if (isset($_SESSION['actors_name']) == true) {
    if ($_SESSION['actors_name'] != 'cashier' && $_SESSION['actors_name'] != 'manager') {
        header('location:home.php');
        exit;
    }
}
// untuk PAGINATION
$jumlahData_perHalaman = 20;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $keyword = $_POST['keyword'];
    if (isset($_POST['search']) == true && isset($keyword) == true) {
        $sql = "SELECT * FROM selling WHERE id LIKE '%$keyword%' OR tanggal LIKE '%$keyword%' OR customer LIKE '%$keyword%' OR total LIKE '%$keyword%'";
    }
} else {
    $sql = "SELECT * FROM selling";
}
$sellingResults = mysqli_query($con, $sql);
$row = [];
while ($selling = mysqli_fetch_assoc($sellingResults)) {
    $selling_processed[] = $selling;
}
$totalData = count($selling_processed);
$jumlahHalaman = ceil($totalData / $jumlahData_perHalaman);
// -- round untuk membulatkan ke atas dan bawah tergantung koma nya misal 1.5 -> 2
// -- floor (lantai) untuk membulatkan berapapun ke bawah
// -- ceil (langit-langit) untuk membulatkan berapapun ke atas 
if (isset($_GET['halaman']) == true) {
    $halaman_aktif = $_GET['halaman'];
} else {
    $halaman_aktif = 1;
}
// SIMULASI LOGIKA!!
//halaman=2, awaldata=20
//halaman=3, awaldata=40
$awalData = ($jumlahData_perHalaman * $halaman_aktif) - $jumlahData_perHalaman;
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

    <title>Payment Report</title>
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
                    <div class="card"
                        style="text-align: center; padding: 10px; border-radius: 8px; border: 1px solid grey; box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.8); width: 65%; margin-top: 40px; margin-bottom: 40px;">
                        <h2 class="text-primary" style="font-weight: bold;">
                            Payment Report
                        </h2>
                        <table class="table table-light table-striped table-hover table-responsive"
                            style="width: 100%; text-align: center;">
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                            <?php
                            if (isset($_GET['halaman']) && $_GET['halaman'] > 1) {
                                $halaman_aktif = $_GET['halaman'];
                                $id = (($halaman_aktif - 1) * $jumlahData_perHalaman) + 1;
                            } else {
                                $id = (($halaman_aktif - 1) * $jumlahData_perHalaman) + 1;
                            }
                            $total_price = 0;
                            // kalau pakai search bar
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $keyword = $_POST['keyword'];
                                if (isset($_POST['search']) == true && isset($keyword) == true) {
                                    $sql = "SELECT * FROM selling WHERE id LIKE '%$keyword%' OR tanggal LIKE '%$keyword%' OR customer LIKE '%$keyword%' OR total LIKE '%$keyword%' LIMIT $awalData, $jumlahData_perHalaman";
                                    $sellingResults = mysqli_query($con, $sql);
                                }
                            } else {
                                $sql = "SELECT * FROM selling LIMIT $awalData, $jumlahData_perHalaman";
                                $sellingResults = mysqli_query($con, $sql);
                            }
                            while ($selling = mysqli_fetch_assoc($sellingResults)) {
                                ?>
                                <tr>
                                    <td style="padding-left: 50px; padding-right: 50px;">
                                        <?php
                                        echo $id;
                                        ?>
                                    </td>
                                    <td style="padding-left: 50px; padding-right: 50px;">
                                        <?php
                                        echo $selling['id'];
                                        ?>
                                    </td>
                                    <td style="padding-left: 40px; padding-right: 40px;">
                                        <?php
                                        echo $selling['tanggal'];
                                        ?>
                                    </td>
                                    <td style="padding-left: 40px; padding-right: 40px;">
                                        <?php
                                        echo $selling['customer'];
                                        ?>
                                    </td>
                                    <td style="padding-left: 40px; padding-right: 40px;">
                                        <?php
                                        echo $selling['total'];
                                        ?>
                                    </td>
                                    <td style="padding-left: 40px; padding-right: 40px;">
                                        <?php
                                        if ($selling['status'] == 0) {
                                            echo '<a href="updatepayment.php?id=' . $selling['id'] . '" class="fw-bold" onclick="return confirm(\'Are you sure you want to change to Paid?\');">Unpaid</a>';
                                        } elseif ($selling['status'] == 1) {
                                            echo '<a href="updatepayment.php?id=' . $selling['id'] . '" class="fw-bold" onclick="return confirm(\'Are you sure you want to change to Unpaid?\');">Paid</a>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                $total_price = $total_price + $selling['total'];
                                $id++;
                            }
                            ?>
                            <tr>
                                <th colspan="5" style="color: red;">
                                    Total
                                </th>
                                <td>
                                    <?php
                                    echo $total_price;
                                    ?>
                                </td>
                            </tr>
                        </table>
                        <form action="" method="post">
                            <button type="submit" class="btn btn-primary" id="done" name="done"
                                style="width: 100%;">Done</button>
                        </form>
                        <!-- untuk PAGINATION -->
                        <div class="row">
                            <div class="col">
                                <?php
                                echo '<a href="?halaman=' . 1 . '" style="text-decoration: none;  margin-right: 20px">' . '&laquo;' . '</a>';
                                if ($halaman_aktif == 1) {
                                    echo '<a href="?halaman=' . 1 . '" style="text-decoration: none;">' . '&lt;' . '</a>';
                                } else {
                                    echo '<a href="?halaman=' . $halaman_aktif - 1 . '" style="text-decoration: none;">' . '&lt;' . '</a>';
                                }
                                ?>
                                <!-- ini untuk mengeluarkan semua nomor halamannya di layar dan akan bertambah kalau jumlah datanya bertambah (kurang efisien) -->
                                <?php
                                // for ($i = 1; $i <= $jumlahHalaman; $i++) {
                                //     if ($i == $halaman_aktif) {
                                //         echo '<a href="?halaman= ' . $i . '" style="color: red; font-weight: bold; margin-left: 10px; margin-right: 10px;">' . $i . '</a>';
                                //     } else {
                                //         echo '<a href="?halaman= ' . $i . '" style="font-weight: bold; margin-left: 10px; margin-right: 10px;">' . $i . '</a>';
                                //     }
                                
                                // }
                                ?>
                                <!-- ini yang lebih efisien, user tinggal input halaman berapa dan tidak memenuhi layar -->
                                Page
                                <input type="text" autocomplete="off" id="halaman" name="halaman"
                                    value="<?php echo $halaman_aktif ?>" onBlur="goTo(this.value)"
                                    style="width: 40px; padding: auto; font-weight: bold; text-align: center;">
                                <script language="javascript">
                                    function goTo(page) {
                                        var jumlahHalaman = <?php echo $jumlahHalaman ?>;
                                        page = parseInt(page); // Mengubah input menjadi angka integer
                                        if (isNaN(page)) { // Periksa apakah input bukan angka
                                            page = 1;
                                        }
                                        if (page < 1) {
                                            page = 1;
                                        } else if (page > jumlahHalaman) {
                                            page = jumlahHalaman;
                                        }
                                        window.location.href = 'paymentreport.php?halaman=' + page;
                                        // -- window ini untuk merujuk ke jendela browser yang sedang ditampilkan/untuk pindah ke file.php lainnya
                                    }
                                </script>
                                of
                                <?php echo $jumlahHalaman ?>
                                <?php
                                if ($halaman_aktif == $jumlahHalaman) {
                                    echo '<a href="?halaman=' . $jumlahHalaman . '" style="text-decoration: none;">' . '&gt;' . '</a>';
                                } else {
                                    echo '<a href="?halaman=' . $halaman_aktif + 1 . '" style="text-decoration: none;">' . '&gt;' . '</a>';
                                }
                                echo '<a href="?halaman=' . $jumlahHalaman . '" style="text-decoration: none; margin-left: 20px;">' . '&raquo;' . '</a>';
                                ?>
                            </div>
                        </div>
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