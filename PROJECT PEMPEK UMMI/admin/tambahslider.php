<h2>Tambah Slider</h2> 
<hr>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Tanggal</label>
		<input type="date" class="form-control" name="tanggal">
	</div>
	<div class="form-group">
		<label>Foto Slider</label>
		<input type="file" class="form-control" name="foto">
	</div>
	<button type="submit" class="btn btn-primary" name="save">Simpan</button>
</form>
<?php 
if (isset($_POST['save'])) 
{
 	$nama=$_FILES['foto']['name'];
 	$lokasi=$_FILES['foto']['tmp_name'];
 	move_uploaded_file($lokasi, "../foto_slider/".$nama);
 	$koneksi->query("INSERT INTO slider (foto_slider,tanggal_slider)
 		VALUES('$nama','$_POST[tanggal]')");

 	echo "<div class='alert alert-info'>Data Tersimpan</div>";
 	echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=slider'>";
} 
?>