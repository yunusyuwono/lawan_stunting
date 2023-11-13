<?php 
session_start();
include '../config/koneksi.php';

$a=mysqli_fetch_array(mysqli_query($kon,"SELECT * from anak where idanak='$_POST[anak]'"));
$usia 	= addslashes($_POST['usia']);
$berat = addslashes($_POST['berat']);
$tinggi = addslashes($_POST['tinggi']);
$lingkar = addslashes($_POST['lingkar']);

$idbunda=$_SESSION['idbunda'];
$idanak =$a['idanak'];

$cekn = mysqli_query($kon,"SELECT * from recanak where iduser='$idbunda' and idanak='$idanak' and usia='$usia'");


$cek 	= mysqli_query($kon,"SELECT * FROM berat where jk='$a[jk]' and usia='$usia'");

if(mysqli_num_rows($cekn)==0){
	$save=mysqli_query($kon,"INSERT into recanak (iduser,idanak,usia,tb,bb, lk) values 
						('$idbunda','$idanak','$usia','$tinggi','$berat','$lingkar')");
}
else 
{
	$save=mysqli_query($kon,"UPDATE recanak set bb = '$berat', tb='$tinggi',lk=$lingkar WHERE iduser='$idbunda' and idanak='$idanak' and usia='$usia'");
}

if($save)
{
	echo "Berhasil disimpan";
}
else
{
	echo mysqli_error($kon);
}

?>