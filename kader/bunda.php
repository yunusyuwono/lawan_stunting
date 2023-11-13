<?php include "nav.php";?>
<div class="container mt-2">
	<div class="card">
        <div class="card-header p-1">
            <div class="row">
            <div class="col-10">
            Data Bunda
            </div>
            <div class="col-2" align="right">
                <a class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addbunda"><i class="fas fa-plus"></i></a>
            </div>    
            </div>
        </div>
		<div class="card-body p-1">
			<input type="text" class="form-control" placeholder="Cari Nama Bunda" name="caribunda" id="caribunda" onkeyup="cbunda()">

            <div id="listbunda" class="mt-2">

            </div>
		</div>
	</div>
</div>

<div class="modal fade" id="addbunda">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-10">
                    Tambah Bunda
                </div>
                <div class="col-2" align="right">
                    <a class="btn btn-sm btn-light" data-bs-dismiss="modal"><i class="fas fa-times"></i></a>
                </div>
            </div>    
            <div class="modal-body p-1">
                <form id="fBunda">
                    <div class="form-group">
                        <label>Nama Bunda</label>
                        <input type="text" class="form-control" placeholder="Nama Bunda" id="nama" name="nama">
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir Bunda</label>
                        <input type="text" class="form-control" id="tmplahir" name="tmplahir">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir Bunda</label>
                        <input type="date" class="form-control" id="tgllahir" name="tgllahir">
                    </div>
                    <div class="form-group">
                        <label>No. HP <small class="text-danger">*Hanya angka*</small></label>
                        <input type="text" class="form-control" id="hp" name="hp">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" placeholder="Alamat Bunda" id="alamat" name="alamat"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Desa/Kelurahan</label>
                        <input type="text" class="form-control" id="kel" name="kel">
                    </div>
                    <div class="form-group">
                        <label>Kecamatan</label>
                        <input type="text" class="form-control" id="kec" name="kec">
                    </div>
                    <div class="form-group">
                        <label>Posyandu</label>
                        <input type="text" class="form-control" id="posyandu" name="posyandu">
                    </div>
                    

                    <div class="form-group mt-3" align="right">
                        <a class="btn btn-primary btn-sm" onclick="simpanBunda()" id="btnsimpanBunda">Simpan</a>
                    </div>
                </form>    
            </div>
        </div>
    </div>
</div>
<?php include "foot.php";?>
<script type="text/javascript">
function simpanBunda() {
    fBunda=$('#fBunda').serialize();
    $('#btnsimpanBunda').html('<i class="fas fa-sync fa-spin"></i>');
    $.ajax({
        url : 'bunda.aksi.php?addbunda',
        method : 'POST',
        data : fBunda,
        success : function(data){
            $('#btnsimpanBunda').html('Simpan');
            alert(data);
            cbunda();
        }
    })
}

function cbunda(){
    $.ajax({
        url : 'bunda.data.php',
        success : function(data){
            $('#listbunda').html(data);
        }
    })
}

$(document).ready(function(){
    cbunda();
})
</script>