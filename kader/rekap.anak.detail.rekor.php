<?php 
include "../config/koneksi.php";

$idanak=$_POST['idanak'];
$jenis=$_POST['jenis'];

echo strtoupper($jenis);
echo $jenis=='berat'?' (kg)':' (cm)';
?>
<div class="list-group">
<?php
for($u=0;$u<=60;$u++)
{
    $r=mysqli_fetch_array(mysqli_query($kon,"SELECT * from rekoranak where idanak='$idanak' and jenis='$jenis' and usia='$u'"));
    ?>
    <div class="list-group-item">
        <div class="row">
        <?php
        if(!isset($r['nilai']))
        {
            ?>
            <div class="col-4 p-1">
            <a class="btn btn-sm btn-light w-100">
            <?=$u.' bulan';?> 
            </a>
            </div>
            <div class="col-8 p-1">
            <a class="btn btn-sm btn-warning w-100">
            -
            </a>
            </div>
            <?php
        }
        else
        {
            ?>
            <div class="col-4 p-1">
            <a class="btn btn-sm btn-light w-100">
            <?php
            echo $u.' bulan';
            
            ?>
            </a>
            </div>
            <div class="col-8 p-1">
            <a class="btn btn-sm btn-warning w-100">
            <b><?php echo $r['nilai'];
            echo $jenis=='berat'?' (kg)':' (cm)'; ?></b>
            </a>
            </div>
            <?php
        }
        ?>
        </div>
    </div>
    <?php
}
?>
</div>