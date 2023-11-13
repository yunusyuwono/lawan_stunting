<?php 
session_start();
include '../config/koneksi.php';

$bulan  = addslashes($_POST['bulan']);
$a=mysqli_fetch_array(mysqli_query($kon,"SELECT * from anak where idanak='$_POST[anak]'"));
$usia 	= addslashes($_POST['usia']);
$tinggi = addslashes($_POST['tinggi']);
$idbunda=$_SESSION['idbunda'];
$idanak =$a['idanak'];

$cek 	= mysqli_query($kon,"SELECT * FROM tinggi where jk='$a[jk]' and usia='$usia'");

while ($c=mysqli_fetch_array($cek))
{
	if($tinggi<$c['spatas'])
	{
		echo "Sangat Pendek";
	}
	elseif (($tinggi>=$c['pbawah'])&&($tinggi<=$c['patas'])) {
		echo "Pendek";
	}
	elseif (($tinggi>=$c['nbawah'])&&($tinggi<=$c['natas'])) {
		echo "Normal";
	}
	elseif ($tinggi>=$c['tbawah']) {
		echo "Tinggi";
	}
    else
    {
        echo mysqli_error($kon);
    }
}
$jenis 	= 'tinggi';
$tgl    = date('Y-m-d');

$cekn = mysqli_query($kon,"SELECT * from rekoranak where iduser='$idbunda' and idanak='$idanak' and usia='$usia'  and jenis='$jenis'");

if(mysqli_num_rows($cekn)==0){
	mysqli_query($kon,"INSERT into rekoranak (iduser,idanak,tgl,usia,jenis,nilai) values 
						('$idbunda','$idanak','$tgl','$usia','$jenis','$tinggi')");
}
else 
{
	mysqli_query($kon,"UPDATE rekoranak set nilai = '$tinggi' WHERE iduser='$idbunda' and idanak='$idanak' and usia='$usia' and tgl like '%$tgl%'");
}

?>