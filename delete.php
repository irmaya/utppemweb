<?php
include_once 'exc.php';

if($_POST['del_id'])
{
	$id = $_POST['del_id'];	
	$stmt=$db_con->prepare("DELETE FROM mahasiswa WHERE id=:id");
	$stmt->execute(array(':id'=>$id));	
}
?>