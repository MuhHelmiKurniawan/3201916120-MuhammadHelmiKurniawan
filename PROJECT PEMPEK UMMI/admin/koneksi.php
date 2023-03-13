

<?php

date_default_timezone_set("Asia/Jakarta");
$tgl_now = date("Y-m-d");
$bln_now = date("m");
$jam_now = date("h:i:sa");
error_reporting(0);

//koneksi ke database
mysql_connect("localhost", "root", "");
mysql_select_db("pempek");
 
 //koneksi ke database
//mysql_connect("localhost", "ahmtsang_ahmt", "ferry.15061996");
//mysql_select_db("ahmtsang_ahmt");
 

?>