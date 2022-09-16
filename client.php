<?php
include"header.php";
?>


<div class="container">

<?php
$con=mysqli_connect("localhost","root","12345","anbar");
$tarix=date("Y-m-d H:i:s");




if(isset($_POST['axtar']) && !empty($_POST['sorgu']))
{$sorgu = " WHERE ( ad LIKE '%".$_POST['sorgu']."%') ";}
else
{$sorgu = "";}


?>




<?php
if(isset($_POST['d']))

	include"upload.php";
{

    
   if(empty($_POST['ad'])){unset($_POST['ad']);} else{$ad = trim($_POST['ad']); $ad = htmlspecialchars($ad);}  
   if(empty($_POST['soyad'])){unset($_POST['soyad']);} else{$soyad = trim($_POST['soyad']); $soyad = htmlspecialchars($soyad);}
   if(empty($_POST['shirket'])){unset($_POST['shirket']);} else{$sirket = trim($_POST['shirket']); $sirket = htmlspecialchars($sirket);}
   if(empty($_POST['tel'])){unset($_POST['tel']);} else{$tel = trim($_POST['tel']); $tel = htmlspecialchars($tel);}
   if(empty($_POST['parol'])){unset($_POST['parol']);} else{$parol = trim($_POST['parol']); $parol = htmlspecialchars($parol);}
	if(!empty($ad) && !empty($soyad) && !empty($sirket) && !empty($tel)&& !empty($parol)&& isset($foto))
	{

		$sec=mysqli_query($con,"SELECT * FROM client WHERE telefon='".mysqli_real_escape_string($con,$tel)."'");
		$say=mysqli_num_rows($sec);

		if($say==0)
		{
			$daxilet=mysqli_query($con,"INSERT INTO client(ad,soyad,sirket,telefon,parol,tarix,foto) 
											VALUES('".mysqli_real_escape_string($con,$ad)."','".mysqli_real_escape_string($con,$soyad)."','".mysqli_real_escape_string($con,$sirket)."','".mysqli_real_escape_string($con,$tel)."','".mysqli_real_escape_string($con,$parol)."','".$tarix."','".$foto."')");

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



$duzelt=mysqli_query($con,"SELECT * FROM client ORDER BY id DESC");
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

	$sil=mysqli_query($con,"DELETE FROM client WHERE id='".mysqli_real_escape_string($con,$id)."'");

	if($sil==true)
	{echo'<div class="alert alert-danger" role="alert">Uğurla silindi</div>';}
	else
	{echo'<div class="alert alert-danger" role="alert">Silmək mümkün olmadı</div>';}
}





if(isset($_POST['update']))
{

   if(empty($_POST['id'])){unset($_POST['id']);} else{$id = trim($_POST['id']); $id = htmlspecialchars($id);}       
   if(empty($_POST['ad'])){unset($_POST['ad']);} else{$ad = trim($_POST['ad']); $ad = htmlspecialchars($ad);}  
   if(empty($_POST['soyad'])){unset($_POST['soyad']);} else{$soyad = trim($_POST['soyad']); $soyad = htmlspecialchars($soyad);}
   if(empty($_POST['shirket'])){unset($_POST['shirket']);} else{$sirket = trim($_POST['shirket']); $sirket = htmlspecialchars($sirket);}
   if(empty($_POST['tel'])){unset($_POST['tel']);} else{$tel = trim($_POST['tel']); $tel = htmlspecialchars($tel);}
   if(empty($_POST['parol'])){unset($_POST['parol']);} else{$parol = trim($_POST['parol']); $parol = htmlspecialchars($parol);}
   

		$sec=mysqli_query($con,"SELECT * FROM client WHERE telefon='".mysqli_real_escape_string($con,$tel)."' AND id!='".mysqli_real_escape_string($con,$id)."'");
		$say=mysqli_num_rows($sec);

		if($say==0)
		{
			if($_FILES['foto']['size']<1000)
			{$foto=$_POST['cari_foto'];}
		    else
		    {include"upload.php";}

			$daxilet=mysqli_query($con,"UPDATE client SET 
				ad='".mysqli_real_escape_string($con,$ad)."',foto='".$foto."',soyad='".mysqli_real_escape_string($con,$soyad)."',sirket='".mysqli_real_escape_string($con,$sirket)."',telefon='".mysqli_real_escape_string($con,$tel)."',parol='".mysqli_real_escape_string($con,$parol)."'
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

	?>

	<form method="post" enctype="multipart/form-data">
	<input type="text" class="form-control" placeholder="Müştərinin adı..." name="ad"><br>
	<input type="text" class="form-control" placeholder="Müştərinin soyadı..." name="soyad"><br>
	<input type="text" class="form-control" placeholder="Telefon..." name="tel"><br>
	<input type="text" class="form-control" placeholder="Şirkət..." name="shirket"><br>
	<input type="text" class="form-control" placeholder="Parol..." name="parol"><br>
	<input type="file" name="foto" class="form-control"><br>
	<button type="submit" name="d" class="btn btn-success btn-lg"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
  <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
</svg></button>

<a href="http://localhost/Anbar/excel/Examples/client.php" title="Excelə eksport" class="btn btn-info btn-lg"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-earmark-excel-fill" viewBox="0 0 16 16">
  <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM5.884 6.68L8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64z"/>
</svg></a>

</form>

	
<?php
}



if(isset($_POST['edit']))
{
	
if(empty($_POST['id'])){unset($_POST['id']);} else{$id = trim($_POST['id']); $id = htmlspecialchars($id);}       
   if(empty($_POST['ad'])){unset($_POST['ad']);} else{$ad = trim($_POST['ad']); $ad = htmlspecialchars($ad);}  
   if(empty($_POST['soyad'])){unset($_POST['soyad']);} else{$soyad = trim($_POST['soyad']); $soyad = htmlspecialchars($soyad);}
   if(empty($_POST['shirket'])){unset($_POST['shirket']);} else{$sirket = trim($_POST['shirket']); $sirket = htmlspecialchars($sirket);}
   if(empty($_POST['tel'])){unset($_POST['tel']);} else{$tel = trim($_POST['tel']); $tel = htmlspecialchars($tel);}
   if(empty($_POST['parol'])){unset($_POST['parol']);} else{$parol = trim($_POST['parol']); $parol = htmlspecialchars($parol);}
   


	$sec=mysqli_query($con,"SELECT * FROM client  WHERE id='".mysqli_real_escape_string($con,$id)."'");
	$info=mysqli_fetch_array($sec);
	?>

	<form method="post" enctype="multipart/form-data">
	<input type="hidden" class="form-control" name="id" value="<?=$info['id'] ?>"><br>
	<input type="hidden" class="form-control" name="cari_foto" value="<?=$info['foto'] ?>"><br>
	<input type="text" class="form-control" placeholder="Müştərinin adı..." name="ad" value="<?=$info['ad'] ?>"><br>
	<input type="file" name="foto" class="form-control"><br>
	<img src="<?=$info['foto'] ?>" class="img-thumbnail" width="200px" height="200px">
	<input type="text" class="form-control" placeholder="Müştərinin soyadı..." name="soyad" value="<?=$info['soyad'] ?>"><br>
	<input type="text" class="form-control" placeholder="Telefon..." name="tel" value="<?=$info['telefon'] ?>"><br>
	<input type="text" class="form-control" placeholder="Parol..." name="parol" value="<?=$info['parol'] ?>"><br>
	<input type="text" class="form-control" placeholder="Şirkət..." name="shirket" value="<?=$info['sirket'] ?>"><br>
	<button type="submit" name="update" class="btn btn-success btn-lg"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
</svg></button>
<button type="submit" name="yox" class="btn btn-danger btn-lg"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg></button>
</form>

	
<?php
}


//MUSTERI ADINA GORE CESHIDLEME START
if(isset($_GET['caceshid']) && $_GET['caceshid']=='z-a')
{
	$caceshid_link = '<a href="?caceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY client.ad DESC";
}

if(isset($_GET['caceshid']) && $_GET['caceshid']=='a-z')
{
	$caceshid_link = '<a href="?caceshid=z-a"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
  <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
  <path fill-rule="evenodd" d="M10.082 12.629L9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
  <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY client.ad ASC";
}

if(empty($_GET['caceshid']))
{
	$caceshid_link = '<a href="?caceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
}
//MUSTERI ADINA GORE CESHIDLEME END



//MUSTERI SOYADINA GORE CESHIDLEME START
if(isset($_GET['csceshid']) && $_GET['csceshid']=='z-a')
{
	$csceshid_link = '<a href="?csceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY client.soyad DESC";
}

if(isset($_GET['csceshid']) && $_GET['csceshid']=='a-z')
{
	$csceshid_link = '<a href="?csceshid=z-a"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
  <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
  <path fill-rule="evenodd" d="M10.082 12.629L9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
  <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY client.soyad ASC";
}

if(empty($_GET['csceshid']))
{
	$csceshid_link = '<a href="?csceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
}
//MUSTERI SOYADINA GORE CESHIDLEME END



//SIRKET ADINA GORE CESHIDLEME START
if(isset($_GET['saceshid']) && $_GET['saceshid']=='z-a')
{
	$saceshid_link = '<a href="?saceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY client.sirket DESC";
}

if(isset($_GET['saceshid']) && $_GET['saceshid']=='a-z')
{
	$saceshid_link = '<a href="?saceshid=z-a"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
  <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
  <path fill-rule="evenodd" d="M10.082 12.629L9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
  <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY client.sirket ASC";
}

if(empty($_GET['saceshid']))
{
	$saceshid_link = '<a href="?saceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
}
//SIRKET ADINA GORE CESHIDLEME END




//TARIXE GORE CESHIDLEME START
if(isset($_GET['ctceshid']) && $_GET['ctceshid']=='z-a')
{
	$ctceshid_link = '<a href="?ctceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY client.tarix DESC";
}

if(isset($_GET['ctceshid']) && $_GET['ctceshid']=='a-z')
{
	$ctceshid_link = '<a href="?ctceshid=z-a"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
  <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
  <path fill-rule="evenodd" d="M10.082 12.629L9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
  <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY client.tarix ASC";
}

if(empty($_GET['ctceshid']))
{
	$ctceshid_link = '<a href="?ctceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
}
//TARIXE GORE CESHIDLEME END


if(!isset($_GET['caceshid']) && !isset($_GET['cseshid'])&& !isset($_GET['saceshid'])&& !isset($_GET['ctceshid']))
	{$order = " ORDER BY client.id DESC";}


$sec=mysqli_query($con,"SELECT * FROM client ".$sorgu." ".$order."");
$info=mysqli_fetch_array($sec);



 

?>


<table class="table table-striped table-dark">

  <thead>
    <tr>
      <th>#</th>
      <th>Loqo</th>
      <th>Ad  <?=$caceshid_link ?></th>
      <th>Soyad <?=$csceshid_link ?></th>
      <th>Şirkət <?=$saceshid_link ?></th>
      <th>Telefon</th>
      <th>Parol</th>
      <th>Tarix  <?=$ctceshid_link ?></th>
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
      <td> <img width="65px" height="55px" src="'.$info['foto'].'"></td>
      <td>'.$info['ad'].'</td>
      <td>'.$info['soyad'].'</td>
      <td>'.$info['sirket'].'</td>
      <td>'.$info['telefon'].'</td>
      <td>'.$info['parol'].'</td>
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

   <a href="pdf/data/anbar_client.php?x=<?=$info['id'] ?>" class="btn btn-info"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
  <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
  <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
</svg></a>


		</form>
		</td>

	</tr>




 <?php




}
while($info=mysqli_fetch_array($sec));


?>


</table>



</div>
