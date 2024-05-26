<header class="p-3 text-bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
            </a>

            <ul class="nav col-8">
                <li><a href="index.php" class="nav-link px-2 text-white">صفحه اصلی</a></li>
                <li><a href="#" class="nav-link px-2 text-white">اتوبوس</a></li>
                <li><a href="#" class="nav-link px-2 text-white">قطار</a></li>
                <li><a href="#" class="nav-link px-2 text-white">پیگیری سفر</a></li>
                <li><a href="#" class="nav-link px-2 text-white">درباره ما</a></li>
            </ul>

            <?php if(isset($_SESSION['email'])){ ?>
                <div class="text-end">
                    خوش آمدید <?=$_SESSION['user']?>
                    <?php if($_SESSION['per']==1){ ?>
                        <a href="admin/index.php"><button type="button" class="btn btn-warning">مدیریت</button></a>
                    <?php } ?>
                    <a href="logout.php"><button type="button" class="btn btn-danger">خروج</button></a>
                </div>
            <?php }else { ?>
            <div class="text-end">
                <a href="login.php"><button type="button" class="btn btn-outline-light me-2">ورود</button></a>
                <a href="register.php"><button type="button" class="btn btn-warning">ثبت نام</button></a>
            </div>
            <?php } ?>
        </div>
    </div>
</header>