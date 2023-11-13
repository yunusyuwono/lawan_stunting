<div class="container mt-2 p-0">
	<div class="card card-body p-1">
        <div class="row">
        <div class="form-group col-md-4">
                <label for="jk">Pilih Anak</label>
                <select class="form-control" name="anak" id="anak" autofocus style="text-align:center" disabled>
                   <?php 
                    $anak=mysqli_query($kon,"SELECT * from anak where idanak='$idanak' ");
                    while($a=mysqli_fetch_array($anak))
                    {
                        echo "<option value='".$a['idanak']."'>".$a['nama']."</option>";
                    }
                   ?>
                </select>
            </div>
            
            <div class="form-group col-md-2">
                <label for="usia">Usia Anak ( bulan )</label>
                <input type="number" class="form-control" name="usia" id="usia" style="text-align:center">
            </div>
            <div class="form-group col-md-3">
                <label for="berat">Berat Badan Anak ( kg )</label>
                <input type="number" class="form-control" name="berat" id="berat" style="text-align:center">
            </div>
            <div class="form-group col-md-3">
                <label for="tinggi">Panjang/Tinggi Badan Anak ( cm )</label>
                <input type="number" class="form-control" name="tinggi" id="tinggi" style="text-align:center">
            </div>
            <div class="form-group col-md-3">
                <label for="lingkar">Lingkar Kepala ( cm )</label>
                <input type="number" class="form-control" name="lingkar" id="lingkar" style="text-align:center">
            </div>
            <div class="form-group col-md-3">
                <div class="">
                    <br>
                    <a class="btn btn-warning  w-100" onclick="cekstatus()"><b>Simpan</b></a>
                </div>
            </div>
            <div id="status" class="col-md-12 mt-2"></div>
        </div>
	</div>
</div>
<script type="text/javascript">
function cekstatus(){
    anak 	= $('#anak').val();
	usia 	= $('#usia').val();
	berat 	= $('#berat').val();
    tinggi   = $('#tinggi').val();
    lingkar   = $('#lingkar').val();
	$('#status').html('<div class="alert alert-success" align="center">' + '<i class="fas fa-spin fa-sync fa-2x"></i>' + '</div>');
	if(usia =='' || berat =='' || tinggi =='' || lingkar =='')
	{
		alert('Lengkapi formnya'); 
	}
	else
	{
		$.ajax({
			url : "cek.berat.status.php",
			method : "POST",
			data : {anak:anak, usia: usia,berat:berat, tinggi:tinggi, lingkar:lingkar},
			success : function (data) {
				$('#status').html('<div class="alert alert-light" align="center"><b>' + data + '</b></div>');
			}
		})

	}
}
</script>