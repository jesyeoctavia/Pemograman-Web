<?php
$nama = "";
$posisi = "";
$kataSandi = "";
$konfirmasiKataSandi = "";
$pesanError = array();
$berhasil = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST["name"]);
    $posisi = $_POST["position"];
    $kataSandi = $_POST["password"];
    $konfirmasiKataSandi = $_POST["confirmpassword"];
    if (empty($nama)) {
        $pesanError[] = "Input Nama belum di isi!";
    }
    if (empty($kataSandi)) {
        $pesanError[] = "Input Password belum di isi!";
    }
    if (empty($konfirmasiKataSandi)) {
        $pesanError[] = "Input Confirm Password belum di isi!";
    }
    if (!empty($kataSandi) && !empty($konfirmasiKataSandi) && $kataSandi !== $konfirmasiKataSandi) {
        $pesanError[] = "Password dan Confirm Password belum sama!";
    }
    if (empty($pesanError)) {
        $berhasil = true;
    }
}

if (isset($_POST["reset"])) {
    $nama = "";
    $posisi = "";
    $kataSandi = "";
    $konfirmasiKataSandi = "";
    $pesanError = array();
    $berhasil = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>2373034-Jesye Octavia Nainggolan</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }

        .kotakForm {
            width: 350px;
            border: 1px solid black;
        }

        .headerForm {
            background-color: #c3bcbc;
            text-align: center;
            padding: 10px;
        }

        .isiForm table {
            width: 100%;
            border-collapse: collapse;
        }

        .isiForm td {
            border: 0.5px solid black;
        }

        .isiForm input[type="text"],
        .isiForm input[type="password"],
        .isiForm select {
            width: 100%;
            box-sizing: border-box;
            padding: 5px;
        }

        .footerForm {
            padding: 5px;
            text-align: right;
        }

        .footerForm input[type="reset"],
        .footerForm input[type="submit"] {
            padding: 5px 10px;
            margin-left: 5px;
        }

        .error {
            background-color: #ffcccc;
            border: 1px solid #ff0000;
            padding: 10px;
            margin-bottom: 20px;
            width: 350px;
        }

        .error ul {
            margin: 0;
            padding-left: 20px;
        }

        .error li {
            color: red;
            font-weight: bold;
        }

        .containerSukses {
            width: 300px;
            margin-bottom: 20px;
        }

        .headerSukses {
            background-color: #c3bcbc;
            padding: 10px;
        }

        .link {
            color: blue;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php if (!empty($pesanError)): ?>
    <div class="error">
        <ul>
            <?php foreach ($pesanError as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if ($berhasil): ?>
    <div class="containerSukses">
        <div class="headerSukses">Data yang Anda Masukkan!</div>
        <div class="success-body">
            Name: <?php echo htmlspecialchars($nama); ?><br><br>
            Position: <?php echo htmlspecialchars($posisi); ?><br><br>
            <span class="link" onclick="window.location.href='<?php echo $_SERVER['PHP_SELF']; ?>'">back</span>
        </div>
    </div>
<?php else: ?>
    <div class="kotakForm">
        <div class="headerForm">Add profile</div>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="isiForm">
                <table>
                    <tr>
                        <td>Name</td>
                        <td><input type="text" name="name" value="<?php echo htmlspecialchars($nama); ?>"></td>
                    </tr>
                    <tr>
                        <td>Position</td>
                        <td>
                            <select name="position">
                                <option value="Senior Programmer" <?php echo ($posisi == "Senior Programmer") ? "selected" : ""; ?>>Senior Programmer</option>
                                <optgroup label="Programmer">
                                    <option value="Junior Programmer" <?php echo ($posisi == "Junior Programmer") ? "selected" : ""; ?>>Junior Programmer</option>
                                </optgroup>
                                <optgroup label="System Analyst">
                                    <option value="Senior Analyst" <?php echo ($posisi == "Senior Analyst") ? "selected" : ""; ?>>Senior Analyst</option>
                                    <option value="Junior Analyst" <?php echo ($posisi == "Junior Analyst") ? "selected" : ""; ?>>Junior Analyst</option>
                                </optgroup>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="password"></td>
                    </tr>
                    <tr>
                        <td>Confirm Password</td>
                        <td><input type="password" name="confirmpassword"></td>
                    </tr>
                </table>
            </div>
            <div class="footerForm">
                <input type="submit" name="reset" value="Reset">
                <input type="submit" value="Save">
            </div>
        </form>
    </div>
<?php endif; ?>
</body>
</html>