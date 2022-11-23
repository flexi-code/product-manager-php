<?php
	include "connection.php";

	if ($_GET['action'] == "display") {
		$res = [];
		$sql1 = "SELECT c.category_id,c.category_name, GROUP_CONCAT(sc.sub_category_name) AS sub_cat FROM category c LEFT JOIN sub_category sc ON c.category_id =  sc.category_id  GROUP BY c.category_id ORDER BY c.category_id desc;";
		$result = $con->query($sql1);
		while($row1 = $result->fetch_assoc()) {
			$res[] = $row1;
		}
		echo json_encode($res);
	}
?>
