<?php
	session_start();
	if(!$_SESSION['admin'] || $_SESSION['admin'] == false){
		echo "请先进行登录验证！";
		exit;
	}
	require_once "./functions/admin_function.php";
	$title = "教材信息";
	require_once "./template/header.php";
	$db = db_connect();
	$result = getAllBooks($db);
?>
	<p class="lead" style="text-align: right">
		<a href="admin_order.php" class="btn btn-primary">订单信息</a>
		<a href="admin_add.php" class="btn btn-primary">上架教材</a>
		<a href="admin_signout.php" class="btn btn-primary">退出管理员系统</a>
	</p>
	<table class="table" style="margin-top: 20px">
		<tr>
			<th>ISBN</th>
			<th>教材名称</th>
			<th>版本</th>
			<th>作者</th>
			<th>出版社</th>
			<th>教材封面URL</th>
			<th>数量</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($result)){ ?>
		<tr>
			<td><?php echo $row['book_isbn']; ?></td>
			<td><?php echo $row['book_title']; ?></td>
			<td><?php echo $row['book_version']; ?></td>
			<td><?php echo $row['book_author']; ?></td>
			<td><?php echo $row['book_publisher']; ?></td>
			<td>./bootstrap/img/<?php echo $row['book_image']; ?></td>
			<td style="text-align: right"><?php echo $row['book_quantity']; ?></td>
			<td><a href="admin_edit.php?bookisbn=<?php echo $row['book_isbn']; ?>">编辑数量</a></td>
			<td><a href="admin_delete.php?bookisbn=<?php echo $row['book_isbn']; ?>">删除</a></td>
		</tr>
		<?php } ?>
	</table>

<?php
	if(isset($db)) {mysqli_close($db);}
	require_once "./template/footer.php";
?>