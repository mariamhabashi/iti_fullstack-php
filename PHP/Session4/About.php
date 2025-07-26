<?php
session_start();
$messages = [];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
</head>
<style>
    /* --- General Body and Fonts --- */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f0f4f8;
        color: #333;
        margin: 0;
        padding: 0;
    }

    /* --- Main Container --- */
    .container {
        max-width: 800px;
        margin: 30px auto;
        padding: 20px;
    }

    /* --- Header Section --- */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #fff;
        padding: 15px 30px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
    }

    .page-header h1 {
        margin: 0;
        color: #00253d;
        font-size: 24px;
    }

    /* --- Content Box for Text and Forms --- */
    .content-box {
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
        text-align: left;
    }

    .content-box p {
        font-size: 18px;
        line-height: 1.6;
        color: #555;
    }

    .content-box h5 {
        font-size: 18px;
        color: #007bff;
        /* Changed to a more professional blue */
        font-weight: bold;
        margin-top: 20px;
    }

    /* --- Buttons (Logout and Upload) --- */
    .btn {
        display: inline-block;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        color: white;
        font-weight: bold;
        cursor: pointer;
        border: none;
        transition: background-color 0.3s, transform 0.2s;
    }

    .btn-logout {
        background-color: #dc3545;
        /* Red for logout/danger actions */
    }

    .btn-logout:hover {
        background-color: #c82333;
        transform: translateY(-2px);
    }


    /* --- Messages Area --- */
    .messages {
        padding: 15px;
        margin-top: 20px;
        border-radius: 5px;
        background-color: #e9ecef;
        border: 1px solid #ced4da;
        text-align: left;
    }

    .messages p {
        margin: 0;
        font-size: 16px;
        color: #0056b3;
    }
</style>

<body>
    <div class="container">
        <!-- 1. Header with Welcome Message and Logout Button -->
        <header class="page-header">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['logged_in_user'] ?? 'Guest'); ?>!</h1>
            <a href="logout.php" class="btn btn-logout">Logout</a>
        </header>

        <!-- 2. Main Content -->
        <div class="content-box">
            <h2>Who we are?</h2>
            <p>We are a team of developers who are passionate about creating innovative solutions for our clients.</p>
            <p>Our mission is to help our clients achieve their goals and grow their businesses.</p>
            <p>Whether you're a startup or an established business, we have the skills and experience to help you
                succeed.</p>
            <h5>ITI PortSaid Trainees</h5>
        </div>
    </div>
</body>

</html>