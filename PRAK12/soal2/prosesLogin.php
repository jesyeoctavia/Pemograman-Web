<!-- 2373034-Jesye Octavia Nainggolan -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $isAdmin = ($username === 'admin' && $password === 'admin');
} else {
    header('Location: index.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Proses Login</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }

        p {
            font-weight: bold;
        }

        .success {
            color: black;
            font-size: 24px;
        }

        .success span {
            color: blue;
            font-weight: bold;
            font-size: 40px;
        }

        .fail {
            font-size: 20px;
            color: red;
        }

        .fail span {
            font-weight: bold;
            color: black;
        }

        a {
            display: block;
            color: purple;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php if ($isAdmin): ?>
        <div class="success">
            <p>Login berhasil!</p>
            <p>Selamat datang, <span>admin</span>.</p>
        </div>
    <?php else: ?>
        <div class="fail">
            <p>Username : <span><?= htmlspecialchars($username) ?></span> Tidak Terdaftar!</p>
        </div>
    <?php endif; ?>
    <a href="index.html">kembali ke halaman login</a>
</body>
</html>