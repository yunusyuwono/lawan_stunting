<?php
include "../config/koneksi.php";
    $p=$_POST;
    $idanak=$_POST['idanak'];
    foreach($p as $key=>$val)
    {
        //echo $key.'='.$p[$key].'<br>';
        $kx=explode('-',$key);
        $x=end($kx);
        if($x!='idanak')
        {
            $cb=mysqli_fetch_array(mysqli_query($kon,"SELECT * from itemskor where iditem='$x'"));
            if(isset($p[$key]))
            {
                if($cb['opsi1']==$p[$key])
                {
                    $n=1;
                }
                elseif($cb['opsi2']==$p[$key])
                {
                    $n=2;
                }

                $nb=$n*$cb['skor'];
                $skor[]=$cb['skor'];
                $arn[]=$nb;
            }
        }
        //echo $x.'=>'.$p[$key].'='.$n.'---';
        //$jn[]=$n;
    }
    //echo json_encode($arn);
    $hskor=round(((array_sum($arn)/array_sum($skor))*10)/2,2);
    //echo array_sum($arn).'/'.array_sum($skor).' x 10 = '.$hskor;

    if($hskor>=8.5 && $hskor <=10)
    {
        $ket='BERISIKO STUNTING';
    }
    elseif($hskor>=0 && $hskor < 8.5)
    {
        $ket='TIDAK BERISIKO STUNTING';
    }

    $simskor=mysqli_query($kon,"INSERT into anakskor (idanak,skor,ket) values ('$idanak','$hskor','$ket')");
    if($simskor)
    {
        $psn=array('kode'=>1,'skor'=>$hskor,'ket'=>$ket);
    }
    else
    {
        $psn=array('kode'=>0,'ket'=>mysqli_error($kon));
    }

    echo json_encode($psn);
?>