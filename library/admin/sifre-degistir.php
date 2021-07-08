<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else {
  if (isset($_POST['change'])) {
    $sifre = md5($_POST['sifre']);
    $yenisifre = md5($_POST['yenisifre']);
    $kullaniciadi = $_SESSION['alogin'];
    $sql = "SELECT Sifre FROM admin where kullaniciAdi=:kullaniciadi and Sifre=:sifre";
    $query = $dbh->prepare($sql);
    $query->bindParam(':kullaniciadi', $kullaniciadi, PDO::PARAM_STR);
    $query->bindParam(':sifre', $sifre, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
      $con = "update admin set sifre=:yenisifre where kullaniciAdi=:kullaniciadi";
      $chngpwd1 = $dbh->prepare($con);
      $chngpwd1->bindParam(':kullaniciadi', $kullaniciadi, PDO::PARAM_STR);
      $chngpwd1->bindParam(':yenisifre', $yenisifre, PDO::PARAM_STR);
      $chngpwd1->execute();
      $msg = "Your Sifre succesfully changed";
    } else {
      $error = "Your current sifre is wrong";
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
    <title>Kütüphane Otomasyonu </title>

    <link href="assets/css/bootstrap.css" rel="stylesheet" />

    <link href="assets/css/font-awesome.css" rel="stylesheet" />

    <link href="assets/css/style.css" rel="stylesheet" />

    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <style>
      .errorWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #dd3d36;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
      }

      .succWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #5cb85c;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
      }
    </style>
  </head>
  <script type="text/javascript">
    function valid() {
      if (document.chngpwd.yenisifre.value != document.chngpwd.confirmpassword.value) {
        alert("yeni şifre ve eski şifre eşleşmedi  !!");
        document.chngpwd.confirmpassword.focus();
        return false;
      }
      return true;
    }
  </script>

  <body>

    <?php include('includes/header.php'); ?>

    <div class="content-wrapper">
      <div class="container">
        <div class="row pad-botm">
          <div class="col-md-12">
            <h4 class="header-line">Kullanıcı Parola Değiştirme</h4>
          </div>
        </div>
        <?php if ($error) { ?><div class="errorWrap"><strong>Hata</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>Başarılı</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>

        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <div class="panel panel-info">
              <div class="panel-heading">
                Parola Değiştir
              </div>
              <div class="panel-body">
                <form role="form" method="post" onSubmit="return valid();" name="chngpwd">

                  <div class="form-group">
                    <label>Eski Parola</label>
                    <input class="form-control" type="sifre" name="sifre" autocomplete="off" required />
                  </div>

                  <div class="form-group">
                    <label>Yeni Parola</label>
                    <input class="form-control" type="sifre" name="yenisifre" autocomplete="off" required />
                  </div>

                  <div class="form-group">
                    <label>Parola Onaylayın </label>
                    <input class="form-control" type="sifre" name="confirmpassword" autocomplete="off" required />
                  </div>

                  <button type="submit" name="change" class="btn btn-info">Değiştir </button>
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