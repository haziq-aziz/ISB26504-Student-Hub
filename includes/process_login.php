<?php
session_start();
require '../../db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = sha1($_POST['password']); // Hash the password with SHA1

    $stmt = $conn->prepare("SELECT studentid, email, fullname FROM student WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);

    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($studentid, $email, $fullname);
        $stmt->fetch();

        $_SESSION['studentid'] = $studentid;
        $_SESSION['student_email'] = $email;
        $_SESSION['student_fullname'] = $fullname;

        header("Location: ../index.php");
        exit();
    } else {
        header("Location: ../login.php?error=1");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../login.php");
    exit();
}
?>
