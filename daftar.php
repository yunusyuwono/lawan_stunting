<!DOCTYPE html>
<html lang="en">
<?php 
include 'config/koneksi.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAWAN STUNTING - LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 mt-5">
                <div class="card card-header bg-light p-1" align="center">
                    <b>DAFTAR</b>
                </div>
                <?php 
                if(isset($_POST['daftar']))
                {
                    $nama=addslashes($_POST['nama']);
                    $hp=addslashes($_POST['hp']);
                    $pw=md5(addslashes($_POST['hp']));
                    $tmplahir=addslashes($_POST['tmplahir']);
                    $tgllahir=addslashes($_POST['tgllahir']);
                    $alamat=addslashes($_POST['alamat']);

                    $cp=mysqli_num_rows(mysqli_query($kon,"SELECT * from bunda where hp='$hp'"));
                    if($cp>0)
                    {
                        ?>
                        <div class="alert alert-danger p-1 mt-1 mb-1" align="center">
                            Pendaftaran gagal. No. Handphone anda telah terdaftar sebelumnya
                        </div>
                        <?php
                    }
                    else
                    {
                        $dftr=mysqli_query($kon,"INSERT into bunda (nama,hp,password,tmplahir,tgllahir,alamat) values ('$nama','$hp','$pw','$tmplahir','$tgllahir','$alamat')");
                        if($dftr)
                        {
                            ?>
                            <div class="alert alert-success p-1 mt-1 mb-1" align="center">
                            Pendaftaran berhasil. Silahkan login. (Password sama dengan no.hp)
                        </div>
                            <?php
                        }  
                        else
                        {
                            ?>
                            <div class="alert alert-danger p-1 mt-1 mb-1" align="center">
                            Pendaftaran gagal. <?=mysqli_error($kon);?>
                        </div>
                            <?php
                        }
                    }
                }
                ?>
                <div class="card card-body p-1 mt-2">
                <form method="post">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" placeholder="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label>No. HP</label>
                        <input type="text" class="form-control" placeholder="No. Handphone" name="hp" required>
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" class="form-control" placeholder="Tempat Lahir" name="tmplahir" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" placeholder="Tanggal Lahir" name="tgllahir" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" placeholder="Alamat" name="alamat" required></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <a class="btn btn-link btn-sm w-50" href="./">Kembali ke Login</a>
                        <button class="btn btn-primary btn-sm w-50" name="daftar">Daftar</button>
                        
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</body>
<footer>
	<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.js"></script>
</footer>