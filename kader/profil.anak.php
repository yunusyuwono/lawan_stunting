<?php include "nav.php";?>
<div class="container mt-2">
    <div class="card">
        <div class="card-header p-1">
            Profil Anak
        </div>
		<div class="card-body p-1">
            <div align="right">
                <div class="btn-group w-100">
                    <a class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tinggiberat"><i class="fas fa-circle-plus"></i> Tambah Anak
                    </a>
                </div>
            </div>

            <div id="dataanak" class="mt-3"></div>

            <div class="modal fade" id="tinggiberat">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header row">
                            <div class="col-10">
                                <i class="fas fa-circle-plus"></i> Tambah Anak 
                            </div>
                            <div class="col-2">
                                <a class="btn btn-dark btn-sm" data-bs-dismiss="modal"><i class="fas fa-times" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="modal-body p-1">
                            <form id="fanak">
                                <div class="form-group">
                                    <label>Nama Anak</label>
                                    <input type="text" class="form-control" placeholder="Nama Anak" id="nama" name="nama">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir Anak</label>
                                    <input type="date" class="form-control" id="tgllahir" name="tgllahir">
                                </div>
                                <div class="form-group row">
                                    <label>Jenis Kelamin</label><br>
                                    <div class="col-6">
                                        <input type="radio"  id="jk" name="jk" value="L" checked> Laki-laki
                                    </div>
                                    <div class="col-6">
                                        <input type="radio"  id="jk" name="jk" value="P"> Perempuan
                                    </div>                                    
                                </div>

                                <div class="form-group mt-3">
                                    <a class="btn btn-primary btn-sm" onclick="simpananak()" id="btnsimpananak">Simpan</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "foot.php";?>
<script type="text/javascript">
function loadanak(){
    $.ajax({
        url : 'profil.anak.data.php',
        success : function(data){
            $('#dataanak').html(data);
        }
    })   
}

$(document).ready(function(){
    loadanak();
})

function simpananak() {
    fanak=$('#fanak').serialize();
    $('#btnsimpananak').html('<i class="fas fa-sync fa-spin"></i>');
    $.ajax({
        url : 'profil.anak.aksi.php?tambah',
        method : 'POST',
        data : fanak,
        success : function(data){
            $('#btnsimpananak').html('Simpan');
            alert(data);
            loadanak();
        }
    })
}
</script>