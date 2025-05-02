<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports</title>
    <?php include '../header.php'; ?>
    <style>
        table {
            width: 100%;
            table-layout: fixed;
        }
        th, td {
            word-wrap: break-word;
        }
        th:nth-child(1), td:nth-child(1) {
            width: 10%; /* Adjust as needed */
        }
        th:nth-child(2), td:nth-child(2) {
            width: 70%; /* Adjust as needed */
        }
        th:nth-child(3), td:nth-child(3) {
            width: 20%; /* Adjust as needed */
        }
    </style>
</head>
<body>
    <div>
        <?php include 'head_nav.php'; ?>
        <div style="height: 90vh;" class="d-flex flex-row">
            <div style="width: 15%">
                <?php include 'navigation.php'; ?>
            </div>
            <div style="width: 85%">
                <div class="container p-3">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold">Settings</h3>
                    <!-- Button trigger modal -->
                    
                </div>

                <?php
                $query = "SELECT event_name, location, organizer_name FROM settings WHERE id = 1"; // Adjust the WHERE clause as needed
                $result = $conn->query($query);

                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $eventName = $row['event_name'];
                    $location = $row['location'];
                    $organizerName = $row['organizer_name'];
                } else {
                    $eventName = '';
                    $location = '';
                    $organizerName = '';
                }
                ?>

                <form action="save_settings.php" method="POST" style="width: 50%;">
                    <?php
                    if (isset($_GET['message'])) {
                        $message = htmlspecialchars($_GET['message']);
                        if ($message == 1) {
                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    <strong>Success:</strong> Successfully updated athlete.
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>";
                        } 
                    }
                    ?>
                    <div class="mb-3">
                        <label for="eventName" class="form-label">Event Name</label>
                        <input type="text" class="form-control" id="eventName" name="eventName" value="<?php echo htmlspecialchars($eventName); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" value="<?php echo htmlspecialchars($location); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="organizerName" class="form-label">Organizer Name</label>
                        <input type="text" class="form-control" id="organizerName" name="organizerName" value="<?php echo htmlspecialchars($organizerName); ?>" required>
                    </div>
                    <button type="submit" class="btn rounded-4 btn-outline-primary">
                        Save Settings
                    </button>
                </form>
                </div>
            </div>
        </div>
        <?php include 'footer.php'?>
    </div>

</body>
</html>