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

mysql_select_db($database_koneksin, $koneksin);
$query_rekamanusr = "SELECT * FROM loginmi";
$rekamanusr = mysql_query($query_rekamanusr, $koneksin) or die(mysql_error());
$row_rekamanusr = mysql_fetch_assoc($rekamanusr);
$totalRows_rekamanusr = mysql_num_rows($rekamanusr);
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['nama'])) {
  $loginUsername=$_POST['nama'];
  $password=$_POST['kunci'];
  $enkripsi=hash('sha512',$password);
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "loguser.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_koneksin, $koneksin);
  
  $LoginRS__query=sprintf("SELECT nama, pass FROM loginmi WHERE nama=%s AND pass=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($enkripsi, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $koneksin) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>	
<head>
<title>Login Perpusline</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<meta name="keywords" content="perpusline, aplikasi perpustakaan" />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!--webfonts-->
<!--//webfonts-->
</head>
<body>
<h1>Perpusline - Perpustakaan Online</h1>
	<div class="login-form">
		<h2>Login</h2>
			<div class="form-info">
					<form ACTION="<?php echo $loginFormAction; ?>" METHOD="POST" id="loginmi">
					  <input name="nama" type="text" required class="email" id="nama" placeholder="Nama"/>
					  <input name="kunci" type="password" required class="password" id="kunci" placeholder="Password"/>
						<ul class="login-buttons">
							<li><input type="submit" value="LOGIN"/></li>
							<div class="clear"> </div>
						</ul>
					</form>
			</div>
	</div>
</body>
</html>
<?php
mysql_free_result($rekamanusr);
?>
