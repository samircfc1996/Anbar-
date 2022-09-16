<?php
include"header.php";
?>


<div class="container">

<?php
$con=mysqli_connect("localhost","root","12345","anbar");
$tarix=date("Y-m-d H:i:s");




if(isset($_POST['axtar']) && !empty($_POST['sorgu']))
{$sorgu = " AND (a.ad LIKE '%".$_POST['sorgu']."%' OR b.ad LIKE '%".$_POST['sorgu']."%') ";}
else
{$sorgu = "";}

?>




<?php
if(isset($_POST['d']))
{
	include"upload.php";

   
   if(empty($_POST['ad'])){unset($_POST['ad']);} else{$ad = trim($_POST['ad']); $ad = htmlspecialchars($ad);}  
   if(empty($_POST['alish'])){unset($_POST['alish']);} else{$alis = trim($_POST['alish']); $alis = htmlspecialchars($alis);}
   if(empty($_POST['satish'])){unset($_POST['satish']);} else{$satis = trim($_POST['satish']); $satis = htmlspecialchars($satis);}
   if(empty($_POST['miqdar'])){unset($_POST['miqdar']);} else{$miqdar = trim($_POST['miqdar']); $miqdar = htmlspecialchars($miqdar);}
   if(empty($_POST['brand'])){unset($_POST['brand']);} else{$brand = trim($_POST['brand']); $brand = htmlspecialchars($brand);}




	if(!empty($ad) && !empty($alis) && !empty($satis) && !empty($miqdar) && !empty($brand)&& isset($foto))
	{

		

			$daxilet=mysqli_query($con,"INSERT INTO product(brand,ad,alis,satis,miqdar,tarix,foto) 
											VALUES('".mysqli_real_escape_string($con,$brand)."','".mysqli_real_escape_string($con,$ad)."','".mysqli_real_escape_string($con,$alis)."','".mysqli_real_escape_string($con,$satis)."','".mysqli_real_escape_string($con,$miqdar)."','".$tarix."','".$foto."')");

				if($daxilet==true)
					{echo'<div class="alert alert-success" role="alert">Məhsul uğurla bazaya yerləşdirildi</div>';}
				else
					{echo'<div class="alert alert-danger" role="alert">Məhsulu bazaya yerləşdirmek mümkün olmadı</div>';}
		
	}
	else
	{echo'<div class="alert alert-secondary" role="alert">Lütfən məlumatları tam doldurun</div>';}
	

}



$duzelt=mysqli_query($con,"SELECT * FROM client ORDER BY id DESC");
$melumat=mysqli_fetch_array($duzelt);
$say=mysqli_num_rows($duzelt);

if(isset($_POST['sil']))
{
?>


	<form method="post">

		<input type="hidden" name="id" value="<?=$_POST['id'] ?>">
		<div class="alert alert-danger" role="alert">Məhsulu silməyinizə əminsinizmi?<br>
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
	$sil=mysqli_query($con,"DELETE FROM product WHERE id='".mysqli_real_escape_string($con,$id)."'");

	if($sil==true)
	{echo'<div class="alert alert-danger" role="alert">Uğurla silindi</div>';}
	else
	{echo'<div class="alert alert-danger" role="alert">Silmək mümkün olmadı</div>';}
}


if(isset($_POST['update']))	
{
   if(empty($_POST['ad'])){unset($_POST['ad']);} else{$ad = trim($_POST['ad']); $ad = htmlspecialchars($ad);}  
   if(empty($_POST['alish'])){unset($_POST['alish']);} else{$alis = trim($_POST['alish']); $alis = htmlspecialchars($alis);}
   if(empty($_POST['satish'])){unset($_POST['satish']);} else{$satis = trim($_POST['satish']); $satis = htmlspecialchars($satis);}
   if(empty($_POST['miqdar'])){unset($_POST['miqdar']);} else{$miqdar = trim($_POST['miqdar']); $miqdar = htmlspecialchars($miqdar);}
   if(empty($_POST['brand'])){unset($_POST['brand']);} else{$brand = trim($_POST['brand']); $brand = htmlspecialchars($brand);} 
   if(empty($_POST['id'])){unset($_POST['id']);} else{$id = trim($_POST['id']); $id = htmlspecialchars($id);} 

		$sec=mysqli_query($con,"SELECT * FROM product WHERE ad='".mysqli_real_escape_string($con,$ad)."'AND id!='".mysqli_real_escape_string($con,$id)."'");
		$say=mysqli_num_rows($sec);

		if($say==0)
		{
			if($_FILES['foto']['size']<1000)
			{$foto=$_POST['cari_foto'];}
		    else
		    {include"upload.php";}

			$daxilet=mysqli_query($con,"UPDATE product SET 
				ad='".mysqli_real_escape_string($con,$ad)."',foto='".$foto."',alis='".mysqli_real_escape_string($con,$alis)."',satis='".mysqli_real_escape_string($con,$satis)."',miqdar='".mysqli_real_escape_string($con,$miqdar)."',brand='".mysqli_real_escape_string($con,$brand)."'
				WHERE id='".mysqli_real_escape_string($con,$id)."'");
				if($daxilet==true)
					{echo'<div class="alert alert-success" role="alert">Məhsul uğurla yeniləndi</div>';}
				else
					{echo'<div class="alert alert-danger" role="alert">Məhsulu yeniləmək mümkün olmadı</div>';}
		}
		else
		{echo'<div class="alert alert-warning" role="alert">Bu məhsul artıq bazada mövcuddur</div>';}
}


if(isset($_POST['defect']))
{
	$yenile==mysqli_query($con,"UPDATE product SET 
								defect=defect+1, 
								miqdar=miqdar-1 
								WHERE id='".mysqli_real_escape_string($con,$id)."'");
}

if(isset($_POST['legv']))
{
    

	
	$daxilet=mysqli_query($con,"UPDATE product SET 
						miqdar=miqdar+1,defect=defect-1 WHERE  id='".mysqli_real_escape_string($con,$id)."'");


	

}

if(!isset($_POST['edit']))
{

?>


<form method="post"  enctype="multipart/form-data">

	<select class="form-control" name="brand">

		<option value="">Brendi seçin</option>
		<?php

		$sec = mysqli_query($con,"SELECT * FROM brand ORDER BY ad ASC");

		while($info = mysqli_fetch_array($sec))
		{echo'<option value="'.$info['id'].'">'.$info['ad'].'</option>';}

		?>
	</select><br>

    
	<input type="text" class="form-control" placeholder="Məhsulun adı" name="ad"><br>
	<input type="file" name="foto" class="form-control"><br>
	<input type="text" class="form-control" placeholder="Maya dəyəri" name="alish"><br>
	<input type="text" class="form-control" placeholder="Satışı qiyməti" name="satish"><br>
	<input type="text" class="form-control" placeholder="Miqdar"name="miqdar"><br>
	<button type="submit" name="d" class="btn btn-success btn-lg"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
	  <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
	</svg></button> &nbsp;

	<a href="http://localhost/Anbar/excel/Examples/product.php" title="Excelə eksport" class="btn btn-info btn-lg"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-excel-fill" viewBox="0 0 16 16">
  <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM5.884 6.68L8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64z"/>
</svg></a>
</form>

<?php
}



if(isset($_POST['edit']))
{
       if(empty($_POST['id'])){unset($_POST['id']);} else{$id = trim($_POST['id']); $id = htmlspecialchars($id);} 
     if(empty($_POST['ad'])){unset($_POST['ad']);} else{$ad = trim($_POST['ad']); $ad = htmlspecialchars($ad);}  
   if(empty($_POST['alish'])){unset($_POST['alish']);} else{$alis = trim($_POST['alish']); $alis = htmlspecialchars($alis);}
   if(empty($_POST['satish'])){unset($_POST['satish']);} else{$satis = trim($_POST['satish']); $satis = htmlspecialchars($satis);}
   if(empty($_POST['miqdar'])){unset($_POST['miqdar']);} else{$miqdar = trim($_POST['miqdar']); $miqdar = htmlspecialchars($miqdar);}
   if(empty($_POST['brand'])){unset($_POST['brand']);} else{$brand = trim($_POST['brand']); $brand = htmlspecialchars($brand);} 


	$sec=mysqli_query($con,"SELECT * FROM product  WHERE id='".mysqli_real_escape_string($con,$id)."'");
	$info=mysqli_fetch_array($sec);
	?>
    <form method="post"enctype="multipart/form-data">
	<input type="hidden" class="form-control" name="id" value="<?=$info['id'] ?>">
	Brend:<br>
	<select class="form-control" name="brand">
		<option value="">Brendi seçin</option>
		<?php

		$bsec = mysqli_query($con,"SELECT * FROM brand ORDER BY ad ASC");

		while($binfo = mysqli_fetch_array($bsec))
		{
			if($info['brand']==$binfo['id'])
			{$x='selected';}
			else
			{$x='';}

			echo'<option '.$x.' value="'.$binfo['id'].'">'.$binfo['ad'].'</option>';
		}

		?>
	</select>
    <input type="hidden" class="form-control" name="cari_foto" value="<?=$info['foto'] ?>"><br>
    <input type="file" name="foto" class="form-control"><br>
    <img src="<?=$info['foto'] ?>" class="img-thumbnail" width="200px" height="200px"><br>
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


//MEHSUL ADINA GORE CESHIDLEME START
if(isset($_GET['mceshid']) && $_GET['mceshid']=='z-a')
{
	$mceshid_link = '<a href="?mceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY a.ad DESC";
}

if(isset($_GET['mceshid']) && $_GET['mceshid']=='a-z')
{
	$mceshid_link = '<a href="?mceshid=z-a"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
  <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
  <path fill-rule="evenodd" d="M10.082 12.629L9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
  <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY a.ad ASC";
}

if(empty($_GET['mceshid']))
{
	$mceshid_link = '<a href="?mceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
}
//MEHSUL ADINA GORE CESHIDLEME END







//BREND ADINA GORE CESHIDLEME START
if(isset($_GET['bceshid']) && $_GET['bceshid']=='z-a')
{
	$bceshid_link = '<a href="?bceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY b.ad DESC";
}

if(isset($_GET['bceshid']) && $_GET['bceshid']=='a-z')
{
	$bceshid_link = '<a href="?bceshid=z-a"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
  <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
  <path fill-rule="evenodd" d="M10.082 12.629L9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
  <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY b.ad ASC";
}

if(empty($_GET['bceshid']))
{
	$bceshid_link = '<a href="?bceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';	
}
//MEHSUL ADINA GORE CESHIDLEME END




//Alış Qiymetine GORE CESHIDLEME START
if(isset($_GET['aceshid']) && $_GET['aceshid']=='z-a')
{
	$aceshid_link = '<a href="?aceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY a.alis DESC";
}

if(isset($_GET['aceshid']) && $_GET['aceshid']=='a-z')
{
	$aceshid_link = '<a href="?aceshid=z-a"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
  <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
  <path fill-rule="evenodd" d="M10.082 12.629L9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
  <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY a.alis ASC";
}

if(empty($_GET['aceshid']))
{
	$aceshid_link = '<a href="?aceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';	
}
//Alış Qiymətinə GORE CESHIDLEME END






//Satış Qiymetinə GORE CESHIDLEME START
if(isset($_GET['sceshid']) && $_GET['sceshid']=='z-a')
{
	$sceshid_link = '<a href="?sceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY a.satis DESC";
}

if(isset($_GET['sceshid']) && $_GET['sceshid']=='a-z')
{
	$sceshid_link = '<a href="?sceshid=z-a"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
  <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
  <path fill-rule="evenodd" d="M10.082 12.629L9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
  <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY a.satis ASC";
}

if(empty($_GET['sceshid']))
{
	$sceshid_link = '<a href="?sceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';	
}
//Satış Qiymetine GORE CESHIDLEME END




//Miqdara GORE CESHIDLEME START
if(isset($_GET['mqceshid']) && $_GET['mqceshid']=='z-a')
{
	$mqceshid_link = '<a href="?mqceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY a.miqdar DESC";
}

if(isset($_GET['mqceshid']) && $_GET['mqceshid']=='a-z')
{
	$mqceshid_link = '<a href="?mqceshid=z-a"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
  <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
  <path fill-rule="evenodd" d="M10.082 12.629L9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
  <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY a.miqdar ASC";
}

if(empty($_GET['mqceshid']))
{
	$mqceshid_link = '<a href="?mqceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';	
}
//Miqdara GORE CESHIDLEME END



//Tarixə GORE CESHIDLEME START
if(isset($_GET['tceshid']) && $_GET['tceshid']=='z-a')
{
	$tceshid_link = '<a href="?tceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY a.tarix DESC";
}

if(isset($_GET['tceshid']) && $_GET['tceshid']=='a-z')
{
	$tceshid_link = '<a href="?tceshid=z-a"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
  <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
  <path fill-rule="evenodd" d="M10.082 12.629L9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
  <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY a.tarix ASC";
}

if(empty($_GET['tceshid']))
{
	$tceshid_link = '<a href="?tceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';	
}
//Tarixə GORE CESHIDLEME END





if(!isset($_GET['mceshid']) && !isset($_GET['bceshid'])&& !isset($_GET['aceshid'])&& !isset($_GET['sceshid'])&& !isset($_GET['mqceshid'])&& !isset($_GET['tceshid']))
{$order = " ORDER BY a.id DESC";}

$sec=mysqli_query($con,"SELECT 
						a.id,a.foto,a.ad AS m_ad, a.alis, a.satis, a.miqdar, a.tarix, a.defect, b.ad AS b_ad
 						FROM product a, brand b 
 						WHERE a.brand=b.id ".$sorgu." ".$order."");
$info=mysqli_fetch_array($sec);



?>

<table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Loqo</th>
      <th scope="col">Brend <?=$bceshid_link ?></th>
      <th scope="col">Ad <?=$mceshid_link ?></th>
      <th scope="col">Alış <?=$aceshid_link ?></th>
      <th scope="col">Satış <?=$sceshid_link ?></th>
      <th scope="col">Miqdar <?=$mqceshid_link ?></th>
      <th scope="col">Defekt</th>
      <th scope="col">Tarix <?=$tceshid_link ?></th>
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
      <td> <img <width="65px" height="55px" src="'.$info['foto'].'"></td>
      <td>'.$info['b_ad'].'</td>
      <td>'.$info['m_ad'].'</td>
      <td>'.$info['alis'].'</td>
      <td>'.$info['satis'].'</td>
      <td>'.$info['miqdar'].'</td>
      <td>'.$info['defect'].'</td>
      <td>'.$info['tarix'].'</td>';

     

?>


 <td>
		<form method="post">
			<input type="hidden" name="id" value="<?=$info['id'] ?>">
			<button type="submit"name="edit" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></button>
		<button type="submit" name="sil"class="btn btn-danger" title="Sil"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
	    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg></button>


<button type="submit" name="defect" class="btn btn-warning" title="Defekt"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
</svg>
</button>

   <button type="submit" name="legv" class="btn btn-success" title="Ləğv et"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
  <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
</svg></button>

<a href="pdf/data/anbar_product.php?x=<?=$info['id'] ?>" class="btn btn-info"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
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