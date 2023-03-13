  
      <div class="col-md-8 col-md-offset-2">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title"></h3>
          </div>
          <div class="box-body">
            <form method="post" class="form-horizontal">
              <div class="form-group">
                <label class="control-label col-md-3">Username</label>
                <div class="col-md-7">
                  <input type="text" class="form-control" name="username" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Password</label>
                <div class="col-md-7">
                  <input type="password" class="form-control" name="password" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Nama Lengkap</label>
                <div class="col-md-7">
                  <input type="text" class="form-control" name="nama" required>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-8 col-md-offset-5">
                  <button class="btn btn-primary" name="daftar"><i class="fa fa-sign-in-alt"></i> Tambah</button>
                </div>
              </div>
            </form>
            <?php  
            //jika ada yang mendaftar
            if (isset($_POST["daftar"])) 
            {
              //mengambil isian nama,email,password,alamat,telepon
              $nama=$_POST["nama"];
              $username=$_POST["username"];
              $password=$_POST["password"];

              //cek apakah email sudah pernah di gunakan
              $ambil=$koneksi->query("SELECT * FROM admin WHERE username='$username' ");
              $yangcocok=$ambil->num_rows;
              if ($yangcocok==1) 
              {
                echo "<script>alert('pendaftaran gagal, email sudah di gunakan');</script>";
                echo "<script>location='daftar.php' ;</script>";
              }
              else
              {
                //query insert ke table pelanggan
                $koneksi->query("INSERT INTO admin (username,password,nama_lengkap) VALUES ('$username','$password','$nama')");

                echo "<script>alert('pendaftaran sukses, silahkan login');</script>";
                echo "<script>location='login.php' ;</script>";
              }
            }
            ?>
          </div>
        </div>
      </div>
                
                
        </div>
    </div>


     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
   
</body>
</html>