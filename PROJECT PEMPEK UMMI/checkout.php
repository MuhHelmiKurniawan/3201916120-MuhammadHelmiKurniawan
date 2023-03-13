<?php
session_start();
//koneksi database
$koneksi = new mysqli("localhost","root","","pempek");
// jk tidak ada session pelanggan(blm login)mk dilarikan ke login.php
if (!isset($_SESSION["pelanggan"])) 
{
	echo "<script>alert('Silahkan login terlebih dahulu');</script>";
	echo "<script>location='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Checkout - Pempek Ummi</title>
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
						<li><i class="fab fa-instagram"></i></i> @PempekUmmi</li>
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

				<!-- awal tabel keranjang -->
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Checkout</h3>
					</div>
					<div class="box-body">
						<div class="table-responsive">
							<table class="table table-bordered table-hover table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Produk</th>
										<th>Harga</th>
										<th>Jumlah</th>
										<th>Subharga</th>
									</tr>
								</thead>
								<tbody>
									<?php $nomor=1; ?>
									<?php $totalbelanja=0; ?>
									<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
									<!-- menampilkan produk yang sedang diperulangkan berdasarkan id_produk -->
									<?php 
									$ambil=$koneksi->query("SELECT * FROM menumakanan WHERE id_menu='$id_produk' "); 
									$pecah=$ambil->fetch_assoc();
									$subharga=$pecah["harga_menu"]*$jumlah;
									?>
									<tr>
										<td><?php echo $nomor; ?></td>
										<td><?php echo $pecah["nama_menu"]; ?></td>
										<td>Rp. <?php echo number_format($pecah["harga_menu"]); ?></td>
										<td><?php echo $jumlah; ?></td>
										<td>Rp. <?php echo number_format($subharga); ?></td>
									</tr>
									<?php $nomor++; ?>
									<?php $totalbelanja+=$subharga; ?>
									<?php endforeach ?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="4">Total Belanja</th>
										<th>Rp. <?php echo number_format($totalbelanja) ?></th>
									</tr>
								</tfoot>
							</table>

							<form method="post">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?>" class="form-control">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]["kontak_pelanggan"] ?>" class="form-control">
										</div>
									</div>
									<div class="col-md-4">
										<select class="form-control" name="id_ongkir">
											<option value="">Pilih Ongkos Kirim</option>
											<?php
											$ambil = $koneksi->query("SELECT * FROM ongkir");
											while($perongkir = $ambil->fetch_assoc()){
											?>
											<option value="<?php echo $perongkir["id_ongkir"] ?>">
												<?php echo $perongkir['nama_kota'] ?> -
												Rp. <?php echo number_format($perongkir['tarif'])  ?>
											</option>
											<?php } ?>
										</select>
									</div>
									<label>&nbsp;</label><br>
								</div>
									<div class="form-group">
										<label>Alamat Lengkap Pengiriman "termasuk kode pos" </label>
										<textarea class="form-control" name="alamat_pengiriman" placeholder="masukkan alamat lengkap pengiriman(termasuk kode pos) "></textarea>
									</div>	
								<button class="btn btn-primary" name="checkout"><i class="fa fa-chevron-circle-right"></i> Checkout</button>
							</form>
							<?php 
							if (isset($_POST["checkout"])) 
							{
							 	$id_pelanggan=$_SESSION["pelanggan"]["id_pelanggan"];
							 	$id_ongkir=$_POST["id_ongkir"];
							 	$tanggal_pembelian=date("Y-m-d");
							 	$alamat_pengiriman=$_POST['alamat_pengiriman'];

							 	$ambil=$koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
							 	$arrayongkir=$ambil->fetch_assoc();
							 	$nama_kota=$arrayongkir['nama_kota'];
							 	$tarif=$arrayongkir['tarif'];

							 	$total_pembelian=$totalbelanja + $tarif;
							 	//1. menyimpan data ke tabel pembelian
							 	$koneksi->query("INSERT INTO pembelian (id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,nama_kota,tarif,alamat_pengiriman) VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif','$alamat_pengiriman') ");
							 	// mendapatkan id_pembelian barusan terjadi
							 	$id_pembelian_barusan=$koneksi->insert_id;

							 	foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) 
							 	{
							 		//mendapatkan data produk berdasarkan id_produk
							 		$ambil=$koneksi->query("SELECT * FROM menumakanan WHERE id_menu='$id_produk' ");
							 		$perproduk=$ambil->fetch_assoc();

							 		$nama=$perproduk['nama_menu'];
							 		$harga=$perproduk['harga_menu'];

							 		$subharga=$perproduk['harga_menu']*$jumlah;
							 		$koneksi->query("INSERT INTO pembelian_menu(id_pembelian,id_menu,nama,harga,subharga,jumlah) VALUES ('$id_pembelian_barusan','$id_produk','$nama','$harga','$subharga','$jumlah') ");
							 	}
							 	// mengkosongkan keranjang belanja
							 	unset($_SESSION["keranjang"]);
							 	//tampilan dialihkan ke halaman nota, nota dari pembellian yang barusan
							 	echo "<script>alert('pembelian sukses');</script>";
							 	echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
							} 
							?>
						</div>
					</div>
				</div>
				<!-- akhir tabel keranjang -->

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
			</div>
			<div class="col-md-3 col-md-pull-9">
				 
				<!-- awal sidebar kategori -->
				<div class="panel panel-color">
					<div class="panel-heading">
						<h3 class="panel-title">Kategori</h3>
					</div>
					<div class="list-group">
						<a href="lenjer.php" class="list-group-item"><i class="fas fa-utensils"></i></i> Lenjer</a>
						<a href="KapalSelam.php" class="list-group-item"><i class="fas fa-utensils"></i></i> Kapal Selam Besar</a>
						<a href="KapalSelamTelurAsin.php" class="list-group-item"><i class="fas fa-utensils"></i></i> Kapal Selam Telur Asin</a>
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