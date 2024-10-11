<?php
// Include the database connection
include('../Mysql/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the field name and value sent via AJAX
    $fieldName = isset($_POST['fieldName']) ? trim($_POST['fieldName']) : '';
    $fieldValue = isset($_POST['fieldValue']) ? trim($_POST['fieldValue']) : '';

    // Initialize a response variable
    $response = '';

    // Verify based on the specific field being checked
    if (!empty($fieldValue)) {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM farmer_list WHERE $fieldName = ?");
        $stmt->bind_param("s", $fieldValue); // Bind as string
        $stmt->execute();
        $result = $stmt->get_result();

        // Log the SQL query for debugging
        error_log("Executing query: SELECT * FROM farmer_list WHERE $fieldName = '$fieldValue'");

        // Check if the result is found in the database
        if ($result->num_rows > 0) {
            $response = "Verified";
        } else {
            $response = "Not Verified: No match found in database.";
        }
    } else {
        $response = "Please fill in the $fieldName.";
    }

    // Send the response back to the AJAX call
    echo $response;
}
?>
