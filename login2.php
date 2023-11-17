<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "restaurant");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    // -- (TEKNIK ENKRIPSI PASSWORD JADI STRING LAIN YANG RANDOM) ada juga password_hash() yang lebih aman dan password yang sudah di hash tdk dapat diubah 
    // jdi data asli lagi. kalau md5 masih bisa mangkannya ga aman.

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($password = $row['password']) {
            // -- sebenarnya ngga usah dicek lagi passwordnya nggapapa karena sudah dicek di $sql
            // -- kalau mau dicek passwordnya dulu mending di $sql nya cuma SELECT * FROM users;
            $_SESSION['login'] = true;
            header('location:home.php');
        }
    } else {
        $_SESSION['error_message'] = '<b>' . 'Unknown username or password' . '</b>';
        header('location:index.php');
    }
} else {
    $error = true;
}

mysqli_close($con);
?>