<?php
    function db_connect(){
        $db = mysqli_connect('localhost', 'qmxzdb', 'P@ssw0rd', 'qmxzdb');
        if(!$db){
            echo "无法连接至数据库";
            exit;
        }
        return $db;
    }

    function getAllBooks($db){
        $query = "SELECT * FROM books ORDER BY book_isbn";
        $result = mysqli_query($db, $query);
        return $result;
    }

    function getAllOrders($db){
        $query = "SELECT * FROM orders";
        $result = mysqli_query($db, $query);
        return $result;
    }
    
    function getBookByBook_isbn($db, $book_isbn){
        $query = "SELECT * FROM books WHERE book_isbn = '$book_isbn'";
        $result = mysqli_query($db, $query);
        return $result;
    }

    function getBookByOrder_id($db, $order_id){
        $query = "SELECT l.book_isbn, l.book_title, l.book_author, l.book_publisher, l.book_version, m.order_quantity FROM order_items m join books l on m.book_isbn = l.book_isbn WHERE m.order_id = '$order_id'";
        $result = mysqli_query($db, $query);
        return $result;
    }

    function getStudentByOrder_id($db, $order_id){
        $query = "SELECT m.order_id, l.* FROM orders m join students l on m.student_id = l.student_id WHERE m.order_id = '$order_id'";
        $result = mysqli_query($db, $query);
        return $result;
    }
?>