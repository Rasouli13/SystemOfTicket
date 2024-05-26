<?php
require_once "../dbconfig.php";
if (!isset($_SESSION["per"]) && $_SESSION["per"] != 1) {
    header('location:../index.php');
    exit();
}

    if (isset($_GET['delete']) && !empty($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $sql = "SELECT pic FROM ticket WHERE id = :id";
        $result = $conn->prepare($sql);
        $result->bindParam(':id', $delete_id);
        $result->execute();
        $results = $result->fetch();
        @unlink('../img/ticket/'.$results['pic']);
        $sql = "DELETE FROM ticket WHERE id = :id";
        $query = $conn->prepare($sql);
        $query->bindParam(':id', $delete_id);
        $query->execute();
        $success = "محتوای مورد نظر حذف شد.";
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
            <h4>کل بلیط ها</h4>
            <hr>
            <table class="table table-striped table-hover text-center">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>مبدا</th>
                    <th>مقصد</th>
                    <th>شرکت</th>
                    <th>تاریخ</th>
                    <th>مدیریت</th>

                </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM ticket GROUP BY id DESC";
                $result = $conn->prepare($sql);
                $result->execute();
                if ($result->rowCount() > 0) {
                    $id = 1;
                    $results = $result->fetchAll();
                    foreach ($results as $result) {
                        ?>
                        <tr>

                            <td><?php echo $id++ ?></td>
                            <td><?=$result['orgin']?></td>
                            <td><?=$result['destination']?></td>
                            <td><?=$result['company']?></td>
                            <td><?=$result['startdate']?>-<?=$result['starttime']?></td>
                            <td>
                                <a href="add.php?edit=<?php echo $result['id'] ?>"
                                   class="btn btn-sm btn-primary">ویرایش</a>
                                <a href="all.php?delete=<?php echo $result['id'] ?>"
                                   class="btn btn-sm btn-danger">حذف</a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>