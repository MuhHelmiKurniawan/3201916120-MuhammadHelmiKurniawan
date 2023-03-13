<?php  
session_start();
//koneksi ke database
$koneksi = new mysqli("localhost","root","","pempek");
$ambil=$koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]' "); 
$detail=$ambil->fetch_assoc();
?>

<!-- jika pelanggan yang beli tidak sama dengan pelanggan yang login, maka akan di larikan ke riwayat.php karena dia tidak berhak melihat nota orang lain -->
<!-- pelanggan yang beli harus pelanggan yang login -->
<?php  
//mendapatkan id_pelanggan yang beli
$idpelangganyangbeli = $detail["id_pelanggan"];

//mendapatkan id_pelanggan yang login
$idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

if ($idpelangganyangbeli!==$idpelangganyanglogin) 
{
	echo "<script>alert('jangan nakal!!!'); </script>";
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
	<title>Nota - Pempek Ummi</title>
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
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Nota Pembelian</h3>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-3">
						<h5 class="nota-title">Pempek Ummi</h5>
						<p>
							<i class="fa fa-map-marker"></i> Jl.Kenanga Sanggau Permai,Kota Sanggau<br>
							<i class="fa fa-mobile"></i> 0812-5880-5036 <br>
							<i class="fab fa-instagram"></i> @pempekummi.id <br>
						</p>

					</div>
					<div class="col-md-3">
						<h5 class="nota-title">Pembelian</h5>
						<p>
							Tanggal <i class="fa fa-calendar"></i> <?php echo $detail['tanggal_pembelian']; ?> <br>
							Status <span class="btn btn-danger btn-sm">
								<?php echo $detail["status_pembelian"]; ?>
							</span>
						</p>
					</div>
					<div class="col-md-3">
						<h5 class="nota-title">Pelanggan</h5>
						<p>
							<i class="fa fa-user"></i> <?php echo $detail['nama_pelanggan'];?> <br>
							<i class="fa fa-phone"></i> <?php echo $detail['kontak_pelanggan']; ?> <br>
							<i class="fa fa-envelope"></i> <?php echo $detail['email_pelanggan']; ?>
						</p>
					</div>
					<div class="col-md-3">
						<h5 class="nota-title">Pengiriman</h5>
						<p>
							Alamat: <strong><?php echo $detail['alamat_pengiriman']; ?></strong>,  <br>
							<strong><?php echo $detail['nama_kota'] ?></strong><br>
							Ongkos Kirim: Rp. <?php echo number_format($detail['tarif']); ?>
						</p>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>NO</th>
								<th>Nama Menu</th>
								<th>Harga</th>
								<th>Jumlah</th>
								<th>Sub Total</th>
							</tr>
						</thead>
						<tbody>
							<?php $nomor=1; ?>
							<?php $ambil=$koneksi->query("SELECT * FROM pembelian_menu WHERE id_pembelian='$_GET[id]' "); ?>
							<?php while($pecah=$ambil->fetch_assoc()){ ?>
							<tr>
								<td><?php echo $nomor ?></td>
								<td><?php echo $pecah['nama']; ?></td>
								<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
								<td><?php echo $pecah['jumlah']; ?></td>
								<td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
							</tr>
							<?php $nomor++; ?>
						<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="alert alert-info">
							Silahkan Melakukan pembayaran sebesar <strong>Rp. <?php echo number_format($detail['total_pembelian']); ?></strong> Ke : <br>
							Bank Mandiri: Rusniar Septinia, 146 00 1315482 3 <br>
							Lalu kirim bukti pembayaran pada halaman pelanggan<br>
							Dapat melakukan Cash On Delivery (COD) jika pembelian diatas mencapai Rp.200.000 konfirmasi melalui nomor 0812-5880-5036
						</div>
					</div>
					<div class="col-md-6">
						<table class="table">
							<?php $ambil=$koneksi->query("SELECT * FROM pembelian_menu WHERE id_pembelian='$_GET[id]' "); ?>
							<?php while($pecah=$ambil->fetch_assoc()){ ?>
							<?php $subtotal=$pecah["harga"]*$pecah["jumlah"]; ?>
							<?php } ?>
							<tr>
								<td>Total Ongkos</td>
								<th> Rp. <?php echo number_format($detail['tarif']); ?></th>
							</tr>
							<tr>
								<td>Total Bayar</td>
								<th>Rp. <?php echo number_format($detail['total_pembelian']); ?></th>
							</tr>
						</table>
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