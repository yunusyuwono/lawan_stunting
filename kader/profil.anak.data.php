<?php 
session_start();
include "../config/koneksi.php";
$idbunda=$_SESSION['idbunda']; //diganti dengan sesi

?>
<div class="row">
    <?php 
    $anak=mysqli_query($kon,"SELECT * from anak where idbunda='$idbunda'");
    while($a=mysqli_fetch_array($anak))
    {
        ?>
        <div class="col-12 mt-1" onclick="window.location.href='profil.anak.detail?idanak=<?=$a['idanak'];?>'">
            <div class="card card-body p-1">
                <div class="row">
                    <div class="col-3" align="center">
                    <?php 
                    if($a['jk']=='L')
                    {
                        ?>
                        <i class="fas fa-3x fa-male text-primary"></i>
                        <?php
                    }
                    elseif($a['jk']=='P')
                    {
                        ?>
                        <i class="fas fa-3x fa-female text-danger"></i>
                        <?php
                    }   
                    ?>
                    </div>
                    <div class="col-9">
                        <b><?=$a['nama'];?></b><br>
                        <i><?=date('d M Y',strtotime($a['tgllhr']));?></i>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>