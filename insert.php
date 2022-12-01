<?php
	include "header.php";
	include "connection.php";
?>
<script>
	$(document).ready(function() {
		$('.js-basic-example-multiple').select2();
		$('.js-example-placeholder-multiple').select2();

		$.ajax({
			type: "GET",
			url: "display_category.php?action=display",
			dataType: "json",
		}).done(function(data){
			data.reverse().forEach(item => {
				var html = `</optgroup>`;
				var category_id = item.sub_cat_id.split(",");
				var category_name = item.sub_cat.split(",");
				var limit = category_id.length;
				for(var i=limit-1;i>=0;i--) {
					var temp = `<option value="`+category_id[i]+`">`+category_name[i]+`</option>`;
					var html = temp.concat(html);
				}
				var open = `<optgroup value="${item.category_id}" label="${item.category_name}">`;
				var html = open.concat(html);
				$("#Category")[0].insertAdjacentHTML('beforeend', html);
			});
		});

		$("#product_insert").submit(function(event) {
			event.preventDefault();
			var formdata = new FormData(this);

			$.ajax({
				type: "POST",
				url: "add_product.php?action=insert",
				data: formdata,
				processData: false,
				contentType: false,
			}).done(function (response) {
				//code for validation purpose
				var temp = JSON.parse(response);	
				console.log(temp);
				console.log(temp.op_status);
				if(temp.errors) {
				temp.errors.forEach(error_code => {
					switch (error_code) {
						case 1:
							$("#nameErr").html("Name is required !");
							break;
						case 2:
							$("#nameErr").html("Only alphabets and white space are allowed !");
						break;

						case 3:
							$("#priceErr").html("Price cannot be empty !");
						break;

						case 4:
							$("#priceErr").html("Price cannot contain letter or symbols !");
						break;

						case 5:
							$('#catErr').html("Category is not selected !");
						break;

						case 6:
							$("#imageErr").html("Image is not selected !");
						break;

						case 7:
							$("#statusErr").html("Status is not selected !");
						break;

						case 8:
							$("#quantityErr").html("Quantity cannot be empty !");
						break;

						case 9:
							$("#quantityErr").html("Quantity can only contain letter or symbols !");
						break;

						case 10:
							$("#descErr").html("Description is empty !");
						break;

						default:
							break;
					}
				});
				}
				if(temp.op_status == "success") {
					alert("Product inserted");
				}
				$("#product_insert").submit(function() {
					$("#nameErr").empty();
					$("#priceErr").empty();
					$("#catErr").empty();
					$("#imageErr").empty();
					$("#statusErr").empty();
					$("#quantityErr").empty();
					$("#descErr").empty();
				});
			});
		});
	});
</script>
<form method="POST" class="container container-md input-form" enctype="multipart/form-data" id="product_insert" action="add_product.php?action=insert">
	<h1 class="display-4 text-center row mw-100 d-flex justify-content-center">Data Entry Form</h1>
	<div class="container mw-100">
		<div class="column px-5">

			<span class="form-input-group my-3 inp-grp">
				<label for="name">Name</label>
				<input type="text" name="name" id="name" class="form-control w-100" value="<?php echo isset($name) ? $name : "";?>" autocomplete="off">
				<span class="fw-bolder text-danger" id="nameErr"></span>
			</span>
			<br><br>

			<span class="form-input-group my-3 inp-grp">
				<label for="desc">Description</label>
				<textarea name="description" id="desc" rows="4" class="form-control mh-15 mw-25" autocomplete="off" style="resize:none;"><?php echo isset($desc) ? $desc : "";?></textarea>		
				<span class="fw-bolder text-danger" id="descErr"></span>
			</span>
			<br><br>

			<span class="form-input-group my-3 inp-grp">
				<label for="price">Price</label>
				<input type="text" name="price" id="price" class="form-control" value="<?php echo isset($price) ? $price : "";?>" autocomplete="off">
				<span class="fw-bolder text-danger fade show"></span>
				<span class="fw-bolder text-danger" id="priceErr"></span>
			</span>
			<br><br>
			<span>Select Category</span>
			<select class="select-basic-example-multiple js-example-placeholder-multiple form-control fw-bold" 
			data-placeholder="&#xF468;  Search category" id="Category" name="category[]" style="font-family:Arial, FontAwesome;" multiple>
			</select>
			<span class="fw-bolder text-danger" id="catErr"></span>
			</span>
			<br>
		</div>
		<br><br>

		<div class="column px-5">
			<span class="form-input-group my-3 inp-grp">
				<label for="file">Image</label>
				<input type="file" class="form-control" name="image" id="file" autocomplete="off">	
			</span>
				<span class="fw-bolder text-danger" id="imageErr"></span>
			<br><br>
			<span class="form-input-group my-3">
				<label>Status</label>
				<span class="form-inline">
					<span class="form-input-group">
						<input type="radio" name="status" value="draft" id="draft" class="form-check-input">
						<label for="draft" class="form-check-label">Draft</label>
					</span>
					<span class="form-input-group">
						<input type="radio" name="status" value="publish" id="publish" class="form-check-input">
						<label for="publish" class="form-check-label">Publish</label>
					</span>
				</span>
			</span><br>
			<span class="fw-bolder text-danger" id="statusErr"></span>
			<br><br>

			<span class="form-input-group my-3 inp-grp">
				<label for="quantity">Quantity</label>	
				<input type="text" class="form-control" name="quantity" id="quantity" value="<?php echo isset($quantity) ? $quantity : "";?>" autocomplete="off">
				<span class="fw-bolder text-danger" id="quantityErr"></span>
			</span>
		</div>

	</div>
	<div class="display-4 text-center mw-100">
		<input type="submit" value="submit" name="submit" class="form-control btn btn-primary mw-20" id="submit">
	</div>
</form>
</body>
</html>