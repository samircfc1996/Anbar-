<?php
include"header.php";
?>

<div class="container">


<?php
$con=mysqli_connect("localhost","samir","12345","anbar");
$tarix=date("Y-m-d H:i:s");




if(isset($_POST['axtar']) && !empty($_POST['sorgu']))
{$sorgu = " WHERE ( ad LIKE '%".$_POST['sorgu']."%') ";}
else
{$sorgu = "";}

?>

<?php
if(isset($_POST['d']))
{
include"upload.php";

	 
if(empty($_POST['ad'])){unset($_POST['ad']);} else{$ad = trim($_POST['ad']); $ad = htmlspecialchars($ad);} 


	{$sec=mysqli_query($con,"SELECT * FROM brand WHERE ad='".mysqli_real_escape_string($con,$ad)."'");
    $say=mysqli_num_rows($sec);


    if($say==0) 
	{
		$daxilet=mysqli_query($con,"INSERT INTO brand(ad,foto,tarix) VALUES('".mysqli_real_escape_string($con,$ad)."','".$foto."','".$tarix."')"); 
    
           if($daxilet==true) {echo'<div class="alert alert-success" role="alert">Brend uğurla bazaya yerlədirildi</div>';} 
                         else {echo'<div class="alert alert-success" role="alert">Brendi bazaya yerləshdirmək mümkün olmadı</div>';} 


  }       
  else {echo'<div class="alert alert-warning" role="alert">Bu brend artıq bazada mövcuddur</div>';} } 
 

 }


$duzelt=mysqli_query($con,"SELECT * FROM brand ORDER BY id DESC");
$melumat=mysqli_fetch_array($duzelt); $say=mysqli_num_rows($duzelt);

if(isset($_POST['sil']))
{
?>
	<form method="post">

		<input type="hidden" name="id" value="<?=$_POST['id'] ?>">
		<div class="alert alert-danger" role="alert">Brendi silməyinizə əminsinizmi?<br>
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
	if(empty($_POST['id'])){unset($_POST['id']);} else{$id = trim($_POST['id']); $id = htmlspecialchars($id);} 

	$sil=mysqli_query($con,"DELETE FROM brand WHERE id='".mysqli_real_escape_string($con,$id)."'");
	if($sil==true)
	{echo'<div class="alert alert-danger" role="alert">Uğurla silindi</div>';}
	else
	{echo'<div class="alert alert-danger" role="alert">Silmək mümkün olmadı</div>';}
}




if(!isset($_POST['edit']))
{
     
	$sec=mysqli_query($con,"SELECT * FROM brand  WHERE id='".mysqli_real_escape_string($con,$ad)."'");
	$info=mysqli_fetch_array($sec);
	?>

	<form method="post" enctype="multipart/form-data">
	<input type="text" class="form-control" placeholder="Brendin adi..." name="ad" autocomplete="off"><br>
	<input type="file" name="foto" class="form-control"><br>
	<button type="submit" name="d" class="btn btn-success btn-lg"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
</svg></button> &nbsp;

<a href="http://localhost/Anbar/excel/Examples/brend.php" title="Excelə eksport" class="btn btn-info btn-lg"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-earmark-excel-fill" viewBox="0 0 16 16">
  <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM5.884 6.68L8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64z"/>
</svg></a>

</form>

	
<?php
}





if(isset($_POST['edit']))
{


	$sec=mysqli_query($con,"SELECT * FROM brand  WHERE id='".mysqli_real_escape_string($con,$_POST['id'])."'");
	$info=mysqli_fetch_array($sec);
	?>

	<form method="post" enctype="multipart/form-data">
	<input type="text"class="form-control" placeholder="Ad..." name="ad" value="<?=$info['ad'] ?>"><br>
	<img src="<?=$info['foto'] ?>" class="img-thumbnail" width="200px" height="200px">
	<input type="file" name="foto" class="form-control"><br>
	<input type="hidden" name="id" value="<?=$info['id'] ?>">
	<input type="hidden" name="cari_foto" value="<?=$info['foto'] ?>">
	<button type="submit"name="yenile" class="btn btn-success btn-lg"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
</svg></button>
</form>

	
<?php
}


if(isset($_POST['yenile']))
{

if(empty($_POST['id'])){unset($_POST['id']);} else{$id = trim($_POST['id']); $id = htmlspecialchars($id);} 
if(empty($_POST['ad'])){unset($_POST['ad']);} else{$ad = trim($_POST['ad']); $ad = htmlspecialchars($ad);} 





			$sec=mysqli_query($con,"SELECT * FROM brand WHERE ad='".mysqli_real_escape_string($con,$ad)."' AND id!='".mysqli_real_escape_string($con,$id)."'");
			$say=mysqli_num_rows($sec);

			if($say==0)
			{
				if($_FILES['foto']['size']<1000)
				{$foto = $_POST['cari_foto'];}
				else
				{include"upload.php";}

				$yenile=mysqli_query($con,"UPDATE brand
					  SET  ad='".mysqli_real_escape_string($con,$ad)."', foto='".$foto."'
					WHERE id='".mysqli_real_escape_string($con,$id)."'");
					

				if($yenile==true)
				{echo'<div class="alert alert-success" role="alert">Brend uğurla yeniləndi</div>';}
				else
				{echo'<div class="alert alert-danger" role="alert">Brendi yeniləmək mümkün olmadı</div>';}
		
			}
			else
			{echo'<div class="alert alert-warning" role="alert">Bu brend artıq bazada mövcuddur</div>';}
	}




if(isset($_GET['baceshid']) && $_GET['baceshid']=='z-a')
{
	$baceshid_link = '<a href="?baceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY brand.ad DESC";
}

if(isset($_GET['baceshid']) && $_GET['baceshid']=='a-z')
{
	$baceshid_link = '<a href="?baceshid=z-a"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
  <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
  <path fill-rule="evenodd" d="M10.082 12.629L9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
  <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY brand.ad ASC";
}

if(empty($_GET['baceshid']))
{
	$baceshid_link = '<a href="?baceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';	
}
//Tarixə GORE CESHIDLEME END





if(!isset($_GET['baceshid']))
{$order = " ORDER BY brand.id DESC";}


$duzelt=mysqli_query($con,"SELECT * FROM brand ".$sorgu." ".$order."");
$melumat=mysqli_fetch_array($duzelt);


?>



<table class="table table-striped table-dark">
<thead>
    <tr>
      <th scope="col">#</th>
      <th>Loqo</th>
      <th scope="col">Ad  <?=$baceshid_link ?></th>
      <th></th>
    </tr>
  </thead>

  <tbody>
<?php

$i=0;

do


{

	$i++;
    echo'<tr>';
    echo'<td>'.$i.'</td>';
    echo'<td><img width="65px" height="55px" src="'.$melumat['foto'].'"></td>';
    echo'<td>'.$melumat['ad'].'</td>';


	?>
		<td>
		<form method="post">
			<input type="hidden" name="id" value="<?=$melumat['id'] ?>">
			<button type="submit"name="edit" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></button>
			<button type="submit" name="sil"class="btn btn-danger" title="Sil"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
			  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg></button>
		</form>
		</td>

		<?php

		echo'</tr>';





}
while($melumat=mysqli_fetch_array($duzelt));


?>


</table>




</div>




















