
<!-- content -->
 <div class="content-mahasiswa">
    <div class="container">
        <?php 
            foreach ($matkul as $row) {
               echo "<h2 class='text-center'>Pilih Dosen " .$row->nama. "</h2>";
            } 
        ?>
        <div class="row">
          <?php 
            foreach ($dosen as $row) {
              echo '<div class="col-sm-4 style="width:60%">';
                echo '<div class="thumbnail">';
                  echo "<a href='http://localhost/elearning/index.php/index/proses_pilih_matkul/$row->npd/$id_mt' class='thumbnail' style='width:100%'>";
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
    <br>     
    <br>     
    <br>     
    <br>     
 </div>
<!-- akhir content -->
    

