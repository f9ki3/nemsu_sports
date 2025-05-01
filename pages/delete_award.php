<?php 
include 'session.php';
include '../connection.php';
if (isset($_GET['id'])) {
    $athlete_id = intval($_GET['id']);
    $query = "DELETE FROM sports_award WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $athlete_id);

    if ($stmt->execute()) {
        echo "Athlete deleted successfully";
        header("Location: manage_awards.php?message=2");
        exit();
    } else {
        echo "<script>alert('Error deleting athlete.');</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('No athlete ID provided.');</script>";
    echo "<script>window.location.href = 'athletes_list.php';</script>";
}
?>