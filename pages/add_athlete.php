<?php
include 'session.php';
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $sport_id = mysqli_real_escape_string($conn, $_POST['sport_id']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $middle_initial = mysqli_real_escape_string($conn, $_POST['middle_initial']);
    $date_of_birth = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $t_shirt_size = mysqli_real_escape_string($conn, $_POST['t_shirt_size']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Insert data into the database
    $query = "INSERT INTO athletes (sport_id, last_name, first_name, middle_initial, date_of_birth, age, t_shirt_size, email) 
              VALUES ('$sport_id', '$last_name', '$first_name', '$middle_initial', '$date_of_birth', '$age', '$t_shirt_size', '$email')";

    if (mysqli_query($conn, $query)) {
        // Redirect or display success message
        echo "Athlete added successfully";
        header("Location: manage_athletes.php?message=1");
        exit();
    } else {
        // Handle errors
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>
