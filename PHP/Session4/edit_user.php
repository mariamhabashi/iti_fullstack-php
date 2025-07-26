<?php
// Define the JSON file path
$jsonFile = 'users.json';

// --- Helper functions (same as in users.php) ---
function getUsers($filename)
{
    if (!file_exists($filename)) {
        return [];
    }
    $jsonData = file_get_contents($filename);
    $users = json_decode($jsonData, true);
    return is_array($users) ? $users : [];
}

function saveUsers($filename, $users)
{
    $jsonData = json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents($filename, $jsonData);
}

// --- Logic starts here ---
$error = '';
$userToEdit = null;

// Get the original email from the URL to identify the user
if (!isset($_GET['email'])) {
    die("Error: No user specified for editing.");
}
$originalEmail = $_GET['email'];


// --- Handle form submission (POST request) to update the user ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the updated data from the form
    $updatedData = [
        'name' => trim($_POST['name']),
        'email' => trim($_POST['email']),
        'age' => trim($_POST['age']),
        'country' => trim($_POST['country']),
        'gender' => $_POST['gender'],
        'languages' => trim($_POST['languages'])
    ];

    // Get the original email from the hidden field
    $emailToFind = $_POST['original_email'];

    // Read all users
    $users = getUsers($jsonFile);

    // Find the user and update their data
    foreach ($users as $index => $user) {
        if ($user['email'] === $emailToFind) {
            // Keep the original password hash
            $updatedData['password_hash'] = $user['password_hash'];
            $users[$index] = $updatedData;
            break;
        }
    }

    // Save the updated array back to the file
    saveUsers($jsonFile, $users);

    // Redirect to the user list
    header('Location: users.php');
    exit;
}


// --- Find the user to display in the form (GET request) ---
$users = getUsers($jsonFile);
foreach ($users as $user) {
    if ($user['email'] === $originalEmail) {
        $userToEdit = $user;
        break;
    }
}

// If user not found, show an error
if ($userToEdit === null) {
    die("Error: User with email '{$originalEmail}' not found.");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 20px;
        }

        .container {
            max-width: 500px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #555;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .button {
            width: 100%;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            font-size: 16px;
            background-color: #007bff;
            /* Blue */
        }

        .button:hover {
            background-color: #0056b3;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Edit User: <?= htmlspecialchars($userToEdit['name']) ?></h1>

        <form method="post" action="edit_user.php?email=<?= urlencode($originalEmail) ?>">
            <!-- Hidden field to remember the original email, in case it gets changed -->
            <input type="hidden" name="original_email" value="<?= htmlspecialchars($userToEdit['email']) ?>">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($userToEdit['name']) ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($userToEdit['email']) ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" id="age" name="age" value="<?= htmlspecialchars($userToEdit['age']) ?>" required>
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" id="country" name="country" value="<?= htmlspecialchars($userToEdit['country']) ?>"
                    required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender" name="gender">
                    <option value="Male" <?= ($userToEdit['gender'] === 'Male') ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= ($userToEdit['gender'] === 'Female') ? 'selected' : '' ?>>Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="languages">Languages (comma-separated)</label>
                <input type="text" id="languages" name="languages"
                    value="<?= htmlspecialchars($userToEdit['languages']) ?>">
            </div>

            <button type="submit" class="button">Save Changes</button>
        </form>

        <a href="users.php" class="back-link">Back to User List</a>
    </div>

</body>

</html>