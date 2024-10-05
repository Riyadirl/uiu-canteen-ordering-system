<?php

include('../config/config.php');


$email = $password = "";
$email_err = $password_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email)) {
        $email_err = "Please enter your email.";
    }

    if (empty($password)) {
        $password_err = "Please enter your password.";
    } else {
        // validate password
        $sql = "SELECT id, password, role FROM users WHERE email = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $id, $hashed_password, $role);
                if (mysqli_stmt_fetch($stmt)) {
                    if (password_verify($password, $hashed_password)) {
                        session_start();
                        $_SESSION["loggedin"] = true;
                        $_SESSION["user_id"] = $id;
                        if($role == 'for_order'){
                            header("location: userHome.php");
                        }
                        elseif($role == 'canteen_owner'){
                            header("location: canteenOwnerHome.php");
                        }
                        elseif($role == 'admin'){
                            header("location: adminHome.php");
                        }
                        elseif($role == 'delivery_man'){
                            header("location: dHome.php");
                        }
                        exit();
                    } else {
                        $password_err = "The password you entered was not valid.";
                    }
                }
            } else {
                $email_err = "No account found with that email.";
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
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>">
            <span class="error"><?php echo $email_err; ?></span>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <span class="error"><?php echo $password_err; ?></span>

            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>

    </div>
</body>

</html>