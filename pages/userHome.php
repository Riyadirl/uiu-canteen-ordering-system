<?php
session_start(); // Start session to track cart items
include("../config/config.php");

$query = "SELECT `id`, `foodname`, `image`, `price`, `quantity`, `canteen_id` FROM `food` WHERE 1";
$run = mysqli_query($conn, $query);

// Handle "Add to Cart" button functionality
if (isset($_POST['cbtn'])) {
    $food_id = $_POST['id'];
    
    // Check if item already exists in the cart
    if (isset($_SESSION['cart'][$food_id])) {
        $_SESSION['cart'][$food_id]['quantity']++;
    } else {
        // Fetch food details and add it to the cart
        $food_query = "SELECT `id`, `foodname`, `price`, `canteen_id`, `image` FROM `food` WHERE `id` = $food_id";
        $food_run = mysqli_query($conn, $food_query);
        $food = mysqli_fetch_assoc($food_run);

        $_SESSION['cart'][$food_id] = [
            'foodname' => $food['foodname'],
            'price' => $food['price'],
            'canteen_id' => $food['canteen_id'],
            'image' => $food['image'],
            'quantity' => 1 // Start with quantity 1
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        img {
    height: 150px; /* Set a fixed height */
    width: 100%;   /* Set the width to fill the container */
    object-fit: cover; /* Ensures the image fills the space without distortion */
    margin: 0px;
    border-radius: 20px;
}

        .col-3 {
            margin-bottom: 10px;
        }
        td {
            text-align: left;
        }
    </style>
    <script>
        function confirmOrder(event) {
            event.preventDefault();
            let confirmation = confirm("Confirm Order?");
            if (confirmation) {
                window.location.href = 'user_dashBoard.php';
            }
        }
    </script>
</head>
<body>
    <?php include("../include/usernav.php"); ?>
    <div class="container text-center">
        <div class="row">
            <?php
            if (mysqli_num_rows($run) > 0) {
                while ($result = mysqli_fetch_assoc($run)) {
                    ?>
                    <div class="col-3">
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
                            <table class="table">
                                <tr>
                                    <td colspan="2"><img src="../assets/images/food/<?php echo $result['canteen_id'] ?>/<?php echo $result['image'] ?>" alt="Food Image"></td>
                                </tr>
                                <tr>
                                    <td>Name: </td>
                                    <td><?php echo $result['foodname'] ?></td>
                                </tr>
                                <tr>
                                    <td>Price: </td>
                                    <td><?php echo $result['price'] ?> tk</td>
                                </tr>
                                <tr>
                                    <td>Quantity: </td>
                                    <td><?php echo $result['quantity'] ?></td>
                                </tr>
                                <tr>
                                    <td><input type="submit" value="Add to cart" class="btn btn-primary" name="cbtn"></td>
                                    <td><input type="button" value="Order Now" class="btn btn-primary" onclick="confirmOrder(event)"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <?php include('../include/footer.php'); ?>
</body>
</html>
