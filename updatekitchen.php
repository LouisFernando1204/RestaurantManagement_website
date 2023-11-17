<?php
$con = mysqli_connect('localhost', 'root', '', 'restaurant');
if (mysqli_connect_errno()) {
    echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
}

$id = $_POST['id'];
date_default_timezone_set("Asia/Jakarta");
$time_now = date('h:i:s');

if (isset($_POST['finish'])) {
    $sql = "UPDATE `selling` SET `time_finish`='$time_now' WHERE id = " . $id;
    $update_time_finish = mysqli_query($con, $sql);
} elseif (isset($_POST['unfinish'])) {
    $sql = "UPDATE `selling` SET `time_finish`=NULL WHERE id = " . $id;
    // -- sebelum dan sesudah isi dari value time_finish tidak usah diberi 
    // tanda petik satu untuk mengeluarkan defaul value (NULL) yg sudah disetting di database sblmnya.
    $update_time_finish = mysqli_query($con, $sql);
}

// / Mendapatkan referer (halaman sebelumnya) untuk kembali ke halaman tersebut setelah update
$referer = $_SERVER['HTTP_REFERER'];

// Redirect kembali ke halaman referer
header("Location: $referer");

mysqli_close($con);
?>