<?php

$Courses = [
    "Web Development",
    "Database Management",
    "Operating Systems",
    "Software Engineering",
    ["Computer Networks", "Data Structures", "Algorithms"],
];
foreach ($Courses as $k=>$v) {
    //Multidimensional array check
    if (is_array($v)) {
        foreach ($v as $sub_k => $sub_v) {
            echo "  - ".$sub_k . " : " . $sub_v . "<br>";
        }
    }else{
        echo $k ."  :  ".$v."<br>";
    }
}
?>
<!--Regestration Form-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task2</title>
</head>
<style>
    body{
        font-family: Arial, sans-serif;
        background-color: #e6f3f8ff;
        color: #333;
    }
    h2{
        text-align: center;
    }
    form{
        width: 300px;
        margin: auto;
        padding: 20px;
        border-radius: 5px;
        text-align: center;
        background-color: #00253dcc;
        color: white;
    }
</style>
<body>
    <h2>Regestration Form</h2>

    <form action="results.php" method="POST">
        <label for="name">Name</label><br>
        <input type="text" id="name" name="name" required>
        <br><br>

        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" required>
        <br><br>

        <label for="country">Country</label><br>
        <select id="country" name="country">
            <option value="Egypt">Egypt</option>
            <option value="Saudi Arbya">Saudi Arbya</option>
            <option value="United Arab Emirates">United Arab Emirates</option>
            <option value="Jordon">Jordon</option>
        </select>
        <br><br>

        <label>Gender</label><br>
        <input type="radio" id="male" name="gender" value="Male" checked>
        <label for="male">Male</label>
        <input type="radio" id="female" name="gender" value="Female">
        <label for="female">Female</label>
        <br><br>

        <label>Languages</label><br>
        <input type="checkbox" id="Arabic" name="languages[]" value="arabic">
        <label for="Arabic">Arabic</label><br>
        <input type="checkbox" id="English" name="languages[]" value="English">
        <label for="English">English</label><br>
        <input type="checkbox" id="Spanish" name="languages[]" value="Spanish">
        <label for="Spanish">Spanish</label><br>
        <br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>

