<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background: linear-gradient(to right, #7f5fdc, #b794f4);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding-bottom: 20px;
        }

        .registration-form {
            width: 100%;
            max-width: 400px;
            background: #fff;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
            margin-top: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(138, 95, 207, 0.4);
            width: 100%;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5a3db2, #6a47a7);
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(90, 61, 178, 0.4);
        }

        .alert {
            background-color: #e63946;
            color: #fff;
            padding: 0.5rem;
            border-radius: 8px;
            text-align: center;
            margin-top: 1rem;
        }

        .bottom-text {
            font-size: 0.9rem;
            color: #6a47a7;
            margin-top: auto;
            text-align: center;
            padding-top: 1rem;
        }

        .login-link {
            display: inline-block;
            background: linear-gradient(135deg, #6a47a7, #8a5fcf);
            color: white;
            font-weight: bold;
            padding: 0.6rem 1.2rem;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(138, 95, 207, 0.4);
            margin-top: 0.5rem;
        }

        .login-link:hover {
            background: linear-gradient(135deg, #5a3db2, #6a47a7);
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(90, 61, 178, 0.4);
        }
    </style>
</head>

<body>
    <div class="container">
        <form method="post" action="" class="p-4 shadow rounded registration-form">
            <h1 class="text-center mb-4">Create An Account</h1>
            <div class="mb-3">
                <input type="text" name="username" placeholder="Enter the Username" class="form-control" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" placeholder="Enter your Email" class="form-control" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" placeholder="Enter your Password" class="form-control" required>
            </div>
            <div class="mb-3">
                <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Select Role:</label>
                <select name="role" class="form-control" required>
                    <option value="General User">User</option>
                    <option value="Admin">Admin</option>
                </select>
            </div>
            <?php if (!empty($error_message)): ?>
                <div class="alert"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <button type="submit" name="register" class="btn btn-primary">Register</button>
        </form>

        <!-- "Already have an account?" text and login button at the bottom -->
        <div class="bottom-text">
            Already have an account? <a href="login.php" class="login-link">Login here</a>
        </div>
    </div>
</body>

</html>