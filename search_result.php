<?php
	session_start();
	$count = 0;
	require_once "./functions/client_function.php";
	$db = db_connect();
	$key = $_POST['key'];
	$result = getBooksBySearch($db, $key);

	$title = "检索结果";
  require "./template/header.php";
?>
	<p class="lead">检索结果</p>
  <?php 
    if(mysqli_num_rows($result) == 0){
      echo "抱歉！库存中暂无相关教材。";
    }
    else{
      for($i = 0; $i < mysqli_num_rows($result); $i++){ 
  ?>
      <div class="row">
        <?php while($query_row = mysqli_fetch_assoc($result)){ ?>
          <div class="col-md-3">
            <a href="book.php?bookisbn=<?php echo $query_row['book_isbn']; ?>">
              <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $query_row['book_image']; ?>"><br/>
              <?php echo $query_row['book_title'] . " " . $query_row['book_version'] ?><br/>
              <?php echo $query_row['book_author'] ?>
            </a>
          </div>
        <?php
          $count++;
          if($count >= 4){
              $count = 0;
              break;
            }
          } ?> 
      </div>
<?php
    }
  }
	mysqli_close($db);
	require "./template/footer.php";
?>