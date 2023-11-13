<?php include "nav.php";?>
<div class="container mt-2">
	<div class="card">
        <div class="card-header p-1">
            Rekap Bunda Hamil
        </div>
		<div class="card-body p-1">
			<select class="form-control" id="bunda" name="bunda" onchange="cbunda()">
                <option>Pilih Bunda</option>
                <?php 
                $bunh=mysqli_query($kon,"SELECT * from bunda where idbunda in(SELECT iduser from rekorbunda)");
                while($b=mysqli_fetch_array($bunh))
                {
                    ?>
                    <option value="<?=$b['idbunda']?>"><?=$b['nama'];?></option>
                    <?php
                }
                ?>
            </select>

            <div id="listbunda" class="mt-2">

            </div>
		</div>
	</div>
</div>
<?php include "foot.php";?>
<script type="text/javascript">
function cbunda(){
    caribunda=$('#bunda').val();
    $('#listbunda').html('Sedang mencari...');   
    $.ajax({
        url : 'rekap.bunda.data.php',
        method : 'POST',
        data : {cari:caribunda},
        success : function(data){
            $('#listbunda').html(data);   
        }
    })
}

$(document).ready(function(){
    cbunda();
})
</script>