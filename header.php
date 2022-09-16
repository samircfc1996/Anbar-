<?php
session_start();

if(!isset($_SESSION['tel']) or !isset($_SESSION['parol']))
{echo'<meta http-equiv="refresh" content="0; URL=index.php">'; exit;}

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>


<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<?php
$con=mysqli_connect("localhost","root","12345","anbar");
$tarix=date("Y-m-d H:i:s");



?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark  fixed-top">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="index.php">Anbar</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

      <li class="nav-item active">
        <a class="nav-link" href="brend.php">Brend</a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="product.php">Məhsul</a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="client.php">Müştəri</a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="xerc.php">Xərc</a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="exit.php">Çıxış</a>
      </li>

    </ul>
    <form class="form-inline my-2 my-lg-0" method="post">
      <input class="form-control mr-sm-2" type="text" name="sorgu" placeholder="Axtar..." aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="axtar">Axtar </button> &nbsp;
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="hamisi">Hamısı </button>
    </form>
  </div>
</nav>




<br><br><br><br>





