<?php
require_once("includes/config.php");
if (!empty($_POST["uyeid"])) {
  $uyeid = strtoupper($_POST["uyeid"]);

  $sql = "SELECT isim,Durum FROM uyetablo WHERE uyeId=:uyeid";
  $query = $dbh->prepare($sql);
  $query->bindParam(':uyeid', $uyeid, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  $cnt = 1;
  if ($query->rowCount() > 0) {
    foreach ($results as $result) {
      if ($result->Durum == 0) {
        echo "<span style='color:red'> Student ID Blocked </span>" . "<br />";
        echo "<b>Student Name-</b>" . $result->isim;
        echo "<script>$('#submit').prop('disabled',true);</script>";
      } else {
?>


<?php
        echo htmlentities($result->isim);
        echo "<script>$('#submit').prop('disabled',false);</script>";
      }
    }
  } else {

    echo "<span style='color:red'> Invaid Student Id. Please Enter Valid Student id .</span>";
    echo "<script>$('#submit').prop('disabled',true);</script>";
  }
}



?>
