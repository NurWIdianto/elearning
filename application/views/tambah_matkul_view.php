<!-- form -->
<div class="content-dosen-upload">
  <div class="container">
    <div class="col-sm-6">
    </div>
    <div class="col-sm-6">
      <h2 class="text-center">Form Tambah Mata Kuliah</h2>
      <form action="http://localhost/elearning/index.php/upload" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col-25">
          <label for="fname">ID Matkul</label>
        </div>
        <div class="col-75">
          <input type="text" id="fname" name="id_matkul" placeholder="Input Mata Kuliah ..." required autocomplete="off">
        </div>
      </div>
      <div class="row">
        <div class="col-25">
          <label for="lname">Nama</label>
        </div>
        <div class="col-75">
          <input type="text" id="fname" name="nama" placeholder="Input Mata Kuliah ..." required autocomplete="off">
        </div>
      </div>
      <div class="row">
        <div class="col-25">
        </div>
        <div class="col-75">
          <div class="btn-group">
            <br>
            <input type="submit" value="Upload" name="btnsubmit" class="btn btn-primary  btn-lg">
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- akhri form -->
    
  