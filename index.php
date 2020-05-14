<?php
  session_start();
  $count = 0;
  // connecto database
  
  $title = "栖墨小栈";
  require_once "./template/header.php";
  require_once "./functions/client_function.php";
  $db = db_connect();
  $row = getRecommendedBooks($db);
?>
      <!-- Example row of columns -->
      <p class="lead text-center text-muted">常用教材</p>
      <div class="row">
        <?php foreach($row as $book) { ?>
      	<div class="col-md-3">
      		<a href="book.php?bookisbn=<?php echo $book['book_isbn']; ?>">
           <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $book['book_image']; ?>">
          </a>
      	</div>
        <?php } ?>
      </div>
<?php
  if(isset($db)) {mysqli_close($db);}
  require_once "./template/footer.php";
?>