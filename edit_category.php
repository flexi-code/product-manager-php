<?php
	include "connection.php";

	//code to validate category
	//-------------------------
	$error = [];
	$file_string = "";

	$id = isset($_GET['id']) ? trim($_GET['id']) : null;
	$category = isset($_GET['category']) ? trim($_GET['category']) : null;

	$sql1 = "SELECT GROUP_CONCAT(sub_category_name) FROM sub_category where category_id=".$id.";";
	$result1 = $con->query($sql1);
	$oldsubcategory = mysqli_fetch_array($result1)[0];

	$subcategory = isset($_GET['subcategory']) ? trim($_GET['subcategory']) : "";

	if (empty($category)) {
		$errors['category_err'] = "Category is empty";
	}
	$oldsubcategory_arr = explode(",",$oldsubcategory);
	$subcategory_arr = explode(",",$subcategory);
	//if(neither removed && neither add)
	// if (array_diff($oldsubcategory_arr,$subcategory_arr) == null && array_diff($subcategory_arr,$oldsubcategory_arr) == null) {
	// 	$errors['sub_category_err'] = "Sub-category already exists";
	// } 
	// if (array_diff(array_unique($subcategory_arr),$subcategory_arr) == null && array_diff($subcategory_arr,array_unique($subcategory_arr)) == null) {
	// 	$errors['sub_category_err'] = "Sub-category already exists";
	// }

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
    			$sql1 = "UPDATE category SET category_name = '".$category."' where category_id = ".$id.";";
			    if($con->query($sql1)) {
				    $last_id = $con -> insert_id;
                    if(!empty($subcategory)) {
						$itemremoved = array_diff($oldsubcategory_arr,array_unique($subcategory_arr));
						//$data['item_removed'] = $itemremoved;
						$itemadded = array_diff(array_unique($subcategory_arr),$oldsubcategory_arr);
						//$data['itemadded'] = $itemadded;

						if(!empty($itemremoved)) {
							foreach ($itemremoved as $value) {
								if(!trim(empty($value))) {
									$sql = "delete from sub_category where sub_category_name='".trim($value)."' and category_id='".$_GET['id']."'";
									$con -> query($sql);
								}
							}
						}

						if(!empty($itemadded)) {
							foreach ($itemadded as $value) {
								if(!trim(empty($value))) {
									$sql = "insert into sub_category(category_id,sub_category_name) values('".$_GET['id']."','".trim($value)."');";		
									$con -> query($sql);
								}
							}
						}

                    } else {}
				}
			} else {}		
		// }
	}
?>