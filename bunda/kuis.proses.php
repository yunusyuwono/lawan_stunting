<?php 
session_start();
include "../config/koneksi.php";
$u=mysqli_fetch_array(mysqli_query($kon,"SELECT * FROM bunda where idbunda='$_SESSION[idbunda]'"));
$cs=mysqli_num_rows(mysqli_query($kon,"SELECT * from itemkuis"));
$jp=count($_POST)-1;
if($jp<$cs)
{
	$kdp=3;
	$dm=$cs-$jp;
	$msg=array('kode'=>$kdp, 'dm'=>'Ada soal yang belum terjawab sebanyak : '.$dm);
}
elseif($jp==$cs)
{
	$p=$_POST;
	unset($p['idbunda']);

	//$dm='';
	$jb=0;
	for($s=1;$s<=count($p);$s++)
	{
		$v=$p['pg-'.$s];
		$ns=$s;
		$soal=mysqli_fetch_array(mysqli_query($kon,"SELECT * from itemkuis where idsoal='$ns'"));
		/*
		$dm .='No. '.$ns.'. Jawaban : '.$v.' KJ : '.$soal['j'].' -->';
		$dm .=$v==$soal['j']?'B':'S';
		$dm .='<br>';
		*/
		$ket= $v==$soal['j']?'B':'S';
		if($ket=='B')
		{
			$jb=$jb+1;
		}
	}
	$nilai=$jb*4;
	$dm='Nilai anda pada kuis ini adalah <br><br>'.$nilai;
	mysqli_query($kon,"INSERT into kuis (idbunda,nilai) values ('$u[idbunda]','$nilai')");
	$kdp=1;
	$msg=array('kode'=>$kdp, 'dm'=>$dm);
}



echo json_encode($msg);
?>