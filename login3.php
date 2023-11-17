<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "restaurant");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);
    // -- ini untuk menghindari SQL Injection/karakter-karakter khusus yang diinput oleh user

    $sql = "SELECT us.*, us.user_id as user_id, us.name as user_name, act.name as actors_name FROM users us, actors act WHERE us.actor_id = act.id AND username='$username' AND password='$password'";
    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['login'] = true;
        $_SESSION['actors_name'] = $row['actors_name'];
        $_SESSION['user_name'] = $row['user_name'];
        $_SESSION['user_id'] = $row['user_id'];
        if (isset($_POST['remember_me'])) {
            $years_inputed = 100;
            setcookie('id', $row['user_id'], time() + ($years_inputed * 365 * 24 * 60 * 60));
            setcookie('key', hash('sha256', $row['user_name']), time() + ($years_inputed * 365 * 24 * 60 * 60));
        }
        header('location:home.php');
    } else {
        $_SESSION['error_message'] = '<b>' . 'Unknown username or password' . '</b>';
        header('location:index.php');
    }
}
// else {
//     $error = true;
// } -- sebenarnya tidak perlu

mysqli_close($con);
?>