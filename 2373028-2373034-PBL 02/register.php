<?php
include 'config.php';

$error = '';
$success = '';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['fullname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    // Validasi input
    if (empty($name) || empty($username) || empty($email) || empty($password)) {
        $error = 'Semua field harus diisi!';
    } else {
        // Cek apakah user sudah ada
        $check_user = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' OR username = '$username'") or die('Query failed');

        if (mysqli_num_rows($check_user) > 0) {
            $error = 'Username atau email sudah digunakan!';
        } else {
            // Hash password dan simpan ke database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            $insert_query = "INSERT INTO users (fullname, username, email, password, user_type) 
                        VALUES ('$name', '$username', '$email', '$hashed_password', '$user_type')";
            
            $result = mysqli_query($conn, $insert_query);
            
            if ($result) {
                $success = 'Registrasi berhasil! Silakan login.';
                // Optional: redirect ke login page setelah beberapa detik
                // header("refresh:2;url=loginRegister.php");
            } else {
                $error = 'Registrasi gagal. Silakan coba lagi.';
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
    <title>Register - PaperNest</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f5f1;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .registerContainer {
            position: relative;
            background-color: white;
            padding: 2.5rem 2rem 3rem;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            text-align: center;
        }

        .closeButton {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 20px;
            color: #999;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.2s ease;
        }

        .closeButton:hover {
            color: #e74c3c;
        }

        .brand {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .brand .paper {
            background-color: #2c3e50;
            color: white;
            padding: 0 6px;
            border-radius: 4px;
        }

        .brand .nest {
            color: #e74c3c;
            margin-left: 4px;
        }

        h2 {
            font-size: 20px;
            margin-bottom: 1.5rem;
            color: #e74c3c;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            border: 1px solid #f5c6cb;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            border: 1px solid #c3e6cb;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 12px 14px;
            margin-top: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: border 0.2s;
        }

        input:focus,
        select:focus {
            border-color: #e74c3c;
            outline: none;
        }

        button {
            width: 100%;
            margin-top: 20px;
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        button:hover {
            background-color: #c0392b;
        }

        .loginLink {
            margin-top: 1.2rem;
            display: block;
            font-size: 0.95rem;
            color: #333;
            text-decoration: none;
        }

        .loginLink:hover {
            color: #e74c3c;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="registerContainer">
        <a href="loginRegister.php" class="closeButton">&times;</a>
        <div class="brand">
            <span class="paper">Paper</span><span class="nest">Nest</span>
        </div>
        <h2>Create Your Account</h2>
        
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <input type="text" name="fullname" placeholder="Full Name" required value="<?php echo isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : ''; ?>">
            
            <input type="text" name="username" placeholder="Username" required value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
            
            <input type="email" name="email" placeholder="Email Address" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            
            <input type="password" name="password" placeholder="Password" required>
            
            <select name="user_type" required>
                <option value="">Select User Type</option>
                <option value="user" <?php echo (isset($_POST['user_type']) && $_POST['user_type'] == 'user') ? 'selected' : ''; ?>>User</option>
                <option value="admin" <?php echo (isset($_POST['user_type']) && $_POST['user_type'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
            </select>
            
            <button type="submit" name="submit">Register</button>
        </form>
        
        <a class="loginLink" href="loginRegister.php">Already have an account? Login here</a>
    </div>
</body>
</html>