<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Coach</title>
    <?php include '../header.php'; ?>
    <style>
        table {
            width: 100%;
            table-layout: fixed;
        }
        th, td {
            word-wrap: break-word;
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
                    <h3 class="fw-bold">Edit Coach</h3>
                </div>
                <div style="overflow-y: auto; max-height: 70vh;">
                <div class="row">
                    <?php
                        $id = $_GET['id'];

                        // Fetch the current data for the coach
                        $query = "SELECT sport_id, lastname, firstname, middle_initial, contact_number, t_shirt_size FROM coaches WHERE id = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $coach = $result->fetch_assoc();

                        if (!$coach) {
                            echo "Coach not found.";
                            exit;
                        }
                    ?>
                    <form action="update_coach.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sport_id" class="form-label">Sport:</label>
                                    <select id="sport_id" name="sport_id" class="form-control" required>
                                        <?php
                                            $sports_query = "SELECT id, name FROM sports";
                                            $sports_result = $conn->query($sports_query);
                                            while ($sport = $sports_result->fetch_assoc()) {
                                                $selected = $sport['id'] == $coach['sport_id'] ? 'selected' : '';
                                                echo "<option value='" . htmlspecialchars($sport['id']) . "' $selected>" . htmlspecialchars($sport['name']) . "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="lastname" class="form-label">Last Name:</label>
                                    <input type="text" id="lastname" name="lastname" class="form-control" value="<?php echo htmlspecialchars($coach['lastname']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="firstname" class="form-label">First Name:</label>
                                    <input type="text" id="firstname" name="firstname" class="form-control" value="<?php echo htmlspecialchars($coach['firstname']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="middle_initial" class="form-label">Middle Initial:</label>
                                    <input type="text" id="middle_initial" name="middle_initial" class="form-control" value="<?php echo htmlspecialchars($coach['middle_initial']); ?>" maxlength="1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contact_number" class="form-label">Contact Number:</label>
                                    <input type="text" id="contact_number" name="contact_number" class="form-control" value="<?php echo htmlspecialchars($coach['contact_number']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="t_shirt_size" class="form-label">T-Shirt Size:</label>
                                    <input type="text" id="t_shirt_size" name="t_shirt_size" class="form-control" value="<?php echo htmlspecialchars($coach['t_shirt_size']); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="manage_coaches.php" class="btn text-primary border-primary">Cancel</a>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'?>
    </div>

</body>
</html>
