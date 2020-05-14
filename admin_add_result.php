<?php
	session_start();
	if(!$_SESSION['admin'] || $_SESSION['admin'] == false){
		echo "请先进行登录验证！";
		exit;
	}
	require_once "./functions/admin_function.php";
	$title = "上架教材反馈";
	require "./template/header.php";
	$db = db_connect();

	$book_isbn = $_POST['book_isbn'];
	$book_title = $_POST['book_title'];
	$book_version = $_POST['book_version'];
	$book_author = $_POST['book_author'];
	$book_publisher = $_POST['book_publisher'];
	$book_image = $_FILES['book_image']["name"];
	$book_quantity = intval($_POST['book_quantity']);

	$image_type = array(".jpg", ".jpeg", ".png");

	for($i = 0; $i < sizeof($image_type) ; $i++){
		$book_image_check = $book_isbn . $image_type[$i];
		if($book_image == $book_image_check) break;
		else{
			echo "上传文件文件名错误！请重试！";
			continue;
		}
	}

	$query = "DELETE FROM books WHERE book_isbn = '$book_isbn'";
	$result = mysqli_query($db, $query);
	for($i = 0; $i < sizeof($image_type); $i++){
		$filename = "./bootstrap/img/" . $book_isbn . $image_type[$i];
		$result0 = unlink($filename);
		if($result0) break;
		else continue;
	}
	if(!$result){
		echo "删除已有教材信息错误！";
		exit;
	}

	$query1 = "INSERT INTO books VALUES ('$book_isbn', '$book_title', '$book_author', '$book_publisher', '$book_version', '$book_image', $book_quantity)";
	$result1 = mysqli_query($db, $query1);
	if(!$result1){
		echo "上传教材信息错误！";
		exit;
	}
	
	$dir = "/data/wwwroot/qmxz.kidhero.fun/bootstrap/img/" . $book_image;
	$result2 = move_uploaded_file($_FILES['book_image']["tmp_name"], $dir);
	if(!$result2){
		echo "保存图片错误！";
		exit;
	}
?>
	<p class="lead text-success">新的教材已成功上架！</p>
	<a href="admin_add.php" class="btn btn-primary">继续上架教材</a>
	<a href="admin_book.php" class="btn btn-default">返回管理员首页</a>
<?php
	if(isset($db)){
		mysqli_close($db);
	}
	require_once "./template/footer.php";
?>