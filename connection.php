<?php  

	$server = "localhost";
	$username = "root";
	$password = "";
	$dbname = "product_db";

	$con = mysqli_connect($server,$username,$password,$dbname);

	if($con -> connect_error) {
		echo "Error in connection";
	} else {
		// echo "Succesfully connected";		
	}

?>