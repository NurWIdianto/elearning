<!doctype html>
<html lang="en" id="home">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assests/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assests/css/style2.css">

    <title>MAHASIWA</title>
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
    <div class="content-komentar-mahasiswa">
      <div class="container">
        <div class    ="col-sm-6">
            <div class="mengisi">
            <a href       ="http://localhost/elearning/index.php/index/matkul_mahasiswa/<?php echo $this->session->userdata('npd');?>" class="btn btn-warning" role="button">Kembali</a>
            <h2>Daftar Mata Kuliah</h2>
            <div class    ="table-responsive">          
              <table class  ="table table-bordered">
                <thead>
                  <tr>
                    <th>Nama Dosen</th>
                    <th>Mata Kuliah</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($upload_dosen as $row) {
                  ?>
                  <tr>
                  <td><?php echo $row->nama; ?></td>
                  <td><?php echo $row->nama_matkul; ?></td>
                  <td><?php echo $row->keterangan; ?></td>
                  </tr>          
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <form class   ="form-inline" action="http://localhost/elearning/index.php/index/komentar_mahasiswa2/" method="post">
              <div class    ="input-group">
                <input type   ="text" class="form-control input-lg" placeholder="Isikan Komentar...." name="komentar">
                <span class   ="input-group-btn">
                <button class ="btn btn-default btn-lg" type="submit" name="btnsubmit">Kirim</button>
                </span>
              </div>
            </form>
          </div>
        </div>
        <div class="col-sm-6">
            <div class="komentar">
            <h1 class="text-center">Komentar</h1>
            <div class="row">
            <?php
            foreach ($komentar as $row) {
            if ($row->status == "dosen") {
            ?>
            <hr>
            <div class="media">
            <div class="media-left media-top">
            <img src="<?php echo base_url(); ?>./assests/image/avatar.png"  style="width:60px">
            </div>
            <div class="media-body">
            <h4 class="media-heading text-capitalize"><?php   echo $row->nama; ?></h4>
            <p><?php  echo $row->komentar; ?></p>
            </div>
            </div>
            <br>
            <br>
            <?php }else{ ?>
            <hr>
            <div class="media">
            <div class="media-right media-body">
            <h4 class="media-heading text-right text-capitalize"><?php   echo $row->nama; ?></h4>
            <p class="text-right"><?php  echo $row->komentar; ?></p>
            </div>
            <div class="media-right media-top">
            <img src="<?php echo base_url(); ?>./assests/image/avatar.png"  style="width:60px">
            </div>
            </div>
            <br>
            <br>
            <?php } ?>
            <?php   }; ?>
            </div>
          </div>
        </div>
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