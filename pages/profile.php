<?php
session_start();
include("../config/config.php");

// Fetch user data from the session
$user_id = $_SESSION['user_id']; // Assuming user_id is stored in session

// Fetch user data from the database
$query = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Handle form submission to update profile
if (isset($_POST['update_profile'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
  
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hashing the new password

    // Update query
    $update_query = "UPDATE users SET name='$name', email='$email', phone='$phone', password='$password' WHERE id='$user_id'";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        echo "<script>alert('Profile updated successfully!');</script>";
    } else {
        echo "<script>alert('Failed to update profile.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="../assets/css/profile.css" rel="stylesheet"> <!-- External CSS file -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include("../include/usernav.php"); ?>
    
    <div class="container profile-container">
        <h2 class="text-center">Edit Profile</h2>

        <form action="profile.php" method="POST" class="profile-form">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $user['name']; ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" name="phone" value="<?php echo $user['phone']; ?>" required>
            </div>

        
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
