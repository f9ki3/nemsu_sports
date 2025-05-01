<?php
include 'session.php';
include '../connection.php';

// Check if the connection is successful
if ($conn) {
    $sport_id = isset($_POST['sport_id']) ? mysqli_real_escape_string($conn, $_POST['sport_id']) : '';
    $last_name = isset($_POST['last_name']) ? mysqli_real_escape_string($conn, $_POST['last_name']) : '';
    $first_name = isset($_POST['first_name']) ? mysqli_real_escape_string($conn, $_POST['first_name']) : '';
    $middle_initial = isset($_POST['middle_initial']) ? mysqli_real_escape_string($conn, $_POST['middle_initial']) : '';
    $date_of_birth = isset($_POST['date_of_birth']) ? mysqli_real_escape_string($conn, $_POST['date_of_birth']) : '';
    $age = isset($_POST['age']) ? mysqli_real_escape_string($conn, $_POST['age']) : '';
    $t_shirt_size = isset($_POST['t_shirt_size']) ? mysqli_real_escape_string($conn, $_POST['t_shirt_size']) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';

    // Insert data into the database
    $query = "INSERT INTO athletes (sport_id, last_name, first_name, middle_initial, date_of_birth, age, t_shirt_size, email) 
              VALUES ('$sport_id', '$last_name', '$first_name', '$middle_initial', '$date_of_birth', '$age', '$t_shirt_size', '$email')";

    if (mysqli_query($conn, $query)) {
        // Redirect or display success message
        echo "<script>alert('Athlete added successfully');</script>";
        header("Location: manage_athletes.php?message=1");
        exit();
    } else {
        // Handle errors
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
} else {
    echo "<script>alert('Database connection failed');</script>";
}
?>
