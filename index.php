<div class="px-3 bg-light">
	<?php
	include "header.php";
?>
</div>
<?php
	include "connection.php";
?>
<script type="text/javascript">
	$(document).ready(function () {
		$('.js-basic-example-multiple').select2();
		$('.js-example-placeholder-multiple').select2();

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

		$.ajax({
			type: 'get',
			url: 'display_category.php?action=view_product',
		}).done(function (response) {
			var temp = JSON.parse(response);
			temp.forEach(product => {
				// console.log(product);
				var duplicate_category = product.pr_category_name.split(",");
				var unique_category = new Set(duplicate_category);
				console.log(unique_category);

				var duplicate_subcategory = product.pr_subcategory_name.split(",");
				var unique_subcategory = new Set(duplicate_subcategory);
				console.log(unique_subcategory);
				
				var html = `
<span class="container  my-2" style="min-width: fit-content; max-width: 80vw; min-height: 78vh;">
    <p class="fw-bold my-2">${product.pr_name}</p>	
    	<span class="d-flex flex-column">
		<h6 class="fw-bold">Category:  </h6>
        	<div class="d-flex flex-row"id="category${product.pr_id}">`;








				$("#product_catalog")[0].insertAdjacentHTML('beforeend',html);
			});
			temp.forEach(item => {
				var option = `<option value=${item.pr_id}>${item.pr_name}</option>`;
				$('#product')[0].insertAdjacentHTML('beforeend', option);
			});
		});
	});
</script>
<div class="container-fluid d-flex justify-content-right" style="margin:0;padding:0;box-sizing:border-box;">
	<div id="sidebar" class="bg-warning	px-3" style="min-width: 22%; min-height: 92.9vh; position: relative;">
		<h3 class=" fw-bold text-white d-flex justify-content-center">
			Dashboard
		</h3>
		<hr class="text-dark">
		<select class="select-basic-example-multiple js-example-placeholder-multiple form-control fw-bold"
			data-placeholder="&#xF291;  Search product" id="product" style="font-family:Arial, FontAwesome" multiple>
		</select>
		<br>
		<br>
		<select class="select-basic-example-multiple js-example-placeholder-multiple form-control fw-bold"
			data-placeholder="&#xF468;  Search category" id="cat" style="font-family:Arial, FontAwesome;" multiple>
		</select>
		<br>
		<br>

		<button type="button" id="search" class="btn btn-success btn-block" style="min-width: 100%;">Search</button>
	</div>
	<div class="container-fluid bg-info px-3">
		<span class=" display-5 fw-bold d-flex text-white justify-content-center">
			Welcome to product Manager
		</span>
		<hr class="text-dark">

		<div class="container bg-white d-flex flex-column" id="product_catalog">









		</div>
	</div>
</div>
</body>

</html>