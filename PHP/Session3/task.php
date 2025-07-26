<?php

    $name_error = $email_error = $age_error = $languages_error =$userData = '';
    $name = $email = $age = $country = $gender = '';
    $languages = [];

    if (isset($_POST['register'])){
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);
            $country = $_POST['country'] ?? '';
            $gender = $_POST['gender'] ?? '';
            $languages = $_POST['languages'] ?? [];
            $languages_string = implode(", ", $languages);

            if (empty($name)){
                $name_error = "Name is required";
            }elseif (!preg_match("/^[a-zA-Z ]*$/", $_POST['name'])) {
                $name_error = "Only letters and white space are allowed.";
            }
            if (empty($email)){
                $email_error = "Email is required";
            }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_error = "Invalid email format";
            }
            if (empty($age)){
                $age_error = "Age is required";
            }elseif (!filter_var($age, FILTER_VALIDATE_INT)) {
                $age_error = "Invalid age format";
            }
            if (empty($languages)){
                $languages_error = "Languages is required";
            }
    }



if (empty($name_error) && empty($email_error) && empty($age_error) && empty($languages_error)) {
        $languages_string = implode(', ', $languages);
        $userData = [
            'Name' => $name,
            'Email' => $email,
            'Age' => $age,
            'Country' => $country,
            'Gender' => $gender,
            'Languages' => $languages_string
        ];

                $queryString = http_build_query($userData);
                header('Location: results.php?' . $queryString);
                exit(); 

}
//1
echo "String Functions" . "<br>";
$string = "Mariam";
echo "Length: " . strlen($string) . "<br>";
//2
echo str_ireplace("WORLD", "Mariam", "Hello world!") . "<br>";
//3
echo str_ireplace("world", "Mariam", "Hello world!") . "<br>";
//4
$str = "(Mariam) is a student" . "<br>";
echo quotemeta($str);
//5
parse_str("name=Mariam&age=22", $stuData);
print_r($stuData);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task2</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #e6f3f8ff;
        color: #333;
    }

    h2 {
        text-align: center;
    }

    form {
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

    <form action="task.php" method="POST">
        <label for="name">Name</label><br>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" ><br><?php $name_error ? print('<span style="color:red; font-weight: bold">' . $name_error . '</span>') : ''; ?>
        <br><br>

        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br><?php $email_error ? print('<span style="color:red; font-weight: bold">' . $email_error . '</span>') : ''; ?>
        <br><br>

        <label for="age">Age</label><br>
        <input type="number" id="age" name="age" value="<?php echo $age; ?>"><br><?php $age_error ? print('<span style="color:red; font-weight: bold">' . $age_error . '</span>') : ''; ?>
        <br><br>

        <label for="country">Country</label><br>
        <select id="country" name="country">
            <option value="Egypt" <?php if ($country == 'Egypt') echo 'selected'; ?>>Egypt</option>
            <option value="Saudi Arbya" <?php if ($country == 'Saudi Arbya') echo 'selected'; ?>>Saudi Arbya</option>
            <option value="United Arab Emirates" <?php if ($country == 'United Arab Emirates') echo 'selected'; ?>>United Arab Emirates</option>
            <option value="Jordon" <?php if ($country == 'Jordon') echo 'selected'; ?>>Jordon</option>
        </select>
        <br><br>

        <label>Gender</label><br>
        <input type="radio" name="gender" value="Male" <?php if ($gender == 'Male') echo 'checked'; ?>>
        <label for="male">Male</label>
        <input type="radio" name="gender" value="Female" <?php if ($gender == 'Female') echo 'checked'; ?>>
        <label for="female">Female</label>
        <br><br>

        <label>Languages</label><br>
        <input type="checkbox" id="Arabic" name="languages[]" value="arabic" <?php if (in_array('arabic', $languages)) echo 'checked'; ?>>
        <label for="Arabic">Arabic</label><br>
        <input type="checkbox" id="English" name="languages[]" value="english" <?php if (in_array('english', $languages)) echo 'checked'; ?>>
        <label for="English">English</label><br>
        <input type="checkbox" id="Spanish" name="languages[]" value="spanish" <?php if (in_array('spanish', $languages)) echo 'checked'; ?>>
        <label for="Spanish">Spanish</label><br>
        <br>
            <?php $languages_error ? print('<span style="color:red; font-weight: bold">' . $languages_error . '</span>') : ''; ?>
        <br>

        <button type="submit" name="register" >Register</button>
    </form>
    
</body>

</html>