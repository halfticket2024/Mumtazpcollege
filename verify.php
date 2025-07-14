<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reg = $_POST['reg_id'] ?? '';
    $course = $_POST['course'] ?? '';  // Now using course instead of DOB

    // Database connection
    $conn = new mysqli(
        "sql104.epizy.com",        // Host
        "if0_39431886",            // Username
        "mumtazpg0786",            // Password
        "if0_39431886_college_db"  // Database name
    );

    // Connection check
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare query to verify reg_id and course
    $sql = "SELECT * FROM issued_ids WHERE registration_number = ? AND course = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $reg, $course);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        // Match found
        header("Location:form.html?reg=" . urlencode($reg));
        exit();
    } else {
        // No match found
        echo "<h3 style='color:red;'>❌ Invalid Registration Number or Course</h3>";
        echo "<a href='instructions.html'>🔙 Try Again</a>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<h3>⚠️ Please submit the form to verify your registration.</h3>";
}
