<h2>Ubah Menu</h2>
<?php
$ambil=$koneksi->query("SELECT * FROM menumakanan WHERE id_menu='$_GET[id]'");
$pecah=$ambil->fetch_assoc();

?>

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
			<option value="<?php echo $value["id_kategori"]; ?>" <?php if($pecah["id_kategori"]==$value["id_kategori"]){echo "selected";} ?> >
				<?php echo $value["nama_kategori"]; ?>
			</option>
			<?php endforeach ?>
		</select>
	</div>
	<div class="form-group">
		<label>Nama</label>
		<input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_menu']; ?>">
	</div>
	<div class="form-group">
		<label>Harga (Rp)</label>
		<input type="number" name="harga" class="form-control" value="<?php echo $pecah['harga_menu']; ?>">
	</div>
	<div class="form-group">
		<img src="../foto_produk/<?php echo $pecah['foto_menu'] ?>" width="200">
	</div>
	<div class="form-group">
		<label>Ganti Foto</label>
		<input type="file" name="foto" class="form-control">
	</div>
	<div class="form-group">
		<label>Tanggal Masuk Barang</label>
		<input type="date" name="tanggal_masuk" class="form-control" value="<?php echo $pecah['tanggal_masuk']; ?>">
	</div>
	<button class="btn btn-primary" name="ubah">Simpan</button>
</form>
<?php 
if (isset($_POST['ubah'])) 
{
	$namafoto=$_FILES['foto']['name'];
	$lokasifoto=$_FILES['foto']['tmp_name'];
	if (!empty($lokasifoto)) 
	{
		move_uploaded_file($lokasifoto, "../foto_produk/$namafoto");

		$koneksi->query("UPDATE menumakanan SET nama_menu='$_POST[nama]',harga_menu='$_POST[harga]',foto_menu='$namafoto',tanggal_masuk='$_POST[tanggal_masuk]',id_kategori='$_POST[id_kategori]' WHERE id_menu='$_GET[id]' ");
	}else
	{
		$koneksi->query("UPDATE menumakanan SET nama_menu='$_POST[nama]',harga_menu='$_POST[harga]',tanggal_masuk='$_POST[tanggal_masuk]',id_kategori='$_POST[id_kategori]' WHERE id_menu='$_GET[id]' ");
	}
	echo "<script>alert('Data Telah Diubah');</script>";
	echo "<script>location='index.php?halaman=menu';</script>";
}
?>