<?php include 'session.php'; ?>
<?php include '../connection.php'; ?>
<?php 
if (isset($_GET['id'])) {
    $sport_id = intval($_GET['id']);
    $query = "DELETE FROM sports WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $sport_id);

    if ($stmt->execute()) {
        echo "Sport deleted successfully.";
        $message = 2;
        header("Location: manage_sports.php?message=" . urlencode($message));
        exit();
    } else {
        echo "Error deleting sport: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No sport ID provided.";
}?>