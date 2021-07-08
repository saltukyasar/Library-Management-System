<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {



?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Kütüphane Otomasyonu | Ödünç Verme İşleme</title>

        <link href="assets/css/bootstrap.css" rel="stylesheet" />
   
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
  
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
 
        <link href="assets/css/style.css" rel="stylesheet" />

        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    </head>

    <body>

        <?php include('includes/header.php'); ?>

        <div class="content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Ödünç Verme İşle</h4>
                    </div>
                    <div class="row">
                        <?php if ($_SESSION['error'] != "") { ?>
                            <div class="col-md-6">
                                <div class="alert alert-danger">
                                    <strong>Hata :</strong>
                                    <?php echo htmlentities($_SESSION['error']); ?>
                                    <?php echo htmlentities($_SESSION['error'] = ""); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($_SESSION['msg'] != "") { ?>
                            <div class="col-md-6">
                                <div class="alert alert-success">
                                    <strong>Başarılı :</strong>
                                    <?php echo htmlentities($_SESSION['msg']); ?>
                                    <?php echo htmlentities($_SESSION['msg'] = ""); ?>
                                </div>
                            </div>
                        <?php } ?>



                        <?php if ($_SESSION['delmsg'] != "") { ?>
                            <div class="col-md-6">
                                <div class="alert alert-success">
                                    <strong>Başarılı :</strong>
                                    <?php echo htmlentities($_SESSION['delmsg']); ?>
                                    <?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
                                </div>
                            </div>
                        <?php } ?>

                    </div>


                </div>
                <div class="row">
                    <div class="col-md-12">
            
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Ödünç Verilen Kitap
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Kullanıcı Adı</th>
                                                <th>Kitap Adı</th>
                                                <th>ISBN </th>
                                                <th>Ödünç Verme Tarihi</th>
                                                <th>İade Verme Tarihi</th>
                                                <th>Durum??</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sql = "SELECT uyetablo.isim,kitaplartablo.kitapIsim,kitaplartablo.ISBNdeger,emanettablo.verilisTarih,emanettablo.teslimTarih,emanettablo.id as rid from  emanettablo join uyetablo on uyetablo.uyeId=emanettablo.uyeId join kitaplartablo on kitaplartablo.id=emanettablo.kitapId order by emanettablo.id desc";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) {               ?>
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?php echo htmlentities($cnt); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->isim); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->kitapIsim); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->ISBNdeger); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->verilisTarih); ?></td>
                                                        <td class="center"><?php if ($result->teslimTarih == "") {
                                                                                echo htmlentities("teslim edilmedi");
                                                                            } else {


                                                                                echo htmlentities($result->teslimTarih);
                                                                            }
                                                                            ?></td>
                                                        <td class="center">

                                                            <a href="update-issue-bookdeails.php?rid=<?php echo htmlentities($result->rid); ?>"><button class="btn btn-primary"><i class="fa fa-edit "></i> Düzenle</button>

                                                        </td>
                                                    </tr>
                                            <?php $cnt = $cnt + 1;
                                                }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>



            </div>
        </div>


        <?php include('includes/footer.php'); ?>

        <script src="assets/js/jquery-1.10.2.js"></script>

        <script src="assets/js/bootstrap.js"></script>

        <script src="assets/js/dataTables/jquery.dataTables.js"></script>
        <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>

        <script src="assets/js/custom.js"></script>
    </body>

    </html>
<?php } ?>