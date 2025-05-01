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
                    <h3 class="fw-bold">Manage Sports</h3>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn rounded-4 btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addSportModal">
                        Add Sport
                    </button>

                    <!-- Modal -->
                    <div class="modal mt-5 fade" id="addSportModal" tabindex="-1" aria-labelledby="addSportModalLabel" aria-hidden="true">
                        <div class="mt-5 modal-dialog">
                            <div class="modal-content">
                            <form method="POST" action="add_sport.php">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addSportModalLabel">Add New Sport</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="sport_name" class="form-label">Sport Name</label>
                                        <input type="text" class="form-control" id="sport_name" name="sport_name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sport_description" class="form-label">Sport Description</label>
                                        <textarea class="form-control" id="sport_description" name="sport_description" rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Sport</button>
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
                                <strong>Success:</strong> Successfully added sport.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                    } elseif ($message == 2) {
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Deleted:</strong>Sports remove from the list.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                    } elseif ($message == 3) {
                        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Edited:</strong>Sports updated from the list.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                    }
                }
                ?>

                <table class="table">
                    <thead>
                        <tr>
                            <?php
                            $sort_column = $_GET['sort'] ?? 'id';
                            $sort_order = $_GET['order'] ?? 'asc';
                            $new_order = $sort_order === 'asc' ? 'desc' : 'asc';

                            function get_sort_icon($column, $current_column, $current_order) {
                                if ($column === $current_column) {
                                    return $current_order === 'asc' ? '↑' : '↓';
                                }
                                return '';
                            }
                            ?>
                            <th scope="col" style="width: 10%;">
                                <a href="?sort=id&order=<?= $new_order ?>" style="text-decoration: none; color: black;">
                                    ID <?= $sort_column === 'id' ? ($sort_order === 'asc' ? '<i class="bi bi-arrow-up"></i>' : '<i class="bi bi-arrow-down"></i>') : '' ?>
                                </a>
                            </th>
                            <th scope="col" style="width: 30%;">
                                <a href="?sort=name&order=<?= $new_order ?>" style="text-decoration: none; color: black;">
                                    Sports Name <?= $sort_column === 'name' ? ($sort_order === 'asc' ? '<i class="bi bi-arrow-up"></i>' : '<i class="bi bi-arrow-down"></i>') : '' ?>
                                </a>
                            </th>
                            <th scope="col" style="width: 40%;">
                                <a href="?sort=description&order=<?= $new_order ?>" style="text-decoration: none; color: black;">
                                    Description <?= $sort_column === 'description' ? ($sort_order === 'asc' ? '<i class="bi bi-arrow-up"></i>' : '<i class="bi bi-arrow-down"></i>') : '' ?>
                                </a>
                            </th>
                            <th scope="col" style="width: 20%;" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM sports ORDER BY $sort_column $sort_order";
                        $result = mysqli_query($conn, $query);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($sport = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td class='text-muted py-3'>{$sport['id']}</td>";
                                echo "<td class='text-muted py-3'>{$sport['name']}</td>";
                                echo "<td class='text-muted py-3'>{$sport['description']}</td>";
                                echo "<td class='text-end py-3'>
                                    <a href='edit_sport.php?id={$sport['id']}' class='btn btn-sm text-primary'><i class='bi bi-pencil'></i> Edit</a> | 
                                    <a href='delete_sport.php?id={$sport['id']}' class='btn btn-sm text-danger'><i class='bi bi-trash'></i> Delete</a>
                                </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center text-muted py-2'>No sports found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <?php include 'footer.php'?>
    </div>

</body>
</html>