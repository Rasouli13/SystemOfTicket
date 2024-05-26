<?php
require_once "../dbconfig.php";
$now = time();
$message ='';
if (isset($_SESSION["state_login"]) && $_SESSION["state_login"] === true) {
    $user_id = $_SESSION["user_id"];
    $sql_session = "SELECT * FROM users WHERE `user_id` = :user_id";
    $result_session = $conn->prepare($sql_session);
    $result_session->bindParam(':user_id', $user_id);
    $result_session->execute();
    if ($result_session->rowCount() > 0) {
        $results_session = $result_session->fetch();
    }
} else {
    header("location: ../index.php");
    exit();
}
//question type
	$cat = "SELECT * FROM `categories` ORDER BY `category_name` ASC";
	$rcat = $conn->prepare($cat);
	$rcat->execute();
	
//submit data
	if(isset($_POST['btn_save'])){
		$title = $_POST['title'];
		$img = $_FILES['img']['name'];
		$q = $conn->prepare("INSERT INTO `categories` (`category_name`,`img`) VALUES (?,?)");
		$q->bindParam(1,$title);
		$q->bindParam(2,$img);
		$q->execute();
		if($q){
            if(isset($_FILES['img']['name'])){
                move_uploaded_file($_FILES['img']['tmp_name'],'../img/cat/'.$_FILES['img']['name']);
            }
			header("location: category.php?op=ok");
		}
		else{
			header("location: category.php?op=error");
		}
	}
//edit
if(isset($_GET['edit'])){
	$edit = $conn->prepare("SELECT * FROM `categories` WHERE `category_id`=:id");
	$edit->bindParam(':id',$_GET['edit']);
	$edit->execute();
	$row = $edit->fetch();
	if(isset($_POST['btn_edit'])){
		$q=$conn->prepare("UPDATE `categories` SET `category_name`=:title WHERE `category_id`=:id");
		$q->bindParam(':title',$_POST['title']);
		$q->bindParam(':id',$row['category_id']);
		$q->execute();
		if($q){
			header("location: category.php?op=ok");
		}
		else{
			header("location: category.php?op=error");
		}
	}
}
//delete
if(isset($_GET['delete'])){
	$d = $conn->prepare("DELETE FROM `categories` WHERE `category_id`=:id");
	$d->bindParam(':id',$_GET['delete']);
	$d->execute();
	if($d){
			header("location: type.php?op=ok");
		}
		else{
			header("location: type.php?op=error");
		}
}
if(isset($_GET['op'])){
	$op = $_GET['op'];
	switch ($op){
		case 'ok':
		$message = '<div class="alert alert-success text-center">عملیات با موفقیت انجام شد</div>';
		break;
		case 'error':
		$message = '<div class="alert alert-danger text-center">مشکلی پیش آمده مجدد تلاش نمایید</div>';
		break;
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
            <h4>دسته بندی</h4>
            <hr>
            <?=$message?>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                    <div class="col-12">
                        <label>عنوان:</label>
                        <input type="text" class="form-control" name="title" placeholder="گروه غذایی را بنویسید" value="<?=@$row['category_name']?>" required>
                    </div>
				</div>
                <div class="form-group row">
                    <div class="col-12">
                        <label>عکس:</label>
                        <input type="file" class="form-control" name="img" >
                    </div>
                </div>
                <div class="text-right">
				<?php if(isset($_GET['edit'])){ ?>
					<button type="submit" class="btn btn-primary" name="btn_edit">ویرایش</button>
				<?php }else{ ?>
                    <button type="submit" class="btn btn-success" name="btn_save">ثبت</button>
				<?php } ?>
                </div>
            </form>
		<div class="col-12 admin-content py-3">
		<form action="" method="POST">
            <table class="table table-striped table-hover text-center">
                <thead>
                <tr>
                    <th>#</th>
                    <th>عنوان</th>
                    <th>تعداد محصولات</th>
                    <th>عکس</th>
					<th>عملیات</th>
                </tr>
                </thead>
                <tbody>
				<?php $count=0; while($row = $rcat->fetch()){ $count++; 
						$q = $conn->prepare("SELECT `category_id` FROM `products` WHERE `category_id`=:id");
						$q->bindParam(':id',$row['category_id']);
						$q->execute();
						
				?>
				<tr>
				<td><?=$count?></td>
				<td><?=$row['category_name']?></td>
				<td><?=$q->rowCount()?></td>
				<td><img src="../img/cat/<?=$row['img']?>" width="50" height="50"></td>
				<td><a href="category.php?delete=<?=$row['category_id']?>" class="btn btn-sm btn-danger">حذف</a> <a href="category.php?edit=<?=$row['category_id']?>" class="btn btn-sm btn-primary">ویرایش</a></td>
				</tr>
				<?php } ?>
				</tbody>
				</table>
		</form>
		</div>
    </div>
</div>
</body>
</html>