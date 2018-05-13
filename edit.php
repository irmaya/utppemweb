
<script type="text/javascript" src="crud.js"></script>

<form class="form-horizontal" action="eds.php" enctype="multipart/form-data" method="post">    
<?php
include('dbcon.php');

include_once 'exc.php';

if($_GET['edit_id'])
{
	$id = $_GET['edit_id'];	
	$stmt=$db_con->prepare("SELECT * FROM mahasiswa WHERE id=:id");
	$stmt->execute(array(':id'=>$id));	
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
}

$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysql_query("SELECT * FROM mahasiswa where id='$id[$i]'");
	while($row = mysql_fetch_array($result))
	  { ?>
	  <div class="thumbnail">
	<div class="control-group">
    <label class="control-label" for="inputEmail">NPM/NIM/KTP</label>
    <div class="controls">
 	<input name="id[]" type="hidden" value="<?php echo  $row['id'] ?>" />
		<input name="npm[]" type="text" value="<?php echo $row['npm'] ?>" />
    </div>
    </div>
	
	<div class="control-group">
    <label class="control-label" for="inputEmail">Nama</label>
    <div class="controls">
		<input name="nama[]" type="text" value="<?php echo $row['nama'] ?>" />
    </div>
    </div>

		<div class="control-group">
    <label class="control-label" for="inputEmail">Jurusan</label>
    <div class="controls">
		<input name="jurusan[]" type="text" value="<?php echo $row['jurusan'] ?>" />
    </div>
    </div>
	
		<div class="control-group">
    <label class="control-label" for="inputEmail">Tempat Lahir</label>
    <div class="controls">
		<input name="tempat_lahir[]" type="text" value="<?php echo $row['tempat_lahir'] ?>" />
    </div>
    </div>
	
			<div class="control-group">
    <label class="control-label" for="inputEmail">Tanggal Lahir</label>
    <div class="controls">
		<input name="tanggal_lahir[]" type="text" value="<?php echo $row['tanggal_lahir'] ?>" />
    </div>
    </div>
	<div class="control-group">
    <label class="control-label" for="inputEmail">Alamat</label>
    <div class="controls">
		<input name="alamat[]" type="text" value="<?php echo $row['alamat'] ?>" />
    </div>
    </div>
	<div class="control-group">
    <label class="control-label" for="inputEmail">Photo</label>
    <div class="controls">
		<input name="gambar" type="file" value="<?php echo $row['photo'] ?>" />
    </div>
    </div>
	<div class="control-group">
    <label class="control-label" for="inputEmail">Password</label>
    <div class="controls">
		<input name="password[]" type="text" value="<?php echo $row['password'] ?>" />
    </div>
    </div>
	</div>

	<br>
	

	
	  
	  <?php 
	  }
}

?>
<input name="ubah" class="btn btn-success" type="submit" value="Simpan">
</form>
</div>
</body>
</html>