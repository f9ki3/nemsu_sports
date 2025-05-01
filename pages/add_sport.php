<?php include 'session.php'; ?>
<?php include '../connection.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sport_name = mysqli_real_escape_string($conn, $_POST['sport_name']);
    $sport_description = mysqli_real_escape_string($conn, $_POST['sport_description']);

    if (!empty($sport_name) && !empty($sport_description)) {
        $query = "INSERT INTO sports (name, description) VALUES ('$sport_name', '$sport_description')";
        if (mysqli_query($conn, $query)) {
            echo "Sport added successfully.";
            $message = 1;
            header("Location: manage_sports.php?message=" . urlencode($message));
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "All fields are required.";
    }
}
?>