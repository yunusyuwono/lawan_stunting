<!DOCTYPE html>
<html lang="en">
<?php 
include 'config/koneksi.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAWAN STUNTING - LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 mt-5">
                <div class="card card-header bg-light p-1" align="center">
                    <b>LOGIN</b>
                </div>
                <?php 
                if(isset($_POST['login']))
                {
                    $akses=$_POST['akses'];
                    $hp=addslashes($_POST['hp']);
                    $pw=md5(addslashes($_POST['pw']));

                    $cp=mysqli_num_rows(mysqli_query($kon,"SELECT * from $akses where hp='$hp' and password='$pw'"));
                    if($cp==0)
                    {
                        ?>
                        <div class="alert alert-danger p-1 mt-1 mb-1" align="center">
                            Login gagal. Username atau Password salah
                        </div>
                        <?php
                    }
                    else
                    {
                       
                        $c=mysqli_fetch_array(mysqli_query($kon,"SELECT * from $akses where hp='$hp' and password='$pw'"));
                        session_start();
                        if($akses=='bunda')
                        {
                            $_SESSION['idbunda']=$c['idbunda'];
                            header("location:bunda/");
                        }
                        elseif($akses=='kader')
                        {
                            $_SESSION['idkader']=$c['idkader'];
                            header("location:kader/");
                        }
                        
                        
                    }
                }
                ?>
                <div class="card card-body p-1 mt-2">
                <form method="post">
                    <div class="form-group">
                        <label>Pilih Akses</label>
                        <select class="form-control" name="akses" id="akses">
                            <option value="bunda">Bunda</option>
                            <option value="kader">admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No. HP</label>
                        <input type="text" class="form-control" placeholder="No. Handphone" name="hp" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="pw" required>
                    </div>
                    <div class="form-group mt-3">
                        <button class="btn btn-primary btn-sm w-100" name="login">Login</button>
                        <a class="btn btn-outline-primary btn-sm w-100" href="daftar">Daftar</a>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</body>
<footer>
	<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.js"></script>
</footer>

<style>
    @import url('https://fonts.googleapis.com/css?family=Raleway:400,700');

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0; 
    font-family: Raleway, sans-serif;
}

body {
    background: linear-gradient(90deg, #C7C5F4, #776BCC);       
}

.container {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
}

.screen {       
    background: linear-gradient(90deg, #5D54A4, #7C78B8);       
    position: relative; 
    height: 600px;
    width: 360px;   
    box-shadow: 0px 0px 24px #5C5696;
}

.screen__content {
    z-index: 1;
    position: relative; 
    height: 100%;
}

.screen__background {       
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 0;
    -webkit-clip-path: inset(0 0 0 0);
    clip-path: inset(0 0 0 0);  
}

.screen__background__shape {
    transform: rotate(45deg);
    position: absolute;
}

.screen__background__shape1 {
    height: 520px;
    width: 520px;
    background: #FFF;   
    top: -50px;
    right: 120px;   
    border-radius: 0 72px 0 0;
}

.screen__background__shape2 {
    height: 220px;
    width: 220px;
    background: #6C63AC;    
    top: -172px;
    right: 0;   
    border-radius: 32px;
}

.screen__background__shape3 {
    height: 540px;
    width: 190px;
    background: linear-gradient(270deg, #5D54A4, #6A679E);
    top: -24px;
    right: 0;   
    border-radius: 32px;
}

.screen__background__shape4 {
    height: 400px;
    width: 200px;
    background: #7E7BB9;    
    top: 420px;
    right: 50px;    
    border-radius: 60px;
}

.login {
    width: 320px;
    padding: 30px;
    padding-top: 156px;
}

.login__field {
    padding: 20px 0px;  
    position: relative; 
}

.login__icon {
    position: absolute;
    top: 30px;
    color: #7875B5;
}

.login__input {
    border: none;
    border-bottom: 2px solid #D1D1D4;
    background: none;
    padding: 10px;
    padding-left: 24px;
    font-weight: 700;
    width: 75%;
    transition: .2s;
}

.login__input:active,
.login__input:focus,
.login__input:hover {
    outline: none;
    border-bottom-color: #6A679E;
}

.login__submit {
    background: #fff;
    font-size: 14px;
    margin-top: 30px;
    padding: 16px 20px;
    border-radius: 26px;
    border: 1px solid #D4D3E8;
    text-transform: uppercase;
    font-weight: 700;
    display: flex;
    align-items: center;
    width: 100%;
    color: #4C489D;
    box-shadow: 0px 2px 2px #5C5696;
    cursor: pointer;
    transition: .2s;
}

.login__submit:active,
.login__submit:focus,
.login__submit:hover {
    border-color: #6A679E;
    outline: none;
}

.button__icon {
    font-size: 24px;
    margin-left: auto;
    color: #7875B5;
}

.social-login { 
    position: absolute;
    height: 140px;
    width: 160px;
    text-align: center;
    bottom: 0px;
    right: 0px;
    color: #fff;
}

.social-icons {
    display: flex;
    align-items: center;
    justify-content: center;
}

.social-login__icon {
    padding: 20px 10px;
    color: #fff;
    text-decoration: none;  
    text-shadow: 0px 0px 8px #7875B5;
}

.social-login__icon:hover {
    transform: scale(1.5);  
}
</style>