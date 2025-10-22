<?php
require_once __DIR__ . '/../core/base.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validate_csrf_token($_POST['csrf_token'])) {
        die('Invalid CSRF token');
    }

    $school_name = trim($_POST['school_name']);
    $school_email = trim($_POST['school_email']);
    $school_phone = trim($_POST['school_phone']);
    $school_address = trim($_POST['school_address']);

    update_school_setting('school_name', $school_name);
    update_school_setting('school_email', $school_email);
    update_school_setting('school_phone', $school_phone);
    update_school_setting('school_address', $school_address);

    header('Location: /school_info');
    exit;
}

$page = 'school_info';
$school_name = get_school_setting('school_name');
$school_email = get_school_setting('school_email');
$school_phone = get_school_setting('school_phone');
$school_address = get_school_setting('school_address');

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/sidebar.php';
?>

<div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container-fluid">
            <button class="btn btn-primary" id="sidebarToggle">Toggle Menu</button>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo htmlspecialchars($_SESSION['username']); ?></a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/profile">Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>School Information</h1>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="/school_info" method="post">
                    <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="school_name" class="form-label">School Name</label>
                                <input type="text" name="school_name" id="school_name" class="form-control" value="<?php echo htmlspecialchars($school_name); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="school_email" class="form-label">School Email</label>
                                <input type="email" name="school_email" id="school_email" class="form-control" value="<?php echo htmlspecialchars($school_email); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="school_phone" class="form-label">School Phone</label>
                                <input type="text" name="school_phone" id="school_phone" class="form-control" value="<?php echo htmlspecialchars($school_phone); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="school_address" class="form-label">School Address</label>
                                <input type="text" name="school_address" id="school_address" class="form-control" value="<?php echo htmlspecialchars($school_address); ?>">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Information</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include __DIR__ . '/includes/footer.php';
?>
