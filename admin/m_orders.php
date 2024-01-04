<!DOCTYPE html>
<html>
<head>
    <title>Manage Order</title>
    <link rel = "stylesheet" type = "text/css" href="../Style/sidebar.css">
    <link rel = "stylesheet" type = "text/css" href="../Style/ACT.css">
    <style>
        body {
            display: flex;
            margin: 0;
            height: 100vh; /* 将body的高度设置为100vh */
            background-color: #f2f2f2;
        }


    </style>
</head>
<body>
    <div id="sidebar">
        <h2><a href="../Administrator.html" style="color: #fff; text-decoration: none;">Management page</a></h2>
        <hr>
        <ul>
            <li><a href="../admin/m_users.php">Manage Users</a></li>
            <li><a href="../admin/m_orders.php">Manage Orders</a></li>
            <li><a href="../admin/m_dishes.php">Manage Dishes</a></li>
            <li><a href="../admin/m_inventory.php">Manage Inventory</a></li>
            <li><a href="../admin/m_suppliers.php">Manage Suppliers</a></li>
            <li><a href="../admin/m_admin.php">Manage Personal Messages</a></li>
        </ul>
    </div>

    
    <div id="content">
        <div id = "Add">
            <form action="./orders/add_order.php" method="post">
                <h3>添加订单：</h3>
                OrderID: <input type="text" name="OrderID"><br>
                UserUserIDName: <input type="text" name="UserID"><br>
                OrderDate: <input type="text" name="OrderDate"><br>
                DishName: <input type="text" name="DishName"><br>
                Quantity: <input type="text" name="Quantity"><br>
                UnitPrice: <input type="text" name="UnitPrice"><br>
                TotalAmount: <input type="text" name="TotalAmount"><br>
                OrderStatus: <input type="text" name="OrderStatus"><br>
                <input type="submit" value="添加">
            </form>
        </div>
        
        <br>

        <div id = "Change">
            <form action="./orders/update_order.php" method="post">
                <h3>修改订单：</h3>
                OrderID: <input type="text" name="OrderID"><br>
                UserID: <input type="text" name="UserID"><br>
                OrderDate: <input type="text" name="OrderDate"><br>
                DishName: <input type="text" name="DishName"><br>
                Quantity: <input type="text" name="Quantity"><br>
                UnitPrice: <input type="text" name="UnitPrice"><br>
                TotalAmount: <input type="text" name="TotalAmount"><br>
                OrderStatus: <input type="text" name="OrderStatus"><br>
                <input type="submit" value="修改">
            </form>
        </div>

        <br>

        <div id = "Table">
            <?php
            // 数据库连接
            include '../database_config.php';

            // 检查连接是否成功
            if ($conn->connect_error) {
                die("连接失败: " . $conn->connect_error);
            }

            // 查询orders表中的数据
            $sql = "SELECT OrderID, UserID, OrderDate, DishName, Quantity, UnitPrice, TotalAmount, OrderStatus FROM orders";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border='1'>
                <tr>
                <th>OrderID</th>
                <th>UserID</th>
                <th>OrderDate</th>
                <th>DishName</th>
                <th>Quantity</th>
                <th>UnitPrice</th>
                <th>TotalAmount</th>
                <th>OrderStatus</th>
                <th>Action</th>
                </tr>";
            // 输出数据
            while($row = $result->fetch_assoc()) {
                echo 
                "<tr>
                    <td>".$row["OrderID"]."</td>
                    <td>".$row["UserID"]."</td>
                    <td>".$row["OrderDate"]."</td>
                    <td>".$row["DishName"]."</td>
                    <td>".$row["Quantity"]."</td>
                    <td>".$row["UnitPrice"]."</td>
                    <td>".$row["TotalAmount"]."</td>
                    <td>".$row["OrderStatus"]."</td>
                    <td>
                        <button onclick='window.location.href=\"./orders/delete_order.php?id=".$row["OrderID"]."\"' style='margin-bottom: 10px;'>删除</button>
                        <form method=\"post\" action=\"./orders/change_order_status.php\">
                            <input type=\"hidden\" name=\"order_id\" value=\"".$row["OrderID"]."\">
                            <button type=\"submit\">出货</button>
                        </form>
                    </td>
                </tr>";
            
            }


                echo "</table>";
            } else {
                echo "0 结果";
            }
            ?>
    </div>
    
</body>
</html>
