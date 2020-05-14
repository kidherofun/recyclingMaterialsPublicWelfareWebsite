<?php
	session_start();
	if(!$_SESSION['admin'] || $_SESSION['admin'] == false){
		echo "请先进行登录验证！";
		exit;
	}
	$title = "上架教材";
	require "./template/header.php";
?>
	<form method="post" action="admin_add_result.php" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<th>ISBN</th>
				<td><input type="text" name="book_isbn" required></td>
			</tr>
			<tr>
				<th>教材名称</th>
				<td><input type="text" name="book_title" required></td>
			</tr>
			<tr>
				<th>版本</th>
				<td><input type="text" name="book_version" required></td>
			</tr>
			<tr>
				<th>作者</th>
				<td><input type="text" name="book_author" required></td>
			</tr>
			<tr>
				<th>出版社</th>
				<td><input type="text" name="book_publisher" required></td>
			</tr>
			<tr>
				<th>教材封面</th>
				<td><input type="file" name="book_image" required></td>
			</tr>
			<tr>
				<th>上架数量</th>
				<td><input type="text" name="book_quantity" required></td>
			</tr>
		</table>
		<p class="text-danger">注：教材封面文件名需与ISBN一致，且仅接受JPG/PNG/JPEG文件。</p>
		<input type="submit" value="上架教材" class="btn btn-primary">
		<input type="reset" value="重新填写" class="btn btn-default">
	</form>
	<br/>
<?php
	require_once "./template/footer.php";
?>