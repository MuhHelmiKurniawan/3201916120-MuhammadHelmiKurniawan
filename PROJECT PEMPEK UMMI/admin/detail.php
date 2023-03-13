<h2>Detail Pembelian</h2>
<?php 
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
	ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>


<div class="row">
	<div class="col-md-4">
		<h3>Pembelian</h3>
		<p>
			Tanggal: <?php echo $detail['tanggal_pembelian']; ?> <br>
			Total: Rp. <?php echo number_format($detail['total_pembelian']); ?><br>
			Status: <?php echo $detail['status_pembelian'] ?>
		</p>
	</div>
	<div class="col-md-4">
		<h3>Pelanggan</h3>
		<strong><?php echo $detail['nama_pelanggan'];?></strong><br>
		<p>
			<?php echo $detail['kontak_pelanggan']; ?> <br>
			<?php echo $detail['email_pelanggan']; ?>
		</p>
	</div>
	<div class="col-md-4">
	 	<h3>Pengiriman</h3>
	 	<p>
	 		Alamat : <?php echo $detail["alamat_pengiriman"] ?>

	 	</p>
	</div>
</div>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>NO</th>
			<th>Nama Makanan</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Subtotal</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_menu JOIN menumakanan ON
		 pembelian_menu.id_menu=menumakanan.id_menu
		 WHERE pembelian_menu.id_pembelian='$_GET[id]'"); ?>
		<?php while($pecah=$ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama_menu']; ?></td>
			<td>Rp. <?php echo number_format($pecah['harga_menu']); ?></td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td>
				Rp. <?php echo number_format($pecah['harga_menu']*$pecah['jumlah']); ?>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php }?>
	</tbody>
</table>