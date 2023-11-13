<?php 
session_start();
include '../config/koneksi.php';

$bulan  = addslashes($_POST['bulan']);
$a=mysqli_fetch_array(mysqli_query($kon,"SELECT * from anak where idanak='$_POST[anak]'"));
$usia 	= addslashes($_POST['usia']);
$berat = addslashes($_POST['berat']);
$tinggi = addslashes($_POST['tinggi']);

$idbunda=$_SESSION['idbunda'];
$idanak =$a['idanak'];

$cekberat 	= mysqli_query($kon,"SELECT * FROM berat where jk='$a[jk]' and usia='$usia'");

while ($c=mysqli_fetch_array($cekberat))
{
	if($berat<=$c['m3'])
	{
		echo "Terlalu Kurus";
	}
	elseif (($berat>$c['m3'])&&($berat<=$c['m2'])) {
		echo "Sangat Kurus";
	}
	elseif (($berat>$c['m2'])&&($berat<=$c['m1'])) {
		echo "Kurus";
	}
	elseif (($berat>$c['m1'])&&($berat<=$c['n'])) {
		echo "Normal";
	}
	elseif (($berat>$c['n'])&&($berat<=$c['p1'])) {
		echo "Berat";
	}
	elseif (($berat>$c['p1'])&&($berat<=$c['p2'])) {
		echo "Sangat Berat";
	}
	elseif (($berat>$c['p2'])&&($berat<=$c['p3'])) {
		echo "Terlalu Berat";
	}
	elseif ($berat>$c['p3']) 
	{
		echo "Terlalu Berat";
	}
    else
    {
        echo mysqli_error($kon);
    }
}
$jenis 	= 'berat';
$tgl    = date('Y-m-d');

$cekn = mysqli_query($kon,"SELECT * from rekoranak where iduser='$idbunda' and idanak='$idanak' and usia='$usia' and jenis='$jenis'");

if(mysqli_num_rows($cekn)==0){
	mysqli_query($kon,"INSERT into rekoranak (iduser,idanak,tgl,usia,jenis,nilai) values 
						('$idbunda','$idanak','$tgl','$usia','$jenis','$berat')");
}
else 
{
	mysqli_query($kon,"UPDATE rekoranak set nilai = '$berat' WHERE iduser='$idbunda' and idanak='$idanak' and usia='$usia'");
}

?>