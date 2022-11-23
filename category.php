<?php
	include "connection.php";
	include "header.php";
?>
<div class="container">
	<table class="table table-striped table-hover">
		<thead class="table-dark">
			<tr>
				<th class="text-center">Category ID</th>
				<th class="text-center">Category Name</th>
				<th class="text-center">Sub-Category Name</th>
				<th class="text-center">Category Action</th>
			</tr>
		</thead>
		<script>
			var category_id, category_name, sub_category;

			function show() {
				$.ajax({
					type: "get",
					url: "display_category.php?action=display",
					dataType: "json",
				}).done(function (data) {
					if (data) {
						data.forEach(item => {
							html = `
							<tr>
								<td class="text-center">${item.category_id}</td>
								<td class="text-center">${item.category_name}</td>
								<td class="text-center">${item.sub_cat}</td>
								<td class="d-flex justify-content-around">
									<button data-bs-toggle="modal" data-bs-target="#editmodal${item.category_id}" class="btn btn-info text-white" onclick="edit_fun(${item.category_id},'${item.category_name}','${item.sub_cat}')">Edit</button>
		<div class="modal fade" id="editmodal${item.category_id}">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">

					<div class="modal-header">
						<h4 class="modal-title">Edit category</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>

					<div class="modal-body">
							<div class="form-floating mb-3 mt-3">
								<input type="text" class="form-control" placeholder=" " id="category_name_edit${item.category_id}"
									autocomplete="off" name="category_name">
								<span id="catErr" class="fw-bolder text-danger"></span>
								<label for="category_name_edit">Category name</label>

							</div>
							<div class="form-floating mb-3 mt-3">
								<textarea type="text" class="form-control" placeholder=" " id="subcategory_edit${item.category_id}"
									name="subcategory_name" style="resize:none; height:5em;"
									autocomplete="off"></textarea>
								<span id="subcatErr" class="fw-bolder text-warning">Note: Duplicate subcategory will not be entered in database.</span>
								<label for="subcategory_edit">Sub category name</label>
							</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-info text-white" id="edit-btn${item.category_id}">Edit</button>
						<button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
									<button data-bs-toggle="modal" data-bs-target="#delmodal${item.category_id}" class="btn btn-danger" onclick="delete_fun(${item.category_id},'${item.category_name}')">Delete</button>
		<div class="modal fade" id="delmodal${item.category_id}">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">

					<div class="modal-header">
						<h4 class="modal-title">Modal Heading</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>

					<div class="modal-body">
						Do you really want to delete <b id="category_name_delete"></b> having id <b
							id="category_id_delete"></b> and its all subcategories ?<br>
						<strong class="text-danger">Warning ! This action cannot be undone</strong>
					</div>

					<div class="modal-footer">
						<a type="button" class="btn btn-danger" id="delete-btn${item.category_id}">Delete</a>
						<button type="button" class="btn btn-dark" data-bs-dismiss="modal" id="close">Close</button>
					</div>
				</div>
			</div>
		</div>
								</td>
							</tr>
								`;
							var tbody = $("tbody").length;
							$("tbody")[tbody-1].insertAdjacentHTML('afterbegin', html);
						});
					}
				});
			}

			var count = 0;

			function edit_fun(category_id, category_name, sub_category) {
				$("#category_name_edit"+category_id).prop("value", category_name);
				$("#subcategory_edit"+category_id).html(sub_category);
				count = 0;
				if(count == 0) {
				$("#edit-btn"+category_id).click(function (event) {
					var new_category_name = $('#category_name_edit'+category_id).prop("value");
					var new_sub_category = $('#subcategory_edit'+category_id).val();
					$.ajax({
						type: "get",
						url: "edit_category.php?action=edit&id="+category_id+"&category="+new_category_name + "&subcategory="+new_sub_category,
						dataType: "json",
					}).done(function (data) {
						if (!data.success) {
							if (data.errors.category_err) {
								$("#catErr").append(
									"<div>" + data.errors.category_err + " ! </div>"
								);
							}
							if (data.errors.sub_category_err) {
								$("#subcatErr").append(
									"<div>" + data.errors.sub_category_err + " ! </div>"
								);
							}
						} 
						if(data.success && count == 0) {
							setTimeout(() => {
								$(".btn-close").click();
							}, 300);
							setTimeout(() => {
								hide();
							}, 400);
							setTimeout(() => {
								show();
							}, 500);
							// $("#category_name_edit").prop("value", category_name);
							// $("#subcategory_edit").html(sub_category);
							count = 1;
						}
					});
					event.preventDefault();
				});
				}
				$("#edit-btn"+category_id).click(function () {
						$("#catErr").empty();
						// $("#subcatErr").empty();
				});
			};

			function delete_fun(category_id, category_name) {
				$("#category_id_delete").html(category_id);
				$("#category_name_delete").html(category_name);
				$("#delete-btn"+category_id).on("click", function () {
					$.ajax({
						type: "get",
						url: "delete_category.php?action=delete&id="+category_id,
						dataType: "JSON",
					}).done(function (data) {
						if (data === true) {
							setTimeout(() => {
								$(".btn-close").click();
							}, 350);
							alert("delete wala hide");
							setTimeout(() => {
								hide();
							}, 450);
							alert("delete wala show");
							setTimeout(() => {
								show();
							}, 550)
						} else {
							//NOT DELETED
						}
					})
				});
			}

			function hide() {
				$('tbody').empty();
			}
				show();
			setInterval(() => {
			<?php
				$rec_ins = isset($_POST['rec_ins']) ? trim($_POST['rec_ins']) : null;
				if(isset($rec_ins)) {
					echo 'refresh();';
					echo 'alert("'.$rec_ins.'");';
				}
			?>
			}, 500);
			
			function refresh() {
				setTimeout(() => {
					hide();
				}, 450);
				setTimeout(() => {
					show();
				}, 550)
			}
		</script>
		<tbody></tbody>
	</table>
</div>
<script>
</script>

</body>

</html>