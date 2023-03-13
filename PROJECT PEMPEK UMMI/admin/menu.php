<h2>
	Data Menu Makanan
	<a href="index.php?halaman=tambahmenu" class="btn btn-primary "><i class="fa fa-plus"></i> Tambah Data</a>
</h2>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Kategori</th>
			<th>Nama</th>
			<th>Harga</th>
			<th>Tanggal Masuk Barang</th>
			<th>Foto</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM menumakanan LEFT JOIN kategori on menumakanan.id_kategori=kategori.id_kategori"); ?>
		<?php while($pecah=$ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor ?></td>
			<td><?php echo $pecah['nama_kategori']?></td>
			<td><?php echo $pecah['nama_menu']; ?></td>
			<td>Rp. <?php echo number_format($pecah['harga_menu']); ?></td>
			<td><?php echo $pecah['tanggal_masuk']; ?></td>
			<td>
				<img src="../foto_produk/<?php echo $pecah['foto_menu']; ?>" width="100">
			</td>
			<td>
				<a href="index.php?halaman=hapusmenu&id=<?php echo $pecah['id_menu'];?>" class="btn-danger btn">Hapus</a>
				<a href="index.php?halaman=ubahproduk&id=<?php echo $pecah['id_menu']; ?>" class="btn-warning btn">Ubah</a>
			</td>
		</tr>
		<?php $nomor++; ?>
	<?php } ?>
	</tbody>
</table>