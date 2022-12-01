<div class="px-3 bg-light">
<?php
	include "header.php";
?>
</div>
<?php
	include "connection.php";
?>
<script type="text/javascript">
	$(document).ready(function(){
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
				$("#cat")[0].insertAdjacentHTML('beforeend', html);
			});
		});

		$.ajax({
			type: 'get',
			url: 'display_category.php?action=view_product',
		}).done(function(response){
			var temp = JSON.parse(response);
			temp.forEach(product => {
				// console.log(product);
				let duplicate_category = product.pr_category.split(",");
				let unique_category = new Set(duplicate_category);

				let duplicate_subcategory = product.pr_subcategory.split(",");
				let unique_subcategory = new Set(duplicate_subcategory);
			});
			temp.forEach(item => {
				var html = `<option value=${item.pr_id}>${item.pr_name}</option>`;
				$('#product')[0].insertAdjacentHTML('beforeend',html);
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
			<span class="container  my-2" style="min-width: fit-content; max-width: 80vw; min-height: 78vh;">
				<p class="fw-bold my-2">#product1</p>	
				<span class="d-flex flex-column">
					<h6 class="fw-bold">Category:  </h6>
					<div class="d-flex flex-row">
					<p class="d-flex justify-content-center col-3 bg-primary fw-bolder br-3 mx-3 px-3 text-white rounded">#Category1</p>
					<p class="d-flex justify-content-center col-3 bg-primary fw-bolder br-3 mx-3 px-3 text-white rounded">#Category1</p>
					<p class="d-flex justify-content-center col-3 bg-primary fw-bolder br-3 mx-3 px-3 text-white rounded">#Category1</p>
					</div>
					<div class="d-flex flex-row">

					</div>
				</span>
				<span class="d-flex flex-column">
					<h6 class="fw-bold">Sub-Category:  </h6>
					<div class="d-flex flex-row">
						<p class="d-flex justify-content-center col-3 bg-primary fw-bolder br-3 mx-3 px-3 text-white rounded">#Category1</p>
						<p class="d-flex justify-content-center col-3 bg-primary fw-bolder br-3 mx-3 px-3 text-white rounded">#Category1</p>
						<p class="d-flex justify-content-center col-3 bg-primary fw-bolder br-3 mx-3 px-3 text-white rounded">#Category1</p>
					</div>
					<div class="d-flex flex-row">
						
					</div>
				</span>
				<hr>
				<span class="container row">
					<img src="product_image.jpg" class="col-3 rounded thumbnail" style="max-height: 40vh; max-width: 40vh">
					<span class="col-9 d-flex row" style="min-width: fit-content; min-height: 100%;">
						<span class="row">
							<div class="col-6 d-flex flex-column align-items-center justify-content-center">
								<h6 class="fw-bold">Price</h6>
								<h6>500 Rs.</h6>
							</div>
							<div class="col-6 d-flex flex-column align-items-center justify-content-center">
								<h6 class="fw-bold">Quantity</h6>
								<h6>9</h6>
							</div>
						</span>
						<span class="row">
							<div class="col-6 d-flex flex-column align-items-center justify-content-center">
								<h6 class="fw-bold">Created at</h6>
								<h6>03/08/2000</h6>
							</div>
							<div class="col-6 d-flex flex-column align-items-center justify-content-center">
								<h6 class="fw-bold">Updated at</h6>
								<h6>07/08/2000</h6>
							</div>
						</span>
						<span class="row">
							<div class="col-6 d-flex flex-column align-items-center justify-content-center">
								<h6 class="fw-bold">Status</h6>
								<h6>Draft</h6>
							</div>
						</span>
					</span>
					<span class="col container">
						<h6>Description</h6>
						<span class="container px-3">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ullamcorper ligula nec arcu dapibus, non maximus nisi porttitor. Vivamus ornare hendrerit leo vel commodo. Aliquam erat volutpat. Nulla et cursus ipsum. Mauris eleifend metus sed lorem viverra aliquam. Nam eget elementum velit, a sollicitudin mi. Vivamus ac lorem molestie, mollis massa in, rhoncus ipsum. pellentesque placerat est quis suscipit venenatis. Sed tempor, odio sed egestas suscipit, leo est tristique dolor, a volutpat felis lectus id magna. Aliquam erat volutpat.</p>

							<p>Cras cursus, neque id dignissim viverra, libero erat vehicula risus, quis eleifend mi risus ac nisl. praesent sagittis iaculis metus. Donec vel pretium nibh. Cras sit amet auctor leo, eget vulputate nisi. Cras lobortis iaculis erat at tristique. Integer felis erat, vehicula quis nulla vel, aliquam vulputate lorem. Curabitur commodo id nisl vitae dictum. In pellentesque pharetra velit id mollis. Nam dignissim vestibulum blandit. Etiam vehicula dictum sem in vehicula. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas tincidunt facilisis fermentum. Nunc tempor sagittis nibh eget aliquam. Ut a suscipit metus, imperdiet condimentum nisi. Mauris pellentesque congue sem, vitae mattis lectus consequat et. praesent sed molestie felis, non accumsan purus.</p>

							<p>Duis a est accumsan, ullamcorper lacus sit amet, vulputate purus. Duis luctus augue vel pharetra dignissim. Nullam consectetur tellus metus, id ultrices nisl feugiat sit amet. Etiam tempor bibendum tellus, vitae volutpat purus fermentum ut. Nullam congue ornare risus, in dignissim enim ultricies fermentum. In eget dui nec odio gravida fermentum id at sem. Nullam sagittis placerat ligula, non rhoncus nulla consequat vel. Maecenas bibendum, odio at dignissim tincidunt, sem nisi euismod diam, in tristique tortor odio vel eros. Fusce diam orci, blandit ac semper et, mollis at nibh. Donec convallis vitae velit eu ullamcorper.</p>

							<p>Mauris viverra arcu non blandit blandit. Quisque consequat, metus ut luctus vehicula, ex nulla feugiat ipsum, fringilla tincidunt nulla lorem nec urna. Cras arcu lacus, semper vitae mattis at, venenatis ac libero. Etiam sit amet eros vel odio ullamcorper bibendum at a tellus. Aenean lorem ligula, laoreet at eros sed, porta blandit nisi. Maecenas dictum nec libero feugiat imperdiet. Suspendisse tincidunt ligula ac risus ultricies, in ultricies tortor dignissim. Nunc et vulputate neque. pellentesque a nibh dolor. Morbi et cursus ligula. Morbi et scelerisque orci. phasellus sagittis, ex nec ultrices ultricies, lorem nisi ultrices nisl, ut malesuada mi ligula vel mauris.</p>

							<p>Aenean eu odio tristique, maximus tortor quis, sodales magna. Nunc nec condimentum est. Suspendisse potenti. Duis fermentum mollis tortor vel malesuada. pellentesque sit amet convallis nunc. Aenean sit amet pharetra lorem. Mauris aliquet velit et dolor ultricies, et elementum arcu aliquet. In in sagittis ligula. Donec fringilla, dui vel gravida hendrerit, eros neque efficitur felis, quis dignissim felis nunc vitae tortor. Quisque in erat at elit tincidunt efficitur at ut libero. proin leo ipsum, consectetur et faucibus vitae, fermentum at tellus. Nulla sem orci, vulputate lobortis nulla viverra, consectetur aliquam ex.</p>
						</span>
					</span>
				</span>
			</span>
		</div>
	</div>
</div>
</body>
</html>