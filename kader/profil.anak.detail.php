<?php include "nav.php";
$b=mysqli_fetch_array(mysqli_query($kon,"SELECT * from anak where idanak='$_GET[idanak]'"));
$idanak=$b['idanak'];
?>
<div class="container mt-2 p-0">
    <div class="card">
        <div class="card-header p-1">
            Detail Perkembangan Anak <br>
            <h4><?=$b['nama'];?></h4>
        </div>
        
		<div class="card-body p-1">
            <div class="row">
                <div class="col-6 p-3">
                    <a class="btn btn-lg btn-light w-100 border-dark p-1" data-bs-toggle="modal" data-bs-target="#mk" onclick="kirim('pertumbuhan')">
                        <img src="../icon/tumbuh.svg" class="img m-1" width="100px" height="100px">  <br>
                        Pertumbuhan
                    </a>
                </div>
                <div class="col-6 p-3">
                    <a class="btn btn-lg btn-light w-100 border-dark p-1" data-bs-toggle="modal" data-bs-target="#mk" onclick="kirim('antro')">
                        <img src="../icon/antro.svg" class="img m-1" width="100px" height="100px">  <br>
                        Antropometri
                    </a>
                </div>
                <div class="col-6 p-3">
                    <a class="btn btn-lg btn-light w-100 border-dark p-1" data-bs-toggle="modal" data-bs-target="#mk" onclick="kirim('skoring')">
                        <img src="../icon/skor.svg" class="img m-1" width="100px" height="100px">  <br>
                        Skoring
                    </a>
                </div>
            </div>
        </div>
        
    </div>

    <div class="modal fade" id="mk">
        <div class="modal-dialog modal-fullscreen-md-down modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body p-1">
                    
                    <div class="card mt-2">
                        <div class="card-header p-1"style="text-transform: uppercase;">
                            <div class="row">
                                <div class="col-10" id="judul"></div>
                                <div class="col-2" align="right">
                                    <a class="btn btn-dark btn-sm" data-bs-dismiss="modal"><i class="fas fa-times"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-1" id="konten">
                            
                        </div>
                    </div>          
                </div>
            </div>
        </div>
    </div>
    
</div>
<?php include "foot.php";?>
<script type="text/javascript">
    function kirim(jenis2){
        $('#konten').html('<div align="center"><i class="fas fa-spin fa-sync-alt fa-3x"></i></div>');
        $.ajax({
            url : 'profil.anak.detail.bagian.php',
            method: 'POST',
            data : {jenis:jenis2,idanak:<?=$idanak;?>},
            success: function(data){
                $('#konten').html(data);
                $('#judul').html(jenis2);
                $('#konten').focus();
            }
        })
    }
</script>