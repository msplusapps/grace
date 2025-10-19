<?php
// Initialize the session
session_start();

// If the user is already logged in, redirect to the dashboard
if (isset($_SESSION['user_id'])) {
    header('Location: /dashboard');
    exit;
}

// Include the database connection file
require_once '../core/config/db.php';
require_once '../core/lib/functions.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validate_csrf_token($_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }

    $ip_address = $_SERVER['REMOTE_ADDR'];
    $timestamp = time();

    // Check for failed login attempts
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM login_attempts WHERE ip_address = ? AND timestamp > ?");
    $stmt->execute([$ip_address, $timestamp - (15 * 60)]);
    $failed_attempts = $stmt->fetchColumn();

    if ($failed_attempts > 5) {
        $error = "You have been temporarily blocked due to too many failed login attempts. Please try again later.";
    } else {
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            $error = "Please enter your username and password.";
        } else {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $stmt = $pdo->prepare("DELETE FROM login_attempts WHERE ip_address = ?");
                $stmt->execute([$ip_address]);

                session_regenerate_id(true);

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                header('Location: /dashboard');
                exit;
            } else {
                $stmt = $pdo->prepare("INSERT INTO login_attempts (ip_address, timestamp) VALUES (?, ?)");
                $stmt->execute([$ip_address, $timestamp]);

                $error = "Invalid username or password.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EduPay Nexus</title>
    <link rel="stylesheet" href="vendor/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">EduPay Nexus</h3></div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <form action="/login.php" method="post">
                            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="username" name="username" type="text" placeholder="Username" required />
                                <label for="username">Username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="password" name="password" type="password" placeholder="Password" required />
                                <label for="password">Password</label>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <button class="btn btn-primary" type="submit">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/bootstrap.bundle.min.js"></script>
</body>
</html>
