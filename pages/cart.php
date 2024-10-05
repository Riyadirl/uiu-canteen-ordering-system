<?php
session_start(); // Start session to access the cart
include("../config/config.php");

// Check if the cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<h2>Your cart is empty!</h2>";
    exit;
}

// Handle quantity update
if (isset($_POST['update_quantity'])) {
    $food_id = $_POST['food_id'];
    $new_quantity = $_POST['quantity'];
    if ($new_quantity <= 0) {
        unset($_SESSION['cart'][$food_id]); // Remove item if quantity is zero or less
    } else {
        $_SESSION['cart'][$food_id]['quantity'] = $new_quantity;
    }
}

// Handle item removal
if (isset($_GET['remove'])) {
    $food_id = $_GET['remove'];
    unset($_SESSION['cart'][$food_id]); // Remove item from cart
}

// Calculate total price
$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_price += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .cart-container {
            margin-top: 50px;
        }
        .cart-table {
            width: 100%;
        }
        .cart-table img {
            width: 100px;
            border-radius: 10px;
        }
        .cart-table td, .cart-table th {
            padding: 15px;
            vertical-align: middle;
        }
        .cart-total {
            text-align: right;
            font-size: 1.5em;
            font-weight: bold;
        }
        .remove-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .remove-btn:hover {
            background-color: #c82333;
        }
        .update-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .update-btn:hover {
            background-color: #0056b3;
        }
        .confirm-btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2em;
            float: right;
        }
        .confirm-btn:hover {
            background-color: #218838;
        }
    </style>
    <script>
        function confirmOrder(event) {
            event.preventDefault();
            let confirmation = confirm("Do you want to confirm your order?");
            if (confirmation) {
                window.location.href = 'userDashboard.php';
            }
        }
    </script>
</head>
<body>
    <?php include("../include/usernav.php"); ?>
    <div class="container cart-container">
        <h2>Your Cart</h2>
        <table class="table cart-table table-bordered">
            <thead>
                <tr>
                    <th>Food</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $food_id => $item): ?>
                    <tr>
                        <td><?php echo $item['foodname']; ?></td>
                        <td><img src="../assets/images/food/<?php echo $item['canteen_id']; ?>/<?php echo $item['image']; ?>" alt="Food Image"></td>
                        <td><?php echo $item['price']; ?> tk</td>
                        <td>
                            <form action="cart.php" method="post" class="d-inline-block">
                                <input type="hidden" name="food_id" value="<?php echo $food_id; ?>">
                                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="0" class="form-control d-inline-block" style="width: 80px;">
                                <button type="submit" name="update_quantity" class="btn update-btn mt-2">Update</button>
                            </form>
                        </td>
                        <td><?php echo $item['price'] * $item['quantity']; ?> tk</td>
                        <td>
                            <a href="cart.php?remove=<?php echo $food_id; ?>" class="remove-btn">Remove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="cart-total">
            Total Price: <?php echo $total_price; ?> tk
        </div>
        <button class="confirm-btn" onclick="confirmOrder(event)">Confirm Order</button>
    </div>
    <?php include('../include/footer.php'); ?>
</body>
</html>
