<?php
include "connection.php";

		$res = [];
		$data = [];
		$product = !empty($_POST['product']) ? $_POST['product'] : $_POST['product'] = [0];
		$sub_category = empty($_POST['sub_category']) ? $_POST['sub_category'] = [0] : $_POST['sub_category'];
		$product_count = count($product);
		$sub_category_count = count($sub_category);
		$total_size = count($product) + count($sub_category);

		//search by product_id
		foreach ($product as $value) {
			$sql3 = 'SELECT p.pr_id,p.pr_name,p.pr_description,p.pr_price,GROUP_CONCAT(DISTINCT(pc.c_name)) as pr_category_name,GROUP_CONCAT(DISTINCT(pc.sc_name)) as pr_subcategory_name,p.pr_image, p.pr_status,p.pr_quantity,p.created_at,p.updated_at FROM product AS P INNER JOIN product_category AS pc on p.pr_id = pc.p_id WHERE pc.p_id = '.$value.' GROUP BY p.pr_id;';
				

			$result3 = $con->query($sql3);
			while($product_search_data = $result3->fetch_assoc()) {
				array_push($data,$product_search_data);
			}
		}
			
		//search by sub_category_id
		foreach ($sub_category as $value) {
			$sql4 = 'SELECT p.pr_id,p.pr_name,p.pr_description,p.pr_price,GROUP_CONCAT(DISTINCT(pc.c_name)) as pr_category_name,GROUP_CONCAT(DISTINCT(pc.sc_name)) as pr_subcategory_name,p.pr_image, p.pr_status,p.pr_quantity,p.created_at,p.updated_at FROM product AS P INNER JOIN product_category AS pc on p.pr_id = pc.p_id WHERE pc.p_id IN(SELECT p.pr_id FROM product AS p INNER JOIN product_category AS pc on p.pr_id = pc.p_id where pc.sc_id = '.$value.') GROUP BY p.pr_id;';
	
			$result4 = $con->query($sql4);
			
			while($category_search_data = $result4->fetch_assoc()) {
				array_push($data,$category_search_data);
			}
		}

		echo json_encode($data);
?>