<?php
	session_start();
	require_once "./functions/client_function.php";
	$title = "订单信息";
	require "./template/header.php";
?>
	<form method="post" action="purchase.php">
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
				<td><input type="text" name="student_id" size="11"></td>
				<td><input type="text" name="student_name" size="8"></td>
				<td><input type="text" name="student_phone" size="11"></td>
				<td><input type="text" name="student_email"></td>
				<td><input type="text" name="student_address" size="11" placeholder="如：6#-II-217"></td>
			</tr>
		</table>
		<div class="form-group">
			<center>
				<?php if(isset($_SESSION['err']) && $_SESSION['err'] == 0){ ?>
					<p class="text-danger">请正确填写所有内容！</p>
				<?php } ?>
				<input type="submit" name="submit" value="发送订单信息" class="btn btn-primary">
			</center>
		</div>
	</form>
<?php
	if(isset($db)){ mysqli_close($db); }
	require_once "./template/footer.php";
?>