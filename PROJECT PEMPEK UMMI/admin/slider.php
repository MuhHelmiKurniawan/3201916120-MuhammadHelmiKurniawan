<h2>
	Data Produk
	<a href="index.php?halaman=tambahslider" class="btn btn-primary "><i class="fa fa-plus"></i> Tambah Data</a>
</h2>
<hr>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Tanggal</th>
			<th>Foto Slider</th>
			<th>aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM slider"); ?>
		<?php while($pecah=$ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor ?></td>
			<td><?php echo $pecah['tanggal_slider']; ?></td>
			<td>
				<img src="../foto_slider/<?php echo $pecah['foto_slider']; ?>" width="100">
			</td>
			<td>
				<a href="index.php?halaman=hapusslider&id=<?php echo $pecah['id_slider'];?>" class="btn-danger btn">hapus</a>
				<a href="index.php?halaman=ubahslider&id=<?php echo $pecah['id_slider']; ?>" class="btn-warning btn">ubah</a>
			</td>
		</tr>
		<?php $nomor++; ?>
	<?php } ?>
	</tbody>
</table>