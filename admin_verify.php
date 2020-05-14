<?php
	session_start();
	if(!isset($_POST['submit'])){
		echo "发生错误！";
		exit;
	}
	require_once "./functions/admin_function.php";
	$db = db_connect();

	$username = $_POST['username'];
	$password = hash('md5', $_POST['password']);

	// get from db
	$query = "SELECT * FROM admin";
	$result = mysqli_query($db, $query);
	if(!$result){
		echo "数据库中无任何数据！";
		exit;
	}
	$row = mysqli_fetch_assoc($result);

	if($username != $row['username'] || $password != $row['password']){
		echo "用户名或密码错误！请重试。";
		$_SESSION['admin'] = false;
		exit;
	}

	if(isset($db)) {mysqli_close($db);}
	$_SESSION['admin'] = true;
	header("Location: admin_book.php");
?>