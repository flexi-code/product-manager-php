<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Product manager</title>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

	<!-- Latest compiled and minified CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Latest compiled JavaScript -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet"/>

	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<style>
		/* Hide scrollbar for Chrome, Safari and Opera */
		*::-webkit-scrollbar {
		  display: none;
		}

		/* Hide scrollbar for IE, Edge and Firefox */
		.example {
		  -ms-overflow-style: none;  /* IE and Edge */
		  scrollbar-width: none;  /* Firefox */
		}

		.select2 .select2-search__field {
			font-family: Arial, FontAwesome !important;
		}

		#product_catalog {
			max-height: 92.9vh;
			overflow-y: scroll;
		}
	</style>

</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">Product Manager</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
			aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav">
				<a class="nav-item nav-link active" href="index.php">Home</span></a>
				<a class="nav-item nav-link active" href="insert.php?action=insert">Insert</a>
				<a class="nav-item nav-link active" href="category.php">View categories</a>
				<a class="nav-item nav-link active" data-bs-toggle="modal" data-bs-target="#myModal">Add category</a>
			</div>
			<div class="modal fade" id="myModal">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">

						<div class="modal-header">
							<h4 class="modal-title">Add Category</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
						</div>

						<div class="modal-body">
							<form method="post" id="add_cat" action="add_category.php?action=insert">
								<div class="container mw-100">
									<div class="column px-5">
										<span class="row form-input-group-vertical my-3 d-flex w-100">
											<label for="category" class="h4">Category name</label>
											<input type="text" name="category" id="category" class="form-control w-100"
												value="<?php echo isset($category) ? $category : "";?>"
												autocomplete="off">
											<span id="categoryErr" class="fw-bolder text-danger">
											</span>

											<label for="subcategory" class="h4">Sub category name</label>
											<span class="text-secondary">
												Use ( , ) to saperate categories
											</span>
											<textarea name="subcategory" class="form-control w-100" id="subcategory"
												autocomplete="off" style="resize:none"></textarea>
										</span>
									</div>
								</div>
						</div>
						<div class="modal-footer">
							<input type="submit" class="btn btn-success" value = "Submit" id="submit">
							<button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
						</div>
						</form>
						<script>
							$(document).ready(function () {
								$("#add_cat").submit(function (event) {
									var formData = {
										category: $("#category").val(),
										subcategory: $("#subcategory").val(),
									};

									var ins={
										rec_ins: "GO TO HELL",
									};

									$.ajax({
										type: "POST",
										url: "add_category.php?action=insert",
										data: formData,
										dataType: "json",
										encode: true,
									}).done(function (data) {
										if (!data.success) {
											if (data.errors.category_err) {
												$("#categoryErr").append(
													'<div class="text-danger help-block">' + data.errors
													.category_err + "</div>"
												);
											}
										} else {
											setTimeout(() => {		
												$(".btn-close").click();	
											}, 200);
											$.ajax({
												type: "POST",
												url: "category.php",
												data: ins,
												dataType: "json",
												encode: true,
											}).done(function(data) {
												alert("record inserted");
											});
										}
									});
									$("#submit").click(function () {
										$("#categoryErr").empty();
									});
									event.preventDefault();
									$("#category").empty();
									$("#subcategory").empty();
								});
							});
						</script>
					</div>
				</div>
			</div>

		</div>
	</nav>