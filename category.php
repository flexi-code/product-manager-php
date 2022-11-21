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

			function edit_fun(category_id, category_name, sub_category) {
				$("#category_name_edit").prop("value", category_name);
				$("#subcategory_edit").html(sub_category);
				$("#editform").submit(function (event) {
					$.ajax({
						type: "get",
						url: "edit_category.php?action=edit&id="+category_id+"&category="+category_name+"&subcategory=&"+sub_category,
						dataType: "json",
					}).done(function (data) {
						console.log(data);
						if (!data.success) {
							if (data.errors.category_err) {
								$("#catErr").append(
									"<div>" + data.errors.category_err + " ! </div>"
								);
							}
						} else {
							setTimeout(() => {
								$("#close").click();
							}, 100);
						}
					});
					$("#editform").submit(function () {
						$("#catErr").empty();
					});
					event.preventDefault();
				})
			};

			function delete_fun(category_id, category_name) {
				$("#category_id_delete").html(category_id);
				$("#category_name_delete").html(category_name);
				$("#delete-btn").on("click", function () {
					$.ajax({
						type: "get",
						url: "delete_category.php?action=delete&id=" + category_id,
						dataType: "JSON",
					}).done(function (data) {
						if (data === true) {
							//DELETED
						} else {
							//NOT DELETED
						}
					})
				});
			}

			function show() {
				$.ajax({
					type: "get",
					url: "testcategory.php?action=display",
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
									<button data-bs-toggle="modal" data-bs-target="#editmodal" class="btn btn-info text-white" onclick="edit_fun(${item.category_id},'${item.category_name}','${item.sub_cat}')">Edit</button>
									<button data-bs-toggle="modal" data-bs-target="#delmodal" class="btn btn-danger" onclick="delete_fun(${item.category_id},'${item.category_name}')">Delete</button>
								</td>
							</tr>
								`;
							$("#tbody")[0].insertAdjacentHTML('beforebegin', html);
						});
					}
				});
			}

			show();
		</script>

		<!-- delete action modal -->
		<div class="modal fade" id="delmodal">
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
						<a type="button" class="btn btn-danger" id="delete-btn">Delete</a>
						<button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<!-- edit action modal -->
		<div class="modal fade" id="editmodal">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">

					<div class="modal-header">
						<h4 class="modal-title">Edit category</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>

					<div class="modal-body">
						<form action="edit_category.php?action=edit" method="get" id="editform">
							<div class="form-floating mb-3 mt-3">
								<input type="text" class="form-control" placeholder=" " id="category_name_edit"
									name="category_name">
								<span id="catErr" class="fw-bolder text-danger"></span>
								<label for="category_name_edit">Category name</label>
								
							</div>
							<div class="form-floating mb-3 mt-3">
								<textarea type="text" class="form-control" placeholder=" " id="subcategory_edit"
									name="subcategory_name" style="resize:none; height:5em;"></textarea>
								<label for="subcategory_edit">Sub category name</label>
							</div>

					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-info text-white" id="edit-btn">Edit</button>
						<button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<tbody id="tbody">
		</tbody>
	</table>
</div>
<script>
</script>
</body>

</html>