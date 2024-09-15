<?php
    include('../config/config.php');
    if(isset($_POST['edit'])){
        $id = $_POST['id'];
        $query = "SELECT * FROM `food` WHERE id = '$id'";
        $run = mysqli_query($conn, $query);
        $result = mysqli_fetch_array($run);
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
        <h2 class="text-center"><b>Edit Food Details</b></h2>

        <form action="add_food.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="foodname">Food Name</label>
                <input type="text" name="foodname" id="foodname" class="form-control" placeholder="<?php echo $result['foodname'] ?>" required>
            </div>


            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" placeholder="<?php echo $result['description'] ?>" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" name="price" id="price" class="form-control" placeholder="<?php echo $result['price'] ?>" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" placeholder="<?php echo $result['quantity'] ?>" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary w-100">Add Food</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>