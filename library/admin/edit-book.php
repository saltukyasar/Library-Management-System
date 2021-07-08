<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['update'])) {
        $kitapIsim = $_POST['kitapIsim '];
        $kategori = $_POST['kategori'];
        $yazar = $_POST['yazar'];
        $isbn = $_POST['isbn'];
        $fiyat = $_POST['fiyat'];
        $bookid = intval($_GET['bookid']);
        $sql = "update  kitaplartablo set kitapIsim=:kitapIsim ,kategoriId=:kategori,yazarId=:yazar,ISBNdeger=:isbn,kitapFyt=:fiyat where id=:bookid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':kitapIsim ', $kitapIsim, PDO::PARAM_STR);
        $query->bindParam(':kategori', $kategori, PDO::PARAM_STR);
        $query->bindParam(':yazar', $yazar, PDO::PARAM_STR);
        $query->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        $query->bindParam(':fiyat', $fiyat, PDO::PARAM_STR);
        $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['msg'] = "";
        header('location:manage-books.php');
    }
?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="yazar" content="" />
        <title>Kütüphane Otomasyonu | Kitap Düzenleme</title>

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
                        <h4 class="header-line">Kitap Ekle</h4>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class=" panel panel-info">
                        <div class="panel-heading">
                        Kitap Bilgileri
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post">
                                <?php
                                $bookid = intval($_GET['bookid']);
                                $sql = "SELECT kitaplartablo.kitapIsim,kategoritbl.kategoriIsim,kategoritbl.id as cid,yazartablo.yazarIsim,yazartablo.id as athrid,kitaplartablo.ISBNdeger,kitaplartablo.kitapFyt,kitaplartablo.id as bookid from  kitaplartablo join kategoritbl on kategoritbl.id=kitaplartablo.kategoriId join yazartablo on yazartablo.id=kitaplartablo.yazarId where kitaplartablo.id=:bookid";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {               ?>

                                        <div class="form-group">
                                            <label>Kitap Adı<span style="color:red;">*</span></label>
                                            <input class="form-control" type="text" name="kitapIsim " value="<?php echo htmlentities($result->kitapIsim); ?>" required />
                                        </div>

                                        <div class="form-group">
                                            <label> Kategorisi<span style="color:red;">*</span></label>
                                            <select class="form-control" name="kategori" required="required">
                                                <option value="<?php echo htmlentities($result->cid); ?>"> <?php echo htmlentities($catname = $result->kategoriIsim); ?></option>
                                                <?php
                                                $durum = 1;
                                                $sql1 = "SELECT * from  kategoritbl where Durum=:durum";
                                                $query1 = $dbh->prepare($sql1);
                                                $query1->bindParam(':durum', $durum, PDO::PARAM_STR);
                                                $query1->execute();
                                                $resultss = $query1->fetchAll(PDO::FETCH_OBJ);
                                                if ($query1->rowCount() > 0) {
                                                    foreach ($resultss as $row) {
                                                        if ($catname == $row->kategoriIsim) {
                                                            continue;
                                                        } else {
                                                ?>
                                                            <option value="<?php echo htmlentities($row->id); ?>"><?php echo htmlentities($row->kategoriIsim); ?></option>
                                                <?php }
                                                    }
                                                } ?>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label> Yazar<span style="color:red;">*</span></label>
                                            <select class="form-control" name="yazar" required="required">
                                                <option value="<?php echo htmlentities($result->athrid); ?>"> <?php echo htmlentities($athrname = $result->yazarIsim); ?></option>
                                                <?php

                                                $sql2 = "SELECT * from  yazartablo ";
                                                $query2 = $dbh->prepare($sql2);
                                                $query2->execute();
                                                $result2 = $query2->fetchAll(PDO::FETCH_OBJ);
                                                if ($query2->rowCount() > 0) {
                                                    foreach ($result2 as $ret) {
                                                        if ($athrname == $ret->yazarIsim) {
                                                            continue;
                                                        } else {

                                                ?>
                                                            <option value="<?php echo htmlentities($ret->id); ?>"><?php echo htmlentities($ret->yazarIsim); ?></option>
                                                <?php }
                                                    }
                                                } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>ISBN No<span style="color:red;">*</span></label>
                                            <input class="form-control" type="text" name="isbn" value="<?php echo htmlentities($result->ISBNdeger); ?>" required="required" />
                                            <p class="help-block">ISBN uluslararası kitap numarasıdır ve kitaba özgüdür.</p>
                                        </div>

                                        <div class="form-group">
                                            <label>Fiyat<span style="color:red;">*</span></label>
                                            <input class="form-control" type="text" name="fiyat" value="<?php echo htmlentities($result->kitapFyt); ?>" required="required" />
                                        </div>
                                <?php }
                                } ?>
                                <button type="submit" name="update" class="btn btn-info">Güncelle </button>

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