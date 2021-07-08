<?php
session_start();
error_reporting(0);
include('includes/config.php');
if ($_SESSION['login'] != '') {
  $_SESSION['login'] = '';
}
if (isset($_POST['login'])) {

  if ($_POST["vercode"] != $_SESSION["vercode"] or $_SESSION["vercode"] == '') {
    echo "<script>alert('doğrulama kodunu yanlış girdiniz');</script>";
  } else {
    $email = $_POST['emailId'];
    $sifre = md5($_POST['sifre']);
    $sql = "SELECT EmailId,Sifre,uyeId,Durum FROM uyetablo WHERE EmailId=:email and Sifre=:sifre";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':sifre', $sifre, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
      foreach ($results as $result) {
        $_SESSION['stdid'] = $result->uyeId;
        if ($result->durum == 0) {
          $_SESSION['login'] = $_POST['emailId'];
          echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
        } else {
          echo "<script>alert('hesabınız bloke edildi');</script>";
        }
      }
    } else {
      echo "<script>alert('geçersiz değerler');</script>";
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
  <title>Kütüphane Otomasyonu  | </title>

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
          <h4 class="header-line">Üye Giriş</h4>
        </div>
      </div>


      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
          <div class="panel panel-info">
            <div class="panel-heading">
            Giriş 
            </div>
            <div class="panel-body">
              <form role="form" method="post">

                <div class="form-group">
                  <label>Kullanıcı Adı/Email İd</label>
                  <input class="form-control" type="text" name="emailId" required autocomplete="off" />
                </div>
                <div class="form-group">
                  <label>Parola</label>
                  <input class="form-control" type="password" name="sifre" required autocomplete="off" />
                  <p class="help-block"><a href="user-forgot-password.php"> sifre unuttum</a></p>
                </div>

                <div class="form-group">
                  <label>Resimdeki Sayılar : </label>
                  <input type="text" class="form-control1" name="vercode" maxlength="5" autocomplete="off" required style="height:25px;" />&nbsp;<img src="captcha.php">
                </div>

                <button type="submit" name="login" class="btn btn-info">Giriş </button> | <a href="signup.php">Henüz Kayıt Olmadım</a>
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