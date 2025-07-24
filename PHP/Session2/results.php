<?php
// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";
    $name= htmlspecialchars($_POST['name']);
    $email= htmlspecialchars($_POST['email']);
    $country= htmlspecialchars($_POST['country']);
    $gender= htmlspecialchars($_POST['gender']);

    echo "<p><strong>Name:</strong> " . $name . "</p>";
    echo "<p><strong>Email:</strong> " . $email . "</p>";
    echo "<p><strong>Country:</strong> " . $country . "</p>";
    echo "<p><strong>Gender:</strong> " . $gender . "</p>";

    if (isset($_POST['languages']) && !empty($_POST['languages'])) {
        $languages = $_POST['languages'];
        echo "<p><strong>Languages:</strong></p>";
        
        echo "<ul>";
        
        foreach ($languages as $language) {
            echo "<li>" . htmlspecialchars($language) . "</li>";
        }
        
        echo "</ul>";
        
    } else {
    
        echo "<p><strong>Languages:</strong> None selected.</p>";
    }
    ?>
<style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
   body {
        font-family: Arial, sans-serif;
        background-color: #ece0d0ff;
        color: #333;
        
    }
    h2{
        text-align: center;
        
    }
</style>
<body>
    <h2>Welcome To login page</h2>
</body>
</html>
 
