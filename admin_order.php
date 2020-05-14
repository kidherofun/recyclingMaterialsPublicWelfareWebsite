<?php
	session_start();
	if(!$_SESSION['admin'] || $_SESSION['admin'] == false){
		echo "请先进行登录验证！";
		exit;
	}
	require_once "./functions/admin_function.php";
	$title = "订单信息";
	require_once "./template/header.php";
	$db = db_connect();
	$result = getAllOrders($db);
?>
	<p class="lead" style="text-align: right">
		<a href="admin_book.php" class="btn btn-primary">教材信息</a>
		<a href="admin_signout.php" class="btn btn-primary">退出管理员系统</a>
	</p>
	<table class="table" style="margin-top: 20px">
		<tr>
			<th>订单ID</th>
			<th>学号</th>
			<th>联系电话</th>
			<th>宿舍地址</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($result)){ ?>
		<tr>
			<td><?php echo $row['order_id']; ?></td>
			<td><?php echo $row['student_id']; ?></td>
			<td><?php echo $row['student_phone']; ?></td>
			<td><?php echo $row['student_address']; ?></td>
			<td><a href="admin_order_items.php?orderid=<?php echo $row['order_id']; ?>">详细信息</a></td>
			<td><a href="admin_order_delete.php?orderid=<?php echo $row['order_id']; ?>">删除订单</a></td>
		</tr>
		<?php } ?>
	</table>

<?php
	if(isset($db)) {mysqli_close($db);}
	require_once "./template/footer.php";
?>