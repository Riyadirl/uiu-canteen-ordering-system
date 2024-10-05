<?php
session_start();
include("../config/config.php");

// Check if the user is a delivery man
// if ($_SESSION['role'] != 'delivery_man') {
//     header("Location: unauthorized.php");
//     exit;
// }

// Fetch all delivery items from the database
if(isset($_POST['dc'])){
    $id = $_POST['id'];
    $query = "UPDATE `orders` SET `status`='completed' WHERE id = $id";
    $run = mysqli_query($conn, $query);
}
$query = "SELECT `id`, `user_id`, `order_date`, `total_price`, `status`, `location` FROM `orders` WHERE 1";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery List</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            margin-bottom: 20px;
        }
        .mark-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .mark-btn:hover {
            background-color: #218838;
        }
        .status {
            font-size: 1.2em;
            font-weight: bold;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <h2>Delivery List</h2>
        <table class="table">
            <tr>
                <th>id</th>
                <th>Order-time</th>
                <th>Amount</th>
                <th>Location</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): 
                if($row['status'] != 'completed'){;
        ?>
            <tr>
                <td><?php echo $row['id']?></td>
                <td><?php echo $row['order_date']?></td>
                <td><?php echo $row['total_price']?></td>
                <td><?php echo $row['location']?></td>
                <td><?php echo $row['status']?></td>
                <td><form action="dHome.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                    <input type="submit" value="Delivery complete" name="dc">
                </form></td>
            </tr>
        <?php 
                }
    endwhile; 
    ?>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
