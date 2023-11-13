<?php include "nav.php";?>
<div class="container mt-2 p-1">
	<div class="card">
        <div class="card-header p-1">
            Cek Perkembangan Kehamilan
        </div>
		<div class="card-body p-1">
            <div align="right">
                <div class="btn-group w-100">
                    <a class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tinggiberat"><i class="fas fa-circle-plus"></i> Tinggi dan Berat Badan
                    </a>
                </div>
            </div>

            <div class="modal fade" id="tinggiberat">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header row">
                            <div class="col-10">
                                <i class="fas fa-circle-plus"></i> Tinggi dan Berat Badan 
                            </div>
                            <div class="col-2">
                                <a class="btn btn-dark btn-sm" data-bs-dismiss="modal"><i class="fas fa-times" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="modal-body p-1">
                            <form id="ftinggi">
                                <div class="form-group">
                                    <label>Kondisi Pemeriksaan</label>
                                    <select name="bulanhamil" id="bulanhamil" class="form-control">
                                        <option value="-1">Sebelum Hamil</option>
                                        <option value="0">Hamil 0 Bulan</option>
                                        <option value="1">Hamil 1 Bulan</option>
                                        <option value="2">Hamil 2 Bulan</option>
                                        <option value="3">Hamil 3 Bulan</option>
                                        <option value="4">Hamil 4 Bulan</option>
                                        <option value="5">Hamil 5 Bulan</option>
                                        <option value="6">Hamil 6 Bulan</option>
                                        <option value="7">Hamil 7 Bulan</option>
                                        <option value="8">Hamil 8 Bulan</option>
                                        <option value="9">Hamil 9 Bulan</option>
                                        <option value="10">Hamil 10 Bulan</option>
                                        <option value="11">Hamil 11 Bulan</option>
                                        <option value="12">Hamil 12 Bulan</option>
                                        <option value="99">Setelah Melahirkan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tinggi Badan (cm)</label>
                                    <input type="number" class="form-control" id="tinggi" name="tinggi">
                                </div>
                                <div class="form-group">
                                    <label>Berat Badan (kg)</label>
                                    <input type="number" class="form-control" id="berat" name="berat">
                                </div>
                                <div class="form-group mt-2" align="right">
                                    <a class="btn btn-primary btn-sm" onclick="simpantb()">Simpan</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" id="grafik" style="display: none;">

                </div>
                <div class="col-lg-12" id="list">

                </div>
            </div>
        </div>
    </div>
</div>
<?php include "foot.php";?>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript">
    toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "2000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
</script>
<script type="text/javascript">
function simpantb(){
    bulanhamil      = $('#bulanhamil').val();
	tinggi 		    = $('#tinggi').val();
	berat       	= $('#berat').val();
	if(tinggi =='' || berat =='')
	{
		alert('Lengkapi formnya'); 
	}
	else
	{
		$.ajax({
			url : "cek.bunda.aksi.php?simpan",
			method : "POST",
			data : {bulanhamil:bulanhamil,tinggi:tinggi,berat:berat},
			success : function (data) {
				toastr.success(data);
                loadlist();
                loadgrafik();
			}
		})

	}
}

function loadlist(){
$.ajax({
        url : "cek.bunda.aksi.php?list",
        success : function (data) {
            $('#list').html(data);
        }
    })
}
function loadgrafik(){
$.ajax({
        url : "cek.bunda.aksi.php?grafik",
        success : function (data) {
            $('#grafik').html(data);
        }
    })
}

$(document).ready(function () {
    loadlist();
    loadgrafik();
});
</script>