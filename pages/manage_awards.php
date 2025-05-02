<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Awards</title>
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
                    <h3 class="fw-bold">Sports Awards</h3>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn rounded-4 btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addAwardModal">
                        Create Award
                    </button>

                    <!-- Modal -->
                    <div class="modal mt-5 fade" id="addAwardModal" tabindex="-1" aria-labelledby="addAwardModalLabel" aria-hidden="true">
                        <div class="mt-5 modal-dialog">
                            <div class="modal-content">
                            <form method="POST" action="add_award.php" onsubmit="return validateMedals()">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addAwardModalLabel">Create New Award</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="student_id" class="form-label">Athlete</label>
                                        <select class="form-control" id="student_id" name="student_id" required>
                                            <?php
                                            $athletes_query = "SELECT id, CONCAT(last_name, ', ', first_name, ' ', middle_initial) AS athlete_name FROM athletes";
                                            $athletes_result = mysqli_query($conn, $athletes_query);
                                            while ($athlete = mysqli_fetch_assoc($athletes_result)) {
                                                echo "<option value='{$athlete['id']}'>{$athlete['athlete_name']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="campus_id" class="form-label">Campus</label>
                                        <select class="form-control" id="campus_id" name="campus_id" required>
                                            <?php
                                            $campus_query = "SELECT * FROM campus";
                                            $campus_result = mysqli_query($conn, $campus_query);
                                            while ($campus = mysqli_fetch_assoc($campus_result)) {
                                                echo "<option value='{$campus['id']}'>{$campus['name']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="gold" class="form-label">Gold Medals</label>
                                                <input type="number" class="form-control medal-input" id="gold" name="gold" min="0" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="silver" class="form-label">Silver Medals</label>
                                                <input type="number" class="form-control medal-input" id="silver" name="silver" min="0" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="bronze" class="form-label">Bronze Medals</label>
                                                <input type="number" class="form-control medal-input" id="bronze" name="bronze" min="0" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Create Award</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>

                    <script>
                        function validateMedals() {
                            const gold = parseInt(document.getElementById('gold').value) || 0;
                            const silver = parseInt(document.getElementById('silver').value) || 0;
                            const bronze = parseInt(document.getElementById('bronze').value) || 0;

                            if ((gold > 0 && silver > 0) || (gold > 0 && bronze > 0) || (silver > 0 && bronze > 0)) {
                                alert('You can only assign medals to one category (Gold, Silver, or Bronze).');
                                return false;
                            }

                            return true;
                        }

                        document.querySelectorAll('.medal-input').forEach(input => {
                            input.addEventListener('input', function() {
                                if (this.value > 0) {
                                    document.querySelectorAll('.medal-input').forEach(otherInput => {
                                        if (otherInput !== this) {
                                            otherInput.value = 0;
                                        }
                                    });
                                }
                            });
                        });
                    </script>
                </div>

                <?php
                if (isset($_GET['message'])) {
                    $message = htmlspecialchars($_GET['message']);
                    if ($message == 1) {
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>Success:</strong> Successfully award athlete.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                    } elseif ($message == 2) {
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>Deleted:</strong> Athlete awards from the list.
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
                                <th width="5%">ID</th>
                                <th width="10%">Athlete Name</th>
                                <th width="10%">Sport</th>
                                <th width="10%">Campus</th>
                                <th width="5%">Gold</th>
                                <th width="5%">Silver</th>
                                <th width="5%">Bronze</th>
                                <th width="15%" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT 
                                        sa.id AS award_id,
                                        a.id AS athlete_id,
                                        CONCAT(a.last_name, ', ', a.first_name, ' ', a.middle_initial) AS athlete_name,
                                        a.date_of_birth,
                                        a.age,
                                        a.t_shirt_size,
                                        a.email,
                                        s.name AS sport_name,
                                        s.description AS sport_description,
                                        c.name AS campus_name,
                                        c.description AS campus_description,
                                        sa.student_id,
                                        sa.gold,
                                        sa.silver,
                                        sa.bronze
                                    FROM sports_award sa
                                    JOIN athletes a ON sa.student_id = a.id
                                    JOIN sports s ON a.sport_id = s.id
                                    JOIN campus c ON sa.campus_id = c.id";

                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($award = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td class='text-muted py-4'>{$award['award_id']}</td>";
                                    echo "<td class='text-muted py-4'>{$award['athlete_name']}</td>";
                                    echo "<td class='text-muted py-4'>{$award['sport_name']}</td>";
                                    echo "<td class='text-muted py-4'>{$award['campus_name']}</td>";
                                    echo "<td class='text-center py-4' style='color: gold;'><i class='bi bi-star-fill'></i> {$award['gold']}</td>";
                                    echo "<td class='text-center py-4' style='color: silver;'><i class='bi bi-star-fill'></i> {$award['silver']}</td>";
                                    echo "<td class='text-center py-4' style='color: #cd7f32;'><i class='bi bi-star-fill'></i> {$award['bronze']}</td>";
                                    echo "<td class='text-end py-4'>
                                        <a href='print_award.php?id={$award['student_id']}' class='btn btn-sm text-primary'><i class='bi bi-printer'></i> Print Award</a> | 
                                        <a href='delete_award.php?id={$award['award_id']}' class='btn btn-sm text-danger'><i class='bi bi-trash'></i> Delete</a>
                                    </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='9' class='text-center text-muted py-2'>No awards found</td></tr>";
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