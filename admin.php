<?php
	$title = "管理员登陆";
	require_once "./template/header.php";
?>

	<form class="form-horizontal" method="post" action="admin_verify.php">
		<div class="form-group">
			<label for="name" class="control-label col-md-4">用户名</label>
			<div class="col-md-4">
				<input type="text" name="username" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="pass" class="control-label col-md-4">密码</label>
			<div class="col-md-4">
				<input type="password" name="password" class="form-control">
			</div>
		</div>
		<center>
			<input type="submit" name="submit" value="进入管理员系统" class="btn btn-primary">
		</center>
	</form>

<?php
	require_once "./template/footer.php";
?>