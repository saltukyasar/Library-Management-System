<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "delete from kitaplartablo  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['delmsg'] = "kategori silindi ";
        header('location:manage-books.php');
    }


?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Kütüphane Otomasyonu | Kitap Ödünç Verme</title>
     
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
                        <h4 class="header-line">>Kitap Ödünç Ver</h4>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
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
                                            <th>Kitap Adı</th>
                                            <th>ISBN </th>
                                            <th>Ödünç Zamanı</th>
                                            <th>İade Zamanı</th>
                                            <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sid = $_SESSION['stdid'];
                                                $sql = "SELECT kitaplartablo.kitapIsim,kitaplartablo.ISBNdeger,emanettablo.verilisTarih,emanettablo.teslimTarih,emanettablo.id as rid,emanettablo.fine from  emanettablo join uyetablo on uyetablo.uyeId=emanettablo.uyeId join kitaplartablo on kitaplartablo.id=emanettablo.kitapId where uyetablo.uyeId=:sid order by emanettablo.id desc";
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $result) {               ?>
                                                        <tr class="odd gradeX">
                                                            <td class="center"><?php echo htmlentities($cnt); ?></td>
                                                            <td class="center"><?php echo htmlentities($result->kitapIsim); ?></td>
                                                            <td class="center"><?php echo htmlentities($result->ISBNdeger); ?></td>
                                                            <td class="center"><?php echo htmlentities($result->verilisTarih); ?></td>
                                                            <td class="center"><?php if ($result->teslimTarih == "") { ?>
                                                                    <span style="color:red">
                                                                        <?php echo htmlentities("daha teslim edilmedi"); ?>
                                                                    </span>
                                                                <?php } else {
                                                                                    echo htmlentities($result->teslimTarih);
                                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="center"><?php echo htmlentities($result->fine); ?></td>

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