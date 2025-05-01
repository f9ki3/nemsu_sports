<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Coaches</title>
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
                    <h3 class="fw-bold">Manage Coaches</h3>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn rounded-4 btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addCoachModal">
                        Add Coach
                    </button>

                    <!-- Modal -->
                    <div class="modal mt-5 fade" id="addCoachModal" tabindex="-1" aria-labelledby="addCoachModalLabel" aria-hidden="true">
                        <div class="mt-5 modal-dialog">
                            <div class="modal-content">
                            <form method="POST" action="add_coach.php">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addCoachModalLabel">Add New Coach</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="sport_id" class="form-label">Sport</label>
                                                <select class="form-control" id="sport_id" name="sport_id" required>
                                                    <?php
                                                    $sports_query = "SELECT * FROM sports";
                                                    $sports_result = mysqli_query($conn, $sports_query);
                                                    while ($sport = mysqli_fetch_assoc($sports_result)) {
                                                        echo "<option value='{$sport['id']}'>{$sport['name']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="contact_number" class="form-label">Contact Number</label>
                                                <input type="text" class="form-control" id="contact_number" name="contact_number" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="t_shirt_size" class="form-label">T-Shirt Size</label>
                                                <input type="text" class="form-control" id="t_shirt_size" name="t_shirt_size" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="lastname" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="lastname" name="lastname" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="firstname" name="firstname" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="middle_initial" class="form-label">Middle Initial</label>
                                                <input type="text" class="form-control" id="middle_initial" name="middle_initial">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Coach</button>
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
                                <strong>Success:</strong> Successfully added coach.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                    } elseif ($message == 2) {
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Deleted:</strong> Coach removed from the list.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                    } elseif ($message == 3) {
                        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Edited:</strong> Coach updated from the list.
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
                $query = "SELECT coaches.*, sports.name AS sport_name, 
                          CONCAT(coaches.firstname, ' ', coaches.lastname) AS fullname 
                          FROM coaches 
                          JOIN sports ON coaches.sport_id = sports.id 
                          ORDER BY $sort_column $sort_order";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                ?>

                <div style="overflow-y: auto; max-height: 70vh;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 5%;">
                                    <a href="?sort_column=id&sort_order=<?= $next_sort_order ?>" style="text-decoration: none; color: black;">
                                        ID
                                        <?php if ($sort_column == 'id'): ?>
                                            <i class="bi bi-arrow-<?= $sort_order === 'asc' ? 'up' : 'down' ?>"></i>
                                        <?php endif; ?>
                                    </a>
                                </th>
                                <th style="width: 10%;">
                                    <a href="?sort_column=sport_name&sort_order=<?= $next_sort_order ?>" style="text-decoration: none; color: black;">
                                        Sport
                                        <?php if ($sort_column == 'sport_name'): ?>
                                            <i class="bi bi-arrow-<?= $sort_order === 'asc' ? 'up' : 'down' ?>"></i>
                                        <?php endif; ?>
                                    </a>
                                </th>
                                <th style="width: 20%;">
                                    <a href="?sort_column=fullname&sort_order=<?= $next_sort_order ?>" style="text-decoration: none; color: black;">
                                        Full Name
                                        <?php if ($sort_column == 'fullname'): ?>
                                            <i class="bi bi-arrow-<?= $sort_order === 'asc' ? 'up' : 'down' ?>"></i>
                                        <?php endif; ?>
                                    </a>
                                </th>
                                <th style="width: 10%;">
                                    <a href="?sort_column=contact_number&sort_order=<?= $next_sort_order ?>" style="text-decoration: none; color: black;">
                                        Contact Number
                                        <?php if ($sort_column == 'contact_number'): ?>
                                            <i class="bi bi-arrow-<?= $sort_order === 'asc' ? 'up' : 'down' ?>"></i>
                                        <?php endif; ?>
                                    </a>
                                </th>
                                <th style="width: 10%;">
                                    <a href="?sort_column=t_shirt_size&sort_order=<?= $next_sort_order ?>" style="text-decoration: none; color: black;">
                                        T-Shirt Size
                                        <?php if ($sort_column == 't_shirt_size'): ?>
                                            <i class="bi bi-arrow-<?= $sort_order === 'asc' ? 'up' : 'down' ?>"></i>
                                        <?php endif; ?>
                                    </a>
                                </th>
                                <th style="width: 15%;" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($coach = mysqli_fetch_assoc($result)) {
                                    $fullname = "{$coach['firstname']} {$coach['lastname']}";
                                    echo "<tr>";
                                    echo "<td class='text-muted py-4'>{$coach['id']}</td>";
                                    echo "<td class='text-muted py-4'>{$coach['sport_name']}</td>";
                                    echo "<td class='text-muted py-4'>{$fullname}</td>";
                                    echo "<td class='text-muted py-4'>{$coach['contact_number']}</td>";
                                    echo "<td class='text-muted py-4'>{$coach['t_shirt_size']}</td>";
                                    echo "<td class='text-end py-4'>
                                        <a href='edit_coach.php?id={$coach['id']}' class='btn btn-sm text-primary'><i class='bi bi-pencil'></i> Edit</a> | 
                                        <a href='delete_coach.php?id={$coach['id']}' class='btn btn-sm text-danger'><i class='bi bi-trash'></i> Delete</a>
                                    </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center text-muted py-2'>No coaches found</td></tr>";
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
