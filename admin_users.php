<?php
session_start();
include 'connect.php'; // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Check if the user has admin privileges
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    echo "<p>You do not have permission to access this page.</p>";
    exit();
}

// Retrieve all user information from the database
$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.tailwindcss.com"></script> <!-- Include Tailwind CSS -->
</head>

<body class="bg-gray-100 min-h-screen font-sans">
    <div class="container mx-auto mt-8 p-4">
        <h1 class="text-2xl font-semibold mb-4">All Users</h1>
        <table class="min-w-full bg-white border rounded-lg shadow-lg">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="p-4 text-left font-semibold">Username</th>
                    <th class="p-4 text-left font-semibold">Email</th>
                    <th class="p-4 text-left font-semibold">Role</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                <?php while ($user = $result->fetch_assoc()): ?>
                    <tr class="border-b hover:bg-gray-50 transition duration-150">
                        <td class="p-4"><?php echo htmlspecialchars($user['username']); ?></td>
                        <td class="p-4"><?php echo htmlspecialchars($user['email']); ?></td>
                        <td class="p-4"><?php echo htmlspecialchars($user['role']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="profile.php" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded transition duration-200">Back to Profile</a>
    </div>
</body>

</html>