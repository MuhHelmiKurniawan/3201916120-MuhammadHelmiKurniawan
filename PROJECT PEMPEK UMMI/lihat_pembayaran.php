<?php  
session_start();
//koneksi ke database
$koneksi = new mysqli("localhost","root","","pempek");

$id_pembelian=$_GET["id"];

$ambil=$koneksi->query("SELECT * FROM pembayaran LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian 
	WHERE pembelian.id_pembelian='$id_pembelian' ");
$detbay=$ambil->fetch_assoc();

// echo "<pre>";
// print_r($detbay);
// echo "</pre>";

if (empty($detbay)) 
{
	echo "<script>alert('belum ada data pembayaran');</script>";
	echo "<script>location='member.php';</script>";
	exit();
}
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
if ($_SESSION["pelanggan"]['id_pelanggan']!=$detbay["id_pelanggan"]) 
{
	echo "<script>alert('anda tidak berhak');</script>";
	echo "<script>location='member.php';</script>";
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Lihat Pembayaran - Pempek Ummi</title>
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
		<div class="row">
			<div class="col-md-6">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Lihat Pembayaran</h3>
					</div>
					<div class="box-body">
						<table class="table">
							<tr>
								<th>Nama</th>
								<td><?php echo $detbay["nama"]; ?></td>
							</tr>
							<tr>
								<th>Bank</th>
								<td><?php echo $detbay["bank"]; ?></td>
							</tr>
							<tr>
								<th>Tanggal</th>
								<td><?php echo $detbay["tanggal"]; ?></td>
							</tr>
							<tr>
								<th>Jumlah</th>
								<td>Rp. <?php echo number_format($detbay["jumlah"]); ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Bukti Pembayaran</h3>
					</div>
					<div class="box-body">
						<img src="bukti_pembayaran/<?php echo $detbay["bukti_pembayaran"]; ?>" class="img-responsive">
					</div>
				</div>
			</div>
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