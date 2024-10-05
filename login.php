<?php
// Koneksi ke MySQL
$servername = "localhost";
$username = "root"; // Sesuaikan dengan username database Anda
$password = "root123"; // Sesuaikan dengan password database Anda
$dbname = "nama_database"; // Nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memeriksa jika form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Cek pengguna di database
    $stmt = $conn->prepare("SELECT password FROM users WHERE username=?");
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    // Verifikasi kata sandi
    if ($hashed_password && password_verify($inputPassword, $hashed_password)) {
        echo "Login berhasil";
        // Anda bisa mengarahkan pengguna ke halaman lain setelah login berhasil
        exit()
    } else {
        echo "Username atau password salah";
    }
    $stmt->close();
}
$conn->close();
?>
