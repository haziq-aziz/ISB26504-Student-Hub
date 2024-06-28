<?php
session_start();
if (!isset($_SESSION['studentid'])) {
    header("Location: login.php");
    exit();
}

require_once '../../db_connection.php';
require_once 'Exception.php';

$studentid = $_SESSION['studentid'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['clubid'])) {
        $clubid = $_POST['clubid'];

        try {
            // Prepare the SQL statement to delete the record from the club_student table
            $sql = "DELETE FROM club_student WHERE studentid = ? AND clubid = ?";
            
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("ss", $studentid, $clubid);

                if ($stmt->execute()) {
                    // Redirect to the page with a success message
                    $_SESSION['success_message'] = "You have successfully left the club.";
                    header("Location: ../ghocs.php");
                    exit();
                } else {
                    throw new ClubException("An error occurred while leaving the club.");
                }
            } else {
                throw new ClubException("Failed to prepare the SQL statement.");
            }
        } catch (ClubException $e) {
            $_SESSION['error_message'] = $e->getMessage();
            header("Location: ../ghocs.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "No club selected.";
        header("Location: ../ghocs.php");
        exit();
    }
} else {
    // If the request method is not POST, redirect to the clubs page
    header("Location: ../ghocs.php");
    exit();
}

$conn->close();
?>