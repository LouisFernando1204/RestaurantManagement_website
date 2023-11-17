<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'restaurant');
if (mysqli_connect_errno()) {
    echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['input_data'] = $_POST;
    $customer_name = htmlspecialchars($_POST['customer_name']);
    $event = htmlspecialchars($_POST['event']);
    $capacity = htmlspecialchars($_POST['capacity']);
    $date = $_POST['date'];
    $status = $_POST['status'];
    $uploadOk = 1;

    if (isset($_POST["submit"])) {
        if ($date < date("Y-m-d")) {
            $_SESSION['date_error'] = "<br>" . "Please input the correct date.";
            $uploadOk = 0;
        }
        $referer = $_SERVER['HTTP_REFERER'];
        if ($uploadOk == 0) {
            echo "
            <script language='javascript'>
                alert('$event for $customer_name hasn\\'t been created.');
                window.location.href = '$referer';
            </script>
            ";
        } else {
            $sql = "INSERT INTO `event`(`customer_name`, `event`, `capacity`, `date`, `status`) VALUES ('$customer_name','$event','$capacity','$date','$status')";
            $createEventData = mysqli_query($con, $sql);
            echo "
            <script language='javascript'>
                alert('$event for $customer_name has been successfully created.');
                window.location.href = 'CRUDevent.php';
            </script>
            ";
        }
    }
}
mysqli_close($con);
?>