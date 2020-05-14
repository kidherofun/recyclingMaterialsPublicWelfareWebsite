<?php
	session_start();
	require_once "./functions/client_function.php";

	if(isset($_POST['bookisbn'])){
		$book_isbn = $_POST['bookisbn'];
	}

	if(isset($book_isbn)){
		if(!isset($_SESSION['cart'])){
			$_SESSION['cart'] = array();
		}

		if(!isset($_SESSION['cart'][$book_isbn])){
			$_SESSION['cart'][$book_isbn] = 1;
		}
	}

	if(isset($_POST['save_change'])){
		foreach($_SESSION['cart'] as $isbn => $qty){
			if($_POST[$isbn] == '0'){
				unset($_SESSION['cart']["$isbn"]);
			} else {
				$_SESSION['cart']["$isbn"] = $_POST["$isbn"];
			}
		}
	}

	$title = "我的书篮";
	require "./template/header.php";
?>
   	<form action="cart.php" method="post">
		<p class="lead">我的书篮</p>
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
				<td><input type="text" value="<?php echo $qty; ?>" size="2" name="<?php echo $isbn; ?>">（现有库存<?php echo $book['book_quantity']; ?>本）</td>
			</tr>
			<?php } ?>
		</table>
		<center>
			<input type="submit" class="btn btn-primary" name="save_change" value="保存修改">
			<a href="books.php" class="btn btn-primary">继续采书</a>
			<?php if(isset($_SESSION['cart']["$isbn"])){ ?>
				<a href="checkout.php" class="btn btn-primary">提交借阅信息</a>
			<?php } ?>
		</center>
	</form>
<?php
	if(isset($db)){ mysqli_close($db); }
	require_once "./template/footer.php";
?>