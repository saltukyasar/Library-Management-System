<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['return'])) {
        $rid = intval($_GET['rid']);
        $fine = $_POST['fine'];
        $rstatus = 1;
        $sql = "update emanettablo set fine=:fine,teslimTarih=:rstatus where id=:rid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rid', $rid, PDO::PARAM_STR);
        $query->bindParam(':fine', $fine, PDO::PARAM_STR);
        $query->bindParam(':rstatus', $rstatus, PDO::PARAM_STR);
        $query->execute();

        $_SESSION['msg'] = "kitap teslim edildi";
        header('location:manage-issued-books.php');
    }
?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Kütüphane Otomasyonu | Ödünç Detay</title>
   
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
     
        <link href="assets/css/font-awesome.css" rel="stylesheet" />

        <link href="assets/css/style.css" rel="stylesheet" />
 
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <script>
       
            function getstudent() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "get_student.php",
                    data: 'uyeId=' + $("#uyeId").val(),
                    type: "POST",
                    success: function(data) {
                        $("#get_student_name").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function() {}
                });
            }

    
            function getbook() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "get_book.php",
                    data: 'bookid=' + $("#bookid").val(),
                    type: "POST",
                    success: function(data) {
                        $("#get_book_name").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function() {}
                });
            }
        </script>
        <style type="text/css">
            .others {
                color: red;
            }
        </style>


    </head>

    <body>

        <?php include('includes/header.php'); ?>

        <div class="content-wra
    <div class=" content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Ödünç Detay</h4>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1"">
<div class=" panel panel-info">
                        <div class="panel-heading">
                            Ödünç Detay
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post">
                                <?php
                                $rid = intval($_GET['rid']);
                                $sql = "SELECT uyetablo.isim,kitaplartablo.kitapIsim,kitaplartablo.ISBNdeger,emanettablo.verilisTarih,emanettablo.teslimTarih,emanettablo.id as rid,emanettablo.fine,emanettablo.teslimTarih from  emanettablo join uyetablo on uyetablo.uyeId=emanettablo.uyeId join kitaplartablo on kitaplartablo.id=emanettablo.kitapId where emanettablo.id=:rid";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':rid', $rid, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {               ?>




                                        <div class="form-group">
                                            <label>Üye Adı :</label>
                                            <?php echo htmlentities($result->isim); ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Kitap Adı :</label>
                                            <?php echo htmlentities($result->kitapIsim); ?>
                                        </div>


                                        <div class="form-group">
                                            <label>ISBN :</label>
                                            <?php echo htmlentities($result->ISBNdeger); ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Ödünç Verilen Zaman :</label>
                                            <?php echo htmlentities($result->verilisTarih); ?>
                                        </div>


                                        <div class="form-group">
                                            <label>İade Tarihi :</label>
                                            <?php if ($result->teslimTarih == "") {
                                                echo htmlentities("daha teslim edilmedi");
                                            } else {


                                                echo htmlentities($result->teslimTarih);
                                            }
                                            ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Güzel :</label>
                                            <?php
                                            if ($result->fine == "") { ?>
                                                <input class="form-control" type="text" name="fine" id="fine" required />

                                            <?php } else {
                                                echo htmlentities($result->fine);
                                            }
                                            ?>
                                        </div>
                                        <?php if ($result->teslimTarih == 0) { ?>

                                            <button type="submit" name="return" id="submit" class="btn btn-info">Kitap Teslim Al </button>

                        </div>

            <?php }
                                    }
                                } ?>
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