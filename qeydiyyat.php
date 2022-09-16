<?php
$con=mysqli_connect("localhost","root","12345","anbar");
$tarix=date("Y-m-d H:i:s");
?>




<?php


if(isset($_POST['d']))
{
	if(!empty($_POST['ad']) && !empty($_POST['soyad']) && !empty($_POST['email'])&& !empty($_POST['parol']))

		$sec=mysqli_query($con,"SELECT * FROM istifadeciler WHERE email='".$_POST['email']."'");
		$say=mysqli_num_rows($sec);

		if($say==0)
		{
			$daxilet=mysqli_query($con,"INSERT INTO istifadeciler(ad,soyad,email,parol,tarix) 
											VALUES('".$_POST['ad']."','".$_POST['soyad']."','".$_POST['email']."','".$_POST['parol']."','".$tarix."')");

				if($daxilet==true)
					{echo'İstifadəçi uğurla bazaya yerləşdirildi<br>';}
				else
					{echo'İstifadəçini bazaya yerləşdirmək mümkün olmadı<br>';}
		}
		else
		{echo'Bu istifadəçi artıq bazada mövcuddur<br><br>';}


	}
	else
	{echo'Lütfen məlumatları tam doldurun<br>';}
	


$sec=mysqli_query($con,"SELECT * FROM istifadeciler  ORDER BY id DESC");
$info=mysqli_fetch_array($sec);


?>






<br>
<form method="post">
	İstifadəçinin adı:<br>
	<input type="text" name="ad"><br>
	İstifadəçinin soyadı:<br>
	<input type="text" name="soyad"><br>
	İstifadəçinin emaili:<br>
	<input type="text" name="email"><br>
	İstifadəçinin parolu:<br>
	<input type="text" name="parol"><br>
	<input type="submit" name="d" value="Elave et">
</form>