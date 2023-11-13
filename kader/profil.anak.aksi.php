<?php 
session_start();
include "../config/koneksi.php";
$idbunda=$_SESSION['idbunda']; //diganti dengan sesi
if(isset($_GET['tambah']))
{
    $nama = $_POST['nama'];
    $tgllhr=$_POST['tgllahir'];
    $jk = $_POST['jk'];

    $simpan=mysqli_query($kon,"INSERT into anak (idbunda,nama,tgllhr,jk) VALUES ('$idbunda','$nama','$tgllhr','$jk')");
    if($simpan)
    {
        echo 'Penambahan anak berhasil.';
    }
    else
    {
        echo 'Penambahan anak gagal. '.mysqli_error($kon);
    }
}
?>