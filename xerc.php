<?php
include"header.php";
?>


<div class="container">

<?php
$con=mysqli_connect("localhost","root","12345","anbar");
$tarix=date("Y-m-d H:i:s");


if(isset($_POST['axtar']) && !empty($_POST['sorgu']))
{$sorgu = " AND (teyinat LIKE '%".$_POST['sorgu']."%') ";}
else
{$sorgu = "";}


?>


<?php
if(isset($_POST['d']))
{
	if(empty($_POST['teyinat'])){unset($_POST['teyinat']);} else{$teyinat = trim($_POST['teyinat']); $teyinat = htmlspecialchars($teyinat);} 
	if(empty($_POST['mebleg'])){unset($_POST['mebleg']);} else{$mebleg = trim($_POST['mebleg']); $mebleg = htmlspecialchars($mebleg);} 
	



	if(!empty($teyinat) && !empty($mebleg))
	{

		

		$sec=mysqli_query($con,"SELECT * FROM xerc WHERE teyinat='".mysqli_real_escape_string($con,$teyinat)."'");
		$say=mysqli_num_rows($sec);

		if($say==0)
		{
			$daxilet=mysqli_query($con,"INSERT INTO xerc(teyinat,mebleg,tarix) 
											VALUES('".mysqli_real_escape_string($con,$teyinat)."','".mysqli_real_escape_string($con,$mebleg)."','".$tarix."')");

				if($daxilet==true)
					{echo'<div class="alert alert-success" role="alert">Müştəri uğurla bazaya yerləşdirildi</div>';}
				else
					{echo'<div class="alert alert-danger" role="alert">Müştərini bazaya yerləşdirmek mümkün olmadı</div>';}
		}
		else
		{echo'<div class="alert alert-warning" role="alert">Bu müştəri artıq bazada mövcuddur</div>';}


	}
	else
	{echo'<div class="alert alert-warning" role="alert">Lütfən məlumatları tam doldurun</div>';}
	

}



$duzelt=mysqli_query($con,"SELECT * FROM xerc ORDER BY id DESC");
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
	if(empty($_POST['id'])){unset($_POST['id']);} else{$id = trim($_POST['id']); $id = htmlspecialchars($id);}
	$sil=mysqli_query($con,"DELETE FROM xerc WHERE id='".mysqli_real_escape_string($con,$id)."'");

	if($sil==true)
	{echo'<div class="alert alert-danger" role="alert">Uğurla silindi</div>';}
	else
	{echo'<div class="alert alert-danger" role="alert">Silmək mümkün olmadı</div>';}
}





if(isset($_POST['update']))
{

    if(empty($_POST['id'])){unset($_POST['id']);} else{$id = trim($_POST['id']); $id = htmlspecialchars($id);} 
	if(empty($_POST['teyinat'])){unset($_POST['teyinat']);} else{$teyinat = trim($_POST['teyinat']); $teyinat = htmlspecialchars($teyinat);} 
	if(empty($_POST['mebleg'])){unset($_POST['mebleg']);}   else{$mebleg = trim($_POST['mebleg']);   $mebleg = htmlspecialchars($mebleg);} 
    

    $sec=mysqli_query($con,"SELECT * FROM xerc WHERE teyinat='".mysqli_real_escape_string($con,$teyinat)."' AND id!='".mysqli_real_escape_string($con,$id)."'");
		$say=mysqli_num_rows($sec);

		if($say==0)
		{
			$daxilet=mysqli_query($con,"UPDATE xerc SET 
				teyinat='".mysqli_real_escape_string($con,$teyinat)."',mebleg='".mysqli_real_escape_string($con,$mebleg)."'
				WHERE id='".mysqli_real_escape_string($con,$id)."'");

				if($daxilet==true)
					{echo'<div class="alert alert-success" role="alert">Müştəri uğurla yeniləndi</div>';}
				else
					{echo'<div class="alert alert-danger" role="alert">Müştərini yeniləmək mümkün olmadı</div>';}
		}
		else
		{echo'<div class="alert alert-warning" role="alert">Bu müştəri artıq bazada mövcuddur</div>';}
}







if(!isset($_POST['edit']))
{
   $sec=mysqli_query($con,"SELECT * FROM xerc  WHERE id='".mysqli_real_escape_string($con,$id)."'");
	$info=mysqli_fetch_array($sec);


?>

	<form method="post">
	<input type="text" class="form-control" placeholder="Müştərinin təyinatı" name="teyinat"><br>
	<input type="text" class="form-control" placeholder="Müştərinin daxil etdiyi məbləğ" name="mebleg"><br>
	<button type="submit" name="d" class="btn btn-success btn-lg"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
  <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
</svg></button>



	<a href="http://localhost/Anbar/excel/Examples/xerc.php" title="Excelə eksport" class="btn btn-info btn-lg"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-earmark-excel-fill" viewBox="0 0 16 16">
  <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM5.884 6.68L8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64z"/>
</svg></a>

</form>

	
<?php
}



if(isset($_POST['edit']))
{

     	
      if(empty($_POST['id'])){unset($_POST['id']);} else{$id = trim($_POST['id']); $id = htmlspecialchars($id);} 
      if(empty($_POST['teyinat'])){unset($_POST['teyinat']);} else{$teyinat = trim($_POST['teyinat']); $teyinat = htmlspecialchars($teyinat);} 
	 if(empty($_POST['mebleg'])){unset($_POST['mebleg']);}   else{$mebleg = trim($_POST['mebleg']);   $mebleg = htmlspecialchars($mebleg);} 
    
    
	$sec=mysqli_query($con,"SELECT * FROM xerc  WHERE id='".mysqli_real_escape_string($con,$id)."'");
	
	$info=mysqli_fetch_array($sec);
	?>

	<form method="post">
	<input type="hidden" class="form-control" name="id" value="<?=$info['id'] ?>"><br>
	<input type="text" class="form-control" placeholder="Müştərinin təyinatı..." name="teyinat" value="<?=$info['teyinat'] ?>"><br>
	<input type="text" class="form-control" placeholder="Müştərinin daxil etdiyi məbləğ..." name="mebleg" value="<?=$info['mebleg'] ?>"><br>
	<button type="submit" name="update" class="btn btn-success btn-lg"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
</svg></button>
<button type="submit" name="yox" class="btn btn-danger btn-lg"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg></button>
</form>

	
<?php
}


// TEYINATA GORE CESHIDLEME START
if(isset($_GET['tceshid']) && $_GET['tceshid']=='z-a')
{
	$tceshid_link = '<a href="?tceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY xerc.teyinat DESC";
}

if(isset($_GET['tceshid']) && $_GET['tceshid']=='a-z')
{
	$tceshid_link = '<a href="?tceshid=z-a"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
  <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
  <path fill-rule="evenodd" d="M10.082 12.629L9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
  <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY xerc.teyinat ASC";
}

if(empty($_GET['tceshid']))
{
	$tceshid_link = '<a href="?tceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
}
//TEYINATA GORE CESHIDLEME END



//MEBLEGE GORE CESHIDLEME START
if(isset($_GET['mceshid']) && $_GET['mceshid']=='z-a')
{
	$mceshid_link = '<a href="?mceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY xerc.mebleg DESC";
}

if(isset($_GET['mceshid']) && $_GET['mceshid']=='a-z')
{
	$mceshid_link = '<a href="?mceshid=z-a"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
  <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
  <path fill-rule="evenodd" d="M10.082 12.629L9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
  <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY xerc.mebleg ASC";
}

if(empty($_GET['mceshid']))
{
	$mceshid_link = '<a href="?mceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
}
//MEBLEGE GORE CESHIDLEME END



//TARIXE GORE CESHIDLEME START
if(isset($_GET['xtceshid']) && $_GET['xtceshid']=='z-a')
{
	$xtceshid_link = '<a href="?xtceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY xerc.tarix DESC";
}

if(isset($_GET['xtceshid']) && $_GET['xtceshid']=='a-z')
{
	$xtceshid_link = '<a href="?xtceshid=z-a"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
  <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
  <path fill-rule="evenodd" d="M10.082 12.629L9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
  <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY xerc.tarix ASC";
}

if(empty($_GET['xtceshid']))
{
	$xtceshid_link = '<a href="?xtceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
}
//TARIXE GORE CESHIDLEME END


if(!isset($_GET['tceshid']) && !isset($_GET['mceshid'])&& !isset($_GET['xtceshid']))
{$order = " ORDER BY xerc.id DESC";}


$sec=mysqli_query($con,"SELECT * FROM xerc WHERE  xerc.id ".$sorgu." ".$order."");
$info=mysqli_fetch_array($sec);
 

 
?>


<table class="table table-striped table-dark">

  <thead>
    <tr>
      <th>#</th>
      <th>Təyinat <?=$tceshid_link ?></th>
      <th>Məbləğ  <?=$mceshid_link ?></th>
      <th>Tarix   <?=$xtceshid_link ?></th>
      <th></th>
    </tr>
  </thead>

  <tbody>


<?php

$i=0;

do
{
	  $i++;
      echo'<tr>
      <td>'.$i.'</td>
      <td>'.$info['teyinat'].'</td>
      <td>'.$info['mebleg'].'</td>
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

</table>

</div>


