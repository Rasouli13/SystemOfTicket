<?php
include ('dbconfig.php');
if(isset($_POST['submit'])){
    $start = $_POST['start'];
    $end = $_POST['end'];
    $query = $conn->query("SELECT * FROM `ticket` WHERE `orgin`='$start' AND `destination`='$end'");
    $num = $query->rowCount();
}
?>
<html lang="ar" dir="rtl">
  <head>
      <link rel="stylesheet" href="css/bootstrap.css">
      <link rel="stylesheet" href="css/style.css">
      <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <meta charset="utf-8">
    <title>نتایج جستجو</title>
  </head>
  <body>

<?php include ('header.php')?>

<div class="container">

  <div class="row py-3">
      <?php if($num){
          while($rows = $query->fetch()) { ?>
    <div class="col-4">
      <div class="card shadow-sm">
        <img src="img/ticket/<?=$rows['pic']?>" class="img-thumbnail card-img" alt="<?=$rows['company']?>">

        <div class="card-body">
          <p class="card-text"> <?=$rows['company']?> - <?=number_format($rows['price'])?> تومان</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <button type="button" class="btn btn-sm btn-outline-secondary"><?=$rows['orgin']?></button>
              <span>&nbsp;</span>
              <button type="button" class="btn btn-sm btn-outline-secondary"><?=$rows['destination']?></button>
            </div>
            <small class="text-muted"><?=$rows['starttime']?> - <?=$rows['startdate']?></small>
              <?php if(isset($_SESSION['email'])){ ?>
                <a href="reserve.php?id=<?=$rows['id']?>" class="btn btn-success">رزرو</a>
              <?php } else { ?>
              <a href="register.php" class="text-danger">برای رزرو ابتدا ثبت نام کنید</a>
              <?php } ?>
          </div>
        </div>
      </div>
    </div>
      <?php }
      }else { ?>
       <div class="alert alert-warning">محتوایی جهت نمایش یافت نشد</div>
      <?php } ?>


  </div>
</div>

<?php include ('footer.php'); ?>

</body>
</html>