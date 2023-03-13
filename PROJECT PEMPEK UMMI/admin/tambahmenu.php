<h2>Tambah Menu</h2>
<?php 
$datakategori=array();

$ambil=$koneksi->query("SELECT * FROM kategori");
while ($tiap=$ambil->fetch_assoc()) 
{
	$datakategori[]=$tiap;
}
// echo "<pre>";
// print_r($datakategori);
// echo "</pre>";
?>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Kategori</label>
		<select name="id_kategori" class="form-control">
			<option value="">Pilih Kategori</option>
			<?php foreach ($datakategori as $key => $value): ?>	
			<option value="<?php echo $value["id_kategori"]; ?>"><?php echo $value["nama_kategori"]; ?></option>
			<?php endforeach ?>
		</select>
	</div>
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" name="nama">
	</div>
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" class="form-control" name="harga">
	</div>
	<div class="form-group">
		<label>Foto</label>
		<input type="file" class="form-control" name="foto">
	</div>
	<div class="form-group">
		<label>Tanggal Masuk Barang</label>
		<input type="date" name="tanggal_masuk" class="form-control">
	</div>
	<button class="btn btn-primary" name="save">Simpan</button>
</form>
<?php 
if (isset($_POST['save']))
{
	$nama = $_FILES['foto']['name'];
	$lokasi =$_FILES['foto']['tmp_name'];
	move_uploaded_file($lokasi, "../foto_produk/".$nama);
	$koneksi->query("INSERT INTO menumakanan
		(nama_menu,harga_menu,foto_menu,tanggal_masuk,id_kategori)
		VALUES('$_POST[nama]','$_POST[harga]','$nama','$_POST[tanggal_masuk]','$_POST[id_kategori]')");

	echo "<div class='alert alert-info'>Data Tersimpan</div>";
	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=menu'>";
}
?>