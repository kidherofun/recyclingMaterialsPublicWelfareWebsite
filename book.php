<?php
  session_start();
  $book_isbn = $_GET['bookisbn'];
  require_once "./functions/client_function.php";
  $db = db_connect();
  $result = getBookByBook_isbn($db, $book_isbn);
  $row = mysqli_fetch_assoc($result);
  if(!$row){
    echo "库存中暂时没有此书";
    exit;
  }

  $title = $row['book_title'];
  require "./template/header.php";
?>
      <p class="lead" style="margin: 25px 0"><a href="books.php">所有教材</a> > <?php echo $row['book_title']; ?></p>
      <div class="row">
        <div class="col-md-3 text-center">
          <img class="img-responsive img-thumbnail" src="./bootstrap/img/<?php echo $row['book_image']; ?>">
        </div>
        <div class="col-md-6">
          <h4>详细情况</h4>
          <table class="table">
          	<?php foreach($row as $key => $value){
              if($key == "book_image" || $key == "book_title"){
                continue;
              }
              switch($key){
                case "book_title":
                  $key = "教材名称";
                break;
                case "book_isbn":
                  $key = "ISBN";
                break;
                case "book_author":
                  $key = "作者";
                break;
                case "book_publisher":
                  $key = "出版社";
                break;
                case "book_version":
                  $key = "版本";
                break;
                case "book_quantity":
                  $key = "剩余数量";
                break;
              }
            ?>
            <tr>
              <td><?php echo $key; ?></td>
              <td><?php echo $value; ?></td>
            </tr>
            <?php 
              } 
              if(isset($db)) {mysqli_close($db); }
            ?>
          </table>
          <form method="post" action="cart.php">
            <input type="hidden" name="bookisbn" value="<?php echo $book_isbn;?>">
            <?php if($row['book_quantity'] != 0){ ?>
              <input type="submit" value="添加到书篮" name="cart" class="btn btn-primary">
            <?php } ?>
          </form>
       	</div>
      </div>
<?php
  require "./template/footer.php";
?>