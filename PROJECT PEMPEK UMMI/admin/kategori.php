<h3>
	Data Kategori
	<a href="index.php?halaman=tambahkategori" class="btn btn-default">Tambah data</a>
</h3>
<hr>

<?php  
$semuadata=array();
$ambil=$koneksi->query("SELECT * FROM kategori");
while ($tiap=$ambil->fetch_assoc())
{
	$semuadata[]=$tiap;
}

// echo "<pre>";
// print_r($semuadata);
// echo "</pre>";
?>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Kategori</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($semuadata as $key => $value): ?>	
		<tr>
			<td><?php echo $key+1 ?></td>
			<td><?php echo $value["nama_kategori"]; ?></td>
			<td>
				<a href="index.php?halaman=ubahkategori&id=<?php echo $pecah['id_kategori'];?>" class="btn btn-warning">Ubah</a>
				<a href="index.php?halaman=hapuskategori&id=<?php echo $tiap['id_kategori'];?>" class="btn btn-danger">Hapus</a>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>