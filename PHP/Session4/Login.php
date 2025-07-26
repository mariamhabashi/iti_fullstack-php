<?php
session_start();
$email = '';
$login_error = '';
$email_error = '';
$password_error = '';

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($email)) {
        $email_error = "Email is required";
    }
    if (empty($password)) {
        $password_error = "Password is required";
    }

    if (empty($email_error) && empty($password_error)) {
        if ($email == "admin177@gmail.com" && $password == "admin123##") {
            header('Location: users.php');
            exit();
        } else {
            $file_path = 'users.json';
            $user_found = false;
            if (file_exists($file_path)) {

                $json_data = file_get_contents($file_path);
                $users = json_decode($json_data, true);

                if (is_array($users)) {
                    foreach ($users as $user) {

                        if (isset($user['email']) && $user['email'] === $email && password_verify($password, $user['password_hash'])) {

                            $_SESSION['logged_in_user'] = $user['name'];
                            $user_found = true;
                            break;
                        }
                    }
                }
            }

            if ($user_found) {
                header('Location: About.php');
                exit();
            } else {
                $login_error = "Invalid email or password.";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* --- General Body and Fonts --- */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        h2 {
            text-align: center;
            color: #00253d;
            margin-bottom: 20px;
        }

        /* --- The Form Container --- */
        form {
            width: 350px;
            margin: 0;
            padding: 30px;
            border-radius: 8px;
            background-color: #ffffff;
            color: #333;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        /* --- Form Grouping --- */
        .form-group {
            margin-bottom: 20px;
        }

        /* --- Labels --- */
        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        /* --- Input Fields (Text, Email, Password, etc.) --- */
        input[type="email"],
        input[type="password"] {
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

        /* --- Style for when an input is active (in focus) --- */
        input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        }

        /* --- Error Message Span --- */
        .error-message {
            color: #dc3545;
            font-weight: bold;
            font-size: 0.9em;
            display: block;
            margin-top: 5px;
        }

        .login-error {
            text-align: center;
            padding: 10px;
            background-color: rgba(220, 53, 69, 0.1);
            border: 1px solid #dc3545;
            border-radius: 4px;
            color: #dc3545;
            margin-bottom: 20px;
        }

        /* --- Submit Button --- */
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

        /* --- Button Hover Effect --- */
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <form action="Login.php" method="POST">
        <h2>Login</h2>

        <!-- General Login Error (if any) -->
        <?php if ($login_error): ?>
            <p class="login-error"><?php echo $login_error; ?></p>
        <?php endif; ?>

        <!-- Email Field -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <?php if ($email_error) {
                echo '<span class="error-message">' . $email_error . '</span>';
            } ?>
        </div>

        <!-- Password Field -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" value="">
            <?php if ($password_error) {
                echo '<span class="error-message">' . $password_error . '</span>';
            } ?>
        </div>

        <!-- Submit Button -->
        <button type="submit" name="login">Login</button>
        <p style="color: #555;">Don't have an account? <a href="register.php">Register</a></p>
    </form>

</body>

</html>