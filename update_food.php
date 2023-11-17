<!-- SIMULASI ARRAY multi-dimensi dari $_FILES:
array(1) {
  ["fileToUpload"]=>
  array(6) {
    ["name"]=>
    string(23) "Halal_Indonesia.svg.png"
    ["full_path"]=>
    string(23) "Halal_Indonesia.svg.png"
    ["type"]=>
    string(9) "image/png"
    ["tmp_name"]=>
    string(24) "C:\xampp\tmp\php8E49.tmp"
    ["error"]=>
    int(0)
    ["size"]=>
    int(18408)
  }
} -->
<!-- var_dump($fileName);
var_dump(basename($fileName));
var_dump(pathinfo($fileName, PATHINFO_EXTENSION));
var_dump(pathinfo($fileName, PATHINFO_FILENAME));
------------------------------------------------------
string(38) "cropped-Lisahwan-Logo-Gold-512x512.png"
string(38) "cropped-Lisahwan-Logo-Gold-512x512.png"
string(3) "png"
string(34) "cropped-Lisahwan-Logo-Gold-512x512" -->


<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'restaurant');
if (mysqli_connect_errno()) {
    echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
}

// untuk menerima data berupa text atau angka
$id = $_POST['id'];
$food_drink_name = htmlspecialchars($_POST['food_drink']);
$descriptions = htmlspecialchars($_POST['descriptions']);
$sell_price = htmlspecialchars($_POST['sell_price']);
$buy_price = htmlspecialchars($_POST['buy_price']);
$categories = $_POST['categories'];
$foodDrink_old = $_POST['foodDrink_old'];

if (isset($_POST["submit"])) {
    if ($_FILES['foodDrink']['error'] == 4) {
        $fileName = $foodDrink_old;
        $sql = "UPDATE `food` SET `name`='$food_drink_name',`descriptions`='$descriptions',`sell_price`='$sell_price',`buy_price`='$buy_price',`category_id`='$categories',`image`='$fileName' WHERE id = " . $id;
        $updateFoodData = mysqli_query($con, $sql);
        echo "
        <script language='javascript'>
           alert('$food_drink_name has been successfully updated.');
           window.location.href = 'CRUDfood.php';
       </script>
       ";
    } else {
        // untuk menerima data berupa file(gambar)
        // jadi intinya sebelum data berupa gambar dimasukkan ke dalam database, 
        // maka akan disimpan terlebih dahulu di folder direktori saat ini dan nama file gambar 
        // tersebut yang nantinya akan dimasukkan ke database.
        $fileName = $_FILES['foodDrink']['name'];
        $fileType = strtolower(pathinfo(($fileName), PATHINFO_EXTENSION));
        // pathinfo() akan mengembalikan ekstensi/tipe atau bisa nama dari file tersebut.
        $fileTmp_Name = $_FILES['foodDrink']['tmp_name'];
        $fileSize = $_FILES['foodDrink']['size'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($fileName);
        // basename() akan mengembalikan nama file asli tanpa path atau direktori.

        // Check if image file is a actual image or fake image
        // getimagesize($fileTmp_Name) -- harus di tmp_name untuk mendapatkan infromasi tentang gambar yaitu: 
        // - Width (lebar) dalam piksel.
        // - Height (tinggi) dalam piksel.
        // - MIME type (jenis media) dari gambar, seperti "image/jpeg" untuk JPEG atau "image/png" untuk PNG.
        // - Attribute index, yang digunakan dalam beberapa format gambar tertentu.
        // - HTML-style string yang berisi dimensi dan jenis media, seperti "width="100" height="100"".
        $check = getimagesize($fileTmp_Name);
        if ($check !== false) {
            $_SESSION['fileIsImg'] = "<br>" . "File is an image - " . $check["mime"] . "." . "<br>";
            $uploadOk = 1;
        } else {
            $_SESSION['fileNotImg_error'] = "File is not an image." . "<br>";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $_SESSION['fileExist_error'] = "File already exists." . "<br>";
            $uploadOk = 0;
        }

        // Check file size
        // 1.000.000 byte = 1 mb
        if ($fileSize > 500000) {
            $_SESSION['fileSize_error'] = "Sorry, your file is too large." . "<br>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif") {
            $_SESSION['fileType_error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed." . "<br>";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "
            <script language='javascript'>
                alert('Sorry, $food_drink_name hasn\\'t been updated.');
                window.location.href = 'updateFood_Drink.php?id=$id';
            </script>
        ";
            // if everything is ok, try to upload file
        } else {
            move_uploaded_file($fileTmp_Name, $target_file);
            $sql = "UPDATE `food` SET `name`='$food_drink_name',`descriptions`='$descriptions',`sell_price`='$sell_price',`buy_price`='$buy_price',`category_id`='$categories',`image`='$fileName' WHERE id = " . $id;
            $updateFoodData = mysqli_query($con, $sql);
            echo "
                 <script language='javascript'>
                    alert('$food_drink_name has been successfully updated.');
                    window.location.href = 'CRUDfood.php';
                </script>
                ";
        }
    }
}

mysqli_close($con);
?>