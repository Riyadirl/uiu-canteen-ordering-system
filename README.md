
# UIU Canteen Ordering System

A university-based canteen ordering and delivery system using PHP and MySQL.

## Requirements
- **XAMPP** or similar local server environment
- **PHP 7.x** or above
- **MySQL** (included in XAMPP)

## Installation Guide

Follow the steps below to set up and run the UIU Canteen Ordering System on your local machine:

### 1. Install XAMPP
1. Download and install [XAMPP](https://www.apachefriends.org/index.html).
   - XAMPP provides Apache (for running PHP) and MySQL (for the database).
   
### 2. Clone or Download the Repository
1. Clone this repository or download it as a ZIP file:
   ```bash
   git clone https://github.com/Riyadirl/uiu-canteen-ordering-system.git
   ```
2. Move the project folder `uiu-canteen-ordering-system` to the `htdocs` directory inside your XAMPP installation. The usual path is:
   ```
   C:\xampp\htdocs\
   ```

### 3. Import the Database
1. Open **phpMyAdmin** by going to `http://localhost/phpmyadmin/` in your web browser.
2. Create a new database named `uiucos`.
3. Import the SQL file included in the project:
   1. Click the **Import** tab in phpMyAdmin.
   2. Click **Choose File** and select the `uiucos.sql` file from the `database` folder in the project (or export it from your local machine if not included).
   3. Click **Go** to import the database.

### 4. Update Database Configuration
1. Open the `config/config.php` file in the project directory.
2. Ensure the database configuration is correct for your environment:
   ```php
   $db_host = 'localhost';   // Usually 'localhost'
   $db_user = 'root';        // Default MySQL user in XAMPP
   $db_pass = '';            // Default MySQL password (empty for XAMPP)
   $db_name = 'uiucos';      // Name of the database created in phpMyAdmin
   ```

### 5. Start XAMPP
1. Open the **XAMPP Control Panel**.
2. Start the **Apache** and **MySQL** services.

### 6. Access the Application
1. Open a browser and go to:
   ```
   http://localhost/uiu-canteen-ordering-system/
   ```
2. You should now see the landing page of the UIU Canteen Ordering System.

### 7. File Permissions
- Ensure the `uploads` directory (or any directory that handles file uploads) has the correct write permissions, especially if you are uploading images or files.

## Features
- User registration and authentication
- Canteen owner management
- Food item ordering and tracking
- Delivery management system
- Admin dashboard for system management

