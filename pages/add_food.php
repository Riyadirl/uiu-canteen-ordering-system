<?php
// database
include('../config/config.php');
session_start();
$canteen_id = $_SESSION['canteen_id'];


if (isset($_POST['submit'])) {
    $foodname = $_POST['foodname'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $canteen_id = 1;

    // image upload
    $target_dir = "../assets/images/food/$canteen_id/"; // Ensure the 'uploads' folder is writable
    $image = $_FILES['image']['name'];
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

    // Insert 
    $sql = "INSERT INTO food (foodname, image, description, price, quantity, canteen_id) 
            VALUES ('$foodname', '$image', '$description', '$price', '$quantity', '$canteen_id')";

    if (mysqli_query($conn, $sql)) {
        echo "<div class='alert alert-success'>Food item added successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Food - UIU Canteen Ordering System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='../assets/css/add_food.css' rel="stylesheet">


</head>

<body>

    <?php include('../include/canteenOwnerNav.php'); ?>


    <div class="container">
        <h2 class="text-center"><b>ADD NEW FOOD ITEM</b></h2>

        <form action="add_food.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="foodname">Food Name</label>
                <input type="text" name="foodname" id="foodname" class="form-control" placeholder="Enter food name" required>
            </div>

            <div class="form-group">
                <label for="image">Food Image</label>
                <input type="file" name="image" id="image" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" placeholder="Enter food description" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" name="price" id="price" class="form-control" placeholder="Enter price" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Enter quantity" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary w-100">Add Food</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>