<h2>Ubah Kategori</h2>
<?php
$ambil=$koneksi->query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
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
		<label>Nama Kategori</label>
		<input type="text" class="form-control" name="nama_kategori" value="<?php echo $pecah['nama_kategori']; ?>">
	</div>
	<button class="btn btn-primary" name="ubah">Simpan</button>
</form>
<?php 
if (isset($_POST['ubah'])) 
{
	{
		$koneksi->query("UPDATE kategori SET nama_kategori='$_POST[nama_kategori]' WHERE id_kategori='$_GET[id]' ");
	}
	echo "<script>alert('Data Telah Diubah');</script>";
	echo "<script>location='index.php?halaman=kategori';</script>";
}
?>