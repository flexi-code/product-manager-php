<?php
	include "header.php";
	include "connection.php";
?>
<div class="container-fluid">
  <table class="table table-striped table-hover">
    <thead class="table-dark">
      <tr>
        <th class="text-center">Product name</th>
			<th class="text-center">Product description</th>
			<th class="text-center">Price</th>
			<th class="text-center">Category</th>
			<th class="text-center">Product Image</th>
			<th class="text-center">Created at</th>
			<th class="text-center">Updated at</th>
			<th class="text-center">Status</th>
			<th class="text-center">Quantity</th>
			<th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
    	<?php
			$sql = "SELECT p.pr_id,p.pr_name,p.pr_description,p.pr_price,GROUP_CONCAT(c.category_name) as c_name,p.pr_image,p.created_at,p.updated_at,p.pr_status,p.pr_quantity FROM product p LEFT JOIN product_category cp ON cp.p_id = p.pr_id LEFT JOIN category c ON c.category_id = cp.c_id GROUP BY p.pr_id ORDER BY p.pr_id DESC;";
			$result = mysqli_query($con,$sql);
			while($row = mysqli_fetch_assoc($result)) {
				$id = ($row["pr_id"])? $row["pr_id"] : "no value";
				$name = ($row["pr_name"])? $row["pr_name"] : "no value";
				$description = ($row["pr_description"])? $row["pr_description"] : "no value";
				$price = ($row["pr_price"])? $row["pr_price"] : "no value";
				$category = ($row["c_name"])? $row["c_name"] : "no value";
				$image = ($row["pr_image"])? $row["pr_image"] : "";
				$created_at = ($row["created_at"])? $row["created_at"] : "no value";
				$updated_at = ($row["updated_at"])? $row["updated_at"] : "no value";
				$status = ($row["pr_status"])? $row["pr_status"] : "no value";
				$quantity = ($row["pr_quantity"])? $row["pr_quantity"] : "no value";

				$category = explode(",",$category);
				sort($category);
				$category = implode(",", $category);
				//echo $category;
		?>
      <tr class="table-row">
        <td class="text-center"><?php echo $name;?>	</td>
        <td class="text-center"><?php echo $description;?></td>
        <td class="text-center"><?php echo $price;?></td>
        <td class="text-center"><?php echo $category;?></td>
        <td class="text-center"><?php if($image) {?><img src="product/<?php echo $image;?>" width="120" height="70"/><?php }else{}?></td>
        <td class="text-center"><?php echo $created_at;?></td>
        <td class="text-center"><?php echo $updated_at;?></td>
        <td class="text-center"><?php echo $status;?></td>
        <td class="text-center"><?php echo $quantity;?></td>
        <td class="text-center">
        	<a href="edit.php?action=edit&error=&id=<?php echo $id;?>" class="btn btn-primary me-2">Edit</a>
        	<button type="button" class="btn bg-danger ms-2 btn-dark"  data-bs-toggle="modal" data-bs-target="#myModal<?php echo $id?>">Delete
        	</button>
        	<div class="modal" id="myModal<?php echo $id?>">
					<div class="modal-dialog modal-dialog-centered">
					  <div class="modal-content">
						      <div class="modal-header">
						        <h4 class="modal-title">Confirm delete?</h4>
						        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
						      </div>
						      <div class="modal-body">
						      	Do you really want to delete record for "<?php echo $name?>" ?
						      </div>
					      <div class="modal-footer">
					      	<a href="test.php?action=delete&id=<?php echo $id;?>" class="btn btn-danger">Delete</a>
					        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
					      </div>

					    </div>
					  </div>
					</div>
        </td>
      </tr>
  	<?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>