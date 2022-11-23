<?php
	include "connection.php";
	$sql = "select pr_image from product where pr_id='".$_GET['id']."';";
	$sql1 = "update product set pr_image='' where pr_id='".$_GET['id']."';";
	echo $sql;
	echo "<hr>";
	echo $sql1;
	$img_result = mysqli_query($con,$sql);
	$img = mysqli_fetch_array($img_result)[0];
	echo $img;
	echo "<hr>";
	if(file_exists("product/".$img."")) {
		echo "<br>image found!";
		echo "<hr>";
		if(unlink("product/".$img) && mysqli_query($con,$sql1)) {
			echo "<br>image deleted!";
			header("location: edit.php?id=".$_GET['id'].";");
		}
	}
?>