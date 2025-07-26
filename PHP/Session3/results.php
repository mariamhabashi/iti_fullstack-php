<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Results</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #e6f3f8ff; padding: 20px; }
        .container { background-color: white; padding: 20px; border-radius: 5px; max-width: 600px; margin: auto; }
        h1 { color: #00253d; }
    </style>
</head>
<body>

<div class="container">
    <?php
    if (!empty($_GET)) {
        echo "<h1>Registration Successful!</h1>";
        echo "<p>Here is the data you submitted:</p>";
        echo "<pre>";
        print_r($_GET);
        echo "</pre>";

    } else {
        echo "<h1>No Data Received</h1>";
        echo "<p>Please fill out the form first.</p>";
    }
    ?>
    <a href="task.php">Go back to the form</a>
</div>

</body>
</html>