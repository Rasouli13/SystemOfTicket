<?php
include ('dbconfig.php');
$now = time();
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $pass = md5($_POST['password']);
    $query = $conn->query("SELECT * FROM `users` WHERE `email`='$email' AND `password`='$pass'");
    $count = $query->rowCount();
    $rows = $query->fetch();
    if($count){
        $_SESSION['email']=$email;
        $_SESSION['user'] = $rows['name'].' '.$rows['family'];
        $_SESSION['per'] = $rows['per'];
        $_SESSION['userid'] = $rows['id'];
        header('location:index.php?ok');
        exit();
    }
    else{
        header('location:login.php?error');
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
<h3>اطلاعات خواسته شده را به دقت وارد نمایید</h3>
    <hr>
<div class="mb-3">
    <form method="post" action="">
    <table class="table table-responsive ">
        <tr><td>پست الکترونیک</td><td><input name="email" type="email" class="form-control"></td></tr>
        <tr><td>پسورد</td><td><input name="password" type="password" class="form-control"></td></tr>
    </table>
<button type="submit" name="submit" class="btn btn-primary btn-lg">ورود</button>
</form>
  </div>
</div>
</div>
<?php include ('footer.php'); ?>
</body>
</html>