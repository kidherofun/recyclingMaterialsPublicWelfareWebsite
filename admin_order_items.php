<?php
	session_start();
	if(!$_SESSION['admin'] || $_SESSION['admin'] == false){
		echo "请先进行登录验证！";
		exit;
	}
	
	require_once "./functions/admin_function.php";
	$title = "订单详细信息";
	require_once "./template/header.php";
	$db = db_connect();

	if(isset($_GET['orderid'])){
		$order_id = $_GET['orderid'];
	} else {
		echo "请求错误！";
		exit;
	}

	$result0 = getStudentByOrder_id($db, $order_id);
	$student = mysqli_fetch_assoc($result0);

	$result1 = getBookByOrder_id($db, $order_id);
?>
	<p class="lead">个人信息</p>
	<table class="table">
		<tr>
			<th>订单号</th>
			<th>学号</th>
			<th>姓名</th>
	    	<th>联系电话</th>
			<th>邮箱地址</th>
			<th>宿舍地址</th>
	    </tr>
		<tr>
			<td><?php echo $student['order_id']; ?></td>
			<td><?php echo $student['student_id']; ?></td>
			<td><?php echo $student['student_name']; ?></td>
			<td><?php echo $student['student_phone']; ?></td>
			<td><?php echo $student['student_email']; ?></td>
			<td><?php echo $student['student_address']; ?></td>
		</tr>
	</table>
	<p class="lead">教材信息</p>
	<table class="table">
		<tr>
			<th>ISBN</th>
			<th>教材名称</th>
			<th>版本</th>
	    	<th>作者</th>
			<th>出版社</th>
			<th>借阅数量</th>
	    </tr>
	    <?php
		    for($i = 0;$i < mysqli_num_rows($result1);$i++){
				$book = mysqli_fetch_assoc($result1);
		?>
		<tr>
			<td><?php echo $book['book_isbn']; ?></td>
			<td><?php echo $book['book_title']; ?></td>
			<td><?php echo $book['book_version']; ?></td>
			<td><?php echo $book['book_author']; ?></td>
			<td><?php echo $book['book_publisher']; ?></td>
			<td><?php echo $book['order_quantity']; ?></td>
		</tr>
		<?php } ?>
	</table>
	<a href="javascript:window.print();" class="btn btn-primary">打印订单信息</a>
	<a href="admin_order.php" class="btn btn-default">返回管理员首页</a>
<?php
	if(isset($db)) {mysqli_close($db);}
	require "./template/footer.php"
?>