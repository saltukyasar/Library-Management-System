<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['update'])) {
        $athrid = intval($_GET['athrid']);
        $yazar = $_POST['yazar'];
        $sql = "update  yazartablo set yazarIsim=:yazar where id=:athrid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':yazar', $yazar, PDO::PARAM_STR);
        $query->bindParam(':athrid', $athrid, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['updatemsg'] = "Author info updated successfully";
        header('location:manage-authors.php');
    }
?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Kütüphane Otomasyonu | Yazar Ekleme</title>
     
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
                            Yazar Bilgi
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post">
                                <div class="form-group">
                                    <label>Yazar Adı</label>
                                    <?php
                                    $athrid = intval($_GET['athrid']);
                                    $sql = "SELECT * from  yazartablo where id=:athrid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':athrid', $athrid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {               ?>
                                            <input class="form-control" type="text" name="yazar" value="<?php echo htmlentities($result->yazarIsim); ?>" required />
                                    <?php }
                                    } ?>
                                </div>

                                <button type="submit" name="update" class="btn btn-info">Güncelleme </button>

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