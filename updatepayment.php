<?php
$con = mysqli_connect('localhost', 'root', '', 'restaurant');
if (mysqli_connect_errno()) {
    echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
}
$id = $_GET['id'];

$sql = "SELECT status FROM selling WHERE id =" . $id;
$statusResults = mysqli_query($con, $sql);
$status = mysqli_fetch_assoc($statusResults);

if ($status['status'] == 0) {
    $sql = "UPDATE `selling` SET `status`='1' WHERE id = " . $id;
    $update_to_Unpaid = mysqli_query($con, $sql);
} elseif ($status['status'] == 1) {
    $sql = "UPDATE `selling` SET `status`='0' WHERE id = " . $id;
    $update_to_Paid = mysqli_query($con, $sql);
}

// / Mendapatkan referer (halaman sebelumnya) untuk kembali ke halaman tersebut setelah update
$referer = $_SERVER['HTTP_REFERER'];

// Redirect kembali ke halaman referer
header("Location: $referer");

mysqli_close($con);
?>