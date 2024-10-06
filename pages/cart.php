<?php
session_start(); // Start session to access the cart
include("../config/config.php");

$user_id = $_SESSION['user_id']; // Assuming user_id is stored in the session

// Check if the cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
   
    echo "<img src='../assets/images/icons/empty-cart.png' alt='No Data Found' />";
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

    // Recalculate the total price after updating the quantity
    $total_price = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }
}

// Handle item removal
if (isset($_GET['remove'])) {
    $food_id = $_GET['remove'];
    unset($_SESSION['cart'][$food_id]); // Remove item from cart
}

// Recalculate total price if not set yet
$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_price += $item['price'] * $item['quantity'];
}

// Handle order confirmation
// Handle order confirmation
if (isset($_POST['confirm_order'])) {
    $order_date = date('Y-m-d H:i:s');
    $status = 'pending';
    $location = $_POST['location'];

    // Insert order into the database
    $order_query = "INSERT INTO orders (user_id, order_date, total_price, status, location) VALUES ('$user_id', '$order_date', '$total_price', '$status', '$location')";
    $order_run = mysqli_query($conn, $order_query);
    $order_id = mysqli_insert_id($conn); 

    // Insert each item in the cart into order_items table
    foreach ($_SESSION['cart'] as $food_id => $item) {
        $foodname = $item['foodname'];
        $price = $item['price'];
        $quantity = $item['quantity'];

        // Insert into order_items
        $item_query = "INSERT INTO order_items (order_id, food_id, foodname, price, quantity) VALUES ('$order_id', '$food_id', '$foodname', '$price', '$quantity')";
        mysqli_query($conn, $item_query);

        // Reduce the available quantity in the food table
        $update_quantity_query = "UPDATE food SET quantity = quantity - '$quantity' WHERE id = '$food_id'";
        mysqli_query($conn, $update_quantity_query);
    }

    // Clear the cart after successful order
    unset($_SESSION['cart']);

    // Redirect to user dashboard or order confirmation page
    header("Location: user_dashboard.php");
    exit;
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
                    <tr data-price="<?php echo $item['price']; ?>">
                        <td><?php echo $item['foodname']; ?></td>
                        <td><img src="../assets/images/food/<?php echo $item['canteen_id']; ?>/<?php echo $item['image']; ?>" alt="Food Image"></td>
                        <td><?php echo $item['price']; ?> tk</td>
                        <td>
                            <form action="cart.php" method="post" class="d-inline-block">
                                <input type="hidden" name="food_id" value="<?php echo $food_id; ?>">
                                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="0" class="form-control d-inline-block" style="width: 80px;">
                                
                            </form>
                        </td>
                        <td class="item-total"><?php echo $item['price'] * $item['quantity']; ?> tk</td>
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

        <!-- Confirm Order Form -->
        <form id="confirmOrderForm" action="cart.php" method="post">
            <input type="hidden" name="confirm_order" value="1">
            <h3><label for="location">Enter your location: </label>
            <input type="text" name="location" id="location"></h3>
            <button class="confirm-btn" onclick="confirmOrder(event)">Confirm Order</button>
        </form>
    </div>

    <script>
        // Function to update the total price in real-time
        function updateTotal() {
            let total = 0;
            const rows = document.querySelectorAll('.cart-table tbody tr');
            rows.forEach(row => {
                const price = parseFloat(row.getAttribute('data-price'));
                const quantity = row.querySelector('input[name="quantity"]').value;
                const itemTotal = price * quantity;
                row.querySelector('.item-total').textContent = itemTotal + ' tk';
                total += itemTotal;
            });
            document.querySelector('.cart-total').textContent = 'Total Price: ' + total + ' tk';
        }

        // Add event listeners to quantity input fields
        document.addEventListener('DOMContentLoaded', () => {
            const quantityInputs = document.querySelectorAll('input[name="quantity"]');
            quantityInputs.forEach(input => {
                input.addEventListener('input', updateTotal);
            });
        });

        // Confirm order function
        function confirmOrder(event) {
            event.preventDefault();
            let confirmation = confirm("Confirm order?");
            if (confirmation) {
                document.getElementById("confirmOrderForm").submit(); // Submit the form
            }
        }
    </script>
</body>
</html>
