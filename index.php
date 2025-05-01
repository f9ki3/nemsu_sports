<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS and Icons should be included in header.php -->
    <?php include 'header.php'; ?>
    <?php include 'session.php'; ?>
</head>
<body>
    <div class="container" style="height: 100vh;">
        <div class="row mt-5">
            <div class="col-12 col-md-3 pt-5">
                <div class="text-center mt-5">
                    <img src="assets/img/nemsu_logo.png" alt="logo" style="width: 40%;" class="img-fluid mb-4">
                </div>
                <h3 class="text-center mb-4 fw-bold">Welcome Admin</h3>
                <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
                    <div class="alert alert-danger" role="alert">
                        Invalid credentials. Please try again.
                    </div>
                <?php endif; ?>
                <form action="login_process.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control border-dark" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control border-dark" id="password" name="password" required>
                            <button type="button" class="btn btn-outline-dark" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>     
            </div>
            <div class="col-12 col-md-9">
                <div class="text-center">
                    <img src="assets/img/art1.svg" alt="art" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- Toggle Password Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const togglePassword = document.getElementById('togglePassword');
            const passwordField = document.getElementById('password');

            togglePassword.addEventListener('click', function () {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                this.innerHTML = type === 'password' 
                    ? '<i class="bi bi-eye"></i>' 
                    : '<i class="bi bi-eye-slash"></i>';
            });
        });
    </script>

    <?php include 'footer.php'; ?>
</body>
</html>
