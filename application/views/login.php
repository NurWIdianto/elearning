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
    
    <!-- jumbotron -->
    <div class="jumbotron login">
      <div class="col-sm-5 col-sm-offset-1">
      </div>
      <div class="col-sm-5">
      <!-- form -->
        <div class="content-login">
          <div class="container">
            <h2 class="text-center">Form Login</h2>
            <form action="http://localhost/elearning/index.php/index" method="post">
              <div class="row">
                <div class="col-25">
                  <label for="Status">Status</label>
                </div>
                <div class="col-75">
                  <select id="status" name="status">
                    <option value="dosen">Dosen</option>
                    <option value="mahasiswa">Mahasiswa</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-25">
                <label for="fname">NIP/NPM</label>
          </div>
          <div class  ="col-75">
            <input type ="text" id="fname" name="nomor" placeholder="Your NIP/NPM... " required autocomplete="off">
          </div>
          </div>
          <div class="row">
            <div class  ="col-25">
              <label for  ="lname">Password</label>
            </div>
            <div class  ="col-75">
              <input type ="text" id="lname" name="pass" placeholder="Your Password ..." required autocomplete="off" >
            </div>
          </div>
          <br>
          <div class="row">
            <input type="submit" value="Submit" name="btnsubmit">
          </div>
          <br>
          <div class="row">
             <p>Tidak punya <a href="http://localhost/elearning/index.php/index/proses_registrasi" class="btn btn-info btn-sm">
              <span class="glyphicon glyphicon-registration-mark"></span> Daftar
            </a></p>
          </div>
          </form>
          </div>
        </div>
      </div>
    <!-- akhir form -->
    </div>
    <!-- akhir jumbotron -->
    <!-- content -->
    <div class="content login">
    </div>
    <!-- akhir content -->
