<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Sports Award</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .certificate {
            width: 90%;
            margin: 30px auto;
            padding: 20px;
            border: 10px solid #000;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        .certificate h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }
        .certificate h2 {
            font-size: 50px;
            margin-bottom: 20px;
        }
        .certificate p {
            font-size: 18px;
            margin: 10px 0;
        }
        .signature {
            margin-top: 50px;
            display: flex;
            justify-content: space-around;
        }
        .signature div {
            text-align: center;
        }
        .signature-line {
            margin-top: 20px;
            border-top: 1px solid #000;
            width: 200px;
            margin-left: auto;
            margin-right: auto;
        }
        .b1, .b2 {
            border-radius: 20px;
            padding: 10px 20px;
            cursor: pointer;
            background-color: transparent;
            width: 100px;
        }
        @media print {
            @page {
                size: landscape;
            }
            body {
                transform: none;
                width: auto;
                height: 90vh;
                overflow: visible;
            }

            .b1, .b2 {
                display: none; /* Hide buttons when printing */
            }
        }
    </style>
</head>
<body>
<?php
include 'session.php';
include '../connection.php';

if (isset($_GET['id'])) {
    $athlete_id = intval($_GET['id']); // Get the ID from the link and sanitize it

    $query = "SELECT 
        athletes.id,
        athletes.last_name,
        athletes.first_name,
        athletes.middle_initial,
        sports.name AS sport_name
    FROM 
        athletes
    JOIN 
        sports ON athletes.sport_id = sports.id
    WHERE 
        athletes.id = $athlete_id"; // Add WHERE clause to filter by ID

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $full_name = $row['first_name'] . ' ' . $row['middle_initial'] . '. ' . $row['last_name'];
            $sport_name = $row['sport_name'];
            $date = date('F j, Y'); // Current date
            ?>
            <div class="certificate">
                <img src="../assets/img/nemsu_logo.png" alt="NEMSU Logo" class="img-fluid me-3" style="width: 10%;">
                <h1>🏆 Certificate of Achievement 🏆</h1>
                <p style="margin-top: 2%;">This Certificate is Proudly Presented to</p>
                <h2 style="margin-bottom: 2%"><strong><?php echo $full_name; ?></strong></h2>
                <p>For outstanding performance and excellence in</p>
                <p><strong><?php echo $sport_name; ?></strong></p>
                <p>Awarded this day: <strong><?php echo $date; ?></strong></p>
                <?php
                $settings_query = "SELECT event_name, location, organizer_name FROM settings WHERE id = 1";
                $settings_result = $conn->query($settings_query);

                if ($settings_result->num_rows > 0) {
                    $settings = $settings_result->fetch_assoc();
                    $event_name = $settings['event_name'];
                    $location = $settings['location'];
                    $organizer_name = $settings['organizer_name'];
                } else {
                    $event_name = "Unknown Event";
                    $location = "Unknown Location";
                    $organizer_name = "Unknown Organizer";
                }
                ?>
                <p>Event: <strong><?php echo $event_name; ?></strong></p>
                <p>Location: <strong><?php echo $location; ?></strong></p>
                <p style="margin-top: 2%">🏅 Your dedication, skill, and sportsmanship have truly made a difference. Keep striving for greatness!</p>
                <div class="signature">
                    <div>
                        <div class="signature-line"></div>
                        <p><?php echo $organizer_name; ?></p>
                    </div>
                </div>
                <div style="margin-top: 30px;">
                    <button class="b1" onclick="window.print()">Print</button>
                    <button class="b2" onclick="window.history.back()">Back</button>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<p>No data available to display certificates.</p>";
    }
} else {
    echo "<p>Invalid request. No ID provided.</p>";
}
?>
<script>
    print()
</script>
</body>
</html>


