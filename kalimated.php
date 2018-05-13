<?php require_once('Connections/koneksin.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "wordupd")) {
  $updateSQL = sprintf("UPDATE kalimat SET kalimat1=%s, kalimat2=%s, kalimat3=%s, kalimat4=%s, kalimat5=%s, kalimat6=%s WHERE id=%s",
                       GetSQLValueString($_POST['kalimat1'], "text"),
                       GetSQLValueString($_POST['kalimat2'], "text"),
                       GetSQLValueString($_POST['kalima3'], "text"),
                       GetSQLValueString($_POST['kalimat4'], "text"),
                       GetSQLValueString($_POST['kalimat5'], "text"),
                       GetSQLValueString($_POST['kalimat6'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_koneksin, $koneksin);
  $Result1 = mysql_query($updateSQL, $koneksin) or die(mysql_error());

  $updateGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_koneksin, $koneksin);
$query_rekkalimat = "SELECT * FROM kalimat";
$rekkalimat = mysql_query($query_rekkalimat, $koneksin) or die(mysql_error());
$row_rekkalimat = mysql_fetch_assoc($rekkalimat);
$totalRows_rekkalimat = mysql_num_rows($rekkalimat);
?>
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

    
<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="wordupd" id="wordupd">    
	  <div class="thumbnail">
	
	<div class="control-group">
    <label class="control-label" for="inputEmail">Kalimat 1</label>
    <div class="controls">
    <input name="id" type="hidden" value="<?php echo $row_rekkalimat['id']; ?>" class="form-control"/>
    <textarea name="kalimat1" class="form-control"><?php echo $row_rekkalimat['kalimat1']; ?></textarea>
    </div>
    </div>

		<div class="control-group">
    <label class="control-label" for="inputEmail">Kalimat 2</label>
    <div class="controls">
      <textarea name="kalimat2" class="form-control"><?php echo $row_rekkalimat['kalimat2']; ?></textarea>
    </div>
    </div>
	
    		<div class="control-group">
    <label class="control-label" for="inputEmail">Kalimat 3</label>
    <div class="controls">
      <textarea name="kalima3" class="form-control"><?php echo $row_rekkalimat['kalimat3']; ?></textarea>
    </div>
    </div>

		<div class="control-group">
    <label class="control-label" for="inputEmail">Kalimat 4</label>
    <div class="controls">
      <textarea name="kalimat4" class="form-control"><?php echo $row_rekkalimat['kalimat4']; ?></textarea>
    </div>
    </div>

		<div class="control-group">
    <label class="control-label" for="inputEmail">Kalimat 5</label>
    <div class="controls">
      <textarea name="kalimat5" class="form-control"><?php echo $row_rekkalimat['kalimat5']; ?></textarea>
    </div>
    </div>

		<div class="control-group">
    <label class="control-label" for="inputEmail">Kalimat 6</label>
    <div class="controls">
      <textarea name="kalimat6" class="form-control"><?php echo $row_rekkalimat['kalimat6']; ?></textarea>
    </div>
    </div>

	

	<br>
	
<input name="ubah" class="btn btn-success" type="submit" value="Simpan">
<input type="hidden" name="MM_update" value="wordupd" />
</form>
<?php
mysql_free_result($rekkalimat);
?>
