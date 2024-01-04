<?php
// 检查是否收到了POST请求
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取通过POST请求发送的变量
    $dish_id = $_POST['dish_id'];
    $dish_name = $_POST['dish_name'];
    $selling_price = $_POST['selling_price'];

    // 连接到数据库
    include '../../database_config.php';

    // 检查连接是否成功
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }

    // 准备插入数据的SQL语句
    $sql = "INSERT INTO Dishes (DishID, DishName, SellingPrice) 
            VALUES ('$dish_id', '$dish_name', '$selling_price')";

    // 执行SQL语句
    if ($conn->query($sql) === TRUE) {
        echo "记录插入成功";
        header("Location:../m_dishes.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
