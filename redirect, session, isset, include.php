<?php
// REDIRECT
header('location:food.php');
// exit;
// die();
// fungsinya adalah untuk mengarahkan (redirect) pengguna ke halaman baru. 
// pemanggilan header() dilakukan sebelum tag <html> atau pada awal skrip PHP (pokonya sebelum ada output apa")
// Dalam contoh header("location:food.php"), 
// kita menggunakan header Location untuk mengarahkan pengguna ke halaman food.php.
// Dengan menambahkan exit/die setelah pemanggilan header() salah satu saja,
// Anda memastikan bahwa eksekusi skrip akan berhenti secara tiba-tiba setelah redirect, 
// dan tidak akan ada kode berlebihan yang dieksekusi.
?>



<?php
// SESSION
// adalah mekanisme untuk penyimpanan informasi ke dalam variabel agar bisa digunakan 
// di lebih dari satu halaman file.php
// ketika menyimpan nilai ke dalam variable session maka sudah disimpan ke dalam server (pasti aman)
// - harus menjalankan session_start(); di bagian atas file terlebih dahulu setiap ingin menggunakan session
// CONTOH:

// at halaman1.php
session_start();
$_SESSION['name'] = 'Louis Fernando';

// at halaman2.php
session_start();
echo $_SESSION['name'];

// sesi akan hilang/berakhir ketika browser ditutup atau laptop direstart. 
// jadi jika page browser itu ditutup lalu buka lagi maka akan tetap ada.

// bisa juga dengan menggunakan cara berikut, jadi ketika pindah ke halaman 3 maka sesi akan dihapus/direset jadi kosong. kalau mau start lagi harus ke sesi 2 dulu.:
// at halaman3.php
session_start();
session_destroy();
// -- session_destory(); digunakan untuk menghancurkan segala variable session yang ada/pernah dibuat. 
// istilahnya adalah direstart dari awal jadi kosong.
// bisa pakai session_unset(); dan $_SESSION = []; secara bersamaan untuk jaga-jaga biar session benar-benar dihapus/direset.
?>



<?php
//ISSET
// untuk cek apakah suatu variable sudah ada atau belum ada, apakah sudah ada isi nilainya atau belum
// mengembalikan true jika ada dan false jika belum ada

// ada 2 cara menuliskan fungsi isset:
if (isset($_POST['name']) && isset($_POST['age'])) {
    // isi kode...
}
if (!isset($_POST['name']) && !isset($_POST['age'])) {
    // isi kode...
}

if (isset($_POST['name']) == true && isset($_POST['age']) == true) {
    // isi kode...
}
if (isset($_POST['name']) == false && isset($_POST['age']) == false) {
    // isi kode...
}

// (isset($_POST['name'] == true)) bisa diganti dengan (isset($name))
// karena $_POST['name'] sudah dimasukkan dalam $name
// $name = $_POST['name'];
?>



<?php
// INCLUDE , REQUIRE
// digunakan untuk  menyisipkan (include) file eksternal ke dalam skrip PHP utama sehingga memudahkan membaca kode dan lebih efektif.

include('navigation.php');

// ada 4 macam yaitu:
// -- include(): Digunakan untuk menyisipkan file eksternal ke dalam skrip PHP utama. 
// Jika file yang di-include tidak ditemukan, PHP akan memberikan peringatan (warning) 
// dan melanjutkan eksekusi skrip.

// -- include_once(): Sama seperti include, tetapi hanya akan menyisipkan file sekali saja. 
// Jika file tersebut telah di-include sebelumnya, maka PHP akan mengabaikan pernyataan ini. 
// Ini mencegah adanya duplikasi penyisipan file yang sama.

// -- require(): Digunakan untuk menyisipkan file eksternal ke dalam skrip PHP utama. 
// Jika file yang di-require tidak ditemukan, PHP akan memberikan kesalahan fatal (fatal error) 
// dan menghentikan eksekusi skrip.

// -- require_once(): Sama seperti require, tetapi hanya akan menyisipkan file sekali saja. 
// Jika file tersebut telah di-require sebelumnya, maka PHP akan mengabaikan pernyataan ini. 
// Ini mencegah adanya duplikasi penyisipan file yang sama.

// Jika file yang di-include tidak ditemukan, include akan memberikan peringatan 
// dan melanjutkan eksekusi, sementara require akan memberikan kesalahan fatal dan 
// menghentikan eksekusi skrip.
?>