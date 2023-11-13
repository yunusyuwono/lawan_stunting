<?php include "nav.php";
$idbunda=$_SESSION['idbunda'];
?>
<div class="container mt-2">
	<div class="card">
        <div class="card-header p-1">
            Cek Perkembangan Anak
            <div class="float-right">

            </div>
        </div>
		<div class="card-body p-1">
            <div class="row">
            <div class="form-group col-md-2">
                    <label for="jk">Pilih Anak</label>
                    <select class="form-control" name="anak" id="anak" autofocus style="text-align:center">
                       <?php 
                        $anak=mysqli_query($kon,"SELECT * from anak where idbunda='$idbunda'");
                        while($a=mysqli_fetch_array($anak))
                        {
                            echo "<option value='".$a['idanak']."'>".$a['nama']."</option>";
                        }
                       ?>
                    </select>
                </div>
            <div class="form-group col-md-2">
                    <label for="bulan">Bulan Pemeriksaan</label>
                    <select class="form-control" name="bulan" id="bulan" autofocus style="text-align:center">
                        <?php 
                            $bulan=['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            for($b=0;$b<12;$b++)
                            {
                                $pb=date('Y').'-'.sprintf('%02s',$b+1);
                                ?>
                                <option value="<?=$pb;?>" <?=date('Y-m')==$pb?'selected':'';?>><?=$bulan[$b];?> <i class="fas fa-check"></i></option>
                                <?php
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
                    <div class="">
                        <br>
                        <a class="btn btn-warning  w-100" onclick="cekstatus()"><b>Cek Status</b></a>
                    </div>
                </div>
                <div id="status" class="col-md-12 mt-2"></div>
            </div>
		</div>
	</div>
</div>
<?php include "foot.php";?>
<script type="text/javascript">
function cekstatus(){
    bulan   = $('#bulan').val();
	anak 		= $('#anak').val();
	usia 	= $('#usia').val();
	berat 	= $('#berat').val();
    tinggi   = $('#tinggi').val();
	$('#status').html('<div class="alert alert-success" align="center">' + '<i class="fas fa-spin fa-sync fa-2x"></i>' + '</div>');
	if(usia =='' || berat =='' || tinggi =='' )
	{
		alert('Lengkapi formnya'); 
	}
	else
	{
		$.ajax({
			url : "cek.anak.status.php",
			method : "POST",
			data : {bulan:bulan,anak:anak, usia: usia,berat:berat,tinggi:tinggi},
			success : function (data) {
				$('#status').html('<div class="alert alert-success" align="center">Berat Badan Anak anda dikategorikan sebagai <br><h3><b>' + data + '</b></h3></div>');
			}
		})

	}
}
</script>