<?php
	session_start();
	$_SESSION['err'] = 1;
	foreach($_POST as $key => $value){
		if(trim($value) == ''){
			$_SESSION['err'] = 0;
			break;
		}
	}

	if($_SESSION['err'] == 0){
		header("Location: checkout.php");
	} else {
		unset($_SESSION['err']);
	}


	$_SESSION['ship'] = array();
	foreach($_POST as $key => $value){
		if($key != "submit"){
			$_SESSION['ship'][$key] = $value;
		}
	}
	require_once "./functions/client_function.php";
	$title = "确认订单信息";
	require "./template/header.php";
?>
<form method="post" action="process.php">
	<p class="lead">个人信息</p>
	<table class="table">
		<tr>
			<th>学号</th>
			<th>姓名</th>
	    	<th>联系电话</th>
			<th>邮箱地址</th>
			<th>宿舍地址</th>
	    </tr>
		<tr>
			<td><?php echo $_SESSION['ship']["student_id"]; ?></td>
			<td><?php echo $_SESSION['ship']["student_name"]; ?></td>
			<td><?php echo $_SESSION['ship']["student_phone"]; ?></td>
			<td><?php echo $_SESSION['ship']["student_email"]; ?></td>
			<td><?php echo $_SESSION['ship']["student_address"]; ?></td>
		</tr>
	</table>
	<p class="lead">教材信息</p>
	<table class="table">
		<tr>
			<th>教材名称</th>
			<th>版本</th>
	    	<th>作者</th>
			<th>出版社</th>
			<th>借阅数量</th>
	    </tr>
	    <?php
		    foreach($_SESSION['cart'] as $isbn => $qty){
				$db = db_connect();
				$book = mysqli_fetch_assoc(getBookByBook_isbn($db, $isbn));
		?>
		<tr>
			<td><?php echo $book['book_title']; ?></td>
			<td><?php echo $book['book_version']; ?></td>
			<td><?php echo $book['book_author']; ?></td>
			<td><?php echo $book['book_publisher']; ?></td>
			<td><?php echo $_SESSION['cart']["$isbn"]; ?></td>
		</tr>
		<?php } ?>
	</table>
	<center>
		<input type="submit" name="submit" value="确认订单信息" class="btn btn-primary">
	</center>
</form>
<?php
	if(isset($db)){ mysqli_close($db); }
	require_once "./template/footer.php";
?>