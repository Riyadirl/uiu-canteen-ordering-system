<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            flex: 1;
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<!-- Your page content here -->

<footer class="bg-dark text-white py-2 fixed-bottom">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
