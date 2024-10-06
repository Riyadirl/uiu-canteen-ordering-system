<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<nav class="navbar navbar-expand-lg fixed-top" id="mainNav" style="background-color: chocolate;">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="dashboard.php">UIU Canteen</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                ->
                <li class="nav-item">
                    <a class="nav-link text-white" href="dashboard.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="add_food.php">Add Food</a>
                </li>

               
                <li class="nav-item">
                    <a class="nav-link text-white" href="about.php">About Us</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="profile.php">Profile</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="logout.php" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<style>
    body {
        padding-top: 56px;
    }

    .navbar {
        background-color: chocolate;
        transition: background-color 0.3s ease;
    }


    .navbar:hover {
        background-color: #cc3700;
    }

    .navbar-nav .nav-link {
        transition: color 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
        color: #ffd700;
    }

    .navbar-brand:hover {
        color: #ffd700;
    }

    .navbar-nav .nav-link i:hover {
        color: #ffd700;
    }
</style>