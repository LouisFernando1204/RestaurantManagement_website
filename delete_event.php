<?php
$con = mysqli_connect('localhost', 'root', '', 'restaurant');
if (mysqli_connect_errno()) {
    echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
}
$id = $_GET['id'];
$sql = "DELETE FROM event WHERE id= " . $id;
$deleteEventData = mysqli_query($con, $sql);

$referer = $_SERVER['HTTP_REFERER'];
echo "
    <script language='javascript'>
        alert('Event has been successfully deleted.');
        window.location.href = '$referer';
    </script>
";
mysqli_close($con);
?>