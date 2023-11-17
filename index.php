<?php
session_start();
$con = mysqli_connect('localhost', 'root', '', 'restaurant');
if (mysqli_connect_errno()) {
	echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
}
if (isset($_COOKIE['id']) == true && isset($_COOKIE['key']) == true) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	$sql = "SELECT name FROM users WHERE id = " . $id;
	$userResults = mysqli_query($con, $sql);

	$row = mysqli_fetch_assoc($userResults);
	// ini pakai === biar lebih akurat untuk membandingkan/mencocokkan datanya
	if ($key === hash('sha256', $row['name'])) {
		$_SESSION['login'] = true;
	}
}

if (isset($_SESSION['login']) == true) {
	header('location:home.php');
	exit;
}
?>
<!-- jika ingin tiap aktor yang beda role mempunyai halaman sendiri maka harus dicek seperti ini:
session_start();
if (isset($_SESSION['login']) == true) {
	if(isset($_SESSION['actors_name']) == true)
		if ($_SESSION['actors_name'] == 'chef') {
			header('location:food.php');
			exit;
		}
} -->

<html>

<head>

	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel='icon' href='uploads/favicon.ico' type='image/x-icon' sizes="16x16" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nama+Font&display=swap">

	<title>Welcome to Puede Resto</title>
	<style>
		body {
			font-family: 'Montserrat', sans-serif;
			background-image: url('uploads/food_cover3.jpg');
			background-size: cover;
			/* untuk mengatur tampilan gambar latar belakang */
		}
	</style>
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col" style="padding: 0px;">
				<?php
				include('navigation.php');
				?>
			</div>
		</div>
		<div class="row">
			<div class="col" style="padding: 0px;">
				<center>
					<div class="card"
						style="text-align: center; padding: 10px; border-radius: 8px; border: 1px solid grey; box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.8); width: 30%; margin-top: 40px; margin-bottom: 40px;">
						<center>
							<img src="uploads/waitress-icon.png" class="img-fluid" alt="Waitress Login Here"
								style="width: 300px;">
							<h2 class="mb-1 mt-2" style="font-weight: bold;">
								Login Here
							</h2>
							<form action="login3.php" method="post" style="width: 100%;">
								<div class="mb-2 mt-2">
									<input type="text" class="form-control" id="exampleInputEmail1"
										aria-describedby="emailHelp" placeholder="Username" name="username"
										autocomplete="off" style="width: 80%;">
								</div>
								<div class="mb-3">
									<input type="password" class="form-control" id="exampleInputPassword1"
										placeholder="Password" name="password" style="width: 80%;">
								</div>
								<div class="mb-3">
									<input class="form-check-input" type="checkbox" value="" name="remember_me"
										style="margin-right: 5px;">
									<label class="form-check-label" for="flexCheckDefault">
										Remember me
									</label>
								</div>
								<input type="submit" class="btn btn-primary" name="login" value="Login">
							</form>
							<?php
							if (isset($_SESSION['error_message'])) {
								echo $_SESSION['error_message'];
								$_SESSION['error_message'] = "";
								// $_SESSION = [];
								// session_unset();
								// session_destroy();
							}
							?>
						</center>
					</div>
				</center>
			</div>
		</div>
		<div class="row bg-dark">
			<div class="col" style="padding: 0px;">
				<div id="footer bg-dark" style="color: white; padding: 20px; text-align: right">
					Copyright © Puede Resto
				</div>
			</div>
		</div>
	</div>
	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
		crossorigin="anonymous"></script>
</body>

</html>
<?php
mysqli_close($con);
?>