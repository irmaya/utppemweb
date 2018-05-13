<!--<?php  
session_start();  
ob_start();  
?>  -->
<?php
include('dbcon.php');
$dl=$_POST['dl'];
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
  $batal="DELETE FROM mahasiswa where id='$id[$i]'";
  $hasil= mysql_query($batal);
  };
   if ($hasil){	
	echo "<script language='javascript'>location.assign('hapus_data_mahasiswa.php');window.alert ('DATA BERHASIL DI HAPUS !!!');</script>";
  }
	else
{	 echo "<script type='text/javascript'>alert('Data Tidak Berhasil Dihapus !')</script>";
        echo "<script type='text/javascript'>window.location='hapus_data_mahasiswa.php'</script>";
	};
?>