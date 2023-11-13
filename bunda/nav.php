<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include '../config/koneksi.php';
$u=mysqli_fetch_array(mysqli_query($kon,"SELECT * FROM bunda where idbunda='$_SESSION[idbunda]'"));
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAWAN STUNTING</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    
</head>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="#">LAWAN STUNTING</a>
    <button class="navbar-toggler" style="border:0px">
      
    </button>
    <div class="navbar-toggler btn-group p-0 pr-3">
      <a class="btn btn-light" type="button" href="./"><i class="fas fa-home"></i></a>
      <a class="btn btn-danger" type="button" href="logout"><i class="fas fa-power-off"></i></a>
    </div>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="./">Beranda</a>
        </li>
        <!--<li class="nav-item">
          <a class="nav-link" href="profil.bunda">Profil Bunda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profil.anak">Profil Anak</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cek.bunda">Cek Perkembangan Kehamilan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cek.tinggi">Cek Tinggi/Panjang Badan Anak</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cek.berat">Cek Pertumbuhan Anak</a>
        </li>-->
        <li class="nav-item">
          <a class="nav-link" href="logout">Log Out</a>
        </li>

      </ul>
    </div>
  </div>
</nav>
