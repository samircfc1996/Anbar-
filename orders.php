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

   if(empty($_POST['product_id'])){unset($_POST['product_id']);} else{$product_id = trim($_POST['product_id']); $product_id = htmlspecialchars($product_id);}
   if(empty($_POST['client_id'])){unset($_POST['client_id']);} else{$client_id = trim($_POST['client_id']); $client_id = htmlspecialchars($client_id);}
   if(empty($_POST['miqdar'])){unset($_POST['miqdar']);} else{$miqdar = trim($_POST['miqdar']); $miqdar = htmlspecialchars($miqdar);}

	if(!empty($product_id) && !empty($client_id) && !empty($miqdar))
	{

		

			$daxilet=mysqli_query($con,"INSERT INTO orders(product_id,client_id,miqdar,tarix) 
											VALUES('".mysqli_real_escape_string($con,$product_id)."','".mysqli_real_escape_string($con,$client_id)."','".mysqli_real_escape_string($con,$miqdar)."','".$tarix."')");
				if($daxilet==true)
					{echo'<div class="alert alert-success" role="alert">Sifariş uğurla bazaya yerləşdirildi</div>';}
				else
					{echo'<div class="alert alert-danger" role="alert">Sifarişi bazaya yerləşdirmek mümkün olmadı</div>';}
		
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
	$sil=mysqli_query($con,"DELETE FROM orders WHERE id='".mysqli_real_escape_string($con,$id)."'");
	if($sil==true)

	if($sil==true)
	{echo'<div class="alert alert-danger" role="alert">Uğurla silindi</div>';}
	else
	{echo'<div class="alert alert-danger" role="alert">Silmək mümkün olmadı</div>';}
}


if(isset($_POST['update']))
{

if(empty($_POST['ad'])){unset($_POST['ad']);} else{$ad = trim($_POST['ad']); $ad = htmlspecialchars($ad);}
if(empty($_POST['product_id'])){unset($_POST['product_id']);} else{$product_id = trim($_POST['product_id']); $product_id = htmlspecialchars($product_id);}
if(empty($_POST['client_id'])){unset($_POST['client_id']);} else{$client_id = trim($_POST['client_id']); $client_id = htmlspecialchars($client_id);}     
  if(empty($_POST['alish'])){unset($_POST['alish']);} else{$alis = trim($_POST['alish']); $alis = htmlspecialchars($alis);}
  if(empty($_POST['satish'])){unset($_POST['satish']);} else{$satis = trim($_POST['satish']); $satis = htmlspecialchars($satis);}
  if(empty($_POST['miqdar'])){unset($_POST['miqdar']);} else{$miqdar = trim($_POST['miqdar']); $miqdar = htmlspecialchars($miqdar);}
  if(empty($_POST['brand'])){unset($_POST['brand']);} else{$brand = trim($_POST['brand']); $brand = htmlspecialchars($brand);} 
  if(empty($_POST['id'])){unset($_POST['id']);} else{$id = trim($_POST['id']); $id = htmlspecialchars($id);} 

          
			$daxilet=mysqli_query($con,"UPDATE orders SET 
				ad='".mysqli_real_escape_string($con,$ad)."',product_id='".mysqli_real_escape_string($con,$product_id)."',client_id='".mysqli_real_escape_string($con,$client_id)."',alis='".mysqli_real_escape_string($con,$alis)."',satis='".mysqli_real_escape_string($con,$satis)."',miqdar='".mysqli_real_escape_string($con,$miqdar)."',brand='".mysqli_real_escape_string($con,$brand)."'
				WHERE id='".mysqli_real_escape_string($con,$id)."'");

				if($daxilet==true)
					{echo'<div class="alert alert-success" role="alert">Məhsul uğurla yeniləndi</div>';}
				else
					{echo'<div class="alert alert-danger" role="alert">Məhsulu yeniləmək mümkün olmadı</div>';}
		
}






if(isset($_POST['tesdiq']))
{
	$yoxla = mysqli_query($con,"SELECT product.id, orders.miqdar
 						FROM product, orders
 						WHERE product.id=orders.product_id AND 
 						product.miqdar>orders.miqdar AND
 						orders.id='".$_POST['id']."'");


	if(mysqli_num_rows($yoxla)>0)
	{
		$yinfo =mysqli_fetch_array($yoxla);
			$daxilet=mysqli_query($con,"UPDATE orders SET 
				tesdiq=1 WHERE id='".mysqli_real_escape_string($con,$id)."'");

				if($daxilet==true)
					{
						$daxilet=mysqli_query($con,"UPDATE product SET 
						miqdar=miqdar-".$yinfo['miqdar']." WHERE id='".$yinfo['id']."'");


						echo'<div class="alert alert-success" role="alert">Məhsul uğurla yeniləndi</div>';

					}
				else
					{echo'<div class="alert alert-danger" role="alert">Məhsulu yeniləmək mümkün olmadı</div>';}

	}
	else
	{echo'<div class="alert alert-warning" role="alert">Təsdiq etmək istədiyiniz siafriş üzrə anbarda kifayət qədər məhsul yoxdur</div>';}
		
}




if(isset($_POST['legv']))
{
    $daxilet=mysqli_query($con,"UPDATE orders SET tesdiq=0 WHERE id='".mysqli_real_escape_string($con,$id)."'");
	$sifarish = mysqli_query($con,"SELECT product.id, orders.miqdar
 						FROM product, orders
 						WHERE product.id=orders.product_id AND 
 						product.miqdar>orders.miqdar AND
 						orders.id='".$_POST['id']."'");


	$sinfo =mysqli_fetch_array($sifarish);
	
	$daxilet=mysqli_query($con,"UPDATE product SET 
						miqdar=miqdar+".$sinfo['miqdar']." WHERE id='".$sinfo['id']."'");


	

}




if(!isset($_POST['edit']))
{

 $sec=mysqli_query($con,"SELECT * FROM orders  WHERE id='".mysqli_real_escape_string($con,$id)."'");
	$info=mysqli_fetch_array($sec);


?>


<form method="post">

	<select class="form-control" name="product_id">
		<option value="">Məhsul seçin</option>
		<?php

		$sec = mysqli_query($con,"SELECT product.id,product.ad AS mad, product.miqdar, brand.ad AS bad 
			FROM product, brand 
			WHERE product.brand=brand.id ORDER BY product.ad ASC");

		while($info = mysqli_fetch_array($sec))
		{echo'<option value="'.$info['id'].'">'.$info['bad'].' - '.$info['mad'].' ('.$info['miqdar'].')</option>';}

		?>
	</select><br>


<select class="form-control" name="client_id">
		<option value="">Müştərini seçin</option>
		<?php

		$sec = mysqli_query($con,"SELECT * FROM client ORDER BY ad ASC");

		while($info = mysqli_fetch_array($sec))
		{echo'<option value="'.$info['id'].'">'.$info['ad'].' - '.$info['soyad'].'</option>';}

		?>
	</select><br>
	<input type="text" class="form-control" placeholder="Miqdar"name="miqdar"><br>
	<button type="submit" name="d" class="btn btn-success btn-lg"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
	  <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
	</svg></button> &nbsp;


	<a href="http://localhost/Anbar/excel/Examples/orders.php" class="btn btn-info btn-lg"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-earmark-excel-fill" viewBox="0 0 16 16">
  <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM5.884 6.68L8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64z"/>
</svg></a>
</form>

<?php
}



if(isset($_POST['edit']))
{
if(empty($_POST['id'])){unset($_POST['id']);} else{$id = trim($_POST['id']); $id = htmlspecialchars($id);}

if(empty($_POST['product_id'])){unset($_POST['product_id']);} else{$product_id = trim($_POST['product_id']); $product_id = htmlspecialchars($product_id);}
if(empty($_POST['client_id'])){unset($_POST['client_id']);} else{$client_id = trim($_POST['client_id']); $client_id = htmlspecialchars($client_id);}
if(empty($_POST['alish'])){unset($_POST['alish']);} else{$alis = trim($_POST['alish']); $alis = htmlspecialchars($alis);}
if(empty($_POST['satish'])){unset($_POST['satish']);} else{$satis = trim($_POST['satish']); $satis = htmlspecialchars($satis);}
if(empty($_POST['miqdar'])){unset($_POST['miqdar']);} else{$miqdar = trim($_POST['miqdar']); $miqdar = htmlspecialchars($miqdar);}  
if(empty($_POST['brand'])){unset($_POST['brand']);} else{$brand = trim($_POST['brand']); $brand = htmlspecialchars($brand);} 

	$sec=mysqli_query($con,"SELECT * FROM product  WHERE id='".mysqli_real_escape_string($con,$id)."'");
	$info=mysqli_fetch_array($sec);
	?>
<form method="post">

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

// ADA GORE CESHIDLEME START

if(isset($_GET['oceshid']) && $_GET['oceshid']=='z-a')
{
	$oceshid_link = '<a href="?oceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY client.ad DESC";
}

if(isset($_GET['oceshid']) && $_GET['oceshid']=='a-z')
{
	$oceshid_link = '<a href="?cceshid=z-a"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
  <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
  <path fill-rule="evenodd" d="M10.082 12.629L9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
  <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY client.ad ASC";
}

if(empty($_GET['oceshid']))
{
	$oceshid_link = '<a href="?oceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';	
}

// ADA GORE CESHIDLEME END




// SOYADA GORE CESHIDLEME START
if(isset($_GET['osceshid']) && $_GET['osceshid']=='z-a')
{
	$osceshid_link = '<a href="?osceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY client.soyad DESC";
}

if(isset($_GET['osceshid']) && $_GET['osceshid']=='a-z')
{
	$osceshid_link = '<a href="?osceshid=z-a"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
  <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
  <path fill-rule="evenodd" d="M10.082 12.629L9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
  <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY client.soyad ASC";
}

if(empty($_GET['osceshid']))
{
	$osceshid_link = '<a href="?osceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
}
//SOYADA  GORE CESHIDLEME END


// BRENDİN ADİNA GORE CESHIDLEME START
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
//BRENDİN ADINA GORE CESHIDLEME END//


//MEHSUL ADINA GORE CESHIDLEME START
if(isset($_GET['maceshid']) && $_GET['maceshid']=='z-a')
{
	$maceshid_link = '<a href="?maceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY product.ad DESC";
}

if(isset($_GET['maceshid']) && $_GET['maceshid']=='a-z')
{
	$maceshid_link = '<a href="?maceshid=z-a"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
  <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
  <path fill-rule="evenodd" d="M10.082 12.629L9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
  <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY product.ad ASC";
}

if(empty($_GET['maceshid']))
{
	$maceshid_link = '<a href="?maceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
}
//MEHSUL ADINA GORE CESHIDLEME END



// ALIS QIYMETINE GORE CESHIDLEME START
if(isset($_GET['aqceshid']) && $_GET['aqceshid']=='z-a')
{
	$aqceshid_link = '<a href="?aqceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY product.alis DESC";
}

if(isset($_GET['aqceshid']) && $_GET['aqceshid']=='a-z')
{
	$aqceshid_link = '<a href="?aqceshid=z-a"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
  <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
  <path fill-rule="evenodd" d="M10.082 12.629L9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
  <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY product.alis ASC";
}

if(empty($_GET['aqceshid']))
{
	$aqceshid_link = '<a href="?aqceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
}
//ALIS QIYMETINE GORE CESHIDLEME END



// SATIS QIYMETINE GORE CESHIDLEME START
if(isset($_GET['sqceshid']) && $_GET['sqceshid']=='z-a')
{
	$sqceshid_link = '<a href="?sqceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY product.satis DESC";
}

if(isset($_GET['sqceshid']) && $_GET['sqceshid']=='a-z')
{
	$sqceshid_link = '<a href="?sqceshid=z-a"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
  <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
  <path fill-rule="evenodd" d="M10.082 12.629L9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
  <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY product.satis ASC";
}

if(empty($_GET['sqceshid']))
{
	$sqceshid_link = '<a href="?sqceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
}
//SATIS QIYMETINE GORE CESHIDLEME END


// MIQDARA GORE CESHIDLEME START
if(isset($_GET['pmceshid']) && $_GET['pmceshid']=='z-a')
{
	$pmceshid_link = '<a href="?pmceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY product.miqdar DESC";
}

if(isset($_GET['pmceshid']) && $_GET['pmceshid']=='a-z')
{
	$pmceshid_link = '<a href="?pmceshid=z-a"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
  <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
  <path fill-rule="evenodd" d="M10.082 12.629L9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
  <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY product.miqdar ASC";
}

if(empty($_GET['pmceshid']))
{
	$pmceshid_link = '<a href="?pmceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
}
//MIQDARA  GORE CESHIDLEME END



// SIFARISIN SAYINA  GORE CESHIDLEME START
if(isset($_GET['ssceshid']) && $_GET['ssceshid']=='z-a')
{
	$ssceshid_link = '<a href="?ssceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY orders.miqdar DESC";
}

if(isset($_GET['ssceshid']) && $_GET['ssceshid']=='a-z')
{
	$ssceshid_link = '<a href="?ssceshid=z-a"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
  <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
  <path fill-rule="evenodd" d="M10.082 12.629L9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
  <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY orders.miqdar ASC";
}

if(empty($_GET['ssceshid']))
{
	$ssceshid_link = '<a href="?ssceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
}
//SIFARISIN SAYINA  GORE CESHIDLEME END



// TARIXE GORE CESHIDLEME START
if(isset($_GET['stceshid']) && $_GET['stceshid']=='z-a')
{
	$stceshid_link = '<a href="?stceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY orders.tarix DESC";
}

if(isset($_GET['stceshid']) && $_GET['stceshid']=='a-z')
{
	$stceshid_link = '<a href="?stceshid=z-a"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down-alt" viewBox="0 0 16 16">
  <path d="M12.96 7H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V7z"/>
  <path fill-rule="evenodd" d="M10.082 12.629L9.664 14H8.598l1.789-5.332h1.234L13.402 14h-1.12l-.419-1.371h-1.781zm1.57-.785L11 9.688h-.047l-.652 2.156h1.351z"/>
  <path d="M4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
	$order = " ORDER BY orders.tarix ASC";
}

if(empty($_GET['stceshid']))
{
	$stceshid_link = '<a href="?stceshid=a-z"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-alpha-down" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10.082 5.629L9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371h-1.781zm1.57-.785L11 2.687h-.047l-.652 2.157h1.351z"/>
  <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645V14zM4.5 2.5a.5.5 0 0 0-1 0v9.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L4.5 12.293V2.5z"/>
</svg></a>';
}
//TARIXE GORE CESHIDLEME END





if(!isset($_GET['oceshid']) && !isset($_GET['osceshid']) && !isset($_GET['baceshid'])  && !isset($_GET['maceshid'])  && !isset($_GET['aqceshid'])  && !isset($_GET['sqceshid'])  && !isset($_GET['pmceshid'])  && !isset($_GET['ssceshid'])  && !isset($_GET['stceshid'])){
$order = " ORDER BY orders.id DESC";

}







$sec=mysqli_query($con,"SELECT brand.ad AS bad,
						product.ad AS pad, product.alis, product.satis, product.miqdar AS pmiqdar,
						client.ad AS cad, client.soyad,
						orders.id, orders.miqdar AS smiqdar, orders.tarix, orders.tesdiq
 						FROM brand, product, client, orders
 						WHERE 
 						 brand.id=product.brand AND
 						product.id=orders.product_id AND 
 						client.id=orders.client_id
 						".$order);




$info=mysqli_fetch_array($sec);
$say = mysqli_num_rows($sec);

//Toplam Brend
$b=mysqli_query($con,"SELECT * FROM brand");
$bsay=mysqli_num_rows($b);

//Toplam mehsul + Dovriyye + Gozlenilen qazanc
$m=mysqli_query($con,"SELECT a.id,a.ad AS m_ad, a.alis, a.satis, a.miqdar, a.tarix, b.ad AS b_ad
 						FROM product a, brand b 
 						WHERE a.brand=b.id");
$msay=mysqli_num_rows($m);
$minfo = mysqli_fetch_array($m);


$toplam_alis = 0;
$toplam_satis = 0;

do
{
	$toplam_alis = ($minfo['alis']*$minfo['miqdar'])+$toplam_alis;
	$toplam_satis = ($minfo['satis']*$minfo['miqdar'])+$toplam_satis;
    
}
while($minfo = mysqli_fetch_array($m));

$gqazanc = $toplam_satis - $toplam_alis;
//Toplam mushteri
$c=mysqli_query($con,"SELECT * FROM client ORDER BY id DESC");
$csay=mysqli_num_rows($c);



$qsec = mysqli_query($con,"SELECT * FROM orders, product 
	WHERE orders.product_id=product.id AND orders.tesdiq=1");

while($qinfo = mysqli_fetch_array($qsec))
{
	$c_alis = ($qinfo['alis']*$qinfo['miqdar'])+$c_alis;
	$c_satis = ($qinfo['satis']*$qinfo['miqdar'])+$c_satis;
}

$cqazanc = $c_satis - $c_alis;

?>
<div class="alert alert-dark" role="alert">
	Sifariş: <b><?=$say ?></b> |
	Brend: <b><?=$bsay ?></b> |  
	Məhsul: <b><?=$msay ?></b> |
	Müştəri: <b><?=$csay ?></b> |  
	Alış: <b><?=$toplam_alis ?></b> |
	Satış: <b><?=$toplam_satis ?></b> |
	Gözlənilən qazanc: <b><?=$gqazanc ?></b> |
	Cari qazanc: <b><?=$cqazanc ?></b>


</div>
<table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Ad    <?=$oceshid_link ?></th>
      <th scope="col">Soyad <?=$osceshid_link ?></th>
      <th scope="col">Brend <?=$baceshid_link ?></th>
      <th scope="col">Məhsul<?=$maceshid_link?></th>
      <th scope="col">Alış  <?=$aqceshid_link?> </th>
      <th scope="col">Satış <?=$sqceshid_link?></th>
      <th scope="col">Miqdar<?=$pmceshid_link?></th>
      <th scope="col">Sifariş <?=$ssceshid_link?></th>
      <th scope="col">Tarix <?=$stceshid_link?></th>
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
      <td>'.$info['cad'].'</td>
      <td>'.$info['soyad'].'</td>
      <td>'.$info['bad'].'</td>
      <td>'.$info['pad'].'</td>
      <td>'.$info['alis'].'</td>
      <td>'.$info['satis'].'</td>
      <td>'.$info['pmiqdar'].'</td>
      <td>'.$info['smiqdar'].'</td>
      <td>'.$info['tarix'].'</td>';
     

?>


 <td>
		<form method="post">
			<input type="hidden" name="id" value="<?=$info['id'] ?>">

<?php
if($info['tesdiq']==0)
{
?>

						<button type="submit"name="edit" class="btn btn-success" title="Redaktə et"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
			  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
			  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
			</svg></button>
						<button type="submit" name="sil" class="btn btn-danger" title="Sil"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
			  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
			</svg></button>


			<button type="submit" name="tesdiq" class="btn btn-success" title="Təsdiq et"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
			  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
			</svg></button>


			<a href="pdf/data/anbar_orders.php?x=<?=$info['id'] ?>" class="btn btn-info"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
  <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
  <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
</svg></a>

<?php
}
else
{
	echo'<button type="submit" name="legv" class="btn btn-danger" title="Ləğv et"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg></button>';
}
?>
		</form>
		</td>

	</tr>





<?php

}
while($info=mysqli_fetch_array($sec));

   ?>


 
</table>



</div>