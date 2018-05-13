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

    
<form action="#" method="post" id="simpansei">    
	<div class="control-group">
    <label class="control-label" for="inputEmail">Kode Buku</label>
    <div class="controls">
      <input name="kodeb" type="text" class="form-control" placeholder="A000" required="required" />
    </div>
    </div>
	
	<div class="control-group">
    <label class="control-label" for="inputEmail">Kelompok /Jenis Buku</label>
    <div class="controls">
		<input name="jenisb" type="text" class="form-control" placeholder="Majalah" required="required" />
    </div>
    </div>


	<br>
<input name="ubahe" class="btn btn-success" type="submit" value="Simpan">
</form>
<p>
<div id="dis">
</div>       

</p>