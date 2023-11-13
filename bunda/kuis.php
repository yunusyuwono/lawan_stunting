<?php include "nav.php";?>
<div class="container ">
    <?php 
    $ck=mysqli_fetch_array(mysqli_query($kon,"SELECT * from kuis where idbunda='$u[idbunda]'"));
    if(isset($ck['nilai']))
    {
        ?>
        <div class="alert alert-success p-1 mt-2">
            Anda telah mengikuti Kuis ini pada <?=$ck['entri'];?> dengan nilai <b><?=$ck['nilai'];?></b>
        </div>
        <?php
    }
    else
    {
    ?>
    <form id="fkuis">
        <input type="hidden" name="idbunda" id="idbunda" value="<?=$u['idbunda'];?>">
        <div class="row">
            <?php 
            $itemkuis=mysqli_query($kon,"SELECT * from itemkuis order by idsoal asc");
            $no=1;
            while($d=mysqli_fetch_array($itemkuis))
            {
                ?>
                <div class="col-12">
                    <div class="card card-body">
                        <b><?=$no.'. '.$d['soal'];?></b>
                    
                        <div class="list-group p-0">
                            <div class="list-group-item p-0">
                                <label class="btn btn-sm btn-outline-dark w-100" style="text-align: left;">
                                    <input type="radio" id="<?='pg-'.$d['idsoal'];?>" name="<?='pg-'.$d['idsoal'];?>" value="a"> <?=$d['a'];?>
                                </label>
                            </div>
                            <div class="list-group-item p-0">
                                <label class="btn btn-sm btn-outline-dark w-100" style="text-align: left;">
                                    <input type="radio" id="<?='pg-'.$d['idsoal'];?>" name="<?='pg-'.$d['idsoal'];?>" value="b"> <?=$d['b'];?>
                                </label>
                            </div>
                            <div class="list-group-item p-0">
                                <label class="btn btn-sm btn-outline-dark w-100" style="text-align: left;">
                                    <input type="radio" id="<?='pg-'.$d['idsoal'];?>" name="<?='pg-'.$d['idsoal'];?>" value="c"> <?=$d['c'];?>
                                </label>
                            </div>
                            <div class="list-group-item p-0">
                                <label class="btn btn-sm btn-outline-dark w-100" style="text-align: left;">
                                    <input type="radio" id="<?='pg-'.$d['idsoal'];?>" name="<?='pg-'.$d['idsoal'];?>" value="d"> <?=$d['d'];?>
                                </label>
                            </div>
                        </div>

                        </div>
                </div>
                <?php
                $no++;
            }
            ?>
            </div>
            <div class="" align="center">
            <a class="btn btn-sm btn-primary" id="kirim" data-bs-toggle="modal" data-bs-target="#mk" onclick="hitungskor()">Hitung Skor</a>
            <hr>
            <div class="modal fade" id="mk">
                <div class="modal-dialog modal-fullscreen-md-down modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-body p-1">
                            <div class="card mt-2">
                                <div class="card-header p-1"style="text-transform: uppercase;">
                                    <div class="row">
                                        <div class="col-10" align="left" id="judul"></div>
                                        <div class="col-2" align="right">
                                            <a class="btn btn-dark btn-sm" id="dms" data-bs-dismiss="modal"><i class="fas fa-times"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-1" id="konten">
                                    

                                </div>
                                <div class="card-footer p-1" id="footer" style="display:none">
                                    <a class="btn btn-primary btn-sm" onclick="window.location.reload();">Selesai</a>
                                </div>

                            </div>          
                        </div>
                    </div>
                </div>
            </div>
            </div>
        
    </form>
    <?php 
}
?>
</div>
<?php include "foot.php";?>
<script type="text/javascript">
        function hitungskor(){
            fkuis = $('#fkuis').serialize();
            $('#kirim').html('<i class="fas fa-spin fa-sync-alt"></i>');
            $('#konten').html('<i class="fas fa-spin fa-sync-alt"></i> Harap Tunggu');
            $.ajax({
                url     : 'kuis.proses.php',
                method  : 'post',
                data    : fkuis,
                success : function(data){
                    $('#kirim').html('Hitung Skor');
                    fb=JSON.parse(data);
                    console.log(fb.kode);
                    $('#judul').html('Kode Pesan [ '+fb.kode+' ]');
                    $('#konten').html(fb.dm);    
                    if(fb.kode==1)
                    {
                        $('#dms').hide();
                        $('#footer').show();
                    }
                    //$('#konten').html(data);
                    //$('#pesan').html('Skor Kuis : '+fb.skor);
                }
            })
        }
    </script>