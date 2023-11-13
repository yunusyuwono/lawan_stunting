<?php include "nav.php";?>
<div class="container mt-2">
	<div class="card">
        <div class="card-header p-1">
            <div class="row">
                <div class="col-8">Data Kunjungan</div>
                <div class="col-4" align="right">
                    <a class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addkunjungan"><i class="fas fa-plus"></i></a>
                </div>
            </div>
        </div>
		<div class="card-body p-1">
			<div class="form-group">
                <input type="text" class="form-control" placeholder="Cari Nama Bunda" name="carikunjungan" id="carikunjungan" onkeyup="ckunjungan()">
            </div>
            <div class="form-group">
                <label>Pilih Tahun</label>
                <select name="tahun" class="form-control" id="tahun" onchange="ckunjungan()">
                    <?php 
                    for($t=2023;$t<=date('Y');$t++)
                    {
                        ?>
                        <option value="<?=$t;?>" <?=($t==date('Y'))?'selected':'';?>><?=$t?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div id="listkunjungan" class="mt-2">
            </div>
		</div>
	</div>
</div>

<div class="modal fade" id="addkunjungan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-8">
                    Tambah Kunjungan
                </div>
                <div class="col-4" align="right">
                    <a class="btn btn-sm btn-dark" data-bs-dismiss="modal"><i class="fas fa-times"></i></a>
                </div>
            </div>
            <div class="modal-body p-1">
                <form id="fkunjungan">
                    <label>Pilih Nama Bunda</label>
                    <div class="form-group">
                        <select name="bunda" class="form-control" id="bunda">
                            <?php 
                            $bunda=mysqli_query($kon,"SELECT * from bunda order by nama asc");
                            while($b=mysqli_fetch_array($bunda))
                            {
                                ?>
                                <option value="<?=$b['idbunda'];?>"><?=$b['nama'];?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mt-2" align="right">
                        <a class="btn btn-primary btn-sm" onclick="mulaikun()">Mulai Kunjungan</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "foot.php";?>
<script type="text/javascript">
function ckunjungan(){
    carikunjungan=$('#carikunjungan').val();
    tahun = $('#tahun').val();
    $('#listkunjungan').html('Sedang mencari...');   
    $.ajax({
        url : 'kunjungan.data.php',
        method : 'POST',
        data : {cari:carikunjungan,tahun:tahun},
        success : function(data){
            $('#listkunjungan').html(data);   
        }
    })
}

$(document).ready(function(){
    ckunjungan();
})

function mulaikun(){
    bunda=$('#bunda').val();
    $.ajax({
        url : 'kunjungan.aksi.php?mulai',
        method : 'POST',
        data : {idbunda:bunda},
        success : function(data){
            if(data==1){
                alert('Kunjungan berhasil dibuat');
                window.location.reload();
            }
            else
            {
                alert(data);
            }
        }
    })
}
</script>