<?php
session_start();

$name_error = $email_error = $age_error = $languages_error = $password_error = $file_error = '';
$name = $email = $age = $country = $gender = $password = $profile_picture_path = '';
$languages = [];

if (isset($_POST['register'])) {

    // --- 3. Validate form fields ---
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);
    $country = $_POST['country'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $languages = $_POST['languages'] ?? [];

    if (empty($name)) {
        $name_error = "Name is required";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $name_error = "Only letters and white space are allowed.";
    }
    if (empty($email)) {
        $email_error = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format";
    }
    if (empty($age)) {
        $age_error = "Age is required";
    } elseif (!filter_var($age, FILTER_VALIDATE_INT)) {
        $age_error = "Invalid age format";
    }
    if (empty($languages)) {
        $languages_error = "At least one language is required";
    }
    if (empty($password)) {
        $password_error = "Password is required";
    }
    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . uniqid() . '-' . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allow certain file formats
        if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            $file_error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $profile_picture_path = $target_file; // Save the path for JSON
            } else {
                $file_error = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        $file_error = "Profile picture is required.";
    }

    if (empty($name_error) && empty($email_error) && empty($password_error) && empty($age_error) && empty($languages_error) && empty($file_error)) {

        $file_path = 'users.json';
        $users = file_exists($file_path) ? json_decode(file_get_contents($file_path), true) : [];

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $languages_string = implode(", ", $languages);

        $new_user = [
            'name' => $name,
            'email' => $email,
            'password_hash' => $hashed_password,
            'age' => $age,
            'country' => $country,
            'gender' => $gender,
            'languages' => $languages_string,
            'profile_picture' => $profile_picture_path
        ];

        $users[] = $new_user;
        file_put_contents($file_path, json_encode($users, JSON_PRETTY_PRINT));

        // Redirect to login or another page
        header('Location: login.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration System</title>
    <style>
        /* Your CSS remains the same, it's already good */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #00253d;
        }

        form {
            width: 350px;
            margin: 20px auto;
            padding: 30px;
            border-radius: 8px;
            background-color: #ffffff;
            color: #333;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .form-group {
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        select,
        input[type="file"] {
            width: 100%;
            padding: 12px;
            margin: 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f8f9fa;
            color: #333;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        }

        .options-group label {
            font-weight: normal;
        }

        .option-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .option-item input {
            margin-right: 10px;
        }

        .error-message {
            color: #dc3545;
            font-weight: bold;
            font-size: 0.9em;
            display: block;
            margin-top: 5px;
        }

        button[type="submit"] {
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 14px 20px;
            margin-top: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .upload-section {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
    </style>
</head>

<body>
    <h2>Registration Form</h2>

    <!-- The ONE and ONLY form -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">

        <!-- Name Field -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
            <?php if ($name_error)
                echo '<span class="error-message">' . $name_error . '</span>'; ?>
        </div>

        <!-- Email Field -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <?php if ($email_error)
                echo '<span class="error-message">' . $email_error . '</span>'; ?>
        </div>

        <!-- Password Field -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            <?php if ($password_error)
                echo '<span class="error-message">' . $password_error . '</span>'; ?>
        </div>

        <!-- Age Field -->
        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($age); ?>">
            <?php if ($age_error)
                echo '<span class="error-message">' . $age_error . '</span>'; ?>
        </div>

        <!-- Country Field -->
        <div class="form-group">
            <label for="country">Country</label>
            <select id="country" name="country">
                <option value="Egypt" <?php if ($country == 'Egypt')
                    echo 'selected'; ?>>Egypt</option>
                <option value="Saudi Arbya" <?php if ($country == 'Saudi Arbya')
                    echo 'selected'; ?>>Saudi Arabia</option>
                <option value="United Arab Emirates" <?php if ($country == 'United Arab Emirates')
                    echo 'selected'; ?>>
                    United Arab Emirates</option>
                <option value="Jordan" <?php if ($country == 'Jordan')
                    echo 'selected'; ?>>Jordan</option>
            </select>
        </div>

        <!-- Gender Field -->
        <div class="form-group options-group">
            <label>Gender</label>
            <div class="option-item">
                <input type="radio" id="male" name="gender" value="Male" <?php if ($gender == 'Male' || empty($gender))
                    echo 'checked'; ?>>
                <label for="male">Male</label>
            </div>
            <div class="option-item">
                <input type="radio" id="female" name="gender" value="Female" <?php if ($gender == 'Female')
                    echo 'checked'; ?>>
                <label for="female">Female</label>
            </div>
        </div>

        <!-- Languages Field -->
        <div class="form-group options-group">
            <label>Languages</label>
            <div class="option-item">
                <input type="checkbox" id="Arabic" name="languages[]" value="arabic" <?php if (in_array('arabic', $languages))
                    echo 'checked'; ?>>
                <label for="Arabic">Arabic</label>
            </div>
            <div class="option-item">
                <input type="checkbox" id="English" name="languages[]" value="english" <?php if (in_array('english', $languages))
                    echo 'checked'; ?>>
                <label for="English">English</label>
            </div>
            <div class="option-item">
                <input type="checkbox" id="Spanish" name="languages[]" value="spanish" <?php if (in_array('spanish', $languages))
                    echo 'checked'; ?>>
                <label for="Spanish">Spanish</label>
            </div>
            <?php if ($languages_error)
                echo '<span class="error-message">' . $languages_error . '</span>'; ?>
        </div>

        <!-- File Upload Section (Now inside the main form) -->
        <div class="form-group upload-section">
            <label for="fileToUpload">Profile Picture</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <?php if ($file_error)
                echo '<span class="error-message">' . $file_error . '</span>'; ?>
        </div>

        <!-- The only Submit Button -->
        <button type="submit" name="register">Register</button>
    </form>
</body>

</html>