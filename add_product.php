<?php
	// all headers here
	include "connection.php";
?>
<?php 
	// Error detection module
	$name=$price=$image=$new_img_name=$status=$quantity=$desc="";
	$category = array();
	$response = array();
	$errors = array();

		$name = isset($_POST['name']) ? trim($_POST['name']) : "";

		$price = isset($_POST['price']) ? trim($_POST['price']) : "";

		$category = isset($_POST['category']) ? $_POST['category'] : "";

		$image = isset($_FILES['image']) ? $_FILES['image'] : "";

		$status = isset($_POST['status']) ? trim($_POST['status']) : "";

		$quantity = isset($_POST['quantity']) ? trim($_POST['quantity']) : "";

		$desc = isset($_POST['description']) ? trim($_POST['description']) : "";

		$created_at=$date = date('d-m-Y');

		$updated_at=$date = date('d-m-Y');


		$response['op_status'] = false;

		//checking if name is empty
		if (empty($_POST["name"])) {		
	    	array_push($errors, 1);
		} else if (!preg_match("/^[a-zA-Z ]*$/",$name)) { 
		    array_push($errors, 2);
		}			

		//checking if price is empty
		if(empty($price)) {
			array_push($errors, 3);
		} else if(!preg_match("/^[0-9.]*$/",$price)) {
			array_push($errors, 4);
		}

		//checking if category is empty
		if(empty($category)) {
			array_push($errors, 5);
		} else {}	

		// --------------------------------------------------------------------
		//checking if image is empty
		if(empty($image)) {
			array_push($errors, 6);
		} else {}

		//checking if status is empty
		if(empty($status)) {
			array_push($errors, 7);
		} else {}

		//checking if quantity is empty
		if(empty($quantity)) {
			array_push($errors, 8);
		} else if(!preg_match("/^[0-9]*$/",$quantity)) {
			array_push($errors, 9);
		}

		//checking if description is empty
		if(empty($desc)) {
			array_push($errors, 10);
		} else if(strlen($desc) >= 500) {
			array_push($errors, 11);
		}
?>
<?php
	//query to get category from subcategry id useful in future
	//SELECT "product_id",c.category_id,sc.sub_category_id,c.category_name,sc.sub_category_name FROM `category` AS c INNER JOIN `sub_category` AS sc ON c.category_id = sc.category_id WHERE sc.sub_category_id= 9;
	//
	// if($_GET['action'] === "insert") {
	// code to insert product
	//-----------------------

	// if(isset($_POST['submit'])) { 							!!! toxic code do not uncomment !!!
		$error_string = implode(",", $errors);
		if(empty($errors)) {
				$date = date('d/m/Y');
				if(isset($image)) {
					if($image['size'] < 1000000) {
						$allowed_types = array("image/jpg","image/jpeg","image/png");
						if(in_array($image['type'], $allowed_types)) {
							$new_img_name = uniqid().$image['name'];
							if(move_uploaded_file($image['tmp_name'],"product/".$new_img_name)) {}
						}
					}
				}

				//final sql query
				$sql="INSERT INTO product (pr_name, pr_price,pr_image,created_at,updated_at,pr_status,pr_quantity,pr_description) VALUES ('".$name."', '".$price."', '".$new_img_name."','".$created_at."', '".$updated_at."', '".$status."', '".$quantity."', '".$desc."');";
				
				if(mysqli_query($con,$sql)) {
					$last_id = $con->insert_id;
					foreach ($category as $value) {
						$sql1 = "INSERT INTO product_category SELECT $last_id,c.category_id,sc.sub_category_id,c.category_name,sc.sub_category_name FROM `category` AS c INNER JOIN `sub_category` AS sc ON c.category_id = sc.category_id WHERE sc.sub_category_id= $value;";
						mysqli_query($con,$sql1);
					}
					// header("location: index.php");
				}
				$response['op_status'] = "success";
		} else {
			// header("location: insert.php?action=insert&error=".$error_string);
			$response['op_status'] = "failed";
			$response['errors'] = $errors;
		
		}
		echo json_encode($response);
	// }
	// }
?>

