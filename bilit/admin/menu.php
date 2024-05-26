<?php require_once "../dbconfig.php";?>
<img src="../img/user.png" class="img-fluid" alt="" width="50" height="50">
<h5 class="font-weight-bold pt-3"><?php echo $_SESSION['user'] ?></h5>
<hr>
<!-- Menu -->
<nav class="text-right">
    <div class="d-flex justify-content-between py-2">
        <a class="d-block" href="index.php">داشبورد</a>
        <i class="fas fa-home"></i>
    </div>
    <div class="d-flex justify-content-between py-2">
        <a class="d-block" href="all-users.php">کاربران</a>
        <i class="fas fa-users"></i>
    </div>
    <ul class="nav nav-sidebar d-flex justify-content-between p-0" data-widget="treeview">
        <li class="nav-item"><a href="" class="nav-link px-0">بلیط ها<i class="fas fa-caret-down mr-1 text-muted"></i></a>
            <ul class="nav nav-treeview px-2">
                <li class="nav-item"><a href="add.php" class="nav-link py-1">افزودن</a></li>
                <li class="nav-item"><a href="all.php" class="nav-link py-1">لیست کامل</a></li>
            </ul>
        </li>
        <i class="fas fa-check"></i>
    </ul>
    <div class="d-flex justify-content-between py-2">
        <a class="d-block" href="logout.php">خروج</a>
        <i class="fas fa-sign-out-alt "></i>
    </div>
</nav>