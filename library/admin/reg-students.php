<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

 
    if (isset($_GET['inid'])) {
        $id = $_GET['inid'];
        $durum = 0;
        $sql = "update uyetablo set Durum=:durum  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->bindParam(':durum', $durum, PDO::PARAM_STR);
        $query->execute();
        header('location:reg-students.php');
    }




    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $durum = 1;
        $sql = "update uyetablo set Durum=:durum  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->bindParam(':durum', $durum, PDO::PARAM_STR);
        $query->execute();
        header('location:reg-students.php');
    }


?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Kütüphane Otomasyonu | Üye Kayıt İşleme</title>
     
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
                        <h4 class="header-line">Üye Kayıt İşle</h4>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-12">
                       
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Üye Kayıdı
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Üye ID</th>
                                                <th>Üye Adı</th>
                                                <th>Email id </th>
                                                <th>Telefon Numarası</th>
                                                <th>Kayıt Zamanı</th>
                                                <th>Durum</th>
                                                <th>Durum??</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sql = "SELECT * from uyetablo";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) {               ?>
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?php echo htmlentities($cnt); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->uyeId); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->isim); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->EmailId); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->telNo); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->kayitZmn); ?></td>
                                                        <td class="center"><?php if ($result->durum == 1) {
                                                                                echo htmlentities("aktif");
                                                                            } else {


                                                                                echo htmlentities("bloklandı");
                                                                            }
                                                                            ?></td>
                                                        <td class="center">
                                                            <?php if ($result->durum == 1) { ?>
                                                                <a href="reg-students.php?inid=<?php echo htmlentities($result->id); ?>" onclick="return confirm('engellemek istediğinize emin misiniz?');"" >  <button class=" btn btn-danger"> Aktif Değil</button>
                                                                <?php } else { ?>

                                                                    <a href="reg-students.php?id=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Bu Üyenin Engelini Kaldırmak İstediğinize Emin Misiniz?');""><button class=" btn btn-primary"> Aktif</button>
                                                                    <?php } ?>

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