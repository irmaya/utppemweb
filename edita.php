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
<script src="assets/js/jquery.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.js" type="text/javascript"></script>

    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />

<script type="text/javascript" charset="utf-8" language="javascript" src="assets/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8" language="javascript" src="assets/js/DT_bootstrap.js"></script>


<?php include"dbcon.php"; 
?>

                        <form action="edit_form.php" method="post">

                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="example">
                            <thead>
                                <tr>
                                    <th>Pilih</th>
                                    <th>NPM</th>
                                    <th>Nama Anggota</th>
                                    <th>Jurusan/Kelas</th>
                                    <th>Tempat/Tanggal Lahir</th>
									<th>Alamat</th>
                                    <th>Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                              	<?php 
							$query=mysql_query("select * from mahasiswa")or die(mysql_error());
							while($row=mysql_fetch_array($query)){
							$id=$row['id'];
							?>
                                
										<tr>
										<td align="center">
										<input name="selector[]" type="radio" value="<?php echo $id; ?>">
										</td>
                                         <td><?php echo $row['npm'] ?></td>
                                         <td><?php echo $row['nama'] ?></td>
                                         <td><?php echo $row['jurusan'] ?></td>
                                         <td><?php echo $row['tempat_lahir'] ?>, <?php echo $row['tanggal_lahir'] ?></td>
                                         <td><?php echo $row['alamat'] ?></td>
                                         <td><img src="<?php echo "foto/". $row['photo']; ?>" width="50" height="50" alt="" onerror="this.src = 'foto/users_1.png';"/></td>
                                </tr>
                         <?php  } ?>
						 
                            </tbody>
                        </table>
		<button class="btn btn-success"  name="edit" type="submit">
Edit Data
</button>
</form>
