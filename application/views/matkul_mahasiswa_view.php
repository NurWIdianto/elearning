<!doctype html>
<html lang="en" id="home">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assests/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assests/css/style2.css">

    <title>MAHASISWA</title>
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
          <div class="navbar-header">
           <h3><strong>Mahasiswa</strong></h3>
          </div>
      </div>
      <div class="pull-right">
        <ul class="nav pull-right">
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome,<?php echo $this->session->userdata('username'); ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="http://localhost/elearning/index.php/index/logout"><i class="icon-off"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
      </div>
    </nav>
    <!-- akhir navbar -->

    <!-- content -->
    <div class="content-dosen">
      <div class="container">
        <div class="col-sm-7 col-sm-offset-1">
          <h2 class="text-center">Daftar Mata Kuliah</h2>
          <div class="table-responsive text-center">          
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="text-center">Mata Kuliah</th>
                    <th class="text-center">Lihat</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach ($upload_dosen as $row) {
                  ?>
                  <tr>
                    <td><?php echo $row->nama; ?></td>
                    <td><a href="http://localhost/elearning/index.php/index/komentar_mahasiswa/<?php echo $row->id_mt; ?>" class="btn btn-info" role="button">Lihat</a></td>
                  </tr>          
                  <?php } ?>
                </tbody>
              </table>
          </div> 
          <a href="http://localhost/elearning/index.php/index/mahasiswa" class="btn btn-warning" role="button">Kembali</a>         
        </div>
        <div class="col-sm-3"></div>
      </div>
    </div>
    <!-- akhri conten -->
    

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