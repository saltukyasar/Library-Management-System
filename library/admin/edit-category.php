<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['update']))
{
$kategori=$_POST['kategori'];
$durum=$_POST['durum'];
$catid=intval($_GET['catid']);
$sql="update  kategoritbl set kategoriIsim=:kategori,durum=:durum where id=:catid";
$query = $dbh->prepare($sql);
$query->bindParam(':kategori',$kategori,PDO::PARAM_STR);
$query->bindParam(':durum',$durum,PDO::PARAM_STR);
$query->bindParam(':catid',$catid,PDO::PARAM_STR);
$query->execute();
$_SESSION['updatemsg']="Brand updated successfully";
header('location:manage-categories.php');


}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Kütüphane Otomasyonu | Kategori Düzenleme</title>

    <link href="assets/css/bootstrap.css" rel="stylesheet" />

    <link href="assets/css/font-awesome.css" rel="stylesheet" />

    <link href="assets/css/style.css" rel="stylesheet" />

    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>

<?php include('includes/header.php');?>

    <div class="content-wra
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Kategori Düzenle</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class="panel panel-info">
<div class="panel-heading">
Kategori Bilgileri
</div>
 
<div class="panel-body">
<form role="form" method="post">
<?php 
$catid=intval($_GET['catid']);
$sql="SELECT * from kategoritbl where id=:catid";
$query=$dbh->prepare($sql);
$query-> bindParam(':catid',$catid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{               
  ?> 
<div class="form-group">
<label>Kategori  Adı</label>
<input class="form-control" type="text" name="kategori" value="<?php echo htmlentities($result->kategoriIsim);?>" required />
</div>
<div class="form-group">
<label>Durum</label>
<?php if($result->durum==1) {?>
 <div class="radio">
<label>
<input type="radio" name="durum" id="durum" value="1" checked="checked">Aktif 
</label>
</div>
<div class="radio">
<label>
<input type="radio" name="durum" id="durum" value="0">Aktif Değil
</label>
</div>
<?php } else { ?>
<div class="radio">
<label>
<input type="radio" name="durum" id="durum" value="0" checked="checked">Aktif Değil
</label>
</div>
 <div class="radio">
<label>
<input type="radio" name="durum" id="durum" value="1">Aktif 
</label>

<?php } ?>
</div>
<?php }} ?>
<button type="submit" name="update" class="btn btn-info">Güncelle </button>

                                    </form>
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>

  <?php include('includes/footer.php');?>

    <script src="assets/js/jquery-1.10.2.js"></script>

    <script src="assets/js/bootstrap.js"></script>

    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
