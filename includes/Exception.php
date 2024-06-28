<?php
class ClubException extends Exception {
    public function errorMessage() {
        return "Error: " . $this->getMessage();
    }
}

class EnrolledCourseException extends Exception {
    public function errorMessage() {
        return "Error: " . $this->getMessage();
    }
}
?>