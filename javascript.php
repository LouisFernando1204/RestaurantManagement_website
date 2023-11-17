<!DOCTYPE html>
<html lang="en">
<!-- tag script dapat diletakkan di bagian head atau body tergantung kebutuhan kalau di head 
berarti script tsb akan dieksekusi sebelum content html dibuat (untuk function biasanya) kalau di bagian body berarti 
setelah content dibuat baru script akan dijalankan (untuk ngedit bagian html dan css nya) -->
<!-- -- untuk memisahkan file javascript dapat dibuat filenya sendiri kemudian letakkan semua tag script yang pernah dibuat ke dalam file tersebut
kemudian import file tersebut di file html/php yang membutuhkan javascript itu (dengan: <script src="script.js"></script>) -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar Javascript</title>
    <script src=" https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- ini untuk catatan saja -->
    <script language="javascript">
        // Mengakses elemen <head>
        var headElement = document.head;
        // Mengakses elemen <body>
        var bodyElement = document.body;
        // Menghitung panjang judul (title) dokumen
        var titleLength = document.title.length;
        console.log("Head Element:", headElement);
        console.log("Body Element:", bodyElement);
        console.log("Title Length:", titleLength);

        // itu nanti diakses dengan bantuan ini:
        getElementById():
        // Mengembalikan elemen pertama dengan atribut id tertentu.Dalam contoh ini, kita mengambil elemen dengan ID "myElement":  
        var element = document.getElementById("myElement");

        getElementsByName():
        // Mengembalikan kumpulan elemen dengan atribut name tertentu.Ini biasanya digunakan untuk mengambil elemen - elemen dalam bentuk, seperti radio buttons atau checkboxes:
        var elements = document.getElementsByName("myName");

        getElementsByClassName():
        // Mengembalikan kumpulan elemen dengan kelas tertentu.Ini berguna untuk memilih beberapa elemen yang memiliki kelas yang sama:
        var elements = document.getElementsByClassName("myClass");

        querySelector():
        // Mengembalikan elemen pertama yang sesuai dengan selektor CSS tertentu.Selektor CSS didefinisikan sebagai argumen.Dalam contoh ini, kita mengambil elemen dengan ID "myElement":
        var element = document.querySelector("#myElement");

        querySelectorAll():
        // Mengembalikan kumpulan elemen yang sesuai dengan selektor CSS tertentu.Selektor CSS didefinisikan sebagai argumen.Ini mengembalikan semua elemen yang cocok, bukan hanya yang pertama:
        var elements = document.querySelectorAll(".myClass");

    </script>
    <style type="text/css">
        .red {
            color: red;
        }

        .blue {
            color: blue;
        }
    </style>
</head>

<body>
    <p id="p2">Hello World!</p>
    <h1 id="id01">Old Heading</h1>
    <p>Click the button to display the date.</p>
    <button onclick="displayDate()">The time is?</button>
    <p id="demo"></p>
    <div onmouseover="mOver(this)" onmouseout="mOut(this)"
        style="background-color:#D94A38;width:120px;height:20px;padding:40px;">
        Mouse Over Me</div>
    <h2>Hello, jQuery!</h2>
    <h2>Hello, Louis</h2>
    <button id='btnOuch'>Say Ouch</button>
    <button id='btnHideBlue'>Hide Blue</button>
    <button id='btnColor'>Add blue!</button>
    <button id='btnColorCheck'>Alert color!</button>
    <button id='btnToggle'>Toggle Slide!</button>
    <button id='btnFade'>Fade out!</button>
    <button id='btnReplace'>Replace!</button>
    <p class="blue" style="color: blue;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint tempore ratione
        maxime nam, deleniti nemo
        consectetur ea deserunt dignissimos dolores sequi rerum eligendi, ipsa saepe sapiente quisquam accusantium
        architecto exercitationem.
    <p id="lemon">Lemon drops biscuit chocolate…</p>
    <h1>INI ADALAH HEADER 1</h1>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsam omnis repellendus eius nihil deserunt aliquam in!
        Hic, molestiae a voluptates cum porro nihil odit ducimus enim distinctio soluta exercitationem rerum.</p>
    </p>

    <!-- ini script kalau pakai jQuery -->
    <script>
        $("#btnOuch").click(
            function () {
                alert("Ouch! That hurt.");
            }
        );
        $("h2").click(
            function () {
                $(this).hide("fast");
            }
        );
        $("#btnHideBlue").click(function () {
            $("p.blue").hide("slow");
        });
        $("#lemon").mouseover(
            function () {
                $(this).append("Cookie!");
            }
        );
        $("#btnColor").click(function () {
            $("#lemon").addClass("blue");
        });
        $("#btnColorCheck").click(function () {
            alert($("#lemon").css("color"));
        });
        $("p").mouseover(function () {
            $(this).css("background-color", "yellow");
        });
        $("#btnToggle").click(function () {
            $("#lemon").slideToggle("slow");
        });
        $("#btnFade").click(function () {
            $("#lemon").fadeTo("slow", 0.5);
        });
        $("#btnReplace").click(function () {
            $("#lemon").after("Lollipop soufflé ice cream tootsie roll donut...");
        });
    </script>

    <!-- ini script jika ngga pakai jQuery -->
    <script language="javascript">
        // CONTOH DOM HTML
        document.getElementById("id01").innerHTML = "New Heading";

        // CONTOH DOM CSS
        document.getElementById("p2").style.color = "blue";

        // CONTOH DOM event onclick
        function displayDate() {
            document.getElementById('demo').innerHTML = Date();
            // -- kalau Date() ini untuk menampilkan tanggal dan waktu lengkap sekarang kalau date() untuk memformat tanggal dan waktu
        }

        // CONTOH DOM EVENT hover
        function mOver(obj) {
            obj.innerHTML = 'Thank you';
        }
        function mOut(obj) {
            obj.innerHTML = 'Mouse Over Me';
        }
    </script>
</body>

</html>