<!doctype html>
<html lang="en" id="home">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assests/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assests/css/style.css">

    <title>E LEARNING</title>
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
          <div class="navbar-header">
           <h3>Institut Teknologi</h3>
          </div>
      </div>
    </nav>
    <!-- akhir navbar -->
    
    <!-- jumbotron -->
    <div class="jumbotron">
    <!-- form -->
    <div class="col-sm-5 col-sm-offset-1">
    </div>
    <div class="col-sm-5">
      <div class="content-register">
        <div class="container">
        <div class="row">
          <div class="pull-right">
            <p>Sudah punya akun <a href="http://localhost/elearning" class="btn btn-primary navbar-btn">LOGIN</a></p>
          </div>
        </div>
        <form action="http://localhost/elearning/index.php/register/index" method="post">
          <div class="row">
            <div class="col-25">
              <label for="status">Status</label>
            </div>
            <div class="col-75">
              <select id="status" name="status">
                <option value="mahasiswa">Mahasiswa</option>
                <option value="dosen">Dosen</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="fname">NIP/NPM</label>
            </div>
            <div class="col-75">
              <input type="text" id="nomor" name="nomor" value="<?php  echo $npm;?>" required autocomplete="off" readonly>
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="nama">Name</label>
            </div>
              <div class="col-75">
              <input type="text" id="nama" name="nama" placeholder="Your name.. " required autocomplete="off" autofocus>
            </div>
          </div>
          <div class="row">
            <div class="col-25">
              <label for="lname">Password</label>
            </div>
            <div class="col-75">
              <input type="text" id="pass" name="pass" placeholder="Your Password ..." required autocomplete="off">
            </div>
          </div>
          <br>
          <div class="row">
            <input type="submit" value="Submit" name="btnsubmit">
          </div>
        </form>
        </div>    
      </div>
    </div>
    <!-- akhir form -->
    </div>
    <!-- akhir jumbotron -->

    <!-- Conten -->
    <div class="content">
      <p></p>
    </div>
    <!-- Akhir Conten -->
    <!-- footer -->
    <div class="footer">
      <p>&copy; copyright 2018 | built by. <a href="http://instagram.com/nurzahabi">Nur Widianto</a></p>
    </div>
    <!-- akhir footer -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assests/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assests/js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assests/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assests/js/script.js"></script>   
  </body>
</html>