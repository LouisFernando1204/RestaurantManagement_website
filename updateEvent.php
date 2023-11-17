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

    <title>Create Event</title>
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
                            Create Event
                        </h2>
                        <?php
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM event WHERE id = " . $id;
                        $eventResults = mysqli_query($con, $sql);
                        $event = mysqli_fetch_assoc($eventResults);
                        ?>
                        <form action="update_event.php" method="post" enctype="multipart/form-data"
                            style="margin-top: 20px; margin-bottom: 15px;">
                            <!-- enctype untuk meng-handle file berupa gambar dan juga text biasa -->
                            <input type="hidden" name="id" value="<?php echo $event['id'] ?>">
                            <label for="customer_name" class="fw-bold">Customer: </label>

                            <input type="text" name="customer_name" id="customer_name" autocomplete="on" required
                                class="form-control text-center" style="width: 70%; margin-bottom: 15px;"
                                value="<?php echo $event['customer_name'] ?>">

                            <label for="event" class="fw-bold">Event: </label>

                            <input type="text" name="event" id="event" autocomplete="on" required
                                class="form-control text-center" style="width: 70%; margin-bottom: 15px;"
                                value="<?php echo $event['event'] ?>">

                            <label for="capacity" class="fw-bold">Capacity: </label>

                            <input type="text" name="capacity" id="capacity" autocomplete="on" required
                                class="form-control text-center" style="width: 70%; margin-bottom: 15px;"
                                value="<?php echo $event['capacity'] ?>">

                            <label for="date" class="fw-bold">Date: </label>

                            <input type="date" name="date" id="date" autocomplete="on" required
                                class="form-control text-center" style="width: 70%; margin-bottom: 15px;"
                                value="<?php echo $event['date'] ?>">

                            <label for="status" class="fw-bold">Status: </label>

                            <select name="status" id="status" class="form-select"
                                style="text-align: center; width: 70%; margin-bottom: 15px;" required>
                                <?php
                                if ($event['status'] == 0) {
                                    ?>
                                    <option selected value="0">
                                        No
                                    </option>
                                    <option value="1">
                                        Yes
                                    </option>
                                    <?php
                                } elseif ($event['status'] == 1) {
                                    ?>
                                    <option selected value="1">
                                        Yes
                                    </option>
                                    <option value="0">
                                        No
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>

                            <input type="submit" value="Submit" name="submit" class="btn btn-primary">
                            <br>
                            <div style="color: red;">
                                <?php
                                if (isset($_SESSION['date_error']) == true) {
                                    echo $_SESSION['date_error'];
                                    $_SESSION['date_error'] = "";
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