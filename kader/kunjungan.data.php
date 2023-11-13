<?php
session_start(); 
include "../config/koneksi.php";
$_SESSION['idkader']=1;
$cari=isset($_POST['cari'])?addslashes($_POST['cari']):'all';
$tahun=$_POST['tahun'];
?>
<div class="list-group">
    <?php 
    if($cari!='all')
    {
        $kun=mysqli_query($kon,"SELECT * FROM kunjungan where idkader='$_SESSION[idkader]' and idbunda in(SELECT idbunda from bunda where nama like '%$cari%' and mulai like '%$tahun%') group by idbunda order by idkunjungan desc, selesai asc");
    }
    elseif ($cari =='all') 
    {
        $kun=mysqli_query($kon,"SELECT * FROM kunjungan where idkader=' $_SESSION[idkader]' and mulai like '%$tahun%' group by idbunda order by idkunjungan desc, selesai asc");
    }
    
    while($k=mysqli_fetch_array($kun))
    {
        $b=mysqli_fetch_array(mysqli_query($kon,"SELECT * FROM bunda where idbunda='$k[idbunda]'"));
        ?>
        <div class="list-group-item p-1">
            <div class="row">
                <div class="col-6">
                    <?=$b['nama'];?>
                </div>
                <div class="col-6" align="right">
                    <?php 
                    if($k['selesai']!='')
                    {
                        ?>
                        <div class="btn-group-vertical">
                            <a class="btn btn-primary btn-sm" href="kunjungan.aktifitas?idbunda=<?=$k['idbunda'];?>"><i class="fas fa-edit"></i></a>
                        </div>
                        <?php
                    }
                    else
                    {
                        ?>
                        <div class="btn-group-vertical">
                            <a class="btn btn-primary btn-sm" href="kunjungan.aktifitas?idbunda=<?=$k['idbunda'];?>"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" onclick="hapus('<?=$k['idkunjungan'];?>')"><i class="fas fa-trash"></i></a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-12 p-1">
                    <div class="row no-gutters">
                    <?php 
                    for($i=1;$i<=12;$i++)
                    {
                        $dn=date('Y').'-'.sprintf('%02s',$i);
                        $ck=mysqli_fetch_array(mysqli_query($kon,"SELECT * from kunjungan where idbunda='$b[idbunda]' and mulai like '%$dn%'"));
                        if(isset($ck))
                        {
                            if($ck['selesai']=='')
                            {
                                echo "<div class='col-2' align='center'><small class='badge bg-warning text-dark'>".$i."</small></div>";   
                            }
                            else
                            {
                                echo "<div class='col-2' data-bs-toggle='modal' data-bs-target='#keg".$ck['idkunjungan']."' align='center'><small class='badge bg-success text-white'>".$i."</small></div>";   
                                ?>
                                <div class="modal fade" id="keg<?=$ck['idkunjungan'];?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="col-10">Aktifitas Kunjungan</div>
                                                <div class="col-2" align="right">
                                                    <a class="btn btn-sm btn-dark text-white" data-bs-dismiss="modal"><i class="fas fa-times"></i></a>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <?=$ck['kegiatan'];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        else
                        {
                            echo "<div class='col-2' align='center'><small  class='badge bg-light text-dark'>".$i."</small></div>";
                        }
                        
                    }
                    ?>
                    </div>
                </div>
            </div>
            
        </div>
        <?php
    }
    ?>
</div>