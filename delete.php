<?php
	include_once "connection.php";
	$sql = "select pr_image from product where pr_id=".$_GET['id'].";";
	echo $sql;
	$result_img = mysqli_query($con,$sql);
	
	$sql1 = "delete from product where pr_id='".$_GET['id']."';";
	$sql2 = "delete from product_category where p_id='".$_GET['id']."';";
	//echo "<hr>";
	//echo $sql1;
	//echo "<hr>";
	$img = mysqli_fetch_array($result_img)[0];
	if(file_exists("product/".$img."")) {
		//echo "horray file has been found!!";
		if(unlink("product/".$img."")) {
			//echo "<hr>";
			//echo "Oops!! file has been delete";	
		}
		
	}
	if(mysqli_query($con,$sql1) && mysqli_query($con,$sql2)) { 
		header("location: index.php");
	 } 
?>