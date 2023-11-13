<?php include "nav.php";?>
<div class="container mt-2">
	<div class="card">
        <div class="card-header p-1">
            Rekap Stunting Anak
        </div>
		<div class="card-body p-1">
			<input type="text" class="form-control" placeholder="Cari Nama Anak atau Nama Bunda" name="carianak" id="carianak" onkeyup="canak()">

            <div id="listanak" class="mt-2">

            </div>
		</div>
	</div>
</div>
<?php include "foot.php";?>
<script type="text/javascript">
function canak(){
    carianak=$('#carianak').val();
    $('#listanak').html('Sedang mencari...');   
    $.ajax({
        url : 'rekap.anak.data.php',
        method : 'POST',
        data : {cari:carianak},
        success : function(data){
            $('#listanak').html(data);   
        }
    })
}

$(document).ready(function(){
    canak();
})
</script>