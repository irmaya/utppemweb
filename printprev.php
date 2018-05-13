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
$query_rekkalimat = "SELECT * FROM kalimat";
$rekkalimat = mysql_query($query_rekkalimat, $koneksin) or die(mysql_error());
$row_rekkalimat = mysql_fetch_assoc($rekkalimat);
$totalRows_rekkalimat = mysql_num_rows($rekkalimat);
  
session_start();  
ob_start();  
?>  
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />  
<title><?php echo $data['nama']; ?></title>   
<style type="text/css">
table {background:url(assets/img/collaged.jpg);no-repeat center center fixed; background-size: cover;
 -webkit-background-size: cover; 
 -moz-background-size: cover; -o-background-size: cover;}
</style>
</head>  
<body> 
<?php
include('dbcon.php');
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysql_query("SELECT * FROM mahasiswa where id='$id[$i]'");
	while($data = mysql_fetch_array($result))
	  { ?>
                                    
<?php 
$passwordx=$data['password'];
$enkripsi=crypt($passwordx,$passwordx);
$kalimat1 =   $row_rekkalimat['kalimat1'];
$kalimat2 = $row_rekkalimat['kalimat2'];
$kalimat3 = $row_rekkalimat['kalimat3'];
$kalimat4 = $row_rekkalimat['kalimat4'];
$kalimat5 = $row_rekkalimat['kalimat5'];
$kalimat6 = $row_rekkalimat['kalimat6'];
echo '
<hr>
<table border="0" height="200" width="370" align="center">  
 <tr>  
    <td colspan="4"><img src="assets/img/collage.jpg" width="370" height="50"> </td>
	<td>&nbsp;&nbsp;</td>
	<td colspan="4"><img src="assets/img/collage.jpg" width="370" height="50"> </td>
</tr>
<tr> <p align="justify"> 
    <td colspan="4" align="center"> <u><b><font size="2">KARTU ANGGOTA</font></b></u></td>
	<td rowspan="8">&nbsp;&nbsp;&nbsp;</td>
	<td rowspan="5">
	<ol type="1">
	<li>'.$kalimat1.'</li>
	<li>'.$kalimat2.'</li>
	<li>'.$kalimat3.' </li>
	<li>'.$kalimat4.'</li>
	
	<li>'.$kalimat5.'</li>
	<li>'.$kalimat6.'</li>
	</ol>
	</td></p>
</tr>
<font size="1">
<tr>	
	<td rowspan="5" align="center" width="50">
	<img src="foto/'.$data['photo'].'" width="50" height="60"></td>  
	<td width="">Nama</td>  
    <td width="">:</td>  
    <td width="">'.$data['nama'].'</td>
 </tr><tr>
 <td>NPM</td>  
    <td width="5">:</td>  
    <td>'.$data['npm'].'</td>  
</tr>
<tr>	
<td>Jurusan</td>  
    <td width="5">:</td>  
    <td width="140">'.$data['jurusan'].'</td> 
</tr>
<tr>   
	 <td>Tempat/Tgl Lahir</td>  
    <td>:</td>  
    <td>'.$data['tempat_lahir'].',&nbsp;'.$data['tanggal_lahir'].'</td>
  </tr> 
<tr>	
	<td>Alamat</td>  
    <td width="5">:</td>  
    <td>'.$data['alamat'].'</td> 
  </tr> 
<tr>	
	<td align="center">id:</td>
    <td>'.$enkripsi.'</td>  
    <td></td>
<td>
<br>
.........,'.date('d-m-Y').'<br>Penanggung jawab<br>
<br>
TTD,
<br>
<br>
<u>........................</u><br>
</td>	
  </tr>   
  </font>
</table>';?>
<br><hr>   
<?php 
	  }
}
?>

</body>  
</html>
<?php
mysql_free_result($rekkalimat);
  
$filename="Kartu perpusline-".$kode.".pdf"; 
$content = ob_get_clean();  
$content = '<page style="font-family: freeserif">'.($content).'</page>';  
 require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');  
 try  
 {  
  $html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(1,0));  
  $html2pdf->setDefaultFont('arial','2');  
  $html2pdf->writeHTML($content, isset($_GET['vuehtml']));  
  $html2pdf->Output($filename);  
 }  
 catch(HTML2PDF_exception $e) { echo $e; }  
?>  