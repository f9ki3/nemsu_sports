<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Campus</title>
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
                    <h3 class="fw-bold">Edit Campus</h3>
                </div>
                <div style="overflow-y: auto; max-height: 70vh;">
                <div class="row">
                            <?php

                                $id = $_GET['id'];

                                // Fetch the current data for the campus
                                $query = "SELECT name, location, description FROM campus WHERE id = ?";
                                $stmt = $conn->prepare($query);
                                $stmt->bind_param("i", $id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $campus = $result->fetch_assoc();

                                if (!$campus) {
                                    echo "Campus not found.";
                                    exit;
                                }
                                ?>
                            <div class="col-md-6">
                                <form action="update_campus.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Campus Name:</label>
                                        <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($campus['name']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="location" class="form-label">Location:</label>
                                        <input type="text" id="location" name="location" class="form-control" value="<?php echo htmlspecialchars($campus['location']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description:</label>
                                        <textarea id="description" name="description" class="form-control" rows="4" required><?php echo htmlspecialchars($campus['description']); ?></textarea>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="manage_campuses.php" class="btn text-primary border-primary">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'?>
    </div>

</body>
</html>