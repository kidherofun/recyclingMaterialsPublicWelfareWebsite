<?php
  session_start();
  $count = 0;
  require_once "./functions/client_function.php";
  $db = db_connect();
  $result = getAllBooks($db);

  $title = "所有教材";
  require_once "./template/header.php";
?>
  <p class="lead text-center text-muted">所有教材</p>
    <?php for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
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
  if(isset($db)) { mysqli_close($db); }
  require_once "./template/footer.php";
?>