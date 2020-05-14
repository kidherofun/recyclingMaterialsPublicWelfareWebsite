SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `admin` (
  `username` VARCHAR(255) PRIMARY KEY NOT NULL,
  `password` VARCHAR(255) NOT NULL
) character set = utf8;
INSERT INTO `admin`
(`username`, `password`)
VALUES
('admin', '161ebd7d45089b3446ee4e0d86dbcf92');

CREATE TABLE IF NOT EXISTS `books` (
    `book_isbn`VARCHAR(255) PRIMARY KEY NOT NULL,
    `book_title` VARCHAR(255) NOT NULL,
    `book_author` VARCHAR(255) NOT NULL,
    `book_publisher` VARCHAR(255) NOT NULL,
    `book_version` VARCHAR(255) NOT NULL,
    `book_image` VARCHAR(255) NOT NULL,
    `book_quantity` INT NOT NULL
) character set = utf8;
INSERT INTO `books`
(`book_isbn`, `book_title`, `book_author`, `book_publisher`, `book_version`, `book_image`, `book_quantity`)
VALUES
('3948681220', '概率论与数理统计', '盛骤 谢式千 潘承毅', '高等教育出版社', '第四版', '3948681220.jpg', 23),
('3897728752', 'C语言程序设计', '田祥宏 荣政', '西安电子科技大学出版社', '第四版', '3897728752.jpg', 3),
('5730793065', 'C语言程序设计', '谭浩强', '清华大学出版社', '第四版', '5730793065.jpg', 2),
('2580733513', '半导体物理学简明教程', '陈治明 雷天民 马剑平', '机械工业出版社', '第二版', '2580733513.jpg', 2),
('4547078201', '信号与线性系统分析', '吴大正', '高等教育出版社', '第四版', '4547078201.jpg', 1),
('9590298958', '基础物理实验', '李平舟 武颖丽 吴兴林', '西安电子科技大学出版社', '第二版', '9590298958.jpg', 2),
('6374886850', '微型计算机原理及接口技术', '裘雪红 李伯成 刘凯', '西安电子科技大学出版社', '第二版', '6374886850.jpg', 2),
('9406652178', '微波技术与天线', '王新稳 李萍 李延平', '电子工业出版社', '第二版', '9406652178.jpg', 0),
('6582974197', '微波技术与天线', '王新稳 李延平 李萍', '电子工业出版社', '第三版', '6582974197.jpg', 1);

CREATE TABLE IF NOT EXISTS `students` (
    `student_id` VARCHAR(255) PRIMARY KEY NOT NULL,
    `student_name` VARCHAR(255) NOT NULL,
    `student_phone` VARCHAR(255) NOT NULL,
    `student_email` VARCHAR(255) NOT NULL,
    `student_address` VARCHAR(255) NOT NULL
) character set = utf8;
INSERT INTO `students`
(`student_id`, `student_name`, `student_phone`, `student_email`, `student_address`)
VALUES
('test student id', 'test name', 'test phone', 'test email', 'test address');

CREATE TABLE IF NOT EXISTS `orders` (
    `order_id` VARCHAR(255) PRIMARY KEY NOT NULL,
    `student_id` VARCHAR(255) NOT NULL,
    `student_phone` VARCHAR(255) NOT NULL,
    `student_address` VARCHAR(255) NOT NULL
) character set = utf8;
INSERT INTO `orders`
(`order_id`, `student_id`, `student_phone`, `student_address`)
VALUES
('test order id', 'test student id', 'test phone', 'test address');

CREATE TABLE IF NOT EXISTS `order_items` (
    `order_id` VARCHAR(255) NOT NULL,
    `book_isbn` VARCHAR(255) NOT NULL,
    `order_quantity` INT NOT NULL
) character set = utf8;
INSERT INTO `order_items`
(`order_id`, `book_isbn`, `order_quantity`)
VALUES
('test order id', '6582974197', 1);