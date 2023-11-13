<?php include "nav.php";
$idbunda=$_SESSION['idbunda'];
?>
<div class="container mt-2">
    <div class="card">
        <div class="card-header p-1">
            Profil Bunda
        </div>
		<div class="card-body p-1">
            <?php 
            $bunda=mysqli_fetch_array(mysqli_query($kon,"SELECT * from bunda where idbunda='$idbunda'"));
            ?>
            <form id="fBunda">
                <div class="form-group">
                    <label>Nama Bunda</label>
                    <input type="text" class="form-control" placeholder="Nama Bunda" id="nama" name="nama" value="<?=$bunda['nama'];?>">
                </div>
                <div class="form-group">
                    <label>Tempat Lahir Bunda</label>
                    <input type="text" class="form-control" id="tmplahir" name="tmplahir"value="<?=$bunda['tmplahir'];?>">
                </div>
                <div class="form-group">
                    <label>Tanggal Lahir Bunda</label>
                    <input type="date" class="form-control" id="tgllahir" name="tgllahir" value="<?=$bunda['tgllahir'];?>">
                </div>
                <div class="form-group">
                    <label>No. HP <small class="text-danger">*Hanya angka*</small></label>
                    <input type="text" class="form-control" id="hp" name="hp" value="<?=$bunda['hp'];?>">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" placeholder="Alamat Bunda" id="alamat" name="alamat"><?=$bunda['alamat'];?></textarea>
                </div>
                <div class="form-group">
                    <label>Desa/Kelurahan</label>
                    <input type="text" class="form-control" id="kel" name="kel" value="<?=$bunda['kel'];?>">
                </div>
                <div class="form-group">
                    <label>Kecamatan</label>
                    <input type="text" class="form-control" id="kec" name="kec" value="<?=$bunda['kec'];?>">
                </div>
                <div class="form-group">
                    <label>Posyandu</label>
                    <input type="text" class="form-control" id="posyandu" name="posyandu" value="<?=$bunda['posyandu'];?>">
                </div>
                

                <div class="form-group mt-3" align="right">
                    <a class="btn btn-primary btn-sm" onclick="simpanBunda()" id="btnsimpanBunda">Simpan</a>
                </div>
            </form>    
        
        </div>
    </div>
</div>
<?php include "foot.php";?>
<script type="text/javascript">
function simpanBunda() {
    fBunda=$('#fBunda').serialize();
    $('#btnsimpanBunda').html('<i class="fas fa-sync fa-spin"></i>');
    $.ajax({
        url : 'profil.bunda.edit.php',
        method : 'POST',
        data : fBunda,
        success : function(data){
            $('#btnsimpanBunda').html('Simpan');
            alert(data);
            window.location.reload();
        }
    })
}
</script>