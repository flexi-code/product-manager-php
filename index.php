<!DOCTYPE html>
<div class="px-3 bg-light">
	<?php
	include "header.php";
?>
</div>
<?php
	include "connection.php";
?>
<script type="text/javascript">
	function get_category_string(category) {
		let empty = new Array();
		let category_array = Array.from(category);
		let length = category_array.length;
		let count = 1;
		//enter new div to array
		empty.push('<div class="d-flex flex-row">');
		category_array.forEach(item => {

			// enter new category in same row  
			if(count % 4 != 0) {
				let category = `<p class="d-flex justify-content-center col-3 bg-primary fw-bolder br-3 mx-3 px-3 text-white rounded">${item}</p>`;
				empty.push(category);
			}
			//enter new category in new row
			if(count % 4 == 0) {
				empty.push('</div>');
				empty.push('<div class="d-flex flex-row">');
				let category = `<p class="d-flex justify-content-center col-3 bg-primary fw-bolder br-3 mx-3 px-3 text-white rounded">${item}</p>`;
				empty.push(category);
			}
			count += 1;
		});
		empty.push('</div>');
		return empty.join(" ");
	}

	function get_sub_category_string(sub_category) {
		let empty = new Array();
		let sub_category_array = Array.from(sub_category);
		let length = sub_category_array.length;
		let count = 1;
		//enter new div to array
		empty.push('<div class="d-flex flex-row">');
		sub_category_array.forEach(item => {

			// enter new category in same row  
			if(count % 4 != 0) {
				let sub_category = `<p class="d-flex justify-content-center col-3 bg-primary fw-bolder br-3 mx-3 px-3 text-white rounded">${item}</p>`;
				empty.push(sub_category);
			}
			//enter new category in new row
			if(count % 4 == 0) {
				empty.push('</div>');
				empty.push('<div class="d-flex flex-row">');
				let sub_category = `<p class="d-flex justify-content-center col-3 bg-primary fw-bolder br-3 mx-3 px-3 text-white rounded">${item}</p>`;
				empty.push(sub_category);
			}
			count += 1;
		});
		empty.push('</div>');
		return empty.join(" ");
	}

	$(document).ready(function () {
		$('.js-basic-example-multiple').select2();
		$('.js-example-placeholder-multiple').select2();

		//code to view category
		$.ajax({
			type: "GET",
			url: "display_category.php?action=display",
			dataType: "json",
		}).done(function (data) {
			data.reverse().forEach(item => {
				var html = `</optgroup>`;
				var category_id = item.sub_cat_id.split(",");
				var category_name = item.sub_cat.split(",");
				var limit = category_id.length;
				for (var i = limit - 1; i >= 0; i--) {
					var temp = `<option value="` + category_id[i] + `">` + category_name[i] +
						`</option>`;
					var html = temp.concat(html);
				}
				var open = `<optgroup value="${item.category_id}" label="${item.category_name}">`;
				var html = open.concat(html);
				$("#cat")[0].insertAdjacentHTML('beforeend', html);
			});
		});


		//code to view product details by default
		$.ajax({
			type: 'get',
			url: 'display_category.php?action=view_product',
		}).done(function (response) {
			var temp = JSON.parse(response);

			//let's print product data
			temp.forEach(item => {

				var category = item.pr_category_name.split(",");

				var subcategory = item.pr_subcategory_name.split(",");
				
				var html = `
	<span class="container bg-white my-2" style="min-width: fit-content; max-width: 80vw; min-height: fit-content; margin: 3rem 0rem;">
		<h3 class="fw-bold my-2">${item.pr_name}</h3>	
			<span class="d-flex flex-column">
			<h6 class="fw-bold">Category:  </h6>
				${get_category_string(category)}
			</span>
			<br>
			<span class="d-flex flex-column">
			<h6 class="fw-bold">Sub-Category:  </h6>
				${get_sub_category_string(subcategory)}
			</span>
			<hr>
			<span class="container row">
			<img src="product/${item.pr_image}" class="col-3 rounded thumbnail" style="max-height: 40vh; max-width: 40vh">
			<span class="col-9 d-flex row" style="min-width: fit-content; min-height: 100%;">
				<span class="row">
					<div class="col-6 d-flex flex-column align-items-center justify-content-center">
						<h6 class="fw-bold">Price</h6>
						<h6>${item.pr_price} Rs.</h6>
					</div>
					<div class="col-6 d-flex flex-column align-items-center justify-content-center">
						<h6 class="fw-bold">Quantity</h6>
						<h6>${item.pr_quantity}</h6>
					</div>
				</span>
				<span class="row">
					<div class="col-6 d-flex flex-column align-items-center justify-content-center">
						<h6 class="fw-bold">Created at</h6>
						<h6>${item.created_at}</h6>
					</div>
					<div class="col-6 d-flex flex-column align-items-center justify-content-center">
						<h6 class="fw-bold">Updated at</h6>
						<h6>${item.updated_at}</h6>
					</div>
				</span>
				<span class="row">
					<div class="col-6 d-flex flex-column align-items-center justify-content-center">
						<h6 class="fw-bold">Status</h6>
						<h6>${item.pr_status}</h6>
					</div>
				</span>
			</span>
			<span class="col container">
				<h6 class="my-2 font-weight-bold">Description</h6>
				<span class="container px-3">
					${item.pr_description}
				</span>
			</span>
		</span>
	</span>`;
	
				$("#product_catalog").append(html);
			});

			// code to view product name in search bar
			temp.forEach(item => {
				var option = `<option value=${item.pr_id}>${item.pr_name}</option>`;
				$('#product')[0].insertAdjacentHTML('beforeend', option);
			});
		});

		//code to search product
		$('#search_product').submit(function (event){
			event.preventDefault();
			var formdata = new FormData(this);
			
			if($('#product').val().length != 0 || $('#cat').val().length != 0) {
			$.ajax({
				type: 'post',
				url: 'search_product.php',
				data: formdata,
				dataType: 'json',
				contentType: false,
				processData: false,
			}).done(function(response) {
				console.log(JSON.stringify(response));
				$('#product_catalog').empty();
				response.forEach(item => {
  					// !!!! alert(Object.values(item)); object.values() to convert json to javascript array !!!!

				var category = item.pr_category_name.split(",");

				var subcategory = item.pr_subcategory_name.split(",");

				var html = `
				<span class="container bg-white my-2" style="min-width: fit-content; max-width: 80vw; min-height: fit-content; margin: 3rem 0rem;">
					<span class="d-flex justify-content-between">
						<h3 class="fw-bold my-2">${item.pr_name}</h3>	
					</span>
						<span class="d-flex flex-column">
						<h6 class="fw-bold">Category:  </h6>
							${get_category_string(category)}
						</span>
						<br>
						<span class="d-flex flex-column">
						<h6 class="fw-bold">Sub-Category:  </h6>
							${get_sub_category_string(subcategory)}
						</span>
						<hr>
						<span class="container row">
						<img src="product/${item.pr_image}" class="col-3 rounded thumbnail" style="max-height: 40vh; max-width: 40vh">
						<span class="col-9 d-flex row" style="min-width: fit-content; min-height: 100%;">
							<span class="row">
								<div class="col-6 d-flex flex-column align-items-center justify-content-center">
									<h6 class="fw-bold">Price</h6>
									<h6>${item.pr_price} Rs.</h6>
								</div>
								<div class="col-6 d-flex flex-column align-items-center justify-content-center">
									<h6 class="fw-bold">Quantity</h6>
									<h6>${item.pr_quantity}</h6>
								</div>
							</span>
							<span class="row">
								<div class="col-6 d-flex flex-column align-items-center justify-content-center">
									<h6 class="fw-bold">Created at</h6>
									<h6>${item.created_at}</h6>
								</div>
								<div class="col-6 d-flex flex-column align-items-center justify-content-center">
									<h6 class="fw-bold">Updated at</h6>
									<h6>${item.updated_at}</h6>
								</div>
							</span>
							<span class="row">
								<div class="col-6 d-flex flex-column align-items-center justify-content-center">
									<h6 class="fw-bold">Status</h6>
									<h6>${item.pr_status}</h6>
								</div>
							</span>
						</span>
						<span class="col container">
							<h6 class="my-2 font-weight-bold">Description</h6>
							<span class="container px-3">
								${item.pr_description}
							</span>
						</span>
					</span>
				</span>`;
		
				$("#product_catalog").append(html);
				});
			});
			} else {
				alert(" ;-) kuch to gadbad hai daya!");
			}
		});
	});
	$(".selection").css({"display":"inline-block","min-height":"5vh"});
</script>
<div class="container-fluid d-flex justify-content-right" style="position: fixed;margin:0;padding:0;box-sizing:border-box;">
	<div id="sidebar" class="bg-warning	px-3" style="min-width: 22%; min-height:92vh;max-height: auto; position: relative;">
		<h3 class=" fw-bold text-white d-flex justify-content-center">
			Dashboard
		</h3>
		<hr class="text-dark">

		<form id="search_product" method="POST" action="search_product.php">
		<select class="select-basic-example-multiple js-example-placeholder-multiple form-control fw-bold"
			data-placeholder="&#xF291;  Search product" id="product" name = "product[]" style="font-family:Arial, FontAwesome;" multiple>
		</select>
		<br>
		<br>
		<select class="select-basic-example-multiple js-example-placeholder-multiple form-control fw-bold"
			data-placeholder="&#xF468;  Search category" id="cat" name = "sub_category[]"style="font-family:Arial, FontAwesome;" multiple>
		</select>
		<br>
		<br>

		<button type="submit" id="search" class="btn btn-success btn-block" style="min-width: 100%;">Search</button>
		</form>

	</div>
	<div class="container-fluid bg-info px-3">
		<span class=" display-5 fw-bold d-flex text-white justify-content-center">
			Welcome to Product Manager
		</span>
		<hr class="text-dark">

		<div class="container d-flex flex-column" id="product_catalog" style="overflow-y:scroll;">
		</div>
	</div>
</div>
</body>

</html>