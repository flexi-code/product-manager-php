<?php
	include "connection.php";		
	$sql = "DELETE FROM category where category_id='".$_GET['id']."'";
	$sql1 = "DELETE FROM product WHERE pr_category_id = '".$_GET['id']."'";
	$sql2 = "select pr_image from product where pr_category_id='".$_GET['id']."';";
	echo $sql."<br>";
	echo $sql1."<br>";
	echo $sql2."<br>";
	$result_img = mysqli_query($con,$sql2);
	$img = mysqli_fetch_array($result_img)[0];
	echo $img."<br>";
	if(file_exists("product/".$img."")) {
		echo "horray file has been found!!";
		if(unlink("product/".$img."")) {
			echo "<hr>";
			echo "Oops!! file has been delete";	
		}	
	}
	if(mysqli_query($con,$sql)/* && mysqli_query($con,$sql1)*/) {
		header("location: category.php");
	}
?>