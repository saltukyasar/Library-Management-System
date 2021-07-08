<?php
session_start();
error_reporting(0);
include('includes/config.php');
if ($_SESSION['alogin'] != '') {
    $_SESSION['alogin'] = '';
}
if (isset($_POST['login'])) {

    if ($_POST["vercode"] != $_SESSION["vercode"] or $_SESSION["vercode"] == '') {
        echo "<script>alert('Incorrect verification code');</script>";
    } else {

        $kullaniciadi = $_POST['kullaniciadi'];
        $sifre = md5($_POST['sifre']);
        $sql = "SELECT kullaniciAdi,sifre FROM admin WHERE kullaniciAdi=:kullaniciadi and sifre=:sifre";
        $query = $dbh->prepare($sql);
        $query->bindParam(':kullaniciadi', $kullaniciadi, PDO::PARAM_STR);
        $query->bindParam(':sifre', $sifre, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            $_SESSION['alogin'] = $_POST['kullaniciadi'];
            echo "<script type='text/javascript'> document.location ='admin/dashboard.php'; </script>";
        } else {
            echo "<script>alert('Invalid Details');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Kütüphane Yönetim Sistemi</title>

    <link href="assets/css/bootstrap.css" rel="stylesheet" />

    <link href="assets/css/font-awesome.css" rel="stylesheet" />

    <link href="assets/css/style.css" rel="stylesheet" />

    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>

<body>

    <?php include('includes/header.php'); ?>
 
    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Yönetici</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">

                        </div>
                        <div class="panel-body">
                            <form role="form" method="post">

                                <div class="form-group">
                                    <label>Kullanıcı Adı</label>
                                    <input class="form-control" type="text" name="kullaniciadi" autocomplete="off" required />
                                </div>
                                <div class="form-group">
                                    <label>Şifre</label>
                                    <input class="form-control" type="password" name="sifre" autocomplete="off" required />
                                </div>
                                <div class="form-group">
                                    <label>Doğrulama kodu: </label>
                                    <input type="text" name="vercode" maxlength="5" autocomplete="off" required style="width: 150px; height: 25px;" />&nbsp;<img src="captcha.php">
                                </div>

                                <button type="submit" name="login" class="btn btn-info">Giriş </button>
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
    </script>
</body>

</html>