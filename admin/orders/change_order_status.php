<?php
// 检查是否有 POST 请求发送的数据
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 数据库连接
include '../../database_config.php';

    // 获取表单数据
    $OrderID = $_POST["order_id"];

    // 准备 SQL 语句
    $sql = "UPDATE orders SET OrderStatus=1 WHERE OrderID='$OrderID'";

    // 执行 SQL 语句并检查是否成功
    if ($conn->query($sql) === TRUE) {
        echo "订单更新成功";
        header("Location:../m_orders.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
