<?php
    function db_connect(){
        $db = mysqli_connect('localhost', 'qmxzdb', 'P@ssw0rd', 'qmxzdb');
        if(!$db){
            echo "无法连接至数据库";
            exit;
        }
        return $db;
    }
    
    function getRecommendedBooks($db){
        $recommendedBooks = array();
        $query = "SELECT book_isbn, book_image FROM books ORDER BY book_quantity DESC";//筛选模式待定
        $result = mysqli_query($db, $query);
		for($i = 0; $i < 4; $i++){
			array_push($recommendedBooks, mysqli_fetch_assoc($result));
		}
		return $recommendedBooks;
    }

    function getAllBooks($db){
        $query = "SELECT * FROM books ORDER BY book_isbn";
        $result = mysqli_query($db, $query);
        return $result;
    }

    function getBookByBook_isbn($db, $book_isbn){
        $query = "SELECT * FROM books WHERE book_isbn = '$book_isbn'";
        $result = mysqli_query($db, $query);
        return $result;
    }

    function getOrderId($student_id, $student_name, $student_phone, $student_email, $student_address){
        date_default_timezone_set('Asia/Shanghai');
        $date = date("Y-m-d H:i:s");
        $x = rand(0, 9);
        $data = $student_id . $student_name . $student_phone . $student_email . $student_address . $date . "$x";
        $result = hash("md5", $data);
        return $result;
    }
    
    function getBooksBySearch($db, $key){
        $query = "SELECT * FROM books WHERE book_title LIKE '%%$key%%'";
        $result = mysqli_query($db, $query);
        return $result;
    }
?>