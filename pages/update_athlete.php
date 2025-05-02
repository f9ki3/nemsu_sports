<?php
include 'session.php';
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the ID and form data
    $id = intval($_POST['id']);
    $sport_id = intval($_POST['sport_id']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $middle_initial = mysqli_real_escape_string($conn, $_POST['middle_initial']);
    $date_of_birth = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
    $age = intval($_POST['age']);
    $t_shirt_size = mysqli_real_escape_string($conn, $_POST['t_shirt_size']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Update the athletes table
    $sql = "UPDATE athletes SET 
                sport_id = $sport_id, 
                last_name = '$last_name', 
                first_name = '$first_name', 
                middle_initial = '$middle_initial', 
                date_of_birth = '$date_of_birth', 
                age = $age, 
                t_shirt_size = '$t_shirt_size', 
                email = '$email' 
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // Redirect to manage_athletes.php after successful update
        header('Location: manage_athletes.php?message=3');
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Fetch the athlete details if the ID is provided in the query string
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT sport_id, last_name, first_name, middle_initial, date_of_birth, age, t_shirt_size, email FROM athletes WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $athlete = $result->fetch_assoc();

    if (!$athlete) {
        echo "Athlete not found.";
        exit();
    }
}
?>