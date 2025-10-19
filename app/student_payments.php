<?php
require_once __DIR__ . '/../core/base.php';

$student_id = isset($_GET['student_id']) ? (int)$_GET['student_id'] : 0;
$student = get_student($student_id);

if (!$student) {
    header('Location: /students');
    exit;
}

$payments = get_student_payments($student_id);
$page = 'student_payments';

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
            <h1>Payments for <?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?></h1>
            <a href="/payments" class="btn btn-secondary">Back to Payments</a>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Amount</th>
                            <th>Payment Date</th>
                            <th>Method</th>
                            <th>Reference</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($payments as $payment): ?>
                            <tr>
                                <td>$<?php echo number_format($payment['amount'], 2); ?></td>
                                <td><?php echo htmlspecialchars($payment['payment_date']); ?></td>
                                <td><?php echo htmlspecialchars($payment['payment_method']); ?></td>
                                <td><?php echo htmlspecialchars($payment['reference']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include __DIR__ . '/includes/footer.php';
?>
