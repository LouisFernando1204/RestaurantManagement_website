<?php
$con = mysqli_connect('localhost', 'root', '', 'restaurant');
if (mysqli_connect_errno()) {
    echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
}
$id = $_GET['id'];
$sql = "DELETE FROM users WHERE id= " . $id;
$deleteUserData = mysqli_query($con, $sql);

$referer = $_SERVER['HTTP_REFERER'];
echo "
    <script language='javascript'>
        alert('User has been successfully deleted.');
        window.location.href = '$referer';
    </script>
";
mysqli_close($con);
?>