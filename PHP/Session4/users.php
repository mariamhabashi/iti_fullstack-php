<?php
// Define the JSON file path
$jsonFile = 'users.json';

/**
 * Reads users from the JSON file.
 * @param string $filename
 * @return array
 */
function getUsers($filename)
{
    if (!file_exists($filename)) {
        return [];
    }
    $jsonData = file_get_contents($filename);
    $users = json_decode($jsonData, true);
    return is_array($users) ? $users : [];
}

/**
 * Saves the users array to the JSON file.
 * @param string $filename
 * @param array $users
 */
function saveUsers($filename, $users)
{
    $jsonData = json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents($filename, $jsonData);
}

// Handle the delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $emailToDelete = $_POST['email_to_delete'];

    // 1. Read the current users
    $users = getUsers($jsonFile);

    // Find the user to get the image path before deleting
    foreach ($users as $user) {
        if ($user['email'] === $emailToDelete && !empty($user['profile_picture']) && file_exists($user['profile_picture'])) {
            unlink($user['profile_picture']); // Delete the associated image file
            break;
        }
    }

    // 2. Filter out the user to be deleted from the array
    $users = array_filter($users, function ($user) use ($emailToDelete) {
        return $user['email'] !== $emailToDelete;
    });

    // 3. Re-index the array to prevent JSON issues
    $users = array_values($users);

    // 4. Save the updated array back to the file
    saveUsers($jsonFile, $users);

    // 5. Redirect to the same page to prevent form resubmission
    header('Location: users.php');
    exit;
}

// Get all users to display in the table
$users_list = getUsers($jsonFile);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 20px;
        }

        .container {
            max-width: 1200px;
            /* Increased width for new column */
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
            vertical-align: middle;
            /* Aligns content vertically */
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .actions {
            text-align: center;
            white-space: nowrap;
            /* Prevents buttons from wrapping */
        }

        .button {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
        }

        .add-button {
            background-color: #28a745;
            float: right;
            margin-bottom: 20px;
        }

        .delete-button {
            background-color: #dc3545;
        }

        .delete-button:hover {
            background-color: #c82333;
        }

        .add-button:hover {
            background-color: #218838;
        }

        .edit-button {
            background-color: #ffc107;
            margin-right: 5px;
        }

        .edit-button:hover {
            background-color: #e0a800;
        }

        .actions form {
            display: inline;
        }

        /* Style for the profile picture in the table */
        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            /* Makes the image circular */
            object-fit: cover;
            /* Prevents the image from being stretched */
            border: 2px solid #ddd;
            margin-left: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>User List</h1>

        <a href="register.php" class="button add-button">Add New User</a>

        <table>
            <thead>
                <tr>
                    <th>Profile Picture</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Country</th>
                    <th>Languages</th>
                    <th>Gender</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users_list)): ?>
                    <tr>
                        <!-- Updated colspan to 8 for the new column -->
                        <td colspan="8" style="text-align: center;">No users to display.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users_list as $user): ?>
                        <tr>
                            <td>
                                <?php
                                // Set a default placeholder image
                                $imagePath = 'uploads/placeholder.png';
                                // Check if the user has a picture and if the file exists
                                if (!empty($user['profile_picture']) && file_exists($user['profile_picture'])) {
                                    $imagePath = $user['profile_picture'];
                                }
                                ?>
                                <img src="<?= htmlspecialchars($imagePath) ?>" alt="Profile Picture" class="profile-pic">
                            </td>
                            <td><?= htmlspecialchars($user['name']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['age']) ?></td>
                            <td><?= htmlspecialchars($user['country']) ?></td>
                            <td><?= htmlspecialchars($user['languages']) ?></td>
                            <td><?= htmlspecialchars($user['gender']) ?></td>
                            <td class="actions">
                                <!-- Edit Button -->
                                <a href="edit_user.php?email=<?= urlencode($user['email']) ?>"
                                    class="button edit-button">Edit</a>

                                <!-- Delete Form -->
                                <form method="post" action="users.php"
                                    onsubmit="return confirm('Are you sure you want to delete this user? This will also delete their profile picture.');"
                                    style="display: inline;">
                                    <input type="hidden" name="email_to_delete" value="<?= htmlspecialchars($user['email']) ?>">
                                    <button type="submit" name="delete_user" class="button delete-button">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>

</html>