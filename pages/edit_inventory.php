<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Inventory</title>
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
                    <h3 class="fw-bold">Edit Inventory</h3>
                </div>
                <div style="overflow-y: auto; max-height: 70vh;">
                <div class="row">
                    <?php
                        $id = $_GET['id'];

                        // Fetch the current data for the inventory
                        $query = "SELECT id, student_number, person_incharge, equipment_name, quantity, description, student_name, course_code, equipment_code, borrow_date_time, return_date_time FROM inventory WHERE id = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $inventory = $result->fetch_assoc();

                        if (!$inventory) {
                            echo "Inventory record not found.";
                            exit;
                        }
                    ?>
                    <form action="update_inventory.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="student_number" class="form-label">Student Number:</label>
                                    <input type="text" id="student_number" name="student_number" class="form-control" value="<?php echo htmlspecialchars($inventory['student_number']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="person_incharge" class="form-label">Person In-Charge:</label>
                                    <input type="text" id="person_incharge" name="person_incharge" class="form-control" value="<?php echo htmlspecialchars($inventory['person_incharge']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="equipment_name" class="form-label">Equipment Name:</label>
                                    <input type="text" id="equipment_name" name="equipment_name" class="form-control" value="<?php echo htmlspecialchars($inventory['equipment_name']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity:</label>
                                    <input type="number" id="quantity" name="quantity" class="form-control" value="<?php echo htmlspecialchars($inventory['quantity']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description:</label>
                                    <textarea id="description" name="description" class="form-control" required><?php echo htmlspecialchars($inventory['description']); ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="student_name" class="form-label">Student Name:</label>
                                    <input type="text" id="student_name" name="student_name" class="form-control" value="<?php echo htmlspecialchars($inventory['student_name']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="course_code" class="form-label">Course Code:</label>
                                    <input type="text" id="course_code" name="course_code" class="form-control" value="<?php echo htmlspecialchars($inventory['course_code']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="equipment_code" class="form-label">Equipment Code:</label>
                                    <input type="text" id="equipment_code" name="equipment_code" class="form-control" value="<?php echo htmlspecialchars($inventory['equipment_code']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="borrow_date_time" class="form-label">Borrow Date & Time:</label>
                                    <input type="datetime-local" id="borrow_date_time" name="borrow_date_time" class="form-control" value="<?php echo htmlspecialchars($inventory['borrow_date_time']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="return_date_time" class="form-label">Return Date & Time:</label>
                                    <input type="datetime-local" id="return_date_time" name="return_date_time" class="form-control" value="<?php echo htmlspecialchars($inventory['return_date_time']); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="manage_inventory.php" class="btn text-primary border-primary">Cancel</a>
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
