<?php
include ('dbconfig.php');
if(!isset($_SESSION['email'])){
    header('login.php?redirect');
    exit();
}
if(isset($_POST['search'])){
    $code = intval($_POST['code']);
    $q = $conn->query("SELECT * FROM `reserve` INNER JOIN `users` ON `reserve`.`userid`=`users`.`id` INNER JOIN `ticket` ON `ticket`.`id`=`reserve`.`ticketid` WHERE `code`='$code'");
    $num = $q->rowCount();
    $rows = $q->fetch();
}
?>
<html lang="fa" dir="rtl">
  <head>
      <link rel="stylesheet" href="css/bootstrap.css">
      <link rel="stylesheet" href="css/style.css">
      <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <meta charset="utf-8">
    <title>پیگیری بلیط</title>
  </head>
  <body>

<?php include ('header.php')?>

<div class="container">

  <div class="row py-3">
      <?php if($num){ ?>
    <table class="table table-responsive">
        <tr>
            <td>مبدا</td>
            <td>مقصد</td>
            <td>شرکت</td>
            <td>تاریخ</td>
            <td>قیمت</td>
            <td>مسافر</td>
        </tr>
        <tr>
            <td><?=$rows['orgin']?></td>
            <td><?=$rows['destination']?></td>
            <td><?=$rows['company']?></td>
            <td><?=$rows['startdate']?> - <?=$rows['starttime']?></td>
            <td><?=$rows['price']?></td>
            <td><?=$rows['name']?> <?=$rows['family']?></td>
        </tr>
    </table>
      <?php }
      else { ?>
       <div class="alert alert-warning">محتوایی جهت نمایش موجود نمی باشد</div>
      <?php } ?>

<?php include ('footer.php'); ?>

  </div>
</div>
</body>
</html>