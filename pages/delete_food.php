<?php
session_start();
$canteen_id = $_SESSION['canteen_id'];
include('../config/config.php');
if (isset($_POST['edit'])) {
    echo $_POST['id'];
}
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $image = $_POST['img'];
    $file = "../assets/images/food/$canteen_id/$image";
    $query = "DELETE FROM `food` WHERE id = '$id'";
    if (file_exists($file)) {
        // Attempt to delete the file
        if (unlink($file)) {
            $run = mysqli_query($conn, $query);
            if ($run) {
                header('location:canteenOwnerHome.php');
            }
        } else {
            echo "The file could not be deleted.";
        }
    } else {
        echo "The file does not exist.";
    }

}
?>