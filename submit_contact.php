<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";  // Mặc định của XAMPP/WAMP là rỗng
$dbname = "contact_form_db";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Nhận dữ liệu từ form và lọc dữ liệu
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$message = htmlspecialchars($_POST['message']);

// Chuẩn bị câu lệnh SQL với prepared statements để bảo mật
$stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);

// Thực thi câu lệnh và kiểm tra kết quả
if ($stmt->execute()) {
    echo "Your message has been sent successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Đóng kết nối
$stmt->close();
$conn->close();
?>
