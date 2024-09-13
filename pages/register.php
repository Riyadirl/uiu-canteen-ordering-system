<?php

include('../config/config.php');


$name = $user_id = $email = $phone = $role = $gender = $password = "";
$name_err = $user_id_err = $email_err = $phone_err = $role_err = $gender_err = $password_err = "";

//submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate 
    $name = trim($_POST["name"]);
    $user_id = trim($_POST["user_id"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $role = trim($_POST["role"]);
    $gender = trim($_POST["gender"]);
    $password = trim($_POST["password"]);

    // Validate inputs
    if (empty($name) || empty($user_id) || empty($email) || empty($phone) || empty($role) || empty($gender) || empty($password)) {
        $error_message = "All fields are required.";
    } else {
        // Check exists
        $sql = "SELECT id FROM users WHERE email = ? OR phone = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $email, $phone);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) > 0) {
                $error_message = "Email or phone number already registered.";
            } else {
                // Insert new user
                $sql = "INSERT INTO users (name, user_id, email, phone, role, gender, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
                if ($stmt = mysqli_prepare($conn, $sql)) {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sssssss", $name, $user_id, $email, $phone, $role, $gender, $hashed_password);
                    if (mysqli_stmt_execute($stmt)) {
                        header("Location: login.php");
                        exit();
                    } else {
                        $error_message = "Something went wrong. Please try again.";
                    }
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href='../assets/css/register.css'>
</head>

<body>
    <div class="container">
        <h2>Register</h2>
        <?php if (!empty($error_message)) {
            echo "<p class='error'>$error_message</p>";
        } ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>">

            <label for="user_id">University ID:</label>
            <input type="text" id="user_id" name="user_id" value="<?php echo $user_id; ?>">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>">

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>">

            <label for="role">Role:</label>
            <select id="role" name="role">
                <option value="for_order" <?php echo $role == 'for_order' ? 'selected' : ''; ?>>General</option>
                <option value="canteen_owner" <?php echo $role == 'canteen_owner' ? 'selected' : ''; ?>>Canteen Owner</option>
                <option value="delivery_man" <?php echo $role == 'delivery_man' ? 'selected' : ''; ?>>Delivery Man</option>
               
            </select>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender">
                <option value="male" <?php echo $gender == 'male' ? 'selected' : ''; ?>>Male</option>
                <option value="female" <?php echo $gender == 'female' ? 'selected' : ''; ?>>Female</option>
            </select>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password">

            <input type="submit" value="Register">
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>

</html>