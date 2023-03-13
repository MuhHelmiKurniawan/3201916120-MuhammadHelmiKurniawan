<?php
session_start();
//koneksi database
$koneksi = new mysqli("localhost","root","","pempek");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Login - Pempek Ummi</title>
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/font-awesome/css/fontawesome-all.css">
	<link rel="stylesheet" href="assets/owlcarousel/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/owlcarousel/assets/owl.theme.default.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Open+Sans:wght@700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/dist/css/style.css">
</head>
<body>

<div class="topbar">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-6">
				<div class="contact">
					<ul>
						<li><i class="fa fa-phone"></i> 0812-5880-5036</li>
						<li><i class="fab fa-instagram"></i></i> @pempekummi.id</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<header class="header">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="logo">
					<img src="assets/img/logopempekummi.png" class="img-responsive" width="100">
				</div>
			</div>
			<div class="col-md-6">
			</div>
		</div>
	</div>
</header>
<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target=".naff">
				<span class="sr-only"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="navbar-collapse collapse naff">
			<ul class="nav navbar-nav">
				<li><a href="home.php"><i class="fas fa-home"></i> Home</a></li>
				<li><a href="menu.php"><i class="fas fa-utensils"></i> Menu</a></li>
				<li><a href="keranjang.php"><i class="fas fa-shopping-cart"></i> Keranjang</a></li>
				<li><a href="checkout.php"><i class="fa fa-chevron-circle-right"></i> Check Out</a></li>
				<!-- jika sudah login(ada session pelanggan) -->
				<?php if (isset($_SESSION["pelanggan"])): ?>
					<li><a href="logout.php"><i class="fas fa-sign-in-alt"></i> Logout</a></li>
				<!-- selain itu (blm ada session pelanggan) -->
				<?php else: ?>
					<li><a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
					<li><a href="daftar.php"><i class="fas fa-user-plus"></i> Daftar</a></li>
				<?php endif ?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<!-- jika sudah login(ada session pelanggan) -->
				<?php if (isset($_SESSION["pelanggan"])): ?>
					<li><a href="member.php"><i class="fas fa-user"></i> <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?></a></li>
				<?php endif ?>	
			</ul>
		</div>
	</div>
</nav>
<main class="content">
	<div class="container">
		<div class="row ">
			<div class="col-md-8 col-md-offset-2 ">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Login Pelanggan</h3>
					</div>
					<div class="box-body">
						<form action="" method="post" class="form-horizontal">
							<div class="form-group">
								<label class="control-label col-md-2">Email</label>
								<div class="col-md-8">
									<input type="email" class="form-control" name="email">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2">Password</label>
								<div class="col-md-8">
									<input type="password" class="form-control" name="password">
								</div>
							</div>
							<div class="form-group flex">
								<div class="col-sm-8 col-sm-offset-2 d-flex">
									<button class="btn btn-primary" name="login"><i class="fa fa-paper-plane"></i> Login</button>
									<a href="daftar.php" class="btn btn-primary"><i class="fas fa-user-plus"></i> Daftar</a>
								</div>
								
							</div>
						</form>
					</div>
				</div>
			</div>
			<?php  
			//jika ada tombol login(tombol login ditekan)
			if (isset($_POST["login"])) 
			{
				$email=$_POST["email"];
				$password=$_POST["password"];
				//lakukan query akun di tabel pelanggan di db
				$ambil=$koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password' ");
				//ngitung akun yang terambil
				$akunyangcocok=$ambil->num_rows;
				//jika 1 akun yang cocok, maka diloginkan
				if ($akunyangcocok==1) 
				{
					//anda sudah login
					//mendapatkan akun dalam bentuk array
					$akun = $ambil->fetch_assoc();
					//simpan di session pelanggan
					$_SESSION["pelanggan"]=$akun;
					echo "<script>alert('login sukses, silahkan berbelanja dan nikmati service kami');</script>";
					//jk sudah belanja
					if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"])) 
					{	
						echo "<script>location='checkout.php'</script>";
					}
					else
					{
						echo "<script>location='home.php'</script>";
					}
				}
				else
				{
					//anda gagal login
					echo "<script>alert('anda gagal login, silahkan periksa lagi akun anda');</script>";
					echo "<script>location='login.php'</script>";
				}
			}
			?>
			
		</div>
	</div>
</main>
<footer class="footer">
	<div class="footer-top">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h3 class="footer-title">Tentang Kami</h3>
					<p>
					Pempek Ummi adalah usaha rumahan yang bergerak dibidang kuliner. Pempek Ummi adalah Jasa Pemesanan Makanan. Pempek Ummi dirintis pada tanggal 6 Februari 2022.
					</p>
				</div>
				<div class="col-md-3">
					<h3 class="footer-title">Kontak Kami</h3>
					<ul>
						<li>Telp: 0812-5880-5036</li>
						<li>Instagram: @pempekummi.id</li>
						<li>Alamat: Jl.Kenanga Sanggau Permai,Kota Sanggau</li>
					</ul>
				</div>
				
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="container">Copyright &copy; <strong>Pempekummi.</strong> All Right Reserved</div>
	</div>
</footer>

<!-- script javascrip -->
<script src="assets/dist/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/owlcarousel/owl.carousel.min.js"></script>
<script src="assets/dist/js/buanapetshop.js"></script>
</body>
</html>