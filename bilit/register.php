<?php
include ('dbconfig.php');
$now = time();
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $family = $_POST['family'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $pass = md5($_POST['password']);
    $query = $conn->query("INSERT INTO `users` (`name`,`family`,`email`,`mobile`,`password`,`created_at`,`per`) VALUES ('$name','$family','$email','$mobile','$pass','$now',0)");
    if($query){
        header('location:login.php?ok');
        exit();
    }
    else{
        header('location:register.php?error');
        exit();
    }
}
?>
<html lang="ar" dir="rtl">
  <head>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>صفحه اصلی</title>
  </head>
  <body>

<?php include('header.php')?>

<img src="home1.jpg" class="img-fluid" alt="...">
<div class="container">
    <br>
<h3>مشخصات خود را به صورت دقیق وارد نمایید</h3>
    <hr>
<div class="mb-3">
    <form method="post" action="">
    <table class="table table-responsive ">
        <tr><td>نام</td><td><input name="name" class="form-control"></td></tr>
        <tr><td>نام خانوادگی</td><td><input name="family" class="form-control"></td></tr>
        <tr><td>پست الکترونیک</td><td><input name="email" type="email" class="form-control"></td></tr>
        <tr><td>شماره موبایل</td><td><input name="mobile" class="form-control"></td></tr>
        <tr><td>پسورد</td><td><input name="password" type="password" class="form-control"></td></tr>
    </table>
<button type="submit" name="submit" class="btn btn-primary btn-lg">ثبت نام</button>
</form>
  </div>
</div>
</div>
<?php include ('footer.php'); ?>
</body>
</html>