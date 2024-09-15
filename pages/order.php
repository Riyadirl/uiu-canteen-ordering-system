<?php
if(isset($_POST['cbtn'])){
    echo ("Product added to cart successfully");
}
if(isset($_POST['obtn'])){
    echo ("Product ordered successfully");
}
 echo ('<a href="index.php">Back</a>');
?>