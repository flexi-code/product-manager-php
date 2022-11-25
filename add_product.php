<?php
	// all headers here
	include "connection.php";
?>
<?php 
	// Error detection module
	$name=$price=$image=$new_img_name=$status=$quantity=$desc="";
	$category = array();
	$allerror = array();

		$name = isset($_POST['name']) ? trim($_POST['name']) : "";
		$response['name'] = $name;
		$price = isset($_POST['price']) ? trim($_POST['price']) : "";
		$response['price'] = $price;
		$category = isset($_POST['category']) ? $_POST['category'] : "";
		$response['category'] = $category;
		$image = isset($_FILES['image']['name']) ? trim($_FILES['image']['name']) : "";
		$response['image'] = $image;
		$status = isset($_POST['status']) ? trim($_POST['status']) : "";
		$response['status'] = $status;
		$quantity = isset($_POST['quantity']) ? trim($_POST['quantity']) : "";
		$response['quantity'] = $quantity;
		$desc = isset($_POST['desc']) ? trim($_POST['desc']) : "";
		$response['desc'] = $desc;
		$created_at=$date = date('d/m/Y');
		$response['created_at'] = $created_at;
		$updated_at=$date = date('d/m/Y');
		$response['updated_at'] = $updated_at;

		//checking if name is empty
		if (empty($_POST["name"])) {		
	    	array_push($allerror, 1);
		} else if (!preg_match("/^[a-zA-Z ]*$/",$name)) { 
		    array_push($allerror, 2);
		}			

		//checking if price is empty
		if(empty($price)) {
			array_push($allerror, 3);
		} else if(!preg_match("/^[0-9.]*$/",$price)) {
			array_push($allerror, 4);
		}

		//checking if category is empty
		if(empty($category)) {
			array_push($allerror, 5);
		} else {}	

		// --------------------------------------------------------------------
		// code to convert string to array when category array is null
		if(gettype($category) == "array") {
			//echo "type of category is ".gettype($category);
		} else if(settype($category,"array")) {
			//echo "type of category is ".gettype($category);
		} else {}
		// --------------------------------------------------------------------
		//checking if image is empty
		if(empty($image)) {
			array_push($allerror, 6);
		} else {}

		//checking if status is empty
		if(empty($status)) {
			array_push($allerror, 7);
		} else {}

		//checking if quantity is empty
		if(empty($quantity)) {
			array_push($allerror, 8);
		} else if(!preg_match("/^[0-9]*$/",$quantity)) {
			array_push($allerror, 9);
		}

		//checking if description is empty
		if(empty($desc)) {
			array_push($allerror, 10);
		} else {
		}
?>
<?php
	// if($_GET['action'] === "insert") {
	// code to insert product
	//-----------------------

	// if(isset($_POST['submit'])) { 							!!! toxic code do not uncomment !!!
		$error_string = implode(",", $allerror);
		if(empty($allerror)) {
				$date = date('d/m/Y');
				if(isset($_FILES['image'])) {
					if($_FILES['image']['size'] < 1000000) {
						$allowed_types = array("image/jpg","image/jpeg","image/png");
						if(in_array($_FILES['image']['type'], $allowed_types)) {
							$new_img_name = uniqid().$_FILES['image']['name'];
							if(move_uploaded_file($_FILES['image']['tmp_name'],"product/".$new_img_name)) {}
						}
					}
				}

				//final sql query
				$sql="INSERT INTO product (pr_name, pr_price,pr_image,created_at,updated_at,pr_status,pr_quantity,pr_description) VALUES ('".$name."', '".$price."', '".$new_img_name."','".$created_at."', '".$updated_at."', '".$status."', '".$quantity."', '".$desc."');";
				
				if(mysqli_query($con,$sql)) {
					$last_id = $con->insert_id;
					foreach ($category as $value) {
						$sql3 = "SELECT category_name FROM category WHERE category_id = '".$value."';";
						$result3 = mysqli_query($con,$sql3);
						$cat_name = mysqli_fetch_array($result3)[0];
						$sql1 = "insert into product_category(p_id,c_id,c_name) values('".$last_id."','".$value."','".$cat_name."');";
						mysqli_query($con,$sql1);
					}
					header("location: index.php");
				}
				$response['status'] = "success";
				echo json_encode($response);
		} else {
			// header("location: insert.php?action=insert&error=".$error_string);
			$response['status'] = "failed";
			$response['error'] = $error_string;
			echo json_encode($response);
		}
	// }
	// }
?>

