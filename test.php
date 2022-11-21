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
		$price = isset($_POST['price']) ? trim($_POST['price']) : "";
		$category = isset($_POST['category']) ? $_POST['category'] : "";
		$image = isset($_FILES['image']['name']) ? trim($_FILES['image']['name']) : "";
		$status = isset($_POST['status']) ? trim($_POST['status']) : "";
		$quantity = isset($_POST['quantity']) ? trim($_POST['quantity']) : "";
		$desc = isset($_POST['desc']) ? trim($_POST['desc']) : "";
		$created_at=$date = date('d/m/Y');
		$updated_at=$date = date('d/m/Y');

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
	if($_GET['action'] === "insert") {
	// code to insert product
	//-----------------------

	if(isset($_POST['submit'])) {
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
		} else {
			header("location: insert.php?action=insert&error=".$error_string);
		}
	}
	}
?>
<?php 
	if($_GET['action'] === "edit") {
	//code to update product
	//----------------------
	if(isset($_POST['submit'])) {
		$error_string = implode(",", $allerror);
		$tempcategory = $category = array();
		
		$sql3 = "SELECT GROUP_CONCAT(c.category_name) as c_name FROM product p LEFT JOIN product_category cp ON cp.p_id = p.pr_id LEFT JOIN category c ON c.category_id = cp.c_id WHERE p.pr_id = '".$_GET['id']."';";
		$result = mysqli_query($con,$sql3);
		$dbcategory = mysqli_fetch_array($result)[0]; 
		$tempcategory = explode(",", $dbcategory);

		$category = $_POST['category'];

		if (empty($allerror)) {
			$date = date('d/m/Y');
			if(isset($_FILES['image'])) {
				//echo "some value in file input<br>";
				if($_FILES['image']['size'] < 1000000) {
						//echo "file size is under 1000000<br>";
						$allowed_types = array("image/jpg","image/jpeg","image/png");
					if(in_array($_FILES['image']['type'], $allowed_types)) {
						//echo "valid image type<br>";
						$new_img_name = uniqid().$_FILES['image']['name'];
						//echo "new image name:".$new_img_name."<br>";
						if(move_uploaded_file($_FILES['image']['tmp_name'],"product/".$new_img_name)) {
							$sql = "select pr_image from product where pr_id='".$_GET['id']."'";
							echo $sql;
							echo "<br>";
							$result = mysqli_query($con,$sql);
							$img = mysqli_fetch_array($result)[0];
							echo $img;
							echo "<br>";
							if(file_exists("product/".$img."")) {
								echo "file deleted";
								echo "<br>";
								unlink("product/".$img."");
							}
						}
					}
				}
			}
			//echo "array to string : ".implode(",", $category)."<br>";
			$sql = "UPDATE product p SET p.pr_name = '".$name."', p.pr_description = '".$desc."', p.pr_price = '".$price."', p.pr_image = '".$new_img_name."', p.updated_at = '".$updated_at."', p.pr_status = '".$status."',p.pr_quantity = '".$quantity."' WHERE p.pr_id = '".$_GET['id']."';";

			$itemremoved = array_diff($tempcategory, $category);
			 //echo "item to be removed<br>";
			 //print_r($itemremoved)."<br>";

			$itemadded = array_diff($category,$tempcategory);
			//echo "<br><br>item to be added<br>";
			//print_r($itemadded)."<br>";

			// Loop to delete the unselected categories
			foreach ($itemremoved as $value) {
				$sql4 = "DELETE FROM product_category where c_name = '".$value."' AND p_id = '".$_GET['id']."';";
				mysqli_query($con,$sql4);
			}

			// Loop to inserted the selected categories
			foreach ($itemadded as $value) {
				$sql3 = "SELECT category_id FROM category WHERE category_name = '".$value."';";
				$result3 = mysqli_query($con,$sql3);
				$c_id = mysqli_fetch_array($result3)[0];
				$sql5 = "INSERT INTO product_category(p_id,c_id,c_name) values('".$_GET['id']."','".$c_id."','".$value."') ";
				mysqli_query($con,$sql5);
			}

			if (mysqli_query($con,$sql)) {
				header("location:index.php");
			} 
		} else {
			header("location: edit.php?id=".$_GET['id']."&action=edit&error=".$error_string);
		}
	}
	}
?>
<?php
	if($_GET['action'] === "delete") {
		// code to delete product
		//-----------------------
		$sql = "select pr_image from product where pr_id=".$_GET['id'].";";
		echo $sql;
		$result_img = mysqli_query($con,$sql);
		
		$sql1 = "delete from product where pr_id='".$_GET['id']."';";
		$sql2 = "delete from product_category where p_id='".$_GET['id']."';";

		$img = mysqli_fetch_array($result_img)[0];
		if(file_exists("product/".$img."")) {
			if(unlink("product/".$img."")) {}
		}
		if(mysqli_query($con,$sql1) && mysqli_query($con,$sql2)) { 
			header("location: index.php");
		} 
	}
?>

