<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['create'])) {
        $yazar = $_POST['yazar'];
        $sql = "INSERT INTO  yazartablo(yazarIsim) VALUES(:yazar)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':yazar', $yazar, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Yazar Listed successfully";
            header('location:manage-authors.php');
        } else {
            $_SESSION['error'] = "tekrar deneyin";
            header('location:manage-authors.php');
        }
    }
?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="yazar" content="" />
        <title>Kütüphane Yönetim Sistemi| Yazar Ekleme</title>
      
        <link href="assets/css/bootstrap.css" rel="stylesheet" />

        <link href="assets/css/font-awesome.css" rel="stylesheet" />

        <link href="assets/css/style.css" rel="stylesheet" />

        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    </head>

    <body>

        <?php include('includes/header.php'); ?>


    <div class=" content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Yazar Ekle</h4>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class=" panel panel-info">
                        <div class="panel-heading">
                            Yazar Bilgileri
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post">
                                <div class="form-group">
                                    <label>Yazar Adı</label>
                                    <input class="form-control" type="text" name="yazar" autocomplete="off" required />
                                </div>

                                <button type="submit" name="create" class="btn btn-info">Ekle </button>

                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        </div>

        <?php include('includes/footer.php'); ?>

        <script src="assets/js/jquery-1.10.2.js"></script>

        <script src="assets/js/bootstrap.js"></script>

        <script src="assets/js/custom.js"></script>
    </body>

    </html>
<?php } ?>