<?php
session_start();
include("../config/config.php");



$user_id = $_SESSION['user_id'];


$order_query = "SELECT id, order_date, total_price, status FROM orders WHERE user_id = '$user_id' ORDER BY order_date DESC";
$order_run = mysqli_query($conn, $order_query);


$has_orders = mysqli_num_rows($order_run) > 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .dashboard-container {
            margin-top: 50px;
        }
        .order-table {
            width: 100%;
            margin-top: 20px;
        }
        .order-table th, .order-table td {
            padding: 15px;
            text-align: center;
            vertical-align: middle;
        }
        .status-pending {
            color: #ffc107;
            font-weight: bold;
        }
        .status-completed {
            color: #28a745;
            font-weight: bold;
        }
        .order-status {
            padding: 5px 10px;
            border-radius: 5px;
        }
        .status-pending {
            background-color: #fff3cd;
        }
        .status-completed {
            background-color: #d4edda;
        }
    </style>
</head>
<body>
    <?php include("../include/usernav.php"); ?>
    <div class="container dashboard-container">
        <h2>Your Order History</h2>

        <?php if ($has_orders): ?>
            <table class="table order-table table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Total Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($order = mysqli_fetch_assoc($order_run)): ?>
                        <tr>
                            <td><?php echo $order['id']; ?></td>
                            <td><?php echo date("F j, Y, g:i a", strtotime($order['order_date'])); ?></td>
                            <td><?php echo $order['total_price']; ?> tk</td>
                            <td>
                                <span class="order-status <?php echo $order['status'] == 'pending' ? 'status-pending' : 'status-completed'; ?>">
                                    <?php echo ucfirst($order['status']); ?>
                                </span>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>You have not placed any orders yet.</p>
        <?php endif; ?>
    </div>
    <?php include('../include/footer.php'); ?>
</body>
</html>
