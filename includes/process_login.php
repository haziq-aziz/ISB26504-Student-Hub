<?php
session_start();
require '../../db_connection.php';

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize user input
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        if (empty($email)) {
            throw new Exception("Email is required.");
        }

        $password = sha1($_POST['password']);
        if (empty($password)) {
            throw new Exception("Password is required.");
        }

        // Prepare and execute the SQL statement
        if ($stmt = $conn->prepare("SELECT studentid, email, fullname FROM student WHERE email = ? AND password = ?")) {
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $stmt->store_result();

            // Check if user exists
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($studentid, $email, $fullname);
                $stmt->fetch();

                // Store session variables
                $_SESSION['studentid'] = $studentid;
                $_SESSION['student_email'] = $email;
                $_SESSION['student_fullname'] = $fullname;

                // Redirect to profile page
                header("Location: ../dashboard.php");
                exit();
            } else {
                // Invalid email or password
                throw new Exception("Invalid email or password.");
            }

            // Close statement
            $stmt->close();
        } else {
            throw new Exception("Failed to prepare the SQL statement.");
        }
    } else {
        // Invalid request method
        header("Location: ../login.php");
        exit();
    }
} catch (Exception $e) {
    // Handle exceptions
    if ($e->getMessage() === "Invalid email or password.") {
        header("Location: ../login.php?error=1");
    } else {
        error_log($e->getMessage());
        header("Location: ../login.php?error=2");
    }
    exit();
} finally {
    // Close the database connection
    $conn->close();
}
?>
