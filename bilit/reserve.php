<?php
include ('dbconfig.php');
if(!isset($_SESSION['email'])){
    header('login.php?redirect');
    exit();
}
if(isset($_GET['id'])){
    $ticketid = intval($_GET['id']);
    $userid = $_SESSION['userid'];
    $code = time();
    $now = time();
    $q = $conn->query("INSERT INTO `reserve` (`userid`,`ticketid`,`code`,`created_at`) VALUES ('$userid','$ticketid','$code','$now')");
    $num = $q->rowCount();
}
?>
<html lang="ar" dir="rtl">
  <head>
      <link rel="stylesheet" href="css/bootstrap.css">
      <link rel="stylesheet" href="css/style.css">
      <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <meta charset="utf-8">
    <title>ثبت نتیجه</title>
  </head>
  <body>

<?php include ('header.php')?>

<div class="container">

  <div class="row py-3">
      <?php if($num){ ?>
    <div class="alert alert-info">کاربر گرامی <?=$_SESSION['user']?> بلیط شما با موفقیت در سیستم ثبت شد.<br>
    کد رهگیری : <?=$code?> </div>
      <?php }
      else { ?>
       <div class="alert alert-warning">مشکلی پیش آمده مجدد سعی نمایید</div>
      <?php } ?>


  </div>
</div>

<?php include ('footer.php'); ?>

</body>
</html>