<?php
$jsonFile = 'users.json';

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
    $users = array_values($users);
    $jsonData = json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents($filename, $jsonData);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
    $users = getUsers($jsonFile);
    $originalEmail = $_POST['original_email'];

    foreach ($users as $index => $user) {
        if ($user['email'] === $originalEmail) {
            $imagePath = $user['profile_picture'];
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
                if (!empty($imagePath) && file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $newImageName = time() . '_' . basename($_FILES['profile_picture']['name']);
                $imagePath = 'uploads/' . $newImageName;
                move_uploaded_file($_FILES['profile_picture']['tmp_name'], $imagePath);
            }

            $users[$index]['name'] = $_POST['name'];
            $users[$index]['email'] = $_POST['email'];
            $users[$index]['age'] = $_POST['age'];
            $users[$index]['country'] = $_POST['country'];
            $users[$index]['languages'] = $_POST['languages'];
            $users[$index]['gender'] = $_POST['gender'];
            $users[$index]['profile_picture'] = $imagePath;
            break;
        }
    }
    saveUsers($jsonFile, $users);
    header('Location: users.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $users = getUsers($jsonFile);
    $emailToDelete = $_POST['email_to_delete'];

    foreach ($users as $user) {
        if ($user['email'] === $emailToDelete && !empty($user['profile_picture']) && file_exists($user['profile_picture'])) {
            unlink($user['profile_picture']);
            break;
        }
    }

    $users = array_filter($users, function ($user) use ($emailToDelete) {
        return $user['email'] !== $emailToDelete;
    });

    saveUsers($jsonFile, $users);
    header('Location: users.php');
    exit;
}

$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$userToEdit = null;

if ($action === 'edit' && isset($_GET['email'])) {
    $users = getUsers($jsonFile);
    $emailToFind = $_GET['email'];
    foreach ($users as $user) {
        if ($user['email'] === $emailToFind) {
            $userToEdit = $user;
            break;
        }
    }
} else {
    $users_list = getUsers($jsonFile);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ($action === 'edit' && $userToEdit) ? 'Edit User' : 'User Management' ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 20px;
        }

        .container {
            max-width: 1200px;
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

        .edit-button {
            background-color: #ffc107;
            margin-right: 5px;
        }

        .save-button {
            background-color: #28a745;
            width: 100%;
            padding: 12px;
            font-size: 16px;
            margin-top: 10px;
        }

        .actions form {
            display: inline;
        }

        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ddd;
        }

        .form-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }
    </style>
</head>

<body>

    <div class="container">

        <?php if ($action === 'edit' && $userToEdit): ?>
            <div class="form-container">
                <h1>Edit User: <?= $userToEdit['name'] ?></h1>
                <form method="post" action="users.php" enctype="multipart/form-data">
                    <input type="hidden" name="original_email" value="<?= $userToEdit['email'] ?>">

                    <div>
                        <label class="form-label">Current Picture:</label>
                        <img src="<?= $userToEdit['profile_picture'] ?: 'uploads/placeholder.png' ?>" alt="Profile Picture"
                            class="profile-pic">
                    </div>

                    <label for="profile_picture" class="form-label">Change Picture:</label>
                    <input type="file" id="profile_picture" name="profile_picture" class="form-input">

                    <label for="name" class="form-label">Name:</label>
                    <input type="text" id="name" name="name" class="form-input" value="<?= $userToEdit['name'] ?>" required>

                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-input" value="<?= $userToEdit['email'] ?>"
                        required>

                    <label for="age" class="form-label">Age:</label>
                    <input type="number" id="age" name="age" class="form-input" value="<?= $userToEdit['age'] ?>">

                    <label for="country" class="form-label">Country:</label>
                    <input type="text" id="country" name="country" class="form-input" value="<?= $userToEdit['country'] ?>">

                    <label for="languages" class="form-label">Languages:</label>
                    <input type="text" id="languages" name="languages" class="form-input"
                        value="<?= $userToEdit['languages'] ?>">

                    <label for="gender" class="form-label">Gender:</label>
                    <input type="text" id="gender" name="gender" class="form-input" value="<?= $userToEdit['gender'] ?>">

                    <button type="submit" name="update_user" class="button save-button">Save Changes</button>
                    <a href="users.php" style="display: block; text-align: center; margin-top: 10px;">Cancel</a>
                </form>
            </div>
        <?php else: ?>
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
                            <td colspan="8" style="text-align: center;">No users to display.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($users_list as $user): ?>
                            <tr>
                                <td>
                                    <?php
                                    $imagePath = 'uploads/placeholder.png';
                                    if (!empty($user['profile_picture']) && file_exists($user['profile_picture'])) {
                                        $imagePath = $user['profile_picture'];
                                    }
                                    ?>
                                    <img src="<?= $imagePath ?>" alt="Profile Picture" class="profile-pic">
                                </td>
                                <td><?= $user['name'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td><?= $user['age'] ?></td>
                                <td><?= $user['country'] ?></td>
                                <td><?= $user['languages'] ?></td>
                                <td><?= $user['gender'] ?></td>
                                <td class="actions">
                                    <a href="users.php?action=edit&email=<?= urlencode($user['email']) ?>"
                                        class="button edit-button">Edit</a>
                                    <form method="post" action="users.php"
                                        onsubmit="return confirm('Are you sure you want to delete this user? This will also delete their profile picture.');"
                                        style="display: inline;">
                                        <input type="hidden" name="email_to_delete" value="<?= $user['email'] ?>">
                                        <button type="submit" name="delete_user" class="button delete-button">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endif; ?>

    </div>
</body>

</html>