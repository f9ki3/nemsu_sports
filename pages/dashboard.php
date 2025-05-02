<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php include '../header.php'; ?>
</head>
<body>
    <div>
        <?php include 'head_nav.php'; ?>
        <div style="height: 90vh;" class="d-flex flex-row">
            <div style="width: 15%">
                <?php include 'navigation.php'; ?>
            </div>
            <div style="width: 85%">
                <div class="container g-3 p-3">
                    <h3 class="fw-bolder">Dashboard</h3>
                    <div class="row mt-4">
                        <?php 
                        $cards = [
                            ['title' => 'Sports', 'table' => 'sports', 'icon' => 'bi-trophy', 'bgColor' => 'orange'],
                            ['title' => 'Campuses', 'table' => 'campus', 'icon' => 'bi-building', 'bgColor' => 'blue'],
                            ['title' => 'Athletes', 'table' => 'athletes', 'icon' => 'bi-people', 'bgColor' => 'green'],
                            ['title' => 'Coaches', 'table' => 'coaches', 'icon' => 'bi-person-badge', 'bgColor' => 'red']
                        ];

                        foreach ($cards as $key => $card) {
                            $query = "SELECT COUNT(*) as count FROM " . $card['table'];
                            $result = $conn->query($query);
                            $row = $result->fetch_assoc();
                            $cards[$key]['count'] = $row['count'];
                        }

                        foreach ($cards as $card): ?>
                            <div class="col-md-3">
                                <div class="border rounded-4 p-3 text-center position-relative">
                                    <div class="card-body text-start">
                                        <div class="d-flex justify-content-between">
                                            <p class="card-title">
                                                <?php echo $card['title']; ?>
                                            </p>
                                        </div>
                                        <p class="card-text display-4 fw-bold"><?php echo $card['count']; ?></p>
                                        <div style="background-color: <?php echo $card['bgColor']; ?>; border-radius: 100%; position: absolute; top: 10px; right: 10px;" class="p-3">
                                            <i class="bi text-light <?php echo $card['icon']; ?> fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>


                <?php
                // Fetch data for the chart
                $query = "SELECT 
                            c.name AS campus_name,
                            SUM(sa.gold) AS total_gold,
                            SUM(sa.silver) AS total_silver,
                            SUM(sa.bronze) AS total_bronze
                          FROM sports_award sa
                          JOIN campus c ON sa.campus_id = c.id
                          GROUP BY sa.campus_id
                          ORDER BY total_gold DESC, total_silver DESC, total_bronze DESC";

                $stmt = $conn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();

                $campus_names = [];
                $gold_medals = [];
                $silver_medals = [];
                $bronze_medals = [];

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($award = mysqli_fetch_assoc($result)) {
                        $campus_names[] = $award['campus_name'];
                        $gold_medals[] = $award['total_gold'];
                        $silver_medals[] = $award['total_silver'];
                        $bronze_medals[] = $award['total_bronze'];
                    }
                }
                ?>

                <div class="row mt-5">
                    <div class="col-12 col-md-6">
                        <!-- Bar chart container -->
                        <div id="medalChart"></div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                var options = {
                                    chart: {
                                        type: 'bar',
                                        height: 450,
                                        toolbar: {
                                            tools: {
                                                download: false // Disable download or save as PNG
                                            }
                                        }
                                    },
                                    series: [
                                        {
                                            name: 'Gold',
                                            data: <?php echo json_encode($gold_medals); ?>
                                        },
                                        {
                                            name: 'Silver',
                                            data: <?php echo json_encode($silver_medals); ?>
                                        },
                                        {
                                            name: 'Bronze',
                                            data: <?php echo json_encode($bronze_medals); ?>
                                        }
                                    ],
                                    xaxis: {
                                        categories: <?php echo json_encode($campus_names); ?>
                                    },
                                    colors: ['#FFD700', '#C0C0C0', '#CD7F32'],
                                    title: {
                                        text: 'Medal Distribution by Campus'
                                    }
                                };

                                var chart = new ApexCharts(document.querySelector("#medalChart"), options);
                                chart.render();
                            });
                        </script>
                    </div>
                    <div class="col-12 col-md-6">
                        <div style="overflow-y: auto; max-height: 60vh;">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="3%">Rank</th>
                                        <th width="10%">Campus</th>
                                        <th width="3%">Gold</th>
                                        <th width="3%">Silver</th>
                                        <th width="3%">Bronze</th>
                                        <th width="3%">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $rank = 1;
                                    $result->data_seek(0); // Reset result pointer
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        while ($award = mysqli_fetch_assoc($result)) {
                                            $total_medals = $award['total_gold'] + $award['total_silver'] + $award['total_bronze'];
                                            echo "<tr>";
                                            echo "<td class=' py-4 fw-bold'>{$rank}</td>";
                                            echo "<td class='text-muted py-4'>{$award['campus_name']}</td>";
                                            echo "<td class=' py-4' style='color: gold;'><i class='bi bi-star-fill'></i> {$award['total_gold']}</td>";
                                            echo "<td class=' py-4' style='color: silver;'><i class='bi bi-star-fill'></i> {$award['total_silver']}</td>";
                                            echo "<td class=' py-4' style='color: #cd7f32;'><i class='bi bi-star-fill'></i> {$award['total_bronze']}</td>";
                                            echo "<td class=' py-4 fw-bold'>{$total_medals}</td>";
                                            echo "</tr>";
                                            $rank++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' class=' text-muted py-2'>No awards found</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>