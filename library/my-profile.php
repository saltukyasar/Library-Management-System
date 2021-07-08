<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['update'])) {
        $sid = $_SESSION['stdid'];
        $fname = $_POST['isim'];
        $mobileno = $_POST['mobileno'];

        $sql = "update uyetablo set isim=:fname,telNo=:mobileno where uyeId=:sid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->execute();

        echo '<script>alert("profiliniz güncellendi")</script>';
    }

?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
    
        <title>Kütüphane Otomasyonu | Üye Kayıt</title>

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
                        <h4 class="header-line">Profilim</h4>

                    </div>

                </div>
                <div class="row">

                    <div class="col-md-9 col-md-offset-1">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                            Profilim
                            </div>
                            <div class="panel-body">
                                <form name="signup" method="post">
                                    <?php
                                    $sid = $_SESSION['stdid'];
                                    $sql = "SELECT uyeId,isim,EmailId,telNo,kayitZmn,guncellemeTarihi,Durum from  uyetablo  where uyeId=:sid ";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':uyeId', $sid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {               ?>

                                            <div class="form-group">
                                                <label>Üye ID : </label>
                                                <?php echo htmlentities($result->uyeId); ?>
                                            </div>

                                            <div class="form-group">
                                                <label>Kayıt Tarihi : </label>
                                                <?php echo htmlentities($result->kayitZmn); ?>
                                            </div>
                                            <?php if ($result->guncellemeTarihi != "") { ?>
                                                <div class="form-group">
                                                    <label>Son Güncelleme Tarihi : </label>
                                                    <?php echo htmlentities($result->guncellemeTarihi); ?>
                                                </div>
                                            <?php } ?>


                                            <div class="form-group">
                                                <label>Profil Durumu  : </label>
                                                <?php if ($result->Durum == 1) { ?>
                                                    <span style="color: green">Aktif</span>
                                                <?php } else { ?>
                                                    <span style="color: red">Aktif Değil</span>
                                                <?php } ?>
                                            </div>


                                            <div class="form-group">
                                                <label>Tam Adınız</label>
                                                <input class="form-control" type="text" name="isim" value="<?php echo htmlentities($result->isim); ?>" autocomplete="off" required />
                                            </div>


                                            <div class="form-group">
                                                <label>Telefon Numaranız :</label>
                                                <input class="form-control" type="text" name="mobileno" maxlength="10" value="<?php echo htmlentities($result->telNo); ?>" autocomplete="off" required />
                                            </div>

                                            <div class="form-group">
                                                <label>Email Adresiniz</label>
                                                <input class="form-control" type="email" name="email" id="emailid" value="<?php echo htmlentities($result->EmailId); ?>" autocomplete="off" required readonly />
                                            </div>
                                    <?php }
                                    } ?>

                                    <button type="submit" name="update" class="btn btn-primary" id="submit">Güncelle </button>

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