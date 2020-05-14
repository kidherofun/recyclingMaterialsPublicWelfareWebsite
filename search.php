<?php
  session_start();
  
  $title = "书名检索";
  require_once "./template/header.php";
?>
    <p class="lead text-center text-muted">书名检索</p>
    <form action="search_result.php" method="POST">
        <input type="text" class="form-control" name="key" style="text-align: center"><br/>
        <center>
            <input type="reset" class="btn btn-default" value="重新输入">
            <input type="submit" class="btn btn-primary" value="进行检索">
        </center>
    </form>
<?php
  require_once "./template/footer.php";
?>