<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Inventory</title>
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
                    <h3 class="fw-bold">Manage Inventory</h3>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn rounded-4 btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addInventoryModal">
                        Add Inventory
                    </button>

                    <!-- Modal -->
                    <div class="modal mt-5 fade" id="addInventoryModal" tabindex="-1" aria-labelledby="addInventoryModalLabel" aria-hidden="true">
                        <div class="mt-5 modal-dialog">
                            <div class="modal-content">
                            <form method="POST" action="add_inventory.php">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addInventoryModalLabel">Add New Inventory</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="borrow_date_time" class="form-label">Borrow Date & Time</label>
                                                <input type="datetime-local" class="form-control" id="borrow_date_time" name="borrow_date_time" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="person_incharge" class="form-label">Person In-Charge</label>
                                                <input type="text" class="form-control" id="person_incharge" name="person_incharge" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="equipment_name" class="form-label">Equipment Name</label>
                                                <input type="text" class="form-control" id="equipment_name" name="equipment_name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="quantity" class="form-label">Quantity</label>
                                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="return_date_time" class="form-label">Return Date & Time</label>
                                                <input type="datetime-local" class="form-control" id="return_date_time" name="return_date_time">
                                            </div>
                                            <div class="mb-3">
                                                <label for="student_name" class="form-label">Student Name</label>
                                                <input type="text" class="form-control" id="student_name" name="student_name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="student_number" class="form-label">Student Number</label>
                                                <input type="text" class="form-control" id="student_number" name="student_number" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="course_code" class="form-label">Course Code</label>
                                                <input type="text" class="form-control" id="course_code" name="course_code" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="equipment_code" class="form-label">Equipment Code</label>
                                                <input type="text" class="form-control" id="equipment_code" name="equipment_code" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Inventory</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($_GET['message'])) {
                    $message = htmlspecialchars($_GET['message']);
                    if ($message == 1) {
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Success:</strong> Successfully added inventory.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                    } elseif ($message == 2) {
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Deleted:</strong> Inventory removed from the list.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                    } elseif ($message == 3) {
                        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Edited:</strong> Inventory updated from the list.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                    }
                }
                ?>

                <?php
                // Determine sorting parameters
                $sort_column = isset($_GET['sort_column']) ? $_GET['sort_column'] : 'id';
                $sort_order = isset($_GET['sort_order']) && $_GET['sort_order'] === 'desc' ? 'desc' : 'asc';

                // Toggle sort order for next click
                $next_sort_order = $sort_order === 'asc' ? 'desc' : 'asc';

                // Query with dynamic ORDER BY clause
                $query = "SELECT * FROM inventory ORDER BY $sort_column $sort_order";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                ?>

                <div style="overflow-y: auto;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 5%;"><a href="?sort_column=id&sort_order=<?= $next_sort_order ?>" style="color: black; text-decoration: none;">ID <?= $sort_column === 'id' ? ($sort_order === 'asc' ? '<i class="bi bi-arrow-up"></i>' : '<i class="bi bi-arrow-down"></i>') : '' ?></a></th>
                                <th style="width: 10%;"><a href="?sort_column=student_number&sort_order=<?= $next_sort_order ?>" style="color: black; text-decoration: none;">Student No. <?= $sort_column === 'student_number' ? ($sort_order === 'asc' ? '<i class="bi bi-arrow-up"></i>' : '<i class="bi bi-arrow-down"></i>') : '' ?></a></th>
                                <th style="width: 9%;"><a href="?sort_column=person_incharge&sort_order=<?= $next_sort_order ?>" style="color: black; text-decoration: none;">In-Charge <?= $sort_column === 'person_incharge' ? ($sort_order === 'asc' ? '<i class="bi bi-arrow-up"></i>' : '<i class="bi bi-arrow-down"></i>') : '' ?></a></th>
                                <th style="width: 10%;"><a href="?sort_column=equipment_name&sort_order=<?= $next_sort_order ?>" style="color: black; text-decoration: none;">Equipment<?= $sort_column === 'equipment_name' ? ($sort_order === 'asc' ? '<i class="bi bi-arrow-up"></i>' : '<i class="bi bi-arrow-down"></i>') : '' ?></a></th>
                                <th style="width: 10%;"><a href="?sort_column=description&sort_order=<?= $next_sort_order ?>" style="color: black; text-decoration: none;">Description <?= $sort_column === 'description' ? ($sort_order === 'asc' ? '<i class="bi bi-arrow-up"></i>' : '<i class="bi bi-arrow-down"></i>') : '' ?></a></th>
                                <th style="width: 8%;"><a href="?sort_column=student_name&sort_order=<?= $next_sort_order ?>" style="color: black; text-decoration: none;">Student<?= $sort_column === 'student_name' ? ($sort_order === 'asc' ? '<i class="bi bi-arrow-up"></i>' : '<i class="bi bi-arrow-down"></i>') : '' ?></a></th>
                                <th style="width: 8%;"><a href="?sort_column=course_code&sort_order=<?= $next_sort_order ?>" style="color: black; text-decoration: none;">Course <?= $sort_column === 'course_code' ? ($sort_order === 'asc' ? '<i class="bi bi-arrow-up"></i>' : '<i class="bi bi-arrow-down"></i>') : '' ?></a></th>
                                <th style="width: 10%;"><a href="?sort_column=equipment_code&sort_order=<?= $next_sort_order ?>" style="color: black; text-decoration: none;">Equip Code <?= $sort_column === 'equipment_code' ? ($sort_order === 'asc' ? '<i class="bi bi-arrow-up"></i>' : '<i class="bi bi-arrow-down"></i>') : '' ?></a></th>
                                <th style="width: 11%;"><a href="?sort_column=borrow_date_time&sort_order=<?= $next_sort_order ?>" style="color: black; text-decoration: none;">Borrow/Return <?= $sort_column === 'borrow_date_time' ? ($sort_order === 'asc' ? '<i class="bi bi-arrow-up"></i>' : '<i class="bi bi-arrow-down"></i>') : '' ?></a></th>
                                <th class="text-end" style="width: 15%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($inventory = mysqli_fetch_assoc($result)) {
                                    $borrow_date = date('Y-m-d', strtotime($inventory['borrow_date_time']));
                                    $return_date = $inventory['return_date_time'] ? date('Y-m-d', strtotime($inventory['return_date_time'])) : 'N/A';
                                    echo "<tr class=' text-muted' style='font-size: 0.9rem;'>";
                                    echo "<td class='text-muted py-4'>{$inventory['id']}</td>";
                                    echo "<td class='text-muted py-4'>{$inventory['student_number']}</td>";
                                    echo "<td class='text-muted py-4'>{$inventory['person_incharge']}</td>";
                                    echo "<td class='text-muted py-4'>{$inventory['equipment_name']} ({$inventory['quantity']})</td>";
                                    echo "<td class='text-muted py-4'>{$inventory['description']}</td>";
                                    echo "<td class='text-muted py-4'>{$inventory['student_name']}</td>";
                                    echo "<td class='text-muted py-4'>{$inventory['course_code']}</td>";
                                    echo "<td class='text-muted py-4'>{$inventory['equipment_code']}</td>";
                                    echo "<td class='text-muted py-4'>{$borrow_date} - {$return_date}</td>";
                                    echo "<td class='text-muted py-4 d-flex justify-content-end'>
                                        <a href='edit_inventory.php?id={$inventory['id']}' class='btn btn-sm text-primary me-2'>
                                            <i class='bi bi-pencil'></i> Edit
                                        </a>
                                        |
                                        <a href='delete_inventory.php?id={$inventory['id']}' class='btn btn-sm text-danger ms-2'>
                                            <i class='bi bi-trash'></i> Delete
                                        </a>
                                    </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr class='py-4 text-muted' style='font-size: 0.9rem;'><td colspan='11' class='text-center'>No inventory found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                </div>
            </div>
        </div>
        <?php include 'footer.php'?>
    </div>

</body>
</html>
