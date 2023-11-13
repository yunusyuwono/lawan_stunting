<?php 
session_start();
include "../config/koneksi.php";
$idbunda=$_SESSION['idbunda'];
$nama  = addslashes($_POST['nama']);
$tmplahir=addslashes($_POST['tmplahir']);
$tgllahir=addslashes($_POST['tgllahir']);
$hp     = addslashes($_POST['hp']);
$alamat = addslashes($_POST['alamat']);
$kel    = addslashes($_POST['kel']);
$kec    = addslashes($_POST['kec']);
$posyandu=addslashes($_POST['posyandu']);

$upd=mysqli_query($kon,"UPDATE bunda set nama='$nama',tmplahir='$tmplahir',tgllahir='$tgllahir',hp='$hp', alamat='$alamat', kel='$kel',kec='$kec',posyandu='$posyandu' where idbunda='$idbunda'");

if($upd)
{
    echo "Profil berhasil diperbarui";
}
else 
{
    echo "Profil gagal diperbarui ".mysqli_error($kon);
}
?>