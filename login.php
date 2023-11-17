<?php
$con = mysqli_connect("localhost", "root", "", "restaurant");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($con, $sql);

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

if (isset($row['username'])) {
    echo 'Berhasil Login';
} else {
    echo 'Gagal Login';
}
// cek apakah ada kolom username yang sesuai dengan username dan password yang diinputkan oleh user.

// if ($row = mysqli_fetch_assoc($result)) {
//     echo "Berhasil login";
// } else {
//     echo "Gagal login";
// }
// -- if disini berfungsi seperti kita tidak tahu username dan password yang sebenarnya di table user 
// di database, tapi kita cek kalau misal di variable row ini berhasil mendapatkan baris data yang sesuai dengan 
// perintah query berarti benar/berhasil login.

// if (mysqli_num_rows($result) > 0) {
//     echo 'Berhasil Login';
// } else {
//     echo 'Gagal Login';
// }
// Dalam kode ini, kita hanya perlu memeriksa jumlah baris yang dikembalikan oleh hasil kueri. 
// Jika lebih dari 0, berarti ada hasil yang cocok dan kita mencetak "Berhasil Login". 
// Jika tidak, maka mencetak "Gagal Login".

// NOTES dari video:
// CARA LOGIN YANG BENAR!

// session_start();
// require functions.php;

// if(isset($_POST['login'])) {

// $username = $_POST['username'];
// $password = $_POST['password'];

// $result = mysqli_query($conn, 'SELECT * FROM user where username = '$username' AND password = '$password'');

// --cek username:
// if(mysqli_num_rows($result) > 0) {
// --cek password:
// $row = myqli_fetch_assoc($result);
// if(password_verify($password, $row['password'])) {
//     $_SESSION['login'] = true;
//     header('location:index.php');
//     exit;
//     die();
// }
// }
// }
// else {
//     $error = true;
// }
// --> tinggal main if(isset) di file-file lain untuk mengarahkan user ke file yang diinginkan

// UNTUK ENKRIPSI PASSWORD MENDING PAKAI INI:
// $userInputPassword = $_POST['password'];
// $hashedPassword = password_hash($userInputPassword, PASSWORD_DEFAULT);
// // Simpan $hashedPassword di dalam database
// PASSWORD_DEFAULT mengindikasikan bahwa algoritma enkripsi default yang 
// direkomendasikan akan digunakan. Anda juga bisa mengganti PASSWORD_DEFAULT 
// dengan algoritma tertentu, misalnya PASSWORD_BCRYPT jika Anda ingin spesifik menggunakan Bcrypt.

// KALAU MAU CEK PASSWORD GINI:
// $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
// if (password_verify($password, $row['password'])) {
//     // Password cocok
//     // Berikan akses ke user
// } else {
//     // Password salah
//     // Tampilkan pesan kesalahan
// }

mysqli_close($con);
?>