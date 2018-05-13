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

$npm=$_POST['npm'];
$peminjam=$_POST['peminjam'];
$kodebuku=$_POST['kodebuku'];
$judul=$_POST['judul'];
$kategori=$_POST['kategori'];
$pengarang=$_POST['pengarang'];
$tgl_pinjam=$_POST['tgl_pinjam'];
$tgl_kembali=$_POST['tgl_kembali'];
$denda=$_POST['denda'];
		
		 $host = 'localhost';
            $dbname = 'skyperpus';
            $user = 'root';
            $pass = '';
            
            try {
                $connection = new PDO("mysql:host=" . $host . ";dbname=" . $dbname, $user, $pass);
                $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
                $statement = $connection -> prepare("INSERT INTO pinjaman (npm, peminjam, kodebuku, judul, kategori, pengarang, tgl_pinjam, tgl_kembali, denda) VALUES (:npm, :peminjam, :kodebuku, :judul, :kategori, :pengarang, :tgl_pinjam, :tgl_kembali, :denda)");
                $statement -> bindValue(':npm',$npm);
                $statement -> bindValue(':peminjam',$peminjam);
                $statement -> bindValue(':kodebuku',$kodebuku);
                $statement -> bindValue(':judul',$judul);
                $statement -> bindValue(':kategori',$kategori);
                $statement -> bindValue(':pengarang',$pengarang);
                $statement -> bindValue(':tgl_pinjam', $tgl_pinjam);
				$statement -> bindValue(':tgl_kembali',$tgl_kembali);
				$statement -> bindValue(':denda',$denda);
			
			

$link = mysqli_connect("localhost", "root", "", "skyperpus");
$query = mysqli_query($link,"SELECT * FROM `pinjaman` WHERE peminjam='".$peminjam."' AND judul='".$judul."'");
if(mysqli_num_rows($query) > 0){
	
				echo "anda telah meminjamkan buku ini ke  "    .$peminjam. "<br> mohon dikembalikan jika ingin di proses kembali <br> anggota hanya bisa meminjam satu buku dengan satu judul silahkan pinjam buku lainnya/ judul lain";
$connection = NULL;
exit;
} else {
		$statement->execute();
				echo "ok";
			$connection = NULL;
			exit;

	
}
			
		}catch (PDOException $e){
                echo $e -> getMessage();
		}
		
			
		
		

mysql_free_result($rekusr);
?>