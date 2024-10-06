<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UIU Canteen Ordering System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Ensures the entire page is at least 100% of the viewport height */
        html, body {
            height: 100%;
        }

        /* Flexbox container to push the footer to the bottom */
        .content-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Main content takes the remaining space */
        .content {
            flex: 1;
        }

        /* Make sure the footer stays at the bottom */
        footer {
            background-color: #343a40;
            color: white;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <!-- Main Content -->
        <div class="content">
            <!-- Your page content goes here -->
        </div>

        <!-- Footer -->
        <footer class="bg-dark text-white py-2">
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-6">
                        <small>&copy; <?php echo date("Y"); ?> UIU Canteen Ordering System. All rights reserved.</small>
                    </div>
                    <div class="col-md-6">
                        <small>Contact: contact@uiu-canteen.com | +880 1234 567890</small>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
