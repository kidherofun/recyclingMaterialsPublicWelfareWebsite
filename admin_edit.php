<?php
	session_start();
	if(!$_SESSION['admin'] || $_SESSION['admin'] == false){
		echo "请先进行登录验证！";
		exit;
	}
	require_once "./functions/admin_function.php";
	$title = "编辑教材信息";
	require_once "./template/header.php";
	$db = db_connect();

	if(isset($_GET['bookisbn'])){
		$book_isbn = $_GET['bookisbn'];
	} else {
		echo "请求错误!";
		exit;
	}

	$result = getBookByBook_isbn($db, $book_isbn);
	$row = mysqli_fetch_assoc($result);
?>
	<form method="post" action="admin_edit_result.php?bookisbn=<?php echo $book_isbn; ?>" enctype="multipart/form-data">
	<div class="row">
        <div class="col-md-3 text-center">
          <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $row['book_image']; ?>">
		</div>
		<div class="col-md-6">
			<h4>详细情况</h4>
			<table class="table">
				<tr>
					<th>ISBN</th>
					<td><?php echo $row['book_isbn'] ?></td>
				</tr>
				<tr>
					<th>教材名称</th>
					<td><?php echo $row['book_title'] ?></td>
				</tr>
				<tr>
					<th>版本</th>
					<td><?php echo $row['book_version'] ?></td>
				</tr>
				<tr>
					<th>作者</th>
					<td><?php echo $row['book_author'] ?></td>
				</tr>
				<tr>
					<th>出版社</th>
					<td><?php echo $row['book_publisher'] ?></td>
				</tr>
				<tr>
					<th>上架数量</th>
					<td><input type="text" name="book_quantity" value="<?php echo $row['book_quantity'] ?>" required></td>
				</tr>
			</table>
			<input type="submit" value="确定修改" class="btn btn-primary">
		</div>
	</div>
	</form>
	<br/>
<?php
	if(isset($db)) {mysqli_close($db);}
	require "./template/footer.php"
?>