<?php
session_start(); 
include "../config/koneksi.php";

if(isset($_GET['addbunda']))
{
    $nama  = addslashes($_POST['nama']);
    $tmplahir=addslashes($_POST['tmplahir']);
    $tgllahir=addslashes($_POST['tgllahir']);
    $hp     = addslashes($_POST['hp']);
    $alamat = addslashes($_POST['alamat']);
    $kel    = addslashes($_POST['kel']);
    $kec    = addslashes($_POST['kec']);
    $posyandu=addslashes($_POST['posyandu']);
    $password=md5($hp);

    $simpan=mysqli_query($kon,"INSERT into bunda (nama,tmplahir,tgllahir,hp,password,alamat,kel,kec,posyandu) values ('$nama','$tmplahir','$tgllahir','$hp','$password','$alamat','$kel','$kec','$posyandu')");

    if($simpan)
    {
        echo "Data bunda berhasil ditambahkan";
    }
    else 
    {
        echo "Data bunda gagal ditambahkan ".mysqli_error($kon);
    }
}
?>