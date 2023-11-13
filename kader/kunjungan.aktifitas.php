<?php include "nav.php";?>
<div class="container mt-2">
	<div class="card">
        <div class="card-header p-1">
            <div class="row">
                <?php 
                $k=mysqli_fetch_array(mysqli_query($kon,"SELECT * from kunjungan join bunda on kunjungan.idbunda=bunda.idbunda where kunjungan.idbunda='$_GET[idbunda]' and kunjungan.selesai=''"));
                ?>
                <div class="col-8">Aktifitas Kunjungan
                    <br>
                    <?=$k['nama'];?><br>
                    <small>
                        <?=$k['mulai'];?>
                    </small>
                </div>
                <div class="col-4" align="right">
                    <a class="btn btn-sm btn-light" href="kunjungan"><i class="fas fa-caret-left"></i> Kembali</a>
                </div>
            </div>
        </div>
		<div class="card-body p-1">
            <form action="" id="fkun">
                <div class="form-group">
                    <textarea id="aktifitas" name="aktifitas" class="form-control" rows="6" placeholder="Buat Aktifitas Kunjungan"><?=$k['kegiatan'];?></textarea>
                </div>
                <div class="form-group mt-2">
                    <a class="btn btn-success btn-sm w-100" onclick="selesai('<?=$k['idkunjungan']?>')">Selesaikan Kunjungan</a>
                </div>
            </form>
		</div>
	</div>
</div>
<?php include "foot.php";?>
<script type="text/javascript">
function selesai(idkunjungan){
    akt=$('#aktifitas').val();
    $.ajax({
        url : 'kunjungan.aksi.php?selesai',
        type : 'POST',
        data : {idk : idkunjungan,akt : akt},
        success : function(data){
            if(data==1){
                alert('Kunjungan berhasil diperbarui');
                window.location.href='kunjungan';
            }
            else
            {
                alert(data);
            }
            
        }
    })
}
</script>