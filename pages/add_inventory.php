<?php
include 'session.php';
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $student_number = mysqli_real_escape_string($conn, $_POST['student_number']);
    $person_incharge = mysqli_real_escape_string($conn, $_POST['person_incharge']);
    $equipment_name = mysqli_real_escape_string($conn, $_POST['equipment_name']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
    $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
    $equipment_code = mysqli_real_escape_string($conn, $_POST['equipment_code']);
    $borrow_date_time = mysqli_real_escape_string($conn, $_POST['borrow_date_time']);
    $return_date_time = mysqli_real_escape_string($conn, $_POST['return_date_time']);

    // Insert data into the database
    $query = "INSERT INTO inventory (student_number, person_incharge, equipment_name, quantity, description, student_name, course_code, equipment_code, borrow_date_time, return_date_time) 
              VALUES ('$student_number', '$person_incharge', '$equipment_name', '$quantity', '$description', '$student_name', '$course_code', '$equipment_code', '$borrow_date_time', '$return_date_time')";

    if (mysqli_query($conn, $query)) {
        // Redirect or display success message
        echo "Inventory added successfully";
        header("Location: manage_inventory.php?message=1");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
