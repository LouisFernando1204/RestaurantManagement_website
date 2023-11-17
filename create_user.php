<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'restaurant');
if (mysqli_connect_errno()) {
    echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['input_data'] = $_POST;
    $name = htmlspecialchars($_POST['name']);
    $username = strtolower(stripslashes(htmlspecialchars($_POST['username'])));
    $password = mysqli_real_escape_string($con, htmlspecialchars($_POST['password']));
    $confirm_password = mysqli_real_escape_string($con, htmlspecialchars($_POST['confirm_password']));
    $user = $_POST['user_id'];
    $actor = $_POST['actor_id'];
    $uploadOk = 1;
    if (isset($_POST["submit"])) {
        $sql = "SELECT * FROM users  WHERE username = '$username'";
        $userResults = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($userResults);
        if (mysqli_num_rows($userResults) > 0) {
            $_SESSION['username_error'] = "<br>" . "Username has been used by someone else.";
            $uploadOk = 0;
        }
        if ($password !== $confirm_password) {
            $_SESSION['password_error'] = "<br>" . "Password confirmation does not match." . "<br>";
            $uploadOk = 0;
        }
        $referer = $_SERVER['HTTP_REFERER'];
        if ($uploadOk == 0) {
            echo "
            <script language='javascript'>
                alert('Account for $name hasn\\'t been created.');
                window.location.href = '$referer';
            </script>
            ";
        } else {
            $password_hashed = md5($password);
            $sql = "INSERT INTO `users`(`name`, `username`, `password`, `user_id`, `actor_id`) VALUES ('$name','$username','$password_hashed','$user','$actor')";
            $createUsersData = mysqli_query($con, $sql);
            echo "
            <script language='javascript'>
                alert('Account for $name has been successfully created.');
                window.location.href = 'CRUDusers.php';
            </script>
            ";
        }
    }
}

mysqli_close($con);
?>