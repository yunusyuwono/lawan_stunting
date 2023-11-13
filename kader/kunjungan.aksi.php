<?php
session_start(); 
include "../config/koneksi.php";
$_SESSION['idkader']=1;
if(isset($_GET['mulai']))
{
    $mulai=date('Y-m-d H:i:s');
    $idbunda=$_POST['idbunda'];
    $simpan=mysqli_query($kon,"INSERT into kunjungan (idkader,idbunda,mulai) values ('$_SESSION[idkader]','$idbunda','$mulai')");
    if($simpan)
    {
        echo "1";
    }
    else 
    {
        echo mysqli_error($kon);
    }
}
elseif(isset($_GET['selesai']))
{
    $selesai=date('Y-m-d H:i:s');
    $akt=addslashes($_POST['akt']);
    $idk=addslashes($_POST['idk']);
    $simpan=mysqli_query($kon,"UPDATE kunjungan set kegiatan='$akt',selesai='$selesai' where idkunjungan='$idk'");
    if($simpan)
    {
        echo "1";
    }
    else 
    {
        echo mysqli_error($kon);
    }
}
?>