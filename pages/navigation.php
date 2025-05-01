<?php include 'session.php'; ?>
<?php include '../connection.php'; ?>

<div class="border-end d-flex flex-column justify-content-between" style="height: 90vh; background-color: white; overflow-y: auto;">
    <ul class="nav-list p-4" style="list-style-type: none; padding: 0; margin: 0; font-size: 1rem;">
        <div id="realtime-clock">
            <h2 class="fw-bolder" id="time"></h2>
            <p id="date"></p>
        </div>
        <script>
            function updateClock() {
            const now = new Date();
            const time = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            const date = now.toLocaleDateString([], { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
            document.getElementById('time').textContent = time;
            document.getElementById('date').textContent = date;
            }
            setInterval(updateClock, 1000);
            updateClock(); // Initial call to set the time immediately
        </script>
        <hr>
        <li class="mb-3">
            <a class="text-dark" href="./dashboard.php" style="text-decoration: none;">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>
        <li class="mb-3">
            <a class="text-dark" href="./manage_sports.php" style="text-decoration: none;">
            <i class="bi bi-trophy me-2"></i> Manage Sports
            </a>
        </li>
        <li class="mb-3">
            <a class="text-dark" href="./manage_campuses.php" style="text-decoration: none;">
            <i class="bi bi-building me-2"></i> Manage Campuses
            </a>
        </li>
        <li class="mb-3">
            <a class="text-dark" href="./manage_athletes.php" style="text-decoration: none;">
            <i class="bi bi-people me-2"></i> Manage Athletes
            </a>
        </li>
        <li class="mb-3">
            <a class="text-dark" href="./manage_coaches.php" style="text-decoration: none;">
            <i class="bi bi-person-badge me-2"></i> Manage Coaches
            </a>
        </li>
        <li class="mb-3">
            <a class="text-dark" href="./manage_inventory.php" style="text-decoration: none;">
            <i class="bi bi-box-seam me-2"></i>Manage Inventory
            </a>
        </li>
        <li class="mb-3">
            <a class="text-dark" href="./manage_awards.php" style="text-decoration: none;">
            <i class="bi bi-trophy me-2"></i> Sports Award
            </a>
        </li>
        <li class="mb-3">
            <a class="text-dark" href="./champion.php" style="text-decoration: none;">
            <i class="bi bi-award me-2"></i> Overall Champion
            </a>
        </li>
    </ul>
    <div class="p-4">
        <hr>
        <a class="btn btn-danger rounded-4" href="./logout.php" style="text-decoration: none;">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
</div>
