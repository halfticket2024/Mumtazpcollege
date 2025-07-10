<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reg = $_POST['reg_id'] ?? '';
    $dob = $_POST['dob'] ?? '';

    $conn = new mysqli(
        "sql104.epizy.com",        // Host
        "if0_39431886",            // Username
        "mumtazpg0786",            // Password
        "if0_39431886_college_db"  // Database name
    );

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM issued_ids WHERE registration_number = ? AND dob = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $reg, $dob);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        header("Location:form.html?reg=" . urlencode($reg));
        exit();
    } else {
        echo "<h3 style='color:red;'>❌ Invalid Registration Number or Date of Birth</h3>";
        echo "<a href='instructions.html'>🔙 Try Again</a>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<h3>⚠️ Please submit the form to verify your registration.</h3>";
}
?>