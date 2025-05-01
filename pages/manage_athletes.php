<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Athletes</title>
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
                    <h3 class="fw-bold">Manage Athletes</h3>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn rounded-4 btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addAthleteModal">
                        Add Athlete
                    </button>

                    <!-- Modal -->
                    <div class="modal mt-5 fade" id="addAthleteModal" tabindex="-1" aria-labelledby="addAthleteModalLabel" aria-hidden="true">
                        <div class="mt-5 modal-dialog">
                            <div class="modal-content">
                            <form method="POST" action="add_athlete.php">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addAthleteModalLabel">Add New Athlete</h5>
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
                                                <label for="last_name" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="first_name" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="middle_initial" class="form-label">Middle Initial</label>
                                                <input type="text" class="form-control" id="middle_initial" name="middle_initial">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="age" class="form-label">Age</label>
                                                <input type="number" class="form-control" id="age" name="age" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="t_shirt_size" class="form-label">T-Shirt Size</label>
                                                <input type="text" class="form-control" id="t_shirt_size" name="t_shirt_size" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Athlete</button>
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
                                <strong>Success:</strong> Successfully added athlete.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                    } elseif ($message == 2) {
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Deleted:</strong> Athlete removed from the list.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                    } elseif ($message == 3) {
                        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Edited:</strong> Athlete updated from the list.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                    }
                }
                ?>

                <div style="overflow-y: auto; max-height: 70vh;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 5%;"><a href="?sort=id&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'id' && (!isset($_GET['order']) || $_GET['order'] == 'asc')) ? 'desc' : 'asc'; ?>" class="text-decoration-none text-black">ID <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'id') ? (isset($_GET['order']) && $_GET['order'] == 'desc' ? '<i class="bi bi-arrow-down"></i>' : '<i class="bi bi-arrow-up"></i>') : ''; ?></a></th>
                                <th style="width: 15%;"><a href="?sort=sport_id&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'sport_id' && (!isset($_GET['order']) || $_GET['order'] == 'asc')) ? 'desc' : 'asc'; ?>" class="text-decoration-none text-black">Sport <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'sport_id') ? (isset($_GET['order']) && $_GET['order'] == 'desc' ? '<i class="bi bi-arrow-down"></i>' : '<i class="bi bi-arrow-up"></i>') : ''; ?></a></th>
                                <th style="width: 20%;"><a href="?sort=athlete_name&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'athlete_name' && (!isset($_GET['order']) || $_GET['order'] == 'asc')) ? 'desc' : 'asc'; ?>" class="text-decoration-none text-black">Athlete <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'athlete_name') ? (isset($_GET['order']) && $_GET['order'] == 'desc' ? '<i class="bi bi-arrow-down"></i>' : '<i class="bi bi-arrow-up"></i>') : ''; ?></a></th>
                                <th style="width: 15%;"><a href="?sort=date_of_birth&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'date_of_birth' && (!isset($_GET['order']) || $_GET['order'] == 'asc')) ? 'desc' : 'asc'; ?>" class="text-decoration-none text-black">Date of Birth <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'date_of_birth') ? (isset($_GET['order']) && $_GET['order'] == 'desc' ? '<i class="bi bi-arrow-down"></i>' : '<i class="bi bi-arrow-up"></i>') : ''; ?></a></th>
                                <th style="width: 5%;"><a href="?sort=age&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'age' && (!isset($_GET['order']) || $_GET['order'] == 'asc')) ? 'desc' : 'asc'; ?>" class="text-decoration-none text-black">Age <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'age') ? (isset($_GET['order']) && $_GET['order'] == 'desc' ? '<i class="bi bi-arrow-down"></i>' : '<i class="bi bi-arrow-up"></i>') : ''; ?></a></th>
                                <th style="width: 10%;"><a href="?sort=t_shirt_size&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 't_shirt_size' && (!isset($_GET['order']) || $_GET['order'] == 'asc')) ? 'desc' : 'asc'; ?>" class="text-decoration-none text-black">T-Shirt Size <?php echo (isset($_GET['sort']) && $_GET['sort'] == 't_shirt_size') ? (isset($_GET['order']) && $_GET['order'] == 'desc' ? '<i class="bi bi-arrow-down"></i>' : '<i class="bi bi-arrow-up"></i>') : ''; ?></a></th>
                                <th style="width: 15%;"><a href="?sort=email&order=<?php echo (isset($_GET['sort']) && $_GET['sort'] == 'email' && (!isset($_GET['order']) || $_GET['order'] == 'asc')) ? 'desc' : 'asc'; ?>" class="text-decoration-none text-black">Email <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'email') ? (isset($_GET['order']) && $_GET['order'] == 'desc' ? '<i class="bi bi-arrow-down"></i>' : '<i class="bi bi-arrow-up"></i>') : ''; ?></a></th>
                                <th style="width: 15%;" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sort_column = isset($_GET['sort']) ? $_GET['sort'] : 'id';
                            $sort_order = isset($_GET['order']) && $_GET['order'] == 'desc' ? 'DESC' : 'ASC';
                            $allowed_columns = ['id', 'sport_id', 'athlete_name', 'date_of_birth', 'age', 't_shirt_size', 'email'];
                            if (!in_array($sort_column, $allowed_columns)) {
                                $sort_column = 'id';
                            }

                            $query = "SELECT athletes.*, sports.name AS sport_name, 
                                      CONCAT(athletes.last_name, ', ', athletes.first_name, ' ', athletes.middle_initial) AS athlete_name 
                                      FROM athletes 
                                      JOIN sports ON athletes.sport_id = sports.id 
                                      ORDER BY $sort_column $sort_order";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($athlete = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td class='text-muted py-4'>{$athlete['id']}</td>";
                                    echo "<td class='text-muted py-4'>{$athlete['sport_name']}</td>";
                                    echo "<td class='text-muted py-4'>{$athlete['athlete_name']}</td>";
                                    echo "<td class='text-muted py-4'>{$athlete['date_of_birth']}</td>";
                                    echo "<td class='text-muted py-4'>{$athlete['age']}</td>";
                                    echo "<td class='text-muted py-4'>{$athlete['t_shirt_size']}</td>";
                                    echo "<td class='text-muted py-4'>{$athlete['email']}</td>";
                                    echo "<td class='text-end py-4'>
                                        <a href='edit_athlete.php?id={$athlete['id']}' class='btn btn-sm text-primary'><i class='bi bi-pencil'></i> Edit</a> | 
                                        <a href='delete_athlete.php?id={$athlete['id']}' class='btn btn-sm text-danger'><i class='bi bi-trash'></i> Delete</a>
                                    </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='10' class='text-center text-muted py-2'>No athletes found</td></tr>";
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