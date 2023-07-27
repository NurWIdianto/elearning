<!-- content -->
<div class="content-dosen">
  <div class="container">
    <div class="col-sm-6 col-sm-offset-1">
      <h2 class="text-center">Daftar Mata Kuliah</h2>
      <div class="table-responsive">          
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center">Mata Kuliah</th>
              <th class="text-center">Lihat</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($matkul as $row) {
            ?>
            <tr>
              <td class="text-center"><?php echo $row->nama; ?></td>
              <td class="text-center"><a href="http://localhost/elearning/index.php/index/tambah_lama_respon/<?php echo $row->id_mt; ?>" class="btn btn-success" role="button">tambah</a></td>
            </tr>          
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="btn-group">
        <a href="http://localhost/elearning/index.php/index/dosen" class="btn btn-warning" role="button">Kembali</a>
      </div>
    </div>
    <div class="col-sm-4">
    </div>
  </div>
</div>
<!-- akhri conten -->
