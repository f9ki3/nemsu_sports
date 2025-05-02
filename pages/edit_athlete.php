<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Athlete</title>
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
                    <h3 class="fw-bold">Edit Athlete</h3>
                </div>
                <div style="overflow-y: auto; max-height: 70vh;">
                <div class="row">
                    <?php
                        $id = $_GET['id'];

                        // Fetch the current data for the athlete
                        $query = "SELECT sport_id, last_name, first_name, middle_initial, date_of_birth, age, t_shirt_size, email FROM athletes WHERE id = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $athlete = $result->fetch_assoc();

                        if (!$athlete) {
                            echo "Athlete not found.";
                            exit;
                        }
                    ?>
                    <form action="update_athlete.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
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
                                                $selected = $sport['id'] == $athlete['sport_id'] ? 'selected' : '';
                                                echo "<option value='" . htmlspecialchars($sport['id']) . "' $selected>" . htmlspecialchars($sport['name']) . "</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last Name:</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo htmlspecialchars($athlete['last_name']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First Name:</label>
                                    <input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo htmlspecialchars($athlete['first_name']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="middle_initial" class="form-label">Middle Initial:</label>
                                    <input type="text" id="middle_initial" name="middle_initial" class="form-control" value="<?php echo htmlspecialchars($athlete['middle_initial']); ?>" maxlength="1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date_of_birth" class="form-label">Date of Birth:</label>
                                    <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="<?php echo htmlspecialchars($athlete['date_of_birth']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="age" class="form-label">Age:</label>
                                    <input type="number" id="age" name="age" class="form-control" value="<?php echo htmlspecialchars($athlete['age']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="t_shirt_size" class="form-label">T-Shirt Size:</label>
                                    <input type="text" id="t_shirt_size" name="t_shirt_size" class="form-control" value="<?php echo htmlspecialchars($athlete['t_shirt_size']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($athlete['email']); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="manage_athletes.php" class="btn text-primary border-primary">Cancel</a>
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