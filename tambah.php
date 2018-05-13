 <?php
include('dbcon.php');
 ?>

 <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
     <link rel="stylesheet" href="assets/smoothness/jquery-ui.css">
    
    <script type="text/javascript" src="assets/js/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/jquery-1.9.1.js"></script>
   <script src="assets/js/jquery-ui.js"></script>
   <script type="text/javascript" src="crud.js"></script>

    <script>
  $(function() {
    $( "#tglku" ).datepicker({
     changeMonth:true,
     changeYear:true,
     yearRange:"-100:+0",
     dateFormat:"dd MM yy"
  });
  });
  </script>

<form action="tambah_save.php" enctype="multipart/form-data" method="post">    
	  <div class="thumbnail">
	<div class="control-group">
    <label class="control-label" for="inputEmail">NPM</label>
    <div class="controls">
 	<input name="id" type="hidden"/>
		<input name="npm" type="text" class="form-control" />
    </div>
    </div>
	
	<div class="control-group">
    <label class="control-label" for="inputEmail">Nama</label>
    <div class="controls">
		<input name="nama" type="text" class="form-control" />
    </div>
    </div>

		<div class="control-group">
    <label class="control-label" for="inputEmail">Jurusan</label>
    <div class="controls">
		<input name="jurusan" type="text" class="form-control"/>
    </div>
    </div>
	
		<div class="control-group">
    <label class="control-label" for="inputEmail">Tempat Lahir</label>
    <div class="controls">
		<input name="tempat_lahir" type="text" class="form-control"/>
    </div>
    </div>
	
			<div class="control-group">
    <label class="control-label" for="inputEmail">Tanggal Lahir</label>
    <div class="controls">
		<input name="tanggal_lahir" type="text" id="tglku" class="form-control" />
    </div>
    </div>
	<div class="control-group">
    <label class="control-label" for="inputEmail">Alamat</label>
    <div class="controls">
		<input name="alamat" type="text" class="form-control" />
    </div>
    </div>
	<div class="control-group">
    <label class="control-label" for="inputEmail">Photo</label>
    <div class="controls">
		<input name="gambar" type="file" />
    </div>
    </div>
	<div class="control-group">
    <label class="control-label" for="inputEmail">Password</label>
    <div class="controls">
		<input name="password" type="text" class="form-control" />
    </div>
    </div>
	</div>

	<br>
<input name="ubah" class="btn btn-success" type="submit" value="Simpan">
</form>
