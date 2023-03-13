<?php  
session_start();
//koneksi ke database
$koneksi = new mysqli("localhost","root","","pempek");

//jika tidak ada session pelanggan (blm login)
if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) 
{
	echo "<script>alert('silahkan login')</script>";
	echo "<script>location='login.php';</script>";
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Riwayat Belanja - Pempek Ummi</title>
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
			<div class="col-md-9 col-md-push-3">

				<!-- awal tabel Riwayat Belanja -->
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Riwayat Belanja <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?></h3>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Tanggal</th>
										<th>Status</th>
										<th>Total</th>
										<th>Opsi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$nomor=1;  
									$id_pelanggan=$_SESSION["pelanggan"]["id_pelanggan"];
									$ambil=$koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan' ");
									while($pecah=$ambil->fetch_assoc()){ 
									?>
									<tr>
										<td><?php echo $nomor; ?></td>
										<td><?php echo $pecah["tanggal_pembelian"]; ?></td>
										<td><?php echo $pecah["status_pembelian"]; ?></td>
										<td>Rp. <?php echo number_format($pecah["total_pembelian"]); ?></td>
										<td>
											<a href="nota.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-info btn-sm">
												<i class="fa fa-file"></i> Nota
											</a>
											<?php if ($pecah['status_pembelian']=="pending"): ?>	
												<a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-success btn-sm">
												<i class="fa fa-file-o"></i> Input Pembayaran
											<?php else: ?>
												<a href="lihat_pembayaran.php?id=<?php echo $pecah["id_pembelian"] ?>" class="btn btn-warning">
													Lihat Pembayaran
												</a>
											<?php endif ?>
											</a>
										</td>
									</tr>
									<?php $nomor++; ?>
								<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- akhir tabel Riwayat Belanja -->
				<!-- awal slider produk -->
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Menu Terbaru</h3>
						<div class="box-tools" id="letaknavproduk"></div>
					</div>
					<div class="box-body">
						<div class="owl-carousel slider-produk owl-theme">
							<?php $ambil = $koneksi->query("SELECT * FROM menumakanan ORDER BY tanggal_masuk DESC LIMIT 20"); ?>
							<?php while($perproduk=$ambil->fetch_assoc()){ ?>
							<div class="text-center">
								<div class="image-product">
									<img src="foto_produk/<?php echo $perproduk['foto_menu']; ?>" alt="">
								</div>
								<h3 class="title-product">
									<a href=""><?php echo $perproduk['nama_menu']; ?></a>
								</h3>
								<span class="price-product">Rp. <?php echo number_format($perproduk['harga_menu']); ?></span>
								<a href="detail.php?id=<?php echo $perproduk['id_menu']; ?>" class="btn btn-color">Detail</a>
								<a href="beli.php?id=<?php echo $perproduk['id_menu']; ?>" class="btn btn-primary" class="btn btn-primary">Beli</a>
							</div>
						<?php } ?>
						</div>
					</div>
				</div>
				<!-- akhir slider produk -->
			</div>
			<div class="col-md-3 col-md-pull-9">
				<!-- awal panel member login -->
				<div class="box">
					<div class="box-body">
						<ul class="list-group">
							<li class="list-group-item">
								<i class="fa fa-user"></i> <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?>
							</li>
							<li class="list-group-item">
								<i class="fa fa-phone"></i> <?php echo $_SESSION["pelanggan"]["kontak_pelanggan"] ?>
							</li>
							<li class="list-group-item">
								<i class="fa fa-envelope"></i> <?php echo $_SESSION["pelanggan"]["email_pelanggan"] ?>
							</li>
						</ul>
					</div>
				</div>
				<!-- akhir panel member -->
			</div>
			<div class="col-md-3 col-md-pull-9">
				 
				<!-- awal sidebar kategori -->
				<div class="panel panel-color">
					<div class="panel-heading">
						<h3 class="panel-title">Kategori</h3>
					</div>
					<div class="list-group">
						<a href="lenjer.php" class="list-group-item"><i class="fas fa-utensils"></i></i>Lenjer</a>
						<a href="KapalSelam.php" class="list-group-item"><i class="fas fa-utensils"></i></i>Kapal Selam Besar</a>
						<a href="KapalSelamTelurAsin.php" class="list-group-item"><i class="fas fa-utensils"></i></i>Kapal Selam Telur Asin</a>
					</div>
				</div>
				<!-- akhir sidebar kategori -->
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