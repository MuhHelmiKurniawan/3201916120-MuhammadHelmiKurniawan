<?php  
session_start();
//koneksi ke database
$koneksi = new mysqli("localhost","root","","pempek");
//dapatkan produk dari url
$id_produk=$_GET["id"];
//query diambil data
$ambil=$koneksi->query("SELECT * FROM menumakanan WHERE id_menu='$id_produk' ");
$detail=$ambil->fetch_assoc();

// echo "<pre>";
// print_r($detail);
// echo "</pre>";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Detail - Pempek Ummi</title>
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/font-awesome/css/fontawesome-all.css">
	<link rel="stylesheet" href="assets/owlcarousel/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/owlcarousel/assets/owl.theme.default.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Open+Sans:wght@700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="assets/dist/css/style2.css">
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

				<!-- awal area detail produk -->
				<div class="box">
					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<div class="image-product">	
									<img src="foto_produk/<?php echo $detail["foto_menu"]; ?>" class="img-responsive desc-img">
								</div>
							</div>
							<div class="col-md-6">
								<h1 class="desc-product-title"><?php echo $detail["nama_menu"]; ?></h1>
								<span class="desc-product-price">Rp. <?php echo number_format($detail["harga_menu"]); ?></span>
								
								<form method="post" >
									<div class="form-group">
										<div class="input-group">
											<input type="number" name="jumlah" min="1" class="form-control" name="jumlah">
											<div class="input-group-btn">
												<button class="btn btn-primary" name="beli">
													<i class="fa fa-shopping-bag"></i> Beli
												</button>
											</div>
										</div>
									</div>
								</form>
								<?php  
								if (isset($_POST["beli"])) 
								{
									$jumlah=$_POST["jumlah"];
									$_SESSION["keranjang"][$id_produk]=$jumlah;

									echo "<script>alert('produk telah masuk ke keranjang belanja');</script>";
									echo "<script>location='keranjang.php';</script>";
								}
								?>
							</div>
						</div>
					</div>
				</div>
				<!-- awal slider produk -->
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Produk Terkait</h3>
						<div class="box-tools" id="letaknavproduk">
							
						</div>
					</div>
					<div class="box-body">
						<div class="owl-carousel slider-produk owl-theme">
							<?php $ambil = $koneksi->query("SELECT * FROM menumakanan WHERE id_kategori = '".$detail['id_kategori']."'"); ?>
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