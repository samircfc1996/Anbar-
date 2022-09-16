<?php
include"title.php";
?>

<div class="container">


<?php
$con=mysqli_connect("localhost","samir","12345","anbar");
$tarix=date("Y-m-d H:i:s");


?>


<?php
if(isset($_POST['d']))
{
	if(!empty($_POST['ad']) && !empty($_POST['alish']) && !empty($_POST['satish']) && !empty($_POST['miqdar']))
	{

		

			$daxilet=mysqli_query($con,"INSERT INTO say(ad,alis,satis,miqdar,tarix) 
											VALUES('".$_POST['ad']."','".$_POST['alish']."','".$_POST['satish']."','".$_POST['miqdar']."','".$tarix."')");

				if($daxilet==true)
					{echo'Məhsul uğurla bazaya yerləşdirildi';}
				else
					{echo'Məhsulu bazaya yerləşdirmek mümkün olmadı';}
		
	}
	else
	{echo'Lütfən məlumatları tam doldurun ';}
	

}

$duzelt=mysqli_query($con,"SELECT * FROM say ORDER BY id DESC");
$melumat=mysqli_fetch_array($duzelt);
$say=mysqli_num_rows($duzelt);


if(isset($_POST['sil']))
{
?>
	<form method="post">

		<input type="hidden" name="id" value="<?=$_POST['id'] ?>">
		<div class="alert alert-danger" role="alert">Siz bu brendi silməyinizə əminsinizmi?<br>
		<button type="submit" name="he" class="btn btn-success btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
</svg></button>
<button type="submit" name="yox" class="btn btn-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg></button>
		</div>
		
	</form>
<?php
}

if(isset($_POST['he']))
{
	$sil=mysqli_query($con,"DELETE FROM say WHERE id='".$_POST['id']."'");

	if($sil==true)
	{echo'<div class="alert alert-danger" role="alert">Uğurla silindi</div>';}
	else
	{echo'<div class="alert alert-danger" role="alert">Silmək mümkün olmadı</div>';}

}

if(isset($_POST['update']))
{
		$sec=mysqli_query($con,"SELECT * FROM say WHERE ad='".$_POST['ad']."' AND id!='".$_POST['id']."'");
		$say=mysqli_num_rows($sec);

		if($say==0)
		{
			$daxilet=mysqli_query($con,"UPDATE say SET 
				ad='".$_POST['ad']."',alis='".$_POST['alish']."',satis='".$_POST['satish']."',miqdar='".$_POST['miqdar']."'
				WHERE id='".$_POST['id']."'");

				if($daxilet==true)
					{echo'<div class="alert alert-success" role="alert">Brend uğurla yeniləndi</div>';}
				else
					{echo'<div class="alert alert-danger" role="alert">Brendi yeniləmək mümkün olmadı</div>';}
		}
		else
		{echo'<div class="alert alert-warning" role="alert">Bu brend artıq bazada mövcuddur</div>';}
}


if(!isset($_POST['edit']))
{

?>


   <form method="post">
   <input type="text"class="form-control" placeholder="Məhsulun adı" name="ad"><br>
   <input type="text"class="form-control" placeholder="Maya dəyəri" name="alish"><br>
   <input type="text"class="form-control" placeholder="Satışı qiyməti" name="satish"><br>
   <input type="text"class="form-control"placeholder="Miqdar"name="miqdar"><br>
  <button type="submit" name="d" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
</svg></button> 


</form>

<?php
}

if(isset($_POST['edit']))
{
	$sec=mysqli_query($con,"SELECT * FROM say  WHERE id='".$_POST['id']."'");
	$info=mysqli_fetch_array($sec);
	?>

	<form method="post">
	<input type="hidden" class="form-control" name="id" value="<?=$info['id'] ?>"><br>
	Məhsulun adı:<br>
	<input type="text" class="form-control" placeholder="Məhsulun adı" name="ad" value="<?=$info['ad'] ?>">
	Maya dəyəri:<br>
	<input type="text" class="form-control" placeholder="Maya dəyəri" name="alish" value="<?=$info['alis'] ?>">
	Satış qiyməti:<br>
	<input type="text" class="form-control" placeholder="Satışı qiyməti" name="satish" value="<?=$info['satis'] ?>">
	Miqdar:<br>
	<input type="text" class="form-control" placeholder="Miqdar"name="miqdar" value="<?=$info['miqdar'] ?>"><br>
	<button type="submit" name="update" class="btn btn-success btn-lg"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
</svg></button>
<button type="submit" name="yox" class="btn btn-danger btn-lg"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg></button>
</form>



<?php
}
$sec=mysqli_query($con,"SELECT * FROM say ORDER BY id DESC");
$info=mysqli_fetch_array($sec);

?>



<table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Ad</th>
      <th scope="col">Alış</th>
      <th scope="col">Satış</th>
      <th scope="col">Miqdar</th>
      <th scope="col">Tarix</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
   
<?php

$i=0;


do{



$i++;


      echo'<tr>
      <td>'.$i.'</td>
      <td>'.$info['ad'].'</td>
      <td>'.$info['alis'].'</td>
      <td>'.$info['satis'].'</td>
      <td>'.$info['miqdar'].'</td>
      <td>'.$info['tarix'].'</td>';
     

   
?>

<td>
		<form method="post">
			<input type="hidden" name="id" value="<?=$info['id'] ?>">
			<button type="submit"name="edit" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></button>
			<button type="submit" name="sil"class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
</svg></button>
		</form>
		</td>

	</tr>



<?php

}
while($info=mysqli_fetch_array($sec));


?>

    
  </tbody>
</table>



</div>