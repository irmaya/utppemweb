<?php
include('dbcon.php');

$nom=$_POST['nom'];
$npm=$_POST['npm'];
$status=$_POST['status'];
$peminjam=$_POST['peminjam'];
$kodebuku=$_POST['kodebuku'];
$judul=$_POST['judul'];
$pengarang=$_POST['pengarang'];
$kategori=$_POST['kategori'];
$tgl_pinjam=$_POST['tgl_pinjam'];
$tgl_kembali=$_POST['tgl_kembali'];
$denda=$_POST['denda'];
$status=$_POST['status'];



$N = count($nom);
for($i=0; $i < $N; $i++)
{

$result = mysql_query("UPDATE pinjaman SET npm='$npm[$i]', peminjam='$peminjam[$i]', kodebuku='$kodebuku[$i]' ,judul='$judul[$i]' , pengarang='$pengarang[$i]' , kategori='$kategori[$i]' , tgl_pinjam='$tgl_pinjam[$i]' , tgl_kembali='$tgl_kembali[$i]' ,denda='$denda[$i]',status='$status[$i]'  where nom='$nom[$i]'")or die(mysql_error());
}
header("location: index.php");

?>