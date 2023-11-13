<?php 
include '../config/koneksi.php';
if(isset($_POST['cari']))
{
    $cb=$_POST['cari'];
    $cek=mysqli_query($kon,"SELECT * from rekorbunda where iduser='$cb' order by usiahamil asc");
    while($c=mysqli_fetch_array($cek))
    {
        ?>
        <div class="card mt-1">
            <div class="card-header p-1">
                <small>Kondisi Pemeriksaan</small>
                <h4><?php 
                if($c['usiahamil']=='-1')
                {
                    echo 'Sebelum Hamil';
                }
                elseif($c['usiahamil']=='99')
                {
                    echo 'Setelah Melahirkan';
                }
                else
                {
                    echo 'Hamil '.$c['usiahamil'].' bulan';
                }
                ?></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6 p-0">
                        Tinggi Badan :
                    </div>
                    <div class="col-6 p-0">
                        <?=$c['tinggi'].' cm';?>
                    </div>

                    <div class="col-6 p-0">
                        Berat Badan :
                    </div>
                    <div class="col-6 p-0">
                        <?=$c['berat'].' kg';?>
                    </div>

                    <div class="col-6 p-0">
                        Indeks Massa Tubuh(IMT) :
                    </div>
                    <div class="col-6 p-0">
                        <?php 
                        $imt=$c['berat']/(($c['tinggi']/100)*($c['tinggi']/100));
                        echo round($imt,2);
                        ?>
                    </div>

                    <div class="col-6 p-0">
                        Keterangan :
                    </div>
                    <div class="col-6 p-0">
                        <?php 
                        if($imt<18.5){
                            $ket='Kurus';
                            $cls='btn-warning text-dark';
                        }
                        elseif($imt>=18.5 && $imt<23){
                            $ket='Normal';
                            $cls='btn-success';
                        }
                        elseif($imt>=23 && $imt<30){
                            $ket='Overweight';
                            $cls='btn-warning text-dark';
                        }
                        elseif($imt>=30){
                            $ket='Obesitas';
                            $cls='btn-danger';
                        }                        
                        ?>
                        <a class="btn btn-sm <?=$cls;?> w-100"><?=$ket;?></a>
                    </div>
                    
                </div>
            </div>
        </div>
        <?php
    }
}