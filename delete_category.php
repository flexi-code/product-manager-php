<?php
    include "connection.php";
    $test = false;

    if($_GET['action'] === "delete") {
      $sql = "DELETE FROM category where category_id='".$_GET['id']."'";
      $sql1 = "DELETE FROM sub_category where category_id='".$_GET['id']."'";
      if(mysqli_query($con,$sql) || mysqli_query($con,$sql1)) {
        $test = true;
        echo json_encode($test);
      } else {
        $test = false;
        echo json_encode($test);
      }
    }
?>