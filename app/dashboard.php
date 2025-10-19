<?php
require_once __DIR__ . '/../core/base.php';

$page = 'dashboard';

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/sidebar.php';

// Get dashboard statistics
$student_count = get_student_count();
$total_revenue = get_total_payments();
$pending_payments = get_pending_payments_count();
$overdue_payments = get_overdue_payments_count();
$recent_payments = get_recent_payments();
$recent_students = get_recent_students();
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

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="card-title">Total Students</h5>
                                <p class="card-text fs-4"><?php echo $student_count; ?></p>
                            </div>
                            <div class="fs-2 text-primary">
                                <i data-feather="users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="card-title">Total Revenue</h5>
                                <p class="card-text fs-4">$<?php echo number_format($total_revenue, 2); ?></p>
                            </div>
                            <div class="fs-2 text-success">
                                <i data-feather="dollar-sign"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="card-title">Pending Payments</h5>
                                <p class="card-text fs-4"><?php echo $pending_payments; ?></p>
                            </div>
                            <div class="fs-2 text-warning">
                                <i data-feather="clock"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="card-title">Overdue Payments</h5>
                                <p class="card-text fs-4"><?php echo $overdue_payments; ?></p>
                            </div>
                            <div class="fs-2 text-danger">
                                <i data-feather="alert-triangle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Revenue Overview</h5>
                        <canvas id="paymentsChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Recent Payments</h5>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($recent_payments as $payment): ?>
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <span><?php echo htmlspecialchars($payment['first_name'] . ' ' . $payment['last_name']); ?></span>
                                        <span class="text-success">$<?php echo number_format($payment['amount'], 2); ?></span>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Recent Students</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_students as $student): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?></td>
                                <td><?php echo htmlspecialchars($student['class']); ?></td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>
                                    <a href="/edit_student?id=<?php echo $student['id']; ?>" class="btn btn-sm btn-outline-primary">View</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
$payment_chart_data = get_payment_data_for_chart();
$chart_labels = json_encode(array_column($payment_chart_data, 'date'));
$chart_values = json_encode(array_column($payment_chart_data, 'total'));
?>
<script>
    const chartLabels = <?php echo $chart_labels; ?>;
    const chartValues = <?php echo $chart_values; ?>;
</script>

<?php
include __DIR__ . '/includes/footer.php';
?>
