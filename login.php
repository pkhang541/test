<?php
$conn = new mysqli("localhost", "root", "", "user_system");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    
    if ($stmt->fetch()) {
        if (password_verify($password, $hashed_password)) {
            echo "Đăng nhập thành công!";
        } else {
            echo "Sai mật khẩu!";
        }
    } else {
        echo "Không tìm thấy tài khoản!";
    }

    $stmt->close();
}
?>
