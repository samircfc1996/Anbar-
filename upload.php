<?php

$qovluq = 'foto/';
$file_unvani = $qovluq.basename($_FILES['foto']['name']);

$tip = strtolower(pathinfo($file_unvani,PATHINFO_EXTENSION));

if($tip!='jpg' && $tip!='jepg' && $tip!='png' && $tip!='gif')
{$sehv=1; echo'Yalnız JPG, JPEG, PNG, GIF formatlarına icazə verilir';}

if($_FILES['foto']['size']>500000)
{$sehv=1; echo'Maksimum 5 Mb icazə verilir';}

if(!isset($sehv))
{
	if(move_uploaded_file($_FILES['foto']['tmp_name'], $file_unvani))
	{$foto = $file_unvani;}
}

