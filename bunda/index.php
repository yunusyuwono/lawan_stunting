<?php include "nav.php";?>
<div class="container ">
	<div class="row">
		<div class="col-6  mt-2">
			<a class="btn btn-light w-100" style="border-radius:10px;background-color:#eee;border:1px solid gray" onclick="window.location.href='profil.anak'">
				<img src="../icon/add_anak.svg" class="img m-1" width="100px" height="100px">
				<hr>
				<b style="list-style: none;">Tambah Anak</b>
			</a>
		</div>
		<div class="col-6 mt-2">
			<a class="btn btn-light w-100" style="border-radius:10px;background-color:#eee;border:1px solid gray" onclick="window.location.href='kuis'">
				<i class="fas fa-question-circle text-primary" style="font-size:80pt"></i>
				<hr>
				<b style="list-style: none;">Kuis</b>
			</a>
		</div>
		<?php 
		$anak=mysqli_query($kon,"SELECT * from anak where idbunda='$_SESSION[idbunda]'");
		while($a=mysqli_fetch_array($anak))
		{
			?>
			<div class="col-6  mt-2" onclick="window.location.href='profil.anak.detail?idanak=<?=$a['idanak'];?>'">
				<a class="btn btn-light w-100" style="border-radius:10px;background-color:#efefef;border:1px solid gray">
					<?php 
					if($a['jk']=='L')
					{
						?>
						<img src="../icon/laki.svg" class="img m-1" width="100px" height="100px">
						<?php	
					}
					elseif($a['jk']=='P')
					{
						?>
						<img src="../icon/perempuan.svg" class="img m-1" width="100px" height="100px">
						<?php	
					}
					?>
					<hr>
					<b style="list-style: none;"><?=$a['nama'];?></b>
				</a>
			</div>
			<?php	
		}
		
		?>
	</div>
	
</div>
<?php include "foot.php";?>