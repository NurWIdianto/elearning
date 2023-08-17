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
     <div class="content-mahasiswa">
        <div class="container">
            <h2 class="text-center">Pilih Dosen</h2>
            <div class="row">
              <?php 
                foreach ($rows as $row) {
                  echo '<div class="col-sm-4 style="width:60%">';
                    echo '<div class="thumbnail">';
                      echo "<a href='http://localhost/elearning/index.php/index/matkul_mahasiswa/$row->npd' class='thumbnail' style='width:100%'>";
                        echo '<img src="http://localhost/elearning/assests/image/dosen.png" style="width:60%">';
                        echo '<div class="caption">';
                          echo '<p class="text-center">' . $row->nama . '</p>';
                        echo '</div>';
                      echo '</a>';
                    echo '</div>';
                  echo '</div> ';           
                } 
              ?>
            </div>
        </div>      
     </div>
    <!-- akhir content -->
    

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