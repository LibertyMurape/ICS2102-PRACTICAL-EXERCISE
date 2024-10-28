<?php
session_start(); // Start the session to access session variables
include 'connect.php'; // Ensure this file correctly establishes a database connection

// Check if the user is logged in and has admin privileges
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php"); // Redirect to login if not an admin
    exit();
}

// Retrieve all users from the database
$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen font-sans">

    <!-- Navbar -->
    <nav class="bg-blue-600 text-white p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-semibold">Admin Dashboard</h1>
            <a href="logout.php" class="bg-blue-500 hover:bg-blue-700 px-3 py-1 rounded transition duration-200">Logout</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto mt-8 p-4">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-semibold mb-6 border-b-2 pb-3 border-gray-200">Manage Users</h2>

            <!-- Display success or error messages -->
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4"><?php echo htmlspecialchars($_SESSION['success_message']);
                                                                            unset($_SESSION['success_message']); ?></div>
            <?php endif; ?>
            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4"><?php echo htmlspecialchars($_SESSION['error_message']);
                                                                        unset($_SESSION['error_message']); ?></div>
            <?php endif; ?>

            <!-- Users Table -->
            <table class="min-w-full bg-white border rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="p-4 text-left font-semibold">Username</th>
                        <th class="p-4 text-left font-semibold">Email</th>
                        <th class="p-4 text-left font-semibold">Role</th>
                        <th class="p-4 text-left font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <?php foreach ($users as $user): ?>
                        <tr class="border-b hover:bg-gray-50 transition duration-150">
                            <td class="p-4"><?php echo htmlspecialchars($user['username']); ?></td>
                            <td class="p-4"><?php echo htmlspecialchars($user['email']); ?></td>
                            <td class="p-4"><?php echo htmlspecialchars($user['role']); ?></td>
                            <td class="p-4">
                                <a href="edit_user.php?username=<?php echo urlencode($user['username']); ?>" class="text-blue-600 hover:text-blue-800 font-semibold mr-3">Edit</a>
                                <a href="delete_user.php?username=<?php echo urlencode($user['username']); ?>" onclick="return confirm('Are you sure you want to delete this user?');" class="text-red-600 hover:text-red-800 font-semibold">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>