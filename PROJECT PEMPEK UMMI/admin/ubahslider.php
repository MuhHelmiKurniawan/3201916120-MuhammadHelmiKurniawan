<h2>Ubah Slider</h2>
<hr>

<?php  
$ambil=$koneksi->query("SELECT * FROM slider WHERE id_slider='$_GET[id]' ");
$pecah=$ambil->fetch_assoc();

// echo "<pre>";
// print_r($pecah);
// echo "</pre>";
?>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Tanggal</label>
		<input type="date" class="form-control" name="tanggal" value="<?php echo $pecah['tanggal_slider']; ?>">
	</div>
	<div class="form-group">
		<img src="../foto_slider/<?php echo $pecah['foto_slider']; ?>" width="200">
	</div>
	<div class="form-group">
		<label>Ganti Foto</label>
		<input type="file" name="foto" class="form-control">
	</div>
	<button type="submit" class="btn btn-primary" name="ubah">Ubah</button>
</form>

<?php  
if (isset($_POST['ubah'])) 
{
	$namafoto=$_FILES['foto']['name'];
	$lokasifoto=$_FILES['foto']['tmp_name'];
	//jk foto diubah
	if (!empty($lokasifoto)) 
	{
		move_uploaded_file($lokasifoto, "../foto_slider/$namafoto");

		$koneksi->query("UPDATE slider SET foto_slider='$namafoto',tanggal_slider='$_POST[tanggal]' WHERE id_slider='$_GET[id]' ");
	}
	else
	{
		$koneksi->query("UPDATE slider SET tanggal_slider='$_POST[tanggal]' WHERE id_slider='$_GET[id]' ");	
	}
	echo "<script>alert('data slider telah diubah');</script>";
	echo "<script>location='index.php?halaman=slider';</script>";
}
?>