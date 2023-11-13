<?php 
session_start();
include '../config/koneksi.php';

if(isset($_GET['list']))
{
    $cek=mysqli_query($kon,"SELECT * from rekorbunda where iduser='$_SESSION[idbunda]' order by usiahamil asc");
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
elseif(isset($_GET['grafik']))
{
    $cek=mysqli_query($kon,"SELECT * from rekorbunda where iduser='$_SESSION[idbunda]' order by usiahamil asc");
    while($c=mysqli_fetch_array($cek))
    {
        if($c['usiahamil']=='-1')
        {
            $ket='Sebelum';
        }
        elseif($c['usiahamil']=='99')
        {
            $ket='Melahirkan';
        }
        else
        {
            $ket=$c['usiahamil'].' bulan';
        }

        $label[]=$ket;
        $imt=round($c['berat']/(($c['tinggi']/100)*($c['tinggi']/100)),2);
                        
        $n[]=$imt;
    }
    ?>
    <div class="card mt-1">
        <div class="card-header p-1">
            Grafik
        </div>
        <div class="card-body" >
           
            <canvas id="myChart"></canvas>
        
        
        <script type="text/javascript">
            var ctx = document.getElementById("myChart").getContext('2d');

            var myChart = new Chart(ctx, {
                data: {
                    labels: <?php echo json_encode($label); ?>,
                    datasets: [{
                        type: 'line',
                        label: 'IMT',
                        data: <?php echo json_encode($n); ?>,
                        borderWidth: 1,
                        backgroundColor: ['rgb(200, 200, 212)'],
                        borderColor: ['rgb(0, 99, 212)'],
                        }]
                },
                options: {
                    indexAxis: 'x',
                    responsive: true,
                    maintainAspectRatio :true,
                    scales:{
                        yAxes:[
                            {
                                ticks:{
                                    min:0,
                                    beginAtZero:'true',
                                    stepSize:5,
                                }
                            }
                        ]
                    }
                }
            });


        </script>
        </div>
    </div>
    <?php

}
elseif(isset($_GET['simpan']))
{
    $bh=$_POST['bulanhamil'];
    $berat=$_POST['berat'];
    $tinggi=$_POST['tinggi'];
    $tgl=date('Y-m-d');
    $cek=mysqli_query($kon,"SELECT * from rekorbunda where iduser='$_SESSION[idbunda]' and usiahamil='$bh'");
    if(mysqli_num_rows($cek)>0)
    {
        $simpan=mysqli_query($kon,"UPDATE rekorbunda set berat='$berat',tinggi='$tinggi',tgl='$tgl' where iduser='$_SESSION[idbunda]' and usiahamil='$bh'");
    }
    else
    {
        $simpan=mysqli_query($kon,"INSERT into rekorbunda (iduser,tgl,usiahamil,tinggi,berat) values 
        ('$_SESSION[idbunda]','$tgl','$bh','$tinggi','$berat')");
    }

    if($simpan)
    {
        echo "Data berhasil disimpan";
    }
    else
    {
        echo "Data gagal disimpan ".mysqli_error($kon);
    }
}
?>