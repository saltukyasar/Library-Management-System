<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_POST['change'])) {

  if ($_POST["vercode"] != $_SESSION["vercode"] or $_SESSION["vercode"] == '') {
    echo "<script>alert('hatalı doğrulama kodu girdiniz');</script>";
  } else {
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $yenisifre = md5($_POST['yenisifre']);
    $sql = "SELECT EmailId FROM uyetablo WHERE EmailId=:email and telNo=:mobile";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
      $con = "update uyetablo set sifre=:yenisifre where EmailId=:email and telNo=:mobile";
      $chngpwd1 = $dbh->prepare($con);
      $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
      $chngpwd1->bindParam(':mobile', $mobile, PDO::PARAM_STR);
      $chngpwd1->bindParam(':yenisifre', $yenisifre, PDO::PARAM_STR);
      $chngpwd1->execute();
      echo "<script>alert('şifreniz değiştirlidi');</script>";
    } else {
      echo "<script>alert('geçersiz email adresi');</script>";
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
  <title>Kütüphane Otomasyonu | Parola Kurtarma </title>

  <link href="assets/css/bootstrap.css" rel="stylesheet" />

  <link href="assets/css/font-awesome.css" rel="stylesheet" />

  <link href="assets/css/style.css" rel="stylesheet" />

  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
  <script type="text/javascript">
    function valid() {
      if (document.chngpwd.yenisifre.value != document.chngpwd.confirmpassword.value) {
        alert("şifreler eşleşmedi !!");
        document.chngpwd.confirmpassword.focus();
        return false;
      }
      return true;
    }
  </script>

</head>

<body>
  <!------MENU SECTION START-->
  <?php include('includes/header.php'); ?>
  <!-- MENU SECTION END-->
  <div class="content-wrapper">
    <div class="container">
      <div class="row pad-botm">
        <div class="col-md-12">
          <h4 class="header-line">Parola Değiştirme</h4>
        </div>
      </div>

      <!--LOGIN PANEL START-->
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
          <div class="panel panel-info">
            <div class="panel-heading">
            Giriş 
            </div>
            <div class="panel-body">
              <form role="form" name="chngpwd" method="post" onSubmit="return valid();">

                <div class="form-group">
                  <label>Üye Kayıt İd</label>
                  <input class="form-control" type="email" name="email" required autocomplete="off" />
                </div>

                <div class="form-group">
                  <label>Üye Telefon NO</label>
                  <input class="form-control" type="text" name="mobile" required autocomplete="off" />
                </div>

                <div class="form-group">
                  <label>Parola</label>
                  <input class="form-control" type="sifre" name="yenisifre" required autocomplete="off" />
                </div>

                <div class="form-group">
                  <label>Parola Onay</label>
                  <input class="form-control" type="sifre" name="confirmpassword" required autocomplete="off" />
                </div>

                <div class="form-group">
                  <label>Resimdeki Sayılar : </label>
                  <input type="text" class="form-control1" name="vercode" maxlength="5" autocomplete="off" required style="height:25px;" />&nbsp;<img src="captcha.php">
                </div>

                <button type="submit" name="change" class="btn btn-info">Parolamı Değiştir</button> | <a href="index.php">Giriş</a>
              </form>
            </div>
          </div>
        </div>
      </div>
  


    </div>
  </div>
  <!-- CONTENT-WRAPPER SECTION END-->  <?php include('includes/footer.php'); ?>

  <script src="assets/js/jquery-1.10.2.js"></script>

  <script src="assets/js/bootstrap.js"></script>

  <script src="assets/js/custom.js"></script>

</body>

</html>