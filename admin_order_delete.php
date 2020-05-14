<?php
	session_start();
	if(!$_SESSION['admin'] || $_SESSION['admin'] == false){
		echo "请先进行登录验证！";
		exit;
	}
	$order_id = $_GET['orderid'];

	require_once "./functions/admin_function.php";
	$db = db_connect();

	$query0 = "DELETE FROM orders WHERE order_id = '$order_id'";
	$result0 = mysqli_query($db, $query0);

	$query1 = "DELETE FROM order_items WHERE order_id = '$order_id'";
	$result1 = mysqli_query($db, $query1);

	if(!$result0 || !$result1){
		echo "删除订单信息失败！";
		exit;
	}
	header("Location: admin_order.php");
?>