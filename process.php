<?php
	session_start();
	require_once "./functions/client_function.php";
	$title = "处理订单";
	require "./template/header.php";
	$db = db_connect();
	$student_id = $_SESSION['ship']["student_id"];
	$student_name = $_SESSION['ship']["student_name"];
	$student_phone = $_SESSION['ship']["student_phone"];
	$student_email = $_SESSION['ship']["student_email"];
	$student_address = $_SESSION['ship']["student_address"];
	
	$query = "DELETE FROM students WHERE student_id = '$student_id'";
	$result = mysqli_query($db, $query);
	$query0 = "INSERT INTO students VALUES ('$student_id', '$student_name', '$student_phone', '$student_email', '$student_address')";
	$result0 = mysqli_query($db, $query0);
	if(!$result || !$result0){
		echo "学生数据错误！";
		exit;
	}

	$order_id = getOrderId($student_id, $student_name, $student_phone, $student_email, $student_address);

	$query1 = "INSERT INTO orders VALUES ('$order_id', '$student_id', '$student_phone', '$student_address')";
	$result1 = mysqli_query($db, $query1);
	if(!$result1){
		echo "订单数据错误！";
		exit;
	}

	foreach($_SESSION['cart'] as $isbn => $qty){
		$query2 = "INSERT INTO order_items VALUES ('$order_id', '$isbn', $qty)";
		$result2 = mysqli_query($db, $query2);
		if(!$result2){
			echo "订单项目数据错误！";
			exit;
		}
		$query3 = "UPDATE books SET book_quantity = book_quantity - $qty WHERE book_isbn = '$isbn'";
		$result3 = mysqli_query($db, $query3);
		if(!$result3){
			echo "教材数据错误！";
			exit;
		}
	}

	session_unset();
?>
	<p class="lead text-success">您的订单已提交，您的订单号为：<?php echo $order_id; ?></p>
	<p class="lead text-success">我们将于24小时内将教材送至您的宿舍！</p>
<?php
	if(isset($db)){
		mysqli_close($db);
	}
	require_once "./template/footer.php";
?>