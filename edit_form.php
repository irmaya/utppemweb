<?php require_once('Connections/koneksin.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "loguser.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

mysql_select_db($database_koneksin, $koneksin);
$query_rekusr = "SELECT * FROM loginmi";
$rekusr = mysql_query($query_rekusr, $koneksin) or die(mysql_error());
$row_rekusr = mysql_fetch_assoc($rekusr);
$totalRows_rekusr = mysql_num_rows($rekusr);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Aplikasi Perpustakaan</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
     <link rel="stylesheet" href="assets/smoothness/jquery-ui.css">
    
    <script type="text/javascript" src="assets/js/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/jquery-1.9.1.js"></script>
   <script src="assets/js/jquery-ui.js"></script>

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

</head>
<body>
   <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a  class="navbar-brand" href="#">perpusline 

                </a>
            </div>

            <div class="notifications-wrapper">
<ul class="nav">
               
                
              
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user-plus"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="profile.php"><i class="fa fa-user-plus"></i> My Profile</a>
                        </li>
                    </ul>
                </li>
            </ul>
            </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav  class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <div class="user-img-div">
                            <img src="<?php echo "foto/". $row_rekusr['photo']?>" alt="" onerror="this.src = 'foto/users_1.png';" class="img-circle" width="143" height="139"/>

                           
                        </div>

                    </li>
                     <li>
                       <center> <a  href="#"> <strong> <?php echo $row_rekusr['nama']; ?> </strong></a></center>
                    </li>

                     <li>
                        <a class="active-menu" href="index.php"><i class="fa fa-code "></i>Anggota Baru</a>
                    </li>
                   
                    <li>
                        <a href="#"><i class="fa fa-sitemap "></i>Menu <span class="fa arrow"></span></a>
                         <ul class="nav nav-second-level">
                            <li>
                                <a href="#" id="view-x"><i class="fa fa-list "></i>Daftar Anggota</a>
                            </li>
                             <li>
                                <a href="#" id="cetak-x"><i class="fa fa-print"></i>Cetak Kartu</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-book "></i>Buku <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                                    <li> <a href="#" id="buku-x"><i class="fa fa-archive "></i>Input Buku</a>
                    </li>
                    <li> <a href="#" id="bukuedit-x"><i class="fa fa-list-ol "></i>Tabel Buku</a>
                    </li>
                   <li>
                                        <a href="#" id="pinjam-x"><i class="fa fa-arrow-circle-o-right "></i>Peminjaman</a>
                                    </li>
 
 <li>
                                        <a href="#" id="kembali-x"><i class="fa fa-arrow-circle-o-left "></i>Pengembalian</a>
                                    </li>                                   
                                    <li>
                                        <a href="#" id="kodebuku-x"><i class="fa fa-check-circle"></i>Kode Buku</a>
                                    </li>
                            <li>
                                        <a href="#">About</a>
                                    </li>        
                </ul>
                </li>
                </ul>
            </div>

        </nav>
        <!-- /. SIDEBAR MENU (navbar-side) -->
        <div id="page-wrapper" class="page-wrapper-cls">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Edit Anggota </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           FORM PERPUSTAKAAN DAN ANGGOTA
                        </div>
                        <div class="panel-body">
                        <div class="content-loader">
<form class="form-horizontal" action="eds.php" enctype="multipart/form-data" method="post">    
<?php
include('dbcon.php');


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
		<input name="npm[]" type="text" value="<?php echo $row['npm'] ?>" class="form-control" />
    </div>
    </div>
	
	<div class="control-group">
    <label class="control-label" for="inputEmail">Nama</label>
    <div class="controls">
		<input name="nama[]" type="text" value="<?php echo $row['nama'] ?>" class="form-control"/>
    </div>
    </div>

		<div class="control-group">
    <label class="control-label" for="inputEmail">Jurusan/Kelas</label>
    <div class="controls">
		<input name="jurusan[]" type="text" value="<?php echo $row['jurusan'] ?>" class="form-control"/>
    </div>
    </div>
	
		<div class="control-group">
    <label class="control-label" for="inputEmail">Tempat Lahir</label>
    <div class="controls">
		<input name="tempat_lahir[]" type="text" value="<?php echo $row['tempat_lahir'] ?>" class="form-control"/>
    </div>
    </div>
	
			<div class="control-group">
    <label class="control-label" for="inputEmail">Tanggal Lahir</label>
    <div class="controls">
		<input name="tanggal_lahir[]" type="text" value="<?php echo $row['tanggal_lahir'] ?>" class="form-control" id="tglku"/>
    </div>
    </div>
	<div class="control-group">
    <label class="control-label" for="inputEmail">Alamat</label>
    <div class="controls">
		<input name="alamat[]" type="text" value="<?php echo $row['alamat'] ?>" class="form-control"/>
    </div>
    </div>
	<div class="control-group">
    <label class="control-label" for="inputEmail">Photo (upload ulang jika edit) max 2mb</label>
    <div class="controls">
		<input name="gambar" type="file" value="<?php echo $row['photo'] ?>" />
    </div>
    </div>
	<div class="control-group">
    <div class="controls">
		<input name="password[]" type="hidden" value="<?php echo $row['password'] ?>" class="form-control"/>
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
<br>
<div id="dis"></div>       
                            
</div>
</div>
                      </div>
                    </div>
                </div>
</div>
         
    <footer >
        &copy; 2016 <a href="http://skysoftware.co.nf">skysoftware</a> | By : <a href="http://www.designbootstrap.com/" target="_blank">DesignBootstrap</a>
    </footer>
    <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
<script type="text/javascript" src="crud.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	
	$("#view-x").click(function(){
		$(".content-loader").fadeOut('slow', function()
		{
			$(".content-loader").fadeIn('slow');
			$(".content-loader").load('edita.php');
			$("#view-x").hide();
			$("#cetak-x").show();
		});
	});
	
	
		});
		$("#cetak-x").click(function(){
		$(".content-loader").fadeOut('slow', function()
		{
			$(".content-loader").fadeIn('slow');
			$(".content-loader").load('cetak.php');
			$("#cetak-x").hide();
			$("#view-x").show();
		});
	});
	
	$("#buku-x").click(function(){
		$(".content-loader").fadeIn('slow', function()
		{
			$("body").fadeIn('slow');
			window.location.href="tblbuku.php";
		});
	});
	
	$("#bukuedit-x").click(function(){
		$(".content-loader").fadeOut('slow', function()
		{
			$(".content-loader").fadeIn('slow');
			$(".content-loader").load('book_edit.php');
			$("#bukuedit-x").show();
		});
	});
	
	$("#pinjam-x").click(function(){
		$(".content-loader").fadeOut('slow', function()
		{
			$(".content-loader").fadeIn('slow');
			$(".content-loader").load('tblpinjam.php');
			$("#pinjam-x").show();
		});
	});
	
	$("#kembali-x").click(function(){
		$(".content-loader").fadeOut('slow', function()
		{
			$(".content-loader").fadeIn('slow');
			$(".content-loader").load('tblkembali.php');
			$("#kembali-x").show();
		});
	});
	
	$("#kodebuku-x").click(function(){
		$(".content-loader").fadeOut('slow', function()
		{
			$(".content-loader").fadeIn('slow');
			$(".content-loader").load('kodebuku.php');
			$("#kodebuku-x").show();
		});
	});
</script>
</body>
</html>
<?php
mysql_free_result($rekusr);
?>
