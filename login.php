<?php
session_start();
include 'connect.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Successful login
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email']; // Assuming you have an email column
            $_SESSION['role'] = $user['role']; // Assuming you have a role column

            // Set a cookie for the user email, valid for 1 day
            setcookie('user_email', $user['email'], time() + (86400 * 1), "/"); // 86400 = 1 day

            // Redirect to the profile page or based on user role
            if ($user['role'] === 'Admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: profile.php");
            }
            exit();
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "Username not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Login to your Account</h2>

        <?php if (isset($error_message)): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>

        <form method="post" action="" class="space-y-4">
            <div>
                <input type="text" name="username" placeholder="Username" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-purple-200 focus:border-purple-400">
            </div>
            <div>
                <input type="password" name="password" placeholder="Password" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-purple-200 focus:border-purple-400">
            </div>
            <button type="submit" name="login"
                class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 rounded-lg transition duration-200">Login</button>
        </form>

        <p class="text-center mt-4 text-gray-600">
            Don't have an account?
            <a href="register.php" class="text-purple-600 hover:text-purple-700 font-medium">Register here</a>
        </p>

        <!-- Back to Home Button -->
        <div class="text-center mt-4">
            <a href="index.php"
                class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded-lg font-medium transition duration-200">Back to Home</a>
        </div>
    </div>

</body>

</html>