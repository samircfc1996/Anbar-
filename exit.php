<?php
session_start();
unset($_SESSION['tel']);
unset($_SESSION['parol']);
unset($_SESSION['foto']);
unset($_SESSION['ad']);
unset($_SESSION['soyad']);
unset($_SESSION['sirket']);
echo'<meta http-equiv="refresh" content="0; URL=index.php">'; exit;
