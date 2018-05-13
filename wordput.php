﻿<?php require_once('Connections/koneksin.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "updatme")) {
	
	if ($_FILES['photo']['size'] != 0)
{
$fileName = $_FILES['photo']['name'];
$move = move_uploaded_file($_FILES['photo']['tmp_name'], 'foto/'.$fileName); 
if($move)
		{
			
$kuncina=$_POST['pass'];
$enkripsi=hash('sha512',$kuncina);
  $updateSQL = sprintf("UPDATE loginmi SET nama=%s, pass=%s, photo=%s WHERE id=%s",
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($enkripsi, "text"),
                       GetSQLValueString($fileName, "text"),
                       GetSQLValueString($_POST['id'], "int"));








  mysql_select_db($database_koneksin, $koneksin);
  $Result1 = mysql_query($updateSQL, $koneksin) or die(mysql_error());
}
}
}
mysql_select_db($database_koneksin, $koneksin);
$query_coduser = "SELECT * FROM loginmi";
$coduser = mysql_query($query_coduser, $koneksin) or die(mysql_error());
$row_coduser = mysql_fetch_assoc($coduser);
$totalRows_coduser = mysql_num_rows($coduser);

mysql_select_db($database_koneksin, $koneksin);
$query_rekkalimat = "SELECT * FROM kalimat";
$rekkalimat = mysql_query($query_rekkalimat, $koneksin) or die(mysql_error());
$row_rekkalimat = mysql_fetch_assoc($rekkalimat);
$totalRows_rekkalimat = mysql_num_rows($rekkalimat);
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
                            <img src="<?php echo "foto/". $row_coduser['photo']?>" alt="" onerror="this.src = 'foto/users_1.png';" class="img-circle" width="143" height="139"/>

                           
                        </div>

                    </li>
                     <li>
                       <center> <a  href="#"> <strong> <?php echo $row_coduser['nama']; ?> </strong></a></center>
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
</ul>

        <!-- /. SIDEBAR MENU (navbar-side) -->
        <div id="page-wrapper" class="page-wrapper-cls">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Ganti Kalimat </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                           FORM PERPUSTAKAAN
                        </div>
                        <div class="panel-body">
                        <div class="content-loader">
<form action="<?php echo $editFormAction; ?>" name="updatme" method="POST" enctype="multipart/form-data" id="updatme">    
	  <div class="thumbnail">
	
	<div class="control-group">
    <label class="control-label" for="inputEmail">Kalimat 1</label>
    <div class="controls">
    <input name="id" type="hidden" value="<?php echo $row_rekkalimat['id']; ?>" class="form-control"/>
		<input name="kalimat1" type="text" value="<?php echo $row_rekkalimat['kalimat1']; ?>" class="form-control"/>
    </div>
    </div>

		<div class="control-group">
    <label class="control-label" for="inputEmail">Kalimat 2</label>
    <div class="controls">
		<input name="kalimat2" type="text" value="<?php echo $row_rekkalimat['kalimat2']; ?>" class="form-control"/>
    </div>
    </div>
	
    		<div class="control-group">
    <label class="control-label" for="inputEmail">Kalimat 3</label>
    <div class="controls">
		<input name="kalima32" type="text" value="<?php echo $row_rekkalimat['kalimat3']; ?>" class="form-control"/>
    </div>
    </div>

		<div class="control-group">
    <label class="control-label" for="inputEmail">Kalimat 4</label>
    <div class="controls">
		<input name="kalimat4" type="text" value="<?php echo $row_rekkalimat['kalimat4']; ?>" class="form-control"/>
    </div>
    </div>

		<div class="control-group">
    <label class="control-label" for="inputEmail">Kalimat 5</label>
    <div class="controls">
		<input name="kalimat5" type="text" value="<?php echo $row_rekkalimat['kalimat5']; ?>" class="form-control"/>
    </div>
    </div>

		<div class="control-group">
    <label class="control-label" for="inputEmail">Kalimat 6</label>
    <div class="controls">
		<input name="kalimat6" type="text" value="<?php echo $row_rekkalimat['kalimat6']; ?>" class="form-control"/>
    </div>
    </div>

	

	<br>
	
<input name="ubah" class="btn btn-success" type="submit" value="Simpan">
<input type="hidden" name="MM_update" value="updatme">
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
mysql_free_result($coduser);

mysql_free_result($rekkalimat);
?>
