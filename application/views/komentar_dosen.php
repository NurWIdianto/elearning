<!-- content -->
<div class="content-komentar-dosen">
  <div class="container">
      <!-- style="background-color:rgb(255, 0, 0); -->
      <div class="col-sm-6">
        <h2 class="text-center">Keterangan</h2>
        <div class="table-responsive">          
          <table class="table table-bordered">
            <thead>
            <tr>
            <th class="text-center">Mata Kuliah</th>
            <th class="text-center">Keterangan</th>
            <th class="text-center">Nama File</th>
            <th class="text-center">Download</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($matkul as $row) {
            ?>
            <tr>
              <td class="text-center"><?php echo $row->nama; ?></td>
              <td class="text-center"><?php echo $row->keterangan; ?></td>
              <td class="text-center"><?php echo $row->nama_file; ?></td>
              <td class="text-center">
                <a href="http://localhost/elearning/index.php/index/download_matkul/<?php echo $row->nama_file; ?>" class="btn btn-success" role="button">Download</a>
              </td>
            </tr>          
            <?php } ?>
            </tbody>
          </table>
        </div>
          <div class="btn-group">
            <a href="http://localhost/elearning/index.php/index/upload/<?php echo $id_mt; ?>" class="btn btn-success" role="button">upload</a>
          </div>
          <div class="input-group">
            
          </div>
          <br>
          <form class="form-inline" action="http://localhost/elearning/index.php/index/komentar_dosen2/" method="post">
            <div class="input-group">
              <input type="text" class="form-control input-lg" placeholder="Isikan Komentar...." name="komentar">
              <span class="input-group-btn">
                <button class="btn btn-default btn-lg" type="submit" name="btnsubmit">Kirim</button>
              </span>
            </div>
          </form>
      </div>
      <br>
      <!-- komentar masih error<div class="col-sm-6">
        <h2 class="text-center">Komentar</h2>
        <?php
        foreach ($komentar as $row) {
          if ($row->status == "dosen") {
          ?>
          <hr>
          <div class="media">
            <div class="media-left media-top">
              <img src="<?php echo base_url(); ?>./assests/image/avatar.png"  style="width:60px">
              <h4 class="media-heading text-capitalize text-center"><?php   echo $row->nama; ?></h4>
            </div>
            <div class="media-body">
              <p><?php  echo $row->komentar; ?></p>
            </div>
          </div>
          <br>
          <br>
        <?php }else{ ?>
          <hr>
          <div class="media">
            <div class="media-right media-body">
              <p class="text-right"><?php  echo $row->komentar; ?></p>
            </div>
            <div class="media-right media-top">
              <img src="<?php echo base_url(); ?>./assests/image/avatar.png"  style="width:60px">
              <h4 class="media-heading text-right text-capitalize"><?php   echo $row->nama; ?></h4>
            </div>
          </div>
          <br>
          <br>
        <?php } ?>
        <?php   }; ?>        
      </div>"-->

  </div>
</div>
<!-- akhri conten -->
  