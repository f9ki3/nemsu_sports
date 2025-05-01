<?php
include 'session.php';
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $sport_id = mysqli_real_escape_string($conn, $_POST['sport_id']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $t_shirt_size = mysqli_real_escape_string($conn, $_POST['t_shirt_size']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $middle_initial = mysqli_real_escape_string($conn, $_POST['middle_initial']);

    // Insert data into the database
    $query = "INSERT INTO coaches (sport_id, contact_number, t_shirt_size, lastname, firstname, middle_initial) 
              VALUES ('$sport_id', '$contact_number', '$t_shirt_size', '$lastname', '$firstname', '$middle_initial')";

    if (mysqli_query($conn, $query)) {
        // Redirect or display success message
        echo "Athlete added successfully";
        header("Location: manage_coaches.php?message=1");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
