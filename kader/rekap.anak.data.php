<?php 
include "../config/koneksi.php";

if(isset($_POST['cari']))
{
    $cari=$_POST['cari'];
    $canak=mysqli_query($kon,"SELECT *, anak.nama as nanak, bunda.nama as nabun FROM anak join bunda on anak.idbunda=bunda.idbunda where anak.nama like '%$cari%' or bunda.nama like '%$cari%'  order by anak.nama asc");
}
else 
{
    $canak=mysqli_query($kon,"SELECT *, anak.nama as nanak, bunda.nama as nabun FROM anak join bunda on anak.idbunda=bunda.idbunda order by anak.nama asc");
}
?>
<div class="list-group">
<?php

while ($c=mysqli_fetch_array($canak))
{
    ?>
    <div class="list-group-item mt-1" onclick="window.location.href='rekap.anak.detail?idanak=<?=$c['idanak'];?>'">
        <div class="row">
            <div class="col-12">
                <?=$c['nanak'];?>
            </div>
            <div class="col-1 p-1">
            <?php 
                if($c['jk']=='L')
                {
                    ?>
                    <i class="fas fa-2x fa-male text-primary"></i>
                    <?php
                }
                elseif($c['jk']=='P')
                {
                    ?>
                    <i class="fas fa-2x fa-female text-danger"></i>
                    <?php
                }   
            ?>
            </div>
            <div class="col-4 p-1">
                <div class="btn btn-sm btn-light w-100">
                    <i class="fas fa-calendar-alt"></i> 
                    <?=date('d-m-Y',strtotime($c['tgllahir']));?>
                </div>
            </div>
            <div class="col-7 p-1">
                <div class="btn btn-sm btn-primary w-100">
                <i class="fas fa-user-alt"></i>  
                 <?=$c['nabun'];?>
                </div>
            </div>
        </div>

        <div class="row no-gutters  mt-2">
        <?php 
            $b=mysqli_fetch_array(mysqli_query($kon,"SELECT * from rekoranak where idanak='$c[idanak]' and jenis='berat' order by usia desc limit 1"));
        ?>
            <div class="col-4 p-1">
                <div class="btn btn-sm btn-light w-100">
                    Berat terakhir
                </div>
            </div>
            <div class="col-4 p-1">
                <div class="btn btn-sm btn-success w-100">
                    <?=isset($b['usia'])?$b['usia'].' bulan':'Belum ada';?>
                </div>
            </div>
            <div class="col-4 p-1">
                <div class="btn btn-sm btn-info w-100">
                    <?=isset($b['nilai'])?$b['nilai'].' kg':'Belum ada';?>
                </div>
            </div>
        </div>
        <div class="row no-gutters mt-2">
            <?php 
            $t=mysqli_fetch_array(mysqli_query($kon,"SELECT * from rekoranak where idanak='$c[idanak]' and jenis='tinggi' order by usia desc limit 1"));
        ?>
            <div class="col-4 p-1">
                <div class="btn btn-sm btn-light w-100">
                    Tinggi terakhir
                </div>
            </div>
            <div class="col-4 p-1">
                <div class="btn btn-sm btn-success w-100">
                <?=isset($t['usia'])?$t['usia'].' bulan':'Belum ada';?>
                </div>
            </div>
            <div class="col-4 p-1">
            <div class="btn btn-sm btn-info w-100">
                    <?=isset($t['nilai'])?$t['nilai'].' cm':'Belum ada';?>
                </div>
            </div>
            <?php 
            
            ?>
        </div>
    </div>
    <?php
}
?>
</div>