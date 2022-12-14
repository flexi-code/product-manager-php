<?php
	include "header.php";
	include "connection.php";

	$error_array = array();
	$error_string = $_GET['error'];
	$error_array = explode(",",$error_string);

	foreach ($error_array as $code) {
		switch($code) {
			case '1': $nameErr = "Name is required"; break;
			case '2': $nameErr = "Only alphabets and white space are allowed"; break;
			case '3': $priceErr = "Price cannot be empty"; break;
			case '4': $priceErr = "Price cannot contain letters or symbols"; break;
			case '5': $categoryErr = "Category is not selected"; break;
			case '6': $imageErr = "Image is not selected"; break;
			case '7': $statusErr = "Status is not selected"; break;
			case '8': $quantityErr = "Quantity cannot be empty"; break;
			case '9': $quantityErr = "Quantity can only contain letter or symbols"; break;
			case '10': $descErr = "Description is empty"; break;
			default: break;
		}		
	}
?>
<form method="POST" class=" container container-md input-form" enctype="multipart/form-data" id="form" action="test.php?action=edit&id=<?php echo $_GET['id'];?>">
	<h1 class="display-4 text-center row mw-100 d-flex justify-content-center">Data Update Form</h1>
	<div class="container mw-100">
		<div class="column px-5">
			<input type="hidden" name="oldimgname" value="">
			<span class="form-input-group my-3 inp-grp d-flex w-100">
				<label for="name">Name</label>
				<input type="text" name="name" id="name" class="form-control w-100" value="" autocomplete="off">
				<span class="fw-bolder text-danger"> <?php echo isset($nameErr) ? $nameErr : "";?></span>
			</span>

			<span class="form-input-group my-3 inp-grp">
				<label for="desc">Description</label>
				<textarea name="desc" id="desc" rows="4" class="form-control mh-15 mw-25" autocomplete="off" style="resize:none;"></textarea>		
				<span class="fw-bolder text-danger"> <?php echo isset($descErr) ? $descErr : "";?></span>
			</span>

			<span class="form-input-group my-3 inp-grp">
				<label for="price">Price</label>
				<input type="text" name="price" id="price" class="form-control" value="" autocomplete="off">
				<span class="fw-bolder text-danger fade show"></span>
				<span class="fw-bolder text-danger"> <?php echo isset($priceErr) ? $priceErr : "";?></span>
			</span>

			<span class="form-input-group my-3">
				<label>Category</label><br>
				<?php
					$sql2 = "select * from category;";
					$result = mysqli_query($con,$sql2);
					while($row = mysqli_fetch_array($result)) {?>
					<input type="checkbox" class="form-check-input" name="category[]" id="<?php echo $row[0];?>" value=<?php echo $row[1];?>>
					<label class="form-check-label" for="<?php echo $row[0];?>"><?php echo $row[1];?></label></input><br>
				<?php } ?>
				<span class="fw-bolder text-danger"> <?php echo isset($categoryErr) ? $categoryErr : "";?></span>
		</div>

		<div class="column px-5">
			<span class="form-input-group my-3 inp-grp">
				<label for="file">Image</label>
				<input type="file" class="form-control" name="image" id="file" autocomplete="off">	
			</span>
				<span class="fw-bolder text-danger"> <?php echo isset($imageErr) ? $imageErr : "";?></span>
			<br>
			<span class="form-input-group my-3">
				<label>Status</label>
				<span class="form-inline">
					<span class="form-input-group">
						<input type="radio" name="status" value="draft" id="draft" class="form-radio">
						<label for="draft">Draft</label>
					</span>
					<span class="form-input-group">
						<input type="radio" name="status" value="publish" id="publish" class="form-radio">
						<label for="publish">Publish</label>
					</span>
				</span>
			</span><br>
			<span class="fw-bolder text-danger"><?php echo isset($statusErr) ? $statusErr : "";?></span>
			<br>

			<span class="form-input-group my-3 inp-grp">
				<label for="quantity">Quantity</label>	
				<input type="text" class="form-control" name="quantity" id="quantity" value="" autocomplete="off">
				<span class="fw-bolder text-danger"><?php echo isset($quantityErr) ? $quantityErr : "";?></span>
			</span>
		</div>

	</div>
	<div class="display-4 text-center mw-100">
		<input type="submit" value="submit" name="submit" class="form-control btn btn-primary mw-20">
	</div>
</form>
</body>
</html>