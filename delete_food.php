<?php
$con = mysqli_connect('localhost', 'root', '', 'restaurant');
if (mysqli_connect_errno()) {
    echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
}
$id = $_GET['id'];
$sql = "DELETE FROM food WHERE id= " . $id;
$deleteFoodData = mysqli_query($con, $sql);

$referer = $_SERVER['HTTP_REFERER'];
echo "
    <script language='javascript'>
        alert('Food has been successfully deleted.');
        window.location.href = '$referer';
    </script>
";
mysqli_close($con);
?>