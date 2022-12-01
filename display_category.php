<?php
	include "connection.php";

	if ($_GET['action'] == "display") {
		$res = [];
		$sql1 = "SELECT c.category_id,c.category_name,GROUP_CONCAT(sc.sub_category_id) AS sub_cat_id, GROUP_CONCAT(sc.sub_category_name) AS sub_cat FROM category c LEFT JOIN sub_category sc ON c.category_id =  sc.category_id  GROUP BY c.category_id ORDER BY c.category_id desc;";
		$result1 = $con->query($sql1);
		while($row1 = $result1->fetch_assoc()) {
			$res[] = $row1;
		}
		echo json_encode($res);
	}

	if($_GET['action'] == "view_product") {
		$ret = [];
		$sql2 = "SELECT p.pr_id,p.pr_name,p.pr_description,p.pr_price,GROUP_CONCAT(pc.c_id) as pr_category,GROUP_CONCAT(pc.c_name) as pr_category_name,GROUP_CONCAT(pc.sc_id) as pr_subcategory,GROUP_CONCAT(pc.sc_name) as pr_subcategory_name,p.pr_image, p.pr_status,p.pr_quantity FROM product AS P INNER JOIN product_category AS pc on p.pr_id = pc.p_id GROUP BY p.pr_id;";
		$result2 = $con->query($sql2);
		while($row2 = $result2->fetch_assoc()) {
			$ret[] = $row2;
		}
		echo json_encode($ret);
	}
?>
