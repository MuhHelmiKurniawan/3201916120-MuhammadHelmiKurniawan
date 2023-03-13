<?php
session_start();
//koneksi database
$koneksi = new mysqli("localhost","root","","pempek");

if (!isset($_SESSION['admin']))
{
    echo "<script>alert('Anda Harus Login');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pempek Ummi - Administrator</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">ADMINISTRATOR</a>
            </div>
            <div style="color: #fff;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"><?php echo $_SESSION["admin"]["nama_lengkap"] ?> &nbsp; <a href="index.php?halaman=logout" class="btn btn-danger square-btn-adjust"><i class="fa fa-sign-out fa-1x"></i> LOGOUT</a></div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">	
                <li class="text-center">
                    <img src="assets/img/logo4.png" class="user-image img-responsive"/>
                    </li>			
                    <li><a href="index.php"><i class="fa fa-tachometer fa-2x"></i> DASHBOARD</a></li>
                    <li><a href="index.php?halaman=menu"><i class="fa fa-copy fa-2x"></i> PRODUK</a></li>
                    <li>
                        <a href="index.php?halaman=kategori"><i class="fa fa-filter fa-2x"></i> KATEGORI</a>
                    </li>
                    <li><a href="index.php?halaman=pembelian"><i class="fa fa-book fa-2x"></i> PEMBELIAN</a></li>
                    <li><a href="index.php?halaman=laporan_pembelian"><i class="fa fa-file fa-2x"></i> LAPORAN</a></li>
                    <li><a href="index.php?halaman=pelanggan"><i class="fa fa-users fa-2x"></i> PELANGGAN</a></li>
                    <li class="treeview">
                        <a href="#">
                            <i class="glyphicon glyphicon-cog fa-2x"></i>
                            <span> PENGATURAN</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="index.php?halaman=slider"><i class="glyphicon glyphicon-fast-forward"></i> GANTI FOTO SLIDER</a></li>
                        </ul>
                        <ul class="treeview-menu">
                            <li><a href="index.php?halaman=register"><i class="fa fa-plus"></i> TAMBAH ADMIN</a></li>
                        </ul>
                    </li>
                    <li></li>

                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <?php 
                if (isset($_GET['halaman']))
                {
                    if ($_GET['halaman']=="menu") 
                    {
                        include 'menu.php';
                    }
                    elseif ($_GET['halaman']=="pembelian") 
                    {
                        include 'pembelian.php';
                    }
                    elseif ($_GET['halaman']=="pelanggan") 
                    {
                        include 'pelanggan.php';
                    }
                    elseif ($_GET['halaman']=="detail") 
                    {
                        include 'detail.php';
                    }
                    elseif ($_GET['halaman']=="tambahmenu") 
                    {
                        include 'tambahmenu.php';
                    }
                    elseif ($_GET['halaman']=="tambahpelanggan") 
                    {
                        include 'tambahpelanggan.php';
                    }
                    elseif ($_GET['halaman']=="hapusmenu") 
                    {
                        include 'hapusmenu.php';
                    }
                    elseif ($_GET['halaman']=="hapuspelanggan") 
                    {
                        include 'hapuspelanggan.php';
                    }
                    elseif ($_GET['halaman']=="ubahproduk") 
                    {
                        include 'ubahproduk.php';
                    }
                    elseif ($_GET['halaman']=="logout") 
                    {
                        include 'logout.php';
                    }
                    elseif ($_GET['halaman']=="pembayaran") 
                    {
                        include 'pembayaran.php';
                    }
                    elseif ($_GET['halaman']=="laporan_pembelian") 
                    {
                        include 'laporan_pembelian.php';
                    }
                     elseif ($_GET['halaman']=="kategori") 
                    {
                        include 'kategori.php';
                    }
                    elseif ($_GET['halaman']=="tambahkategori") 
                    {
                        include 'tambahkategori.php';
                    }
                    elseif ($_GET['halaman']=="hapuskategori") 
                    {
                        include 'hapuskategori.php';
                    }
                    elseif ($_GET['halaman']=="ubahkategori") 
                    {
                        include 'ubahkategori.php';
                    }
                    elseif ($_GET["halaman"]=="slider") 
                    {
                        include 'slider.php';
                    }
                    elseif ($_GET["halaman"]=="tambahslider") 
                    {
                        include 'tambahslider.php';
                    }
                    elseif ($_GET["halaman"]=="hapusslider") 
                    {
                        include 'hapusslider.php';
                    }
                    elseif ($_GET["halaman"]=="ubahslider") 
                    {
                        include 'ubahslider.php';
                    }
                    elseif ($_GET["halaman"]=="register") 
                    {
                        include 'register.php';
                    }
                    elseif ($_GET["halaman"]=="pagepending") 
                    {
                        include 'pagepending.php';
                    }


                }
                else
                {
                    include 'home.php';
                }
                ?>
            </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
