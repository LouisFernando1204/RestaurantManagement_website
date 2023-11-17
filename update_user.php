<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'restaurant');
if (mysqli_connect_errno()) {
    echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
}

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = htmlspecialchars($_POST['name']);
    $username = strtolower(stripslashes(htmlspecialchars($_POST['username'])));
    $password = mysqli_real_escape_string($con, htmlspecialchars($_POST['password']));
    $last_password = mysqli_real_escape_string($con, htmlspecialchars($_POST['last_password']));
    $confirm_password = mysqli_real_escape_string($con, htmlspecialchars($_POST['confirm_password']));
    $user = $_POST['user_id'];
    $actor = $_POST['actor_id'];
    $uploadOk = 1;

    if ($last_password != "") {
        $last_password_hashed = md5($last_password);
        $sql = "SELECT * FROM users WHERE password = '$last_password_hashed'";
        $passResults = mysqli_query($con, $sql);
        if (mysqli_num_rows($passResults) == 0) {
            $_SESSION['lastpassword_rejected'] = "<br>" . "Last password is incorrect." . "<br>";
            $uploadOk = 0;
        }
    } else {
        $sql = "SELECT * FROM users WHERE password = '$password'";
        $passOri = mysqli_query($con, $sql);
        if (mysqli_num_rows($passOri) == 0) {
            $_SESSION['updatepass_rejected'] = "<br>" . "Please confirm yang last password first.";
            $uploadOk = 0;
        }
    }
    if ($password !== $confirm_password) {
        $_SESSION['password_error'] = "<br>" . "Password confirmation does not match." . "<br>";
        $uploadOk = 0;
    }
    $referer = $_SERVER['HTTP_REFERER'];
    if ($uploadOk == 0) {
        echo "
            <script language='javascript'>
                alert('Account for $name hasn\\'t been updated.');
                window.location.href = 'updateUsers.php?id=$id';
            </script>
            ";
    } else {
        if ($last_password != "") {
            $password_hashed = md5($password);
        } else {
            $password_hashed = $password;
        }
        $sql = "UPDATE `users` SET `name`='$name',`username`='$username',`password`='$password_hashed',`user_id`='$user',`actor_id`='$actor' WHERE id = " . $id;
        $updateUsersData = mysqli_query($con, $sql);
        echo "
            <script language='javascript'>
                alert('Account for $name has been successfully updated.');
                window.location.href = 'CRUDusers.php';
            </script>
            ";
    }
}

mysqli_close($con);
?>