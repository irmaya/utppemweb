<?php require_once 'dbcon.php';?>
<script src="assets/js/jquery.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.js" type="text/javascript"></script>

    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/smoothness/jquery-ui.css">
<script type="text/javascript" src="crud.js"></script>

<script type="text/javascript" charset="utf-8" language="javascript" src="assets/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8" language="javascript" src="assets/js/DT_bootstrap.js"></script>

 <form action="statusbuku.php" method="post">

                        <table cellspacing="0" width="100%" id="example" class="table table-striped table-hover table-responsive">
        <thead>
        <tr>
        <th width="20%">NPM/NIM/KTP</th>
        <th width="30%">N A M A</th>
        <th width="20%">Judul buku</th>
        <th width="20%">T G l kembali</th>
        <th width="20%">Keterlambatan</th>
        <th width="30%">Denda</th>
        <th width="5%">Status</th>
        <th width="5%">Ubah</th>
        </tr>
        </thead>
        <tbody>
        <?php
        
        
        $query=mysql_query("SELECT * FROM pinjaman ORDER BY nom DESC")or die(mysql_error());
							while($row=mysql_fetch_array($query)){
							$id=$row['nom'];
			?>
			<tr>
			<td><?php echo $row['npm']; ?></td>
			<td><?php echo $row['peminjam']; ?></td>
            <td><?php echo $row['judul']; ?></td>
            <td><?php echo $row['tgl_kembali']; ?></td>
            <td><?php $expired = (time() > strtotime($row['tgl_kembali']));
if ($expired) {
  echo '<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  Batas waktu peminjaman berakhir.
</div>';
}?></td>
<td><?php $date1=$row['tgl_kembali'];
$today = date('d M Y');
$date2=$today;
$selisih=$date2 - $date1;
$ahe=$selisih*$row['denda'];

if ($selisih > 0){
        echo '<div class="alert alert-info">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Pengembalian Telat <b>'.($selisih).' hari! </b>Denda = '.$ahe.' </div>'; 
		
}else{

							}

?>
</td>
<td><?php 
$rekaman=$row['status'];
if ($rekaman != ""){
echo '<div class="alert alert-warning">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
'.$row['status'].'</div>'; 
}else{

}


?>
</td>
<td><input name="selector[]" type="radio" value="<?php echo $id; ?>"></td>

			</tr>
			<?php
		}
		?>
        </tbody>
        </table>
<button class="btn btn-success"  name="edit" type="submit">
Edit Status
</button>
</form>