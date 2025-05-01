<?php
include 'session.php';
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $campus_id = mysqli_real_escape_string($conn, $_POST['campus_id']);
    $gold = (int) $_POST['gold'];
    $silver = (int) $_POST['silver'];
    $bronze = (int) $_POST['bronze'];

    // Insert data into the awards table
    $insert_query = "INSERT INTO sports_award (student_id, campus_id, gold, silver, bronze) 
                     VALUES ('$student_id', '$campus_id', '$gold', '$silver', '$bronze')";

    if (mysqli_query($conn, $insert_query)) {
        // Redirect or display success message
        header('Location: manage_awards.php?message=1');
        exit();
    } else {
        // Handle error
        echo "Error: " . mysqli_error($conn);
    }
}
?>