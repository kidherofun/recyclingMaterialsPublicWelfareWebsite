<?php
	session_start();
	if(!$_SESSION['admin'] || $_SESSION['admin'] == false){
		echo "请先进行登录验证！";
		exit;
	}
	$book_isbn = $_GET['bookisbn'];

	require_once "./functions/admin_function.php";
	$db = db_connect();

	$query = "DELETE FROM books WHERE book_isbn = '$book_isbn'";
	$result = mysqli_query($db, $query);
	$image_type = array(".jpg", ".jpeg", ".png");

	for($i = 0; $i < sizeof($image_type); $i++){
		$filename = "./bootstrap/img/" . $book_isbn . $image_type[$i];
		$result0 = unlink($filename);
		if($result0) break;
		else continue;
	}
	if(!$result){
		echo "删除书本信息失败！";
		exit;
	}
	header("Location: admin_book.php");
?>