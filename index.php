<?php
session_start();
$con=mysqli_connect("localhost","root","12345","anbar");


if(isset($_SESSION['tel']) && isset($_SESSION['parol']))
{echo'<meta http-equiv="refresh" content="0; URL=brend.php">'; exit;}

?>






<html>
  <head>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
  </head>


<style>
	body#LoginForm{ background-image:url("https://hdwallsource.com/img/2014/9/blur-26347-27038-hd-wallpapers.jpg"); background-repeat:no-repeat; background-position:center; background-size:cover; padding:10px;}

.form-heading { color:#fff; font-size:23px;}
.panel h2{ color:#444444; font-size:18px; margin:0 0 8px 0;}
.panel p { color:#777777; font-size:14px; margin-bottom:30px; line-height:24px;}
.login-form .form-control {
  background: #f7f7f7 none repeat scroll 0 0;
  border: 1px solid #d4d4d4;
  border-radius: 4px;
  font-size: 14px;
  height: 50px;
  line-height: 50px;
}
.main-div {
  background: #ffffff none repeat scroll 0 0;
  border-radius: 2px;
  margin: 10px auto 30px;
  max-width: 38%;
  padding: 50px 70px 70px 71px;
}

.login-form .form-group {
  margin-bottom:10px;
}
.login-form{ text-align:center;}
.forgot a {
  color: #777777;
  font-size: 14px;
  text-decoration: underline;
}
.login-form  .btn.btn-primary {
  background: #f0ad4e none repeat scroll 0 0;
  border-color: #f0ad4e;
  color: #ffffff;
  font-size: 14px;
  width: 100%;
  height: 50px;
  line-height: 50px;
  padding: 0;
}
.forgot {
  text-align: left; margin-bottom:30px;
}
.botto-text {
  color: #ffffff;
  font-size: 14px;
  margin: auto;
}
.login-form .btn.btn-primary.reset {
  background: #ff9900 none repeat scroll 0 0;
}
.back { text-align: left; margin-top:10px;}
.back a {color: #444444; font-size: 13px;text-decoration: none;}

</style>


<body id="LoginForm">
<div class="container">
<h1 class="form-heading"><!--login Form--></h1>
<div class="login-form">
<div class="main-div">
    <div class="panel">
   <h2>Anbar</h2>
   <p><?php


if(isset($_POST['d']))
{



$sec=mysqli_query($con,"SELECT * FROM client WHERE telefon='".$_POST['telefon']."' AND parol='".$_POST['parol']."'");

if(mysqli_num_rows($sec)>0)
{
	$info=mysqli_fetch_array($sec);
	
	$_SESSION['ad'] = $info['ad'];
	$_SESSION['soyad'] = $info['soyad'];
	$_SESSION['tel'] = $info['telefon'];
	$_SESSION['parol'] = $info['parol'];
	$_SESSION['sirket'] = $info['sirket'];
	$_SESSION['foto'] = $info['foto'];

	echo'<meta http-equiv="refresh" content="0; URL=brend.php">';
}
else
{echo'Bele bir istifadeci movcud deyildir<br>';}

}

?></p>
   </div>
    <form id="Login" method="post">

        <div class="form-group">


            <input type="tel" class="form-control" placeholder="Email ünvanı" name="telefon">

        </div>

        <div class="form-group">

            <input type="password" class="form-control" placeholder="Şifrə" name="parol">

        </div>
       <!-- <div class="forgot">
        <a href="reset.html">Forgot password?</a>
</div> -->
        <button type="submit" class="btn btn-success btn-lg" name="d">Daxil ol</button>

    </form>
    </div>
<p class="botto-text"> Designed by Samir Mammadov</p>
</div></div></div>


</body>