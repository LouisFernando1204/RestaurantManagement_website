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
// Cek apakah ada data input yang telah disimpan di sesi
if (isset($_SESSION['input_data'])) {
    $input_data = $_SESSION['input_data'];
    // Hapus data input yang sudah diproses
    unset($_SESSION['input_data']);
} else {
    // Jika tidak ada data di sesi, inisialisasi dengan data kosong
    $input_data = [
        'name' => '',
        'username' => '',
        'password' => '',
        'confirm_password' => '',
        'user_id' => '',
        'actor_id' => ''
    ];
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

    <title>Create User</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-image: url('uploads/food_cover3.jpg');
            background-size: cover;
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
                            Create User
                        </h2>
                        <form action="create_user.php" method="post" enctype="multipart/form-data"
                            style="margin-top: 20px; margin-bottom: 15px;">
                            <!-- enctype untuk meng-handle file berupa gambar dan juga text biasa -->
                            <label for="name" class="fw-bold">Name: </label>

                            <input type="text" name="name" id="name" autocomplete="on" required
                                class="form-control text-center" style="width: 70%; margin-bottom: 15px;"
                                value="<?php echo $input_data['name'] ?>">

                            <label for="username" class="fw-bold">Username: </label>

                            <input type="text" name="username" id="username" autocomplete="on" required
                                class="form-control text-center" style="width: 70%; margin-bottom: 15px;"
                                value="<?php echo $input_data['username'] ?>">

                            <label for="password" class="fw-bold">Password: </label>

                            <input type="password" name="password" id="password" autocomplete="on" required
                                class="form-control text-center" style="width: 70%; margin-bottom: 15px;"
                                value="<?php echo $input_data['password'] ?>">

                            <label for="password" class="fw-bold">Confirm Password: </label>

                            <input type="password" name="confirm_password" id="confirm_password" autocomplete="on"
                                required class="form-control text-center" style="width: 70%; margin-bottom: 15px;"
                                value="<?php echo $input_data['confirm_password'] ?>">

                            <label for="user" class="fw-bold">User: </label>

                            <select name="user_id" id="user_id" class="form-select"
                                style="text-align: center; width: 70%; margin-bottom: 15px;">
                                <option selected value="">Choose...</option>
                                <?php
                                $sql = "SELECT * FROM users";
                                $usersResults = mysqli_query($con, $sql);
                                while ($users = mysqli_fetch_assoc($usersResults)) {
                                    ?>
                                    <?php
                                    if ($users['id'] == $input_data['user_id']) {
                                        ?>
                                        <option selected value="<?php echo $users['id'] ?>">
                                            <?php echo $users['name'] ?>
                                        </option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?php echo $users['id'] ?>">
                                            <?php echo $users['name'] ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>

                            <label for="actor" class="fw-bold">Actor: </label>

                            <select name="actor_id" id="actor_id" class="form-select"
                                style="text-align: center; width: 70%; margin-bottom: 15px;" required>
                                <option selected value="">Choose...</option>
                                <?php
                                $sql = "SELECT * FROM actors";
                                $actorsResults = mysqli_query($con, $sql);
                                while ($actors = mysqli_fetch_assoc($actorsResults)) {
                                    ?>
                                    <?php
                                    if ($actors['id'] == $input_data['actor_id']) {
                                        ?>
                                        <option selected value="<?php echo $actors['id'] ?>">
                                            <?php echo $actors['name'] ?>
                                        </option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?php echo $actors['id'] ?>">
                                            <?php echo $actors['name'] ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>

                            <input type="submit" value="Submit" name="submit" class="btn btn-primary">
                            <br>
                            <div style="color: red;">
                                <?php
                                if (isset($_SESSION['username_error']) == true) {
                                    echo $_SESSION['username_error'];
                                    $_SESSION['username_error'] = "";
                                }
                                if (isset($_SESSION['password_error']) == true) {
                                    echo $_SESSION['password_error'];
                                    $_SESSION['password_error'] = "";
                                }
                                ?>
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