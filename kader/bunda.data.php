<?php 
include "../config/koneksi.php";

if(isset($_POST['cari']))
{
    $cari=$_POST['cari'];
    $cbunda=mysqli_query($kon,"SELECT * FROM bunda where nama like '%$cari%' order by nama asc");
}
else 
{
    $cbunda=mysqli_query($kon,"SELECT * FROM bunda order by nama asc");
}
?>
<div class="list-group">
<?php

while ($c=mysqli_fetch_array($cbunda))
{
    ?>
    <div class="list-group-item" >
        <div class="row">
            <div class="col-12">
                <?=$c['nama'];?>
            </div>
            <div class="col-4 p-1">
                <div class="btn btn-sm btn-light w-100">
                    <i class="fas fa-calendar-alt"></i> 
                    <?=date('d-m-Y',strtotime($c['tgllahir']));?>
                </div>
            </div>
            <div class="col-4 p-1">
                <?php 
                $ja=mysqli_num_rows(mysqli_query($kon,"SELECT * FROM anak where idbunda='$c[idbunda]'"));
                ?>
                <div class="btn btn-sm btn-primary w-100">
                <i class="fas fa-user-alt"></i>  
                Anak : <?=$ja;?>
                </div>
            </div>
            <div class="col-4 p-1">
                <?php 
                $ch=mysqli_fetch_array(mysqli_query($kon,"SELECT * FROM kuis where idbunda='$c[idbunda]'"));
                if(isset($ch['idbunda']))
                {
                    ?>
                    <div class="btn btn-sm btn-success w-100">
                    Kuis : <?=$ch['nilai'];?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}
?>
</div>