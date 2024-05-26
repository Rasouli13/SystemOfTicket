<?php
include ('dbconfig.php');
if(isset($_POST['submit'])){
    $start = $_POST['start'];
    $end = $_POST['end'];
    $query = $conn->query("SELECT * FROM `ticket` WHERE `orgin`='$start' AND `destination`='$end'");
    $num = $query->rowCount();
}
//orgin
$orgin = $conn->query("SELECT `orgin` FROM `ticket` GROUP BY `orgin` ORDER BY `orgin` ASC");
//destination
$destination = $conn->query("SELECT `destination` FROM `ticket` GROUP BY `destination` ORDER BY `destination` ASC");
?>
<html lang="fa" dir="rtl">
  <head>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>صفحه اصلی</title>
  </head>
  <body>


<?php include ('header.php')?>

<img src="home1.jpg" class="img-fluid" alt="...">
<div class="container">
    <br>
<h3>مبدا و مقصد خود را انتخاب کنید</h3>
    <hr>
<div class="mb-3">
    <form method="post" action="search.php">
    <label class="col-1 py-1">مبدا:</label>
    <select name="start" class="col-11 form-control" >
    <option selected>انتخاب کنید</option>
    <?php while($orgin_rows = $orgin->fetch()){ ?>
        <option value="<?=$orgin_rows['orgin']?>"><?=$orgin_rows['orgin']?></option>
    <?php } ?>
  </select>

    <label class="col-1 py-1">مقصد:</label>
  <select name="end" class="form-control" id="inputGroupSelect01">
    <option selected>انتخاب کنید</option>
      <?php while($destination_rows = $destination->fetch()){ ?>
          <option value="<?=$destination_rows['destination']?>"><?=$destination_rows['destination']?></option>
      <?php } ?>
  </select>
<br>
<button type="submit" name="submit" class="btn btn-primary">جستجو</button>
</form>
    <hr>
    <form method="post" action="status.php">
        <h6>برای پیگیری بلیط کد رهگیری خود را وارد نمایید</h6>
        <div class="col-sm-12">
            <div class="input-group">
                <input type="text" name="code" class="form-control"> <span class="input-group-btn">
                    <button type="submit" name="search" class="btn btn-success">برو!</button> </span>
            </div>
        </div>

    </form>
  </div>
<?php include ('footer.php'); ?>
  </div>
</div>
</body>
</html>