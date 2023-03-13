<?php 
$ambil=$koneksi->query("SELECT * FROM slider WHERE id_slider='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$foto=$pecah['foto_slider'];
if (file_exists("../foto_slider/$foto")) 
{
	unlink("../foto_slider/$foto");
}

$koneksi->query("DELETE FROM slider WHERE id_slider='$_GET[id]'");

echo "<script>alert('gambar terhapus');</script>";
echo "<script>location='index.php?halaman=slider';</script>";
?>