<?php include('../include/canteenOwnerNav.php');
include('../config/config.php');
session_start();
$oid = $_SESSION['id'];
$query = "SELECT `id`, `canteen_name` FROM `canteen` WHERE owner_id = '$oid'";
$run = mysqli_query($conn, $query);
$result = mysqli_fetch_array($run);
$canteen_id = $result['id'];
$_SESSION['canteen_id'] = $canteen_id;
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
            height: 100px;
            width: 100px;
        }
    </style>
</head>

<body>
    <h1>Canteen Name: <?php echo $result['canteen_name'] ?></h1>
    <h3>Food</h3>
    <hr>
    <table class="table">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Operation</th>
        </tr>

        <?php
        $query = "SELECT `id`, `foodname`, `image`, `description`, `price`, `quantity` FROM `food` WHERE canteen_id = '$canteen_id'";
        $run = mysqli_query($conn, $query);
        if (mysqli_num_rows($run) > 0) {
            while ($result = mysqli_fetch_array($run)) {


                ?>
                <tr>

                    <td><img src="../assets/images/food/<?php echo $canteen_id ?>/<?php echo $result['image'] ?>"
                            alt="Food Image"></td>
                    <td><?php echo $result['foodname'] ?></td>
                    <td><?php echo $result['price'] ?></td>
                    <td><?php echo $result['quantity'] ?></td>
                    <td>
                        <form action="edit_food.php" method="post">
                            <input type="text" name="id" id="id" value="<?php echo $result['id'] ?>" hidden>
                            <input type="submit" value="Edit" name="edit" class="btn btn-primary">
                        </form>
                        <form action="delete_food.php" method="post">
                            <input type="text" name="id" id="id" value="<?php echo $result['id'] ?>" hidden>
                            <input type="text" name="img" id="img" value="<?php echo $result['image'] ?>" hidden>
                            <input type="submit" value="Delete" name="delete" class="btn btn-danger">
                        </form>

                    </td>

                </tr>
                <?php
            }
        }
        ?>
    </table>
</body>

</html>