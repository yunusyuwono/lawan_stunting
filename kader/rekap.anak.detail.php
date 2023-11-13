<?php include "nav.php";
$idanak=$_GET['idanak'];
$a=mysqli_fetch_array(mysqli_query($kon,"SELECT * from anak where idanak='$idanak' limit 1"));
?>
<div class="container mt-2">
	<div class="card">
        <div class="card-header p-1">
            <small>Rekap Stunting</small><br>
            <b><?=$a['nama']?></b> 
        </div>
		<div class="card-body p-1">
			<div class="btn-group w-100">
                <a class="btn btn-primary btn-sm" id="btnberat" onclick="rekor('<?=$a['idanak']?>','berat')">Berat</a>
                <a class="btn btn-success btn-sm" id="btntinggi" onclick="rekor('<?=$a['idanak']?>','tinggi')">Tinggi</a>
            </div>

            <div id="rekordata" class="mt-2">

            </div>
		</div>
	</div>
</div>
<?php include "foot.php";?>
<script type="text/javascript">
function rekor(idanak,jenis){
    $('#rekordata').html('Sedang memuat...');
    if(jenis=='berat'){
        $('#btnberat').html('Berat '+'<i class="fas fa-check"></i>');
        $('#btntinggi').html('Tinggi ');
    }   
    else
    {
        $('#btntinggi').html('Tinggi '+'<i class="fas fa-check"></i>');
        $('#btnberat').html('Berat ');
    }
    $.ajax({
        url : 'rekap.anak.detail.rekor.php',
        method : 'POST',
        data : {idanak:idanak,jenis:jenis},
        success : function(data){
            $('#rekordata').html(data);   
        }
    })
}

$(document).ready(function(){
    rekor('<?=$a['idanak']?>','berat');
})
</script>