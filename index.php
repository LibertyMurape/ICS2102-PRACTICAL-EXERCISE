<?php
// Initialize error message variable
$error_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

    // Basic validation
    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        $error_message = "Registration successful!"; // Change this as per your logic
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #7f5fdc, #b794f4);
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .registration-box {
            width: 100%;
            max-width: 400px;
            padding: 2.5rem;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        h1 {
            color: #4c2882;
            font-weight: bold;
        }

        .form-control {
            border-radius: 8px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #6a47a7, #8a5fcf);
            border: none;
            color: white;
            font-weight: bold;
            border-radius: 25px;
            padding: 0.75rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(138, 95, 207, 0.4);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5a3db2, #6a47a7);
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(90, 61, 178, 0.4);
        }

        .text-danger {
            color: #e63946;
        }

        .back-to-home {
            display: inline-block;
            color: #fff;
            background: linear-gradient(135deg, #b794f4, #7f5fdc);
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.3s ease, transform 0.2s;
            box-shadow: 0 4px 8px rgba(127, 95, 220, 0.3);
        }

        .back-to-home:hover {
            background: linear-gradient(135deg, #7f5fdc, #4c2882);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(76, 40, 130, 0.3);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="registration-box">
            <form method="post" action="">
                <h1 class="text-center mb-4">Register</h1>
                <div class="mb-3">
                    <input type="text" name="username" placeholder="Username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" placeholder="Email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" placeholder="Password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Select Role:</label>
                    <select name="role" class="form-control" required>
                        <option value="General User">General User</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>
                <?php if (!empty($error_message)): ?>
                    <div class="text-danger text-center mb-3"><?php echo $error_message; ?></div>
                <?php endif; ?>
                <button type="submit" name="register" class="btn btn-primary w-100">Register</button>
            </form>
            <p class="text-center mt-3">Already have an account? <a href="login.php" class="link-primary">Login here</a></p>
            <div class="text-center mt-4">
                <a href="index.php" class="back-to-home">Back to Home</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>