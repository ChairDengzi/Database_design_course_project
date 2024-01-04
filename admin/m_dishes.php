
<!DOCTYPE html>
<html>
<head>
    <title>Manage Dishes</title>
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
            <h2>添加新菜品</h2>
            <form method="post" action="./dishes/add_dish.php">
                菜品编号: <input type="text" name="dish_id"><br>
                菜品名称: <input type="text" name="dish_name"><br>
                售价: <input type="text" name="selling_price"><br>
                <input type="submit" value="添加">
            </form>
        </div>

        <div id = "Change">
            <h2>修改现有菜品</h2>
            <form method="post" action="./dishes/modify_dish.php">
                菜品编号: <input type="text" name="modify_id"><br>
                菜品名称: <input type="text" name="modify_name"><br>
                售价: <input type="text" name="modify_price"><br>
                <input type="submit" value="修改">
            </form>
        </div>


        <div id = "Table">
            <h1>管理菜品</h1>
            <table border="1">
                <tr>
                    <th>菜品编号</th>
                    <th>菜品名称</th>
                    <th>售价</th>
                    <th>操作</th>
                </tr>

                <?php
                // PHP代码从数据库中检索并显示菜品

                // 连接数据库
                include '../database_config.php';

                if ($conn->connect_error) {
                    die("连接失败: " . $conn->connect_error);
                }

                // 从数据库选择数据
                $sql = "SELECT DishID, DishName, SellingPrice FROM dishes";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo 
                        "<tr>
                            <td>" . $row["DishID"] . "</td>
                            <td>" . $row["DishName"] . "</td>
                            <td>" . $row["SellingPrice"] . "</td>";
                            echo 
                            "<td><form method='post' action='./dishes/delete_dish.php'>
                                <input type='hidden' name='delete_id' value='" . $row["DishID"] . "'>
                                <input type='submit' value='删除'></form></td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>未找到菜品</td></tr>";
                }
                ?>

            </table>
        </div>
    </div>
    
</body>
</html>
