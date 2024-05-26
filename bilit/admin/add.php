<?php
require_once "../dbconfig.php";
//check login
if (!isset($_SESSION["per"]) && $_SESSION["per"] != 1) {
    header('location:../index.php');
    exit();
}
$message = $id='';
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
}
//get category
$cat = $conn->query("SELECT * FROM `category` ORDER BY `name` ASC");
//get ticket
$restorant = $conn->query("SELECT * FROM `ticket` ORDER BY `orgin` ASC");
//edit date
$data = $conn->query("SELECT * FROM `ticket` WHERE `id`='$id'");
$rows = $data->fetch();
//add products
if(isset($_POST['btn_save'])){
    $company = $_POST['company'];
    $cat = $_POST['category'];
    $orgin = $_POST['orgin'];
    $destination = $_POST['destination'];
    $startdate = $_POST['date'];
    $starttime = $_POST['time'];
    $price = $_POST['price'];
    if(!empty($_FILES['img']['name'])){
        $pic = $_FILES['img']['name'];
    }
    $now = time();
    $q = $conn->query("INSERT INTO `ticket` (`company`,`catid`,`orgin`,`destination`,`startdate`,`starttime`,`price`,`pic`,`created_at`) VALUES ('$company','$cat','$orgin','$destination','$startdate','$starttime','$price','$pic','$now')");
    if($q){
        if(!empty($_FILES['img']['name'])){
            move_uploaded_file($_FILES['img']['tmp_name'],'../img/ticket/'.$_FILES['img']['name']);
        }
        header('location:add.php?ok');
    }
    else{
        header('location:add.php?error');
    }
}
//update
if(isset($_POST['edit'])){
    $company = $_POST['company'];
    $cat = $_POST['category'];
    $orgin = $_POST['orgin'];
    $destination = $_POST['destination'];
    $startdate = $_POST['date'];
    $starttime = $_POST['time'];
    $price = $_POST['price'];
    $pic ='';
    if(!empty($_FILES['img']['name'])){
        $pic = ',`img`="'.$_FILES['img']['name'].'"';
    }
    $now = time();
    $q = $conn->query("UPDATE `ticket` SET `company`='$company',`catid`='$cat',`orgin`='$orgin',`destination`='$destination',`price`='$price',`startdate`='$startdate',`starttime`='$starttime' $pic WHERE `id`='$id'");
    if($q){
        if(!empty($_FILES['img']['name'])){
            move_uploaded_file($_FILES['img']['tmp_name'],'../img/ticket/'.$_FILES['img']['name']);
        }
        header('location:add.php?ok');
    }
    else{
        header('location:add.php?error');
    }
}
?>
<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت</title>
    <!-- css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/adminlte.min.css">
    <link rel="stylesheet" href="../css/admin.css">
    <!-- js -->
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/adminlte.min.js"></script>
    <!-- js sweetalert2 -->
    <script src="../js/sweetalert2@11.js"></script>
    <!-- icon -->
    <script src="../js/all.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-2 admin-menu text-center bg-light py-3">
            <?php
            include("menu.php");
            ?>
        </div>
        <div class="col-10 admin-content text-right py-3">
            <h4>افزودن بلیط</h4>
            <hr>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="col-3">
                        <label>نوع<span class="text-danger">*</span></label>
                        <select class="form-control" name="category" required>
                            <option value="">انتخاب کنید</option>
                            <?php while($rcat = $cat->fetch()) { ?>
                            <option <?=@$rcat['cid']==@$rows['catid']?'SELECTED':''?> value="<?=@$rcat['cid']?>"><?=@$rcat['name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-3">
                        <label>شرکت<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="company" value="<?=@$rows['company']?>" required>
                    </div>
                    <div class="col-3">
                        <label>مبدا<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="orgin" value="<?=@$rows['orgin']?>" required>
                    </div>
                    <div class="col-3">
                        <label>مقصد<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="destination" value="<?=@$rows['destination']?>" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-4">
                        <label>قیمت<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="price" value="<?=@$rows['price']?>" required>
                    </div>
                    <div class="col-4">
                        <label>تاریخ حرکت<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="date" value="<?=@$rows['startdate']?>" required dir="ltr">
                    </div>
                    <div class="col-4">
                        <label>ساعت حرکت<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="time" value="<?=@$rows['starttime']?>" required>
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <div class="col-12">
                        <label>انتخاب عکس<span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="img">
                            <label class="custom-file-label text-center">انتخاب عکس</label>
                            <?php if(isset($_GET['edit'])){ ?>
                            <img src="../img/ticket/<?=$rows['pic']?>" class="img-fluid img-thumbnail" width="200" height="200">
                           <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="text-left">
                    <?php if(isset($_GET['edit'])){ ?>
                        <button type="submit" class="btn btn-primary" name="edit">ویرایش</button>
                    <?php }else { ?>
                        <button type="submit" class="btn btn-success" name="btn_save">ثبت </button>
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>