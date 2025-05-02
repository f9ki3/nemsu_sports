<?php
include 'session.php';
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the ID and form data
    $id = intval($_POST['id']);
    $student_number = mysqli_real_escape_string($conn, $_POST['student_number']);
    $person_incharge = mysqli_real_escape_string($conn, $_POST['person_incharge']);
    $equipment_name = mysqli_real_escape_string($conn, $_POST['equipment_name']);
    $quantity = intval($_POST['quantity']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
    $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
    $equipment_code = mysqli_real_escape_string($conn, $_POST['equipment_code']);
    $borrow_date_time = mysqli_real_escape_string($conn, $_POST['borrow_date_time']);
    $return_date_time = mysqli_real_escape_string($conn, $_POST['return_date_time']);

    // Update the inventory table
    $sql = "UPDATE inventory SET 
                student_number = '$student_number', 
                person_incharge = '$person_incharge', 
                equipment_name = '$equipment_name', 
                quantity = $quantity, 
                description = '$description', 
                student_name = '$student_name', 
                course_code = '$course_code', 
                equipment_code = '$equipment_code', 
                borrow_date_time = '$borrow_date_time', 
                return_date_time = '$return_date_time' 
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // Redirect to manage_inventory.php after successful update
        header('Location: manage_inventory.php?message=3');
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Fetch the inventory details if the ID is provided in the query string
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT student_number, person_incharge, equipment_name, quantity, description, student_name, course_code, equipment_code, borrow_date_time, return_date_time FROM inventory WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $inventory = $result->fetch_assoc();

    if (!$inventory) {
        echo "Inventory record not found.";
        exit();
    }
}
?>
