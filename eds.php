<?php
include('dbcon.php');
$id=$_POST['id'];
$npm=$_POST['npm'];
$nama=$_POST['nama'];
$jurusan=$_POST['jurusan'];
$tempat_lahir=$_POST['tempat_lahir'];
$tanggal_lahir=$_POST['tanggal_lahir'];
$alamat=$_POST['alamat'];
$gambar=$_POST['gambar'];
$password=$_POST['password'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
if ($_POST['ubah']){

if ($_FILES['gambar']['size'] != 0)
{
$fileName = $_FILES['gambar']['name'];
$move = move_uploaded_file($_FILES['gambar']['tmp_name'], 'foto/'.$fileName); 
if($move)
		{
$result = mysql_query("UPDATE mahasiswa SET npm='$npm[$i]', nama='$nama[$i]', jurusan='$jurusan[$i]' ,tempat_lahir='$tempat_lahir[$i]' , tanggal_lahir='$tanggal_lahir[$i]' , alamat='$alamat[$i]' , photo='$fileName' , password='$password[$i]'  where id='$id[$i]'")or die(mysql_error());
	}
	}
$hasil = mysql_query("UPDATE mahasiswa SET npm='$npm[$i]', nama='$nama[$i]', jurusan='$jurusan[$i]' ,tempat_lahir='$tempat_lahir[$i]' , tanggal_lahir='$tanggal_lahir[$i]' , alamat='$alamat[$i]' , password='$password[$i]'  where id='$id[$i]'")or die(mysql_error());	
	}
	}
header("location: index.php");
?>