<?php
	session_start();
	if(!$_SESSION['admin'] || $_SESSION['admin'] == false){
		echo "请先进行登录验证！";
		exit;
	}
	require_once "./functions/admin_function.php";
	$title = "编辑教材反馈";
	require_once "./template/header.php";
	$db = db_connect();

	if(isset($_GET['bookisbn'])){
		$book_isbn = $_GET['bookisbn'];
	} else {
		echo "请求错误!";
		exit;
	}
	$book_quantity = intval($_POST['book_quantity']);

	$query = "UPDATE books SET book_quantity = $book_quantity WHERE book_isbn = '$book_isbn'";
	$result = mysqli_query($db, $query);
	if(!$result){
		echo "更新教材数量信息失败！";
		exit;
	}
?>
	<p class="lead text-success">成功修改教材数量！</p>
	<a href="admin_book.php" class="btn btn-default">退回管理员首页</a>
<?php
	if(isset($db)) {mysqli_close($db);}
	require "./template/footer.php"
?>