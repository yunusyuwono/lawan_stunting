<?php 
include "../config/koneksi.php";
$jenis=$_POST['jenis'];
$a=mysqli_fetch_array(mysqli_query($kon,"SELECT * from anak where idanak='$_POST[idanak]'"));
$idanak=$a['idanak'];
if($jenis=='pertumbuhan')
{
    ?>
    <div class="list-group">
        <div class="list-group-item p-0">
            <div class="row">
                <div class="col-3" align="center">
                    <b>Usia</b>
                </div>
                <div class="col-3" align="center">
                    <b>Tinggi (cm)</b>
                </div>
                <div class="col-3" align="center">
                    <b>Berat (Kg)</b>
                </div>
                <div class="col-3" align="center">
                    <b>Kepala (cm)</b>
                </div>
            </div>
        </div>
        <?php 
        
        for($u=0;$u<=60;$u++)
        {
            $g=mysqli_fetch_array(mysqli_query($kon,"SELECT * from recanak where idanak='$idanak' and usia='$u' order by usia asc"));
            ?>
            <div class="list-group-item p-0">
                <div class="row">
                    <div class="col-3" align="center">
                        <div class="btn btn-light btn-sm w-100"><?=$u.' bulan';?></div>
                    </div>
                    <div class="col-3" align="center">
                        <?=isset($g['tb'])?$g['tb']:'-';?>
                    </div>
                    <div class="col-3" align="center">
                        <?=isset($g['bb'])?$g['bb']:'-';?>
                    </div>
                    <div class="col-3" align="center">
                        <?=isset($g['lk'])?$g['lk']:'-';?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}
elseif($jenis=='berat')
{
    ?>
    <div class="list-group">
        <div class="list-group-item p-1">
            <div class="row">
                <div class="col-6" align="center">
                    <b>Usia</b>
                </div>
            <div class="col-6" align="center">
                <b>Berat (kg)</b>
            </div>
        </div>
    </div>
        <?php 
        $getberat=mysqli_query($kon,"SELECT * from berat where jk='$a[jk]' order by usia asc");
        while($g=mysqli_fetch_array($getberat))
        {
            ?>
            <div class="list-group-item p-1">
                <div class="row">
                    <div class="col-6" align="center">
                        <div class="btn btn-light btn-sm w-100"><?=$g['usia'].' bulan';?></div>
                    </div>
                    <div class="col-6">
                        <?php 
                        $ga=mysqli_fetch_array(mysqli_query($kon,"SELECT * from rekoranak where jenis='berat' and idanak='$idanak' and usia='$g[usia]'"));

                        echo isset($ga['nilai'])?'<span class="btn btn-sm btn-success w-100">'.$ga['nilai'].' kg</span>':'<span class="btn btn-sm btn-danger w-100">-</span>';
                        
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}
elseif($jenis=='antro')
{
    $bbtb=mysqli_query($kon,"SELECT * from bbtb where jk='$a[jk]' and jusia='u24' order by tb asc");
    while($b=mysqli_fetch_array($bbtb))
    {
        $tb[]=$b['tb'];
        $median[]=$b['median'];
        $m3sd[]=$b['m3sd'];
        $m2sd[]=$b['m2sd'];
        $m1sd[]=$b['m1sd'];
        $p1sd[]=$b['p1sd'];
        $p2sd[]=$b['p2sd'];
        $p3sd[]=$b['p3sd'];

        $abt=mysqli_fetch_array(mysqli_query($kon,"SELECT * from recanak where tb='$b[tb]' and idanak='$a[idanak]'"));
        if(empty($abt['bb']))
        {
            $ba=NULL;
        }
        else
        {
            $ba=$abt['bb'];
        }
        $bb[]=$ba;

    }
    error_reporting(0);
    $x = array_filter($bb);
    $avbb = array_sum($x)/count($x);
    //echo 'Rata2 berat Anak : '.$avbb.'<br>';
    $am3 = array_filter($m3sd);
    $avm3 = array_sum($am3)/count($am3);
    //echo 'Rata-rata -3SD : '.$avm3.'<br>';
    $am2 = array_filter($m2sd);
    $avm2 = array_sum($am2)/count($am2);
    //echo 'Rata-rata -2SD : '.$avm2.'<br>';
    $am1 = array_filter($m1sd); 
    $avm1 = array_sum($am1)/count($am1);
    //echo 'Rata-rata -1SD : '.$avm1.'<br>';
    $amed = array_filter($median);
    $avmed = array_sum($amed)/count($amed);
    //echo 'Rata-rata Median : '.$avmed.'<br>';
    $ap1 = array_filter($p1sd);
    $avp1 = array_sum($ap1)/count($ap1);
    //echo 'Rata-rata +1SD : '.$avp1.'<br>';
    $ap2 = array_filter($p2sd);
    $avp2 = array_sum($ap2)/count($ap2);
    //echo 'Rata-rata +2SD : '.$avp2.'<br>';
    $ap3 = array_filter($p3sd);
    $avp3 = array_sum($ap3)/count($ap3);
    //echo 'Rata-rata +3SD : '.$avp3.'<br>';

    if($avbb>=$avp3)
    {
        $kt='Gizi Lebih/Obese';
        $line = $p3sd;
    }
    elseif($avbb>=$avp2 && $avbb<$avp3)
    {
        $kt='Gizi Lebih/Obese';
        $line = $p2sd;
    }
    elseif($avbb>=$avp1 && $avbb<$avp2)
    {
        $kt='Gizi Lebih';
        $line = $p1sd;
    }
    elseif($avbb>=$avmed && $avbb<$avp1)
    {
        $kt='Berisiko Gizi Lebih';
        $line = $median;
    }
    elseif($avbb>=$avm1 && $avbb<$avmed)
    {
        $kt='Gizi Baik (Normal)';
        $line = $m1sd;
    }
    elseif($avbb>=$avm2 && $avbb<$avm1)
    {
        $kt='Gizi Kurang';
        $line = $m2sd;
    }
    elseif($avbb>=$avm3 && $avbb<$avm2)
    {
        $kt='Gizi Buruk';
        $line = $m3sd;
    }
    elseif($avbb<$avm3)
    {
        $kt='Gizi Buruk';
        $line = $m3sd;
    }
    ?>
    <b>Grafik BB/TB (Berat Badan per Tinggi Badan)</b>
    <canvas id="myChart"></canvas>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.js"></script>  
    <script type="text/javascript">
        var ctx = document.getElementById("myChart").getContext('2d');

        var myChart = new Chart(ctx, {
            data: {
                labels: <?php echo json_encode($tb); ?>,
                datasets: 
                    [

                    {
                    type: 'line',
                    label: '<?=$kt;?>',
                    data: <?=json_encode($line);?>,
                    borderWidth: 1,
                    pointRadius:1,
                    backgroundColor: ['rgb(255,255,255)'],
                    borderColor: ['rgb(200, 120, 0)'],
                    },
                    
                    {
                    type: 'line',
                    label: 'Gizi Baik (Normal)  ',
                    data: <?=json_encode($m1sd);?>,
                    borderWidth: 1,
                    pointRadius:1,
                    backgroundColor: ['rgb(255,255,255)'],
                    borderColor: ['rgb(99, 212, 0)'],
                    },
                    /*
                    {
                    type: 'line',
                    label: 'Gizi Kurang',
                    data: <?=json_encode($m2sd);?>,
                    borderWidth: 1,
                    pointRadius:1,
                    backgroundColor: ['rgb(255,255,255)'],
                    borderColor: ['rgb(212, 212, 0)'],
                    },

                    {
                    type: 'line',
                    label: 'Gizi Buruk',
                    data: <?=json_encode($m3sd);?>,
                    borderWidth: 1,
                    pointRadius:1,
                    backgroundColor: ['rgb(255,255,255)'],
                    borderColor: ['rgb(212, 0, 0)'],
                    },

                    {
                    type: 'line',
                    label: 'Berisiko Gizi Lebih',
                    data: <?=json_encode($p1sd);?>,
                    borderWidth: 1,
                    pointRadius:1,
                    backgroundColor: ['rgb(255,255,255)'],
                    borderColor: ['rgb(99, 212, 0)'],
                    },

                    {
                    type: 'line',
                    label: 'Gizi Lebih',
                    data: <?=json_encode($p2sd);?>,
                    borderWidth: 1,
                    pointRadius:1,
                    backgroundColor: ['rgb(255,255,255)'],
                    borderColor: ['rgb(212, 212, 0)'],
                    },

                    {
                    type: 'line',
                    label: 'Gizi Lebih/Obese',
                    data: <?=json_encode($p3sd);?>,
                    borderWidth: 1,
                    pointRadius:1,
                    backgroundColor: ['rgb(255,255,255)'],
                    borderColor: ['rgb(212, 0, 0)'],
                    },
                    */
                    {
                    type: 'scatter',
                    label: '<?=$a['nama'];?>',
                    data: <?=json_encode($bb);?>,
                    borderWidth: 1,
                    pointRadius:4,
                    backgroundColor: ['rgb(255,255,255)'],
                    borderColor: ['rgb(0, 0, 222)'],
                    }

                    ],
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
                                beginAtZero:'false',
                                stepSize:5,
                            }
                        }
                    ]
                },
                interaction: {
                  mode: 'nearest',
                  intersect: false,
                  axis: 'x'
                },
            }
        });


    </script>

    <?php 
    $lku=mysqli_query($kon,"SELECT * from lku where jk='$a[jk]' and jusia='u24' order by usia asc");
    while($l=mysqli_fetch_array($lku))
    {
        $usia[]=$l['usia'];
        $normal[]=$l['n'];
        $m3[]=$l['m3'];
        $m2[]=$l['m2'];
        $m1[]=$l['m1'];
        $p1[]=$l['p1'];
        $p2[]=$l['p2'];
        $p3[]=$l['p3'];

        $alk=mysqli_fetch_array(mysqli_query($kon,"SELECT * from recanak where usia='$l[usia]' and idanak='$a[idanak]'"));
        if(empty($alk['lk']))
        {
            $nlk=NULL;
        }
        else
        {
            $nlk=$alk['lk'];
        }

        $nlak[]=$nlk;

    }

    $p = array_filter($nlak);
    $avp = array_sum($p)/count($p);
    //echo 'Rata2 lingkar kepala anak  : '.$avp.'<br>';
    $pm3 = array_filter($m3);
    $pvm3 = array_sum($pm3)/count($pm3);
    //echo 'Rata-rata -3SD : '.$pvm3.'<br>';
    $pm2 = array_filter($m2);
    $pvm2 = array_sum($pm2)/count($pm2);
    //echo 'Rata-rata -2SD : '.$pvm2.'<br>';
    $pm1 = array_filter($m1); 
    $pvm1 = array_sum($pm1)/count($pm1);
    //echo 'Rata-rata -1SD : '.$pvm1.'<br>';
    $pmed = array_filter($normal);
    $pvmed = array_sum($pmed)/count($pmed);
    //echo 'Rata-rata Median : '.$pvmed.'<br>';
    $pp1 = array_filter($p1);
    $pvp1 = array_sum($pp1)/count($pp1);
    //echo 'Rata-rata +1SD : '.$pvp1.'<br>';
    $pp2 = array_filter($p2);
    $pvp2 = array_sum($pp2)/count($pp2);
    //echo 'Rata-rata +2SD : '.$pvp2.'<br>';
    $pp3 = array_filter($p3);
    $pvp3 = array_sum($pp3)/count($pp3);
    //echo 'Rata-rata +3SD : '.$pvp3.'<br>';

    if($avp>=$pvp3)
    {
        $kg='Makrosefali';
        $brs = $p3;
    }
    elseif($avp>=$pvp2 && $avp<$pvp3)
    {
        $kg='Makrosefali';
        $brs = $p2;
    }
    elseif($avp>=$pvp1 && $avp<$pvp2)
    {
        $kg='Normal';
        $brs = $p1;
    }
    elseif($avp>=$pvmed && $avp<$pvp1)
    {
        $kg='Normal';
        $brs = $normal;
    }
    elseif($avp>=$pvm1 && $avp<$pvmed)
    {
        $kg='Normal';
        $brs = $m1;
    }
    elseif($avp>=$pvm2 && $avp<$pvm1)
    {
        $kg='Normal';
        $brs = $m2;
    }
    elseif($avp>=$pvm3 && $avp<$pvm2)
    {
        $kg='Mikrosefali';
        $brs = $m3;
    }
    elseif($avp>=0 && $avp<$pvm3)
    {
        $kg='Mikrosefali';
        $brs = $m3;
    }


    ?>
    <b>Grafik Lingkar Kepala/Usia</b>
    <canvas id="lku"></canvas>
    <script type="text/javascript">
        var ctx = document.getElementById("lku").getContext('2d');

        var lku = new Chart(ctx, {
            data: {
                labels: <?php echo json_encode($usia); ?>,
                datasets: 
                    [

                    {
                    type: 'line',
                    label: 'Normal',
                    data: <?=json_encode($normal);?>,
                    borderWidth: 1,
                    pointRadius:1,
                    backgroundColor: ['rgb(255,255,255)'],
                    borderColor: ['rgb(0, 212, 0)'],
                    },

                    {
                    type: 'line',
                    label: '<?=$kg;?>',
                    data: <?=json_encode($brs);?>,
                    borderWidth: 1,
                    pointRadius:1,
                    backgroundColor: ['rgb(255,255,255)'],
                    borderColor: ['rgb(200, 150, 0)'],
                    },
                    /*
                    {
                    type: 'line',
                    label: 'Mikrosefali',
                    data: <?=json_encode($m2);?>,
                    borderWidth: 1,
                    pointRadius:1,
                    backgroundColor: ['rgb(255,255,255)'],
                    borderColor: ['rgb(212, 212, 0)'],
                    },

                    {
                    type: 'line',
                    label: 'Mikrosefali',
                    data: <?=json_encode($m3);?>,
                    borderWidth: 1,
                    pointRadius:1,
                    backgroundColor: ['rgb(255,255,255)'],
                    borderColor: ['rgb(212, 0, 0)'],
                    },

                    {
                    type: 'line',
                    label: 'Normal',
                    data: <?=json_encode($p1);?>,
                    borderWidth: 1,
                    pointRadius:1,
                    backgroundColor: ['rgb(255,255,255)'],
                    borderColor: ['rgb(99, 212, 0)'],
                    },

                    {
                    type: 'line',
                    label: 'Makrosefali',
                    data: <?=json_encode($p2);?>,
                    borderWidth: 1,
                    pointRadius:1,
                    backgroundColor: ['rgb(255,255,255)'],
                    borderColor: ['rgb(212, 212, 0)'],
                    },

                    {
                    type: 'line',
                    label: 'Makrosefali',
                    data: <?=json_encode($p3);?>,
                    borderWidth: 1,
                    pointRadius:1,
                    backgroundColor: ['rgb(255,255,255)'],
                    borderColor: ['rgb(212, 0, 0)'],
                    },
                    */
                    {
                    type: 'scatter',
                    label: '<?=$a['nama'];?>',
                    data: <?=json_encode($nlak);?>,
                    borderWidth: 1,
                    pointRadius:4,
                    backgroundColor: ['rgb(255,255,255)'],
                    borderColor: ['rgb(0, 0, 222)'],
                    }

                    ],
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
                                beginAtZero:'false',
                                stepSize:5,
                            }
                        }
                    ]
                },
                interaction: {
                  mode: 'nearest',
                  intersect: false,
                  axis: 'x'
                },
            }
        });


    </script>
        <?php
}
elseif($jenis=='skoring')
{
    $cs=mysqli_fetch_array(mysqli_query($kon,"SELECT * from anakskor where idanak='$a[idanak]' order by idskor desc"));
    if(isset($cs['skor']))
    {
        ?>
        <div class="alert alert-success p-1">
            Skor Perhitungan Stunting : <b><?=$cs['skor'];?></b><br>
            Status : <b><?=$cs['ket'];?></b>
        </div>

        <?php
    }
    else
    {
    ?>
    <form id="fskor">
        <input type="hidden" name="idanak" id="idanak" value="<?=$a['idanak'];?>">
        <div class="row">
            <?php 
            $iteminduk=mysqli_query($kon,"SELECT * from itemskor where idinduk=0 order by iditem asc");
            while($d=mysqli_fetch_array($iteminduk))
            {
                ?>
                <div class="col-12">
                    <b><?=$d['item'];?></b>
                </div>
                <div class="list-group p-2">
                <?php
                $itemturunan=mysqli_query($kon,"SELECT * from itemskor where idinduk='$d[iditem]' order by iditem asc");
                while($t=mysqli_fetch_array($itemturunan))
                {
                    ?>
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12">
                                <?=$t['item'];?>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6">
                                <label class="btn btn-sm btn-success w-100" style="text-align: left;">
                                <input type="radio" id="<?='ij-'.$t['iditem'];?>" name="<?='ij-'.$t['iditem'];?>" value="<?=$t['opsi1'];?>"> <?=$t['opsi1'];?></label>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6">
                                <label class="btn btn-sm btn-warning w-100" style="text-align: left;">
                                <input type="radio" id="<?='ij-'.$t['iditem'];?>" name="<?='ij-'.$t['iditem'];?>" value="<?=$t['opsi2'];?>"> <?=$t['opsi2'];?></label>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                </div>
                <?php
            }
            ?>
            </div>
            <div class="" align="center">
            <a class="btn btn-sm btn-primary" id="kirim" onclick="hitungskor()">Hitung Skor</a>
            <hr>
            <div id="pesan" class="alert"></div>
            </div>
        
    </form>
    <script type="text/javascript">
        function hitungskor(){
            fskor = $('#fskor').serialize();
            $('#kirim').html('<i class="fas fa-spin fa-sync-alt"></i>');
            $.ajax({
                url     : 'profil.anak.skor.php',
                method  : 'post',
                data    : fskor,
                success : function(data){
                    $('#kirim').html('Hitung Skor');
                    fb=JSON.parse(data);
                    console.log(data);
                    if(fb.kode==1)
                    {
                        $('#pesan').addClass('alert-success p-1');
                        $('#pesan').html('Skor Perhitungan Stunting : '+fb.skor+'<br>Status : <b>'+fb.ket+'</b>');
                        $('#pesan').focus();
                    }
                    else if(fb.kode==0)
                    {
                        $('#pesan').addClass('alert-danger p-1');
                        $('#pesan').html('Keterangan : <b>'+fb.ket+'</b>');
                        $('#pesan').focus();
                    }
                }
            })
        }
    </script>
    <?php
    }
}
elseif($jenis=='pengukuran')
{
    include "cek.berat.php";
}
elseif($jenis=='lingkar')
{
    include "cek.berat.php";
}
elseif($jenis=='materi')
{
    $cs=mysqli_fetch_array(mysqli_query($kon,"SELECT * from anakskor where idanak='$idanak' order by idskor desc limit 1 "));
    if(!isset($cs))
    {
        echo "Anda belum melakukan skoring stunting";
    }
    else
    {
        
        ?>
        <div class="list-group p-0">
            <a href="../materi/bagaimana mencapai tumbuh kembang optimal.htm" class="list-group-item p-1">Bagaimana mencapai tumbuh kembang optimal</a>
            <a href="../materi/Stimulasi Tumbuh Kembang aNAK.htm" class="list-group-item p-1">Stimulasi Tumbuh Kembang Anak</a>
            <a href="../materi/IMUNISASI.htm" class="list-group-item p-1">Imunisasi</a>
            <a href="../materi/Mencapai Tumbuh Kembang Anak.htm" class="list-group-item p-1">Mencapai Tumbuh Kembang Anak</a>
            <a href="../materi/PERAWATAN 1000 HARI PERTAMA KEHIDUPAN.htm" class="list-group-item p-1">PERAWATAN 1000 HARI PERTAMA KEHIDUPAN</a>
            <a href="../materi/RESEP MASAKAN.htm" class="list-group-item p-1">RESEP MASAKAN</a>
        </div>
        <?php
       
    }
}
?>