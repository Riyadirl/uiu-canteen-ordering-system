
<?php include("../include/usernav.php"); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - UIU Canteen Ordering System</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
        }

        .navbar {
            background-color: chocolate;
        }

        .navbar-brand,
        .nav-link {
            color: #fff;
        }

        .navbar-brand:hover,
        .nav-link:hover {
            color: #ffd700;
        }

        .container {
            margin-top: 80px;
        }

        .about-section {
            padding: 40px 0;
        }

        .about-title {
            color: chocolate;
            font-size: 2.5rem;
            font-weight: bold;
        }

        .about-description {
            font-size: 1.2rem;
            line-height: 1.6;
        }

        .contact-section {
            background-color: #f1f1f1;
            padding: 40px 2;
        }

        .contact-title {
            color: chocolate;
            font-size: 2rem;
            font-weight: bold;
        }

        .contact-info {
            font-size: 1.1rem;
        }
    </style>
</head>

<body>



    < <div class="container about-section">
        <h1 class="about-title">About Us</h1>
        <p class="about-description">
            Welcome to the UIU Canteen Ordering System, a comprehensive platform designed to streamline food ordering and delivery within the university. Our system connects students, faculty, and staff with a variety of food options from campus canteens, offering a seamless and efficient way to place and manage orders.
            <br><br>
            Our mission is to provide a user-friendly interface that ensures convenience and satisfaction. With features like real-time order tracking, customizable food options, and an easy-to-use menu, we aim to enhance your dining experience at UIU.
            <br><br>
            For more information or assistance, please feel free to contact us.
        </p>
        </div>


        <div class="container contact-section">
            <h2 class="contact-title">Contact Us</h2>
            <p class="contact-info">
                Email: support@uiucanteen.com<br>
                Phone: +880 123 456 789<br>
                Address: UIU Campus, Dhaka, Bangladesh
            </p>
        </div>





        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
        <?php include('../include/footer.php'); ?>
</body>

</html>