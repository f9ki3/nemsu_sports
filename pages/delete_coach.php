<?php include 'session.php'; ?>
<?php include '../connection.php'; ?>
<?php 
if (isset($_GET['id'])) {
    $sport_id = intval($_GET['id']);
    $query = "DELETE FROM coaches WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $sport_id);

    if ($stmt->execute()) {
        echo "Coaches deleted successfully.";
        $message = 2;
        header("Location: manage_coaches.php?message=" . urlencode($message));
        exit();
    } else {
        echo "Error deleting sport: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No sport ID provided.";
}?>