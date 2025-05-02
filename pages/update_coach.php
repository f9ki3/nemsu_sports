<?php
include 'session.php';
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the ID and form data
    $id = intval($_POST['id']);
    $sport_id = intval($_POST['sport_id']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $middle_initial = mysqli_real_escape_string($conn, $_POST['middle_initial']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $t_shirt_size = mysqli_real_escape_string($conn, $_POST['t_shirt_size']);

    // Update the coaches table
    $sql = "UPDATE coaches SET 
                sport_id = $sport_id, 
                lastname = '$lastname', 
                firstname = '$firstname', 
                middle_initial = '$middle_initial', 
                contact_number = '$contact_number', 
                t_shirt_size = '$t_shirt_size' 
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // Redirect to manage_coaches.php after successful update
        header('Location: manage_coaches.php?message=3');
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Fetch the coach details if the ID is provided in the query string
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT sport_id, lastname, firstname, middle_initial, contact_number, t_shirt_size FROM coaches WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $coach = $result->fetch_assoc();

    if (!$coach) {
        echo "Coach not found.";
        exit();
    }
}
?>
