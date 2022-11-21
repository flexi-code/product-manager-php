<?php
	include "connection.php";

	//code to validate category
	//-------------------------
	$sql = "select category_name from category";
	$result = mysqli_query($con,$sql);
	$category_arr = array();
	$category_error = array();
    $sub_category = "";
	$categoryErr = "";
	$error = [];
	$file_string = "";

	while($row = mysqli_fetch_array($result)) {
		array_push($category_arr,$row[0]);
	}
	
	$category = isset($_GET['category']) ? trim($_GET['category']) : null;
	$subcategory = isset($_GET['subcategory']) ? trim($_GET['subcategory']) : "";

	if (in_array($category, $category_arr)) {
		$errors['category_err'] = "Category already exists";	
	} 
	if (empty($category)) {
		$errors['category_err'] = "Category is empty";
	}

	if (!empty($errors)) {
		$data['success'] = false;
		$data['errors'] = $errors;
	} else {
		$data['success'] = true;
		$data['message'] = 'Success!';
	}
    echo json_encode($data);

    //code to edit category
	//-----------------------
	$subcategory_array = [];
	if($_GET['action'] = "edit") {
		// if(isset($_POST['submit'])) {			!!! toxic code do not uncomment !!!
			if(empty($errors)) {
    			$sql1 = "INSERT INTO category(category_name) VALUES ('".$category."');";
			    if($con->query($sql1)) {
				    $last_id = $con -> insert_id;
                    if(!empty($sub_category)) {
                        $subcategory_array = explode(",", $sub_category);
                        $subcategory_array = array_unique($subcategory_array);
                        foreach ($subcategory_array as $value) {
                            if(!empty($value)) {
                                $sql2 = "INSERT INTO sub_category(category_id,sub_category_name) values('".$last_id."','".trim($value)."');";
                                $con->query($sql2);
                            }
                        }
                    } else {}
				}
			} else {}		
		// }
	}
?>