<!-- form -->
<div class="content-dosen-upload">
  <div class="container">
    <h2 class="text-center">Form Upload File</h2>
    <form action="http://localhost/elearning/index.php/upload" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col-25">
          <label for="fname">Mata Kuliah</label>
        </div>
        <div class="col-75">
            <?php
              foreach ($nama_matakuliah as $row) {
            ?>
          <input type="text" id="fname" name="mata_kuliah" placeholder="<?php echo $row->nama; ?>" required autocomplete="off" readonly>
            <?php } ?>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="lname">Keterangan</label>
        </div>
        <div class="col-75">
          <input type="text" id="fname" name="keterangan" placeholder="Input Keterangan ..." required autocomplete="off" autofocus>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="lname">Pilih File yang akan diupload</label>
        </div>
        <div class="col-25">
          <div class="btn-group">
            <input type="file" value="Browse File" name="userfile" class="btn btn-info">
            <div class="alert alert-light" role="alert">
              File hanya bertipe doc,ppt,avi,3gp
            </div>
          </div>
          <div class="btn-group">
             <input type="submit" value="Upload" name="btnsubmit" class="btn btn-warning">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-25">
           <label for="lname"></label>
        </div>
        <div class="col-75">
          <div class="btn-group">
           
          </div> 
        </div> 
      </div>
    </form>
  </div>
</div>
<!-- akhri form -->
    
  