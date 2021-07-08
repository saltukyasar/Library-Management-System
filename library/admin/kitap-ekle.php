<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['add'])) {
        $kitapisim = $_POST['kitapisim'];
        $kategori = $_POST['kategori'];
        $yazar = $_POST['yazar'];
        $isbn = $_POST['isbn'];
        $fiyat = $_POST['fiyat'];
        $sql = "INSERT INTO  kitaplartablo(kitapIsim,kategoriId,yazarId,ISBNdeger,kitapFiyt) VALUES(:kitapisim,:kategori,:yazar,:isbn,:fiyat)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':kitapisim', $kitapisim, PDO::PARAM_STR);
        $query->bindParam(':kategori', $kategori, PDO::PARAM_STR);
        $query->bindParam(':yazar', $yazar, PDO::PARAM_STR);
        $query->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        $query->bindParam(':fiyat', $fiyat, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Book Listed successfully";
            header('location:manage-books.php');
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
            header('location:manage-books.php');
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
        <title>Kütüphane Yönetim Sistemi| Kitap Ekleme</title>

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
                                <div class="form-group">
                                    <label>Kitap Adı<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="kitapisim" autocomplete="off" required />
                                </div>

                                <div class="form-group">
                                    <label> Kategori<span style="color:red;">*</span></label>
                                    <select class="form-control" name="kategori" required="required">
                                        <option value=""> Kategori Seç</option>
                                        <?php
                                        $durum = 1;
                                        $sql = "SELECT * from  kategoritbl where Durum=:durum";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':durum', $durum, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {               ?>
                                                <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->kategoriIsim); ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label> Yazar<span style="color:red;">*</span></label>
                                    <select class="form-control" name="yazar" required="required">
                                        <option value=""> Yazar Seç</option>
                                        <?php

                                        $sql = "SELECT * from  yazartablo ";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {               ?>
                                                <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->yazarIsim); ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>ISBN No<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="isbn" required="required" autocomplete="off" />
                                    <p class="help-block">ISBN uluslararası kitap numarasıdır ve kitaba özgüdür.</p>
                                </div>

                               <!-- <div class="form-group">
                                    <label>Fiyat<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="fiyat" autocomplete="off" required="required" />
                                </div> -->
                                <button type="submit" name="add" class="btn btn-info">Ekle </button>

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