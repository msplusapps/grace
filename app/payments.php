<?php
require_once __DIR__ . '/../core/base.php';

$page = 'payments';

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
        <?php
        // Handle delete request
        if (isset($_GET['delete'])) {
            $payment_id = (int)$_GET['delete'];
            delete_payment($payment_id);
            header('Location: /payments');
            exit;
        }

        // Get search term
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $payments = get_payments($search);
        ?>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Manage Payments</h1>
            <a href="/add_payment" class="btn btn-primary">Add New Payment</a>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Amount</th>
                            <th>Payment Date</th>
                            <th>Method</th>
                            <th>Reference</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($payments as $payment): ?>
                            <tr>
                                <td><a href="/student_payments?student_id=<?php echo $payment['student_id']; ?>"><?php echo htmlspecialchars($payment['student_name']); ?></a></td>
                                <td>$<?php echo number_format($payment['amount'], 2); ?></td>
                                <td><?php echo htmlspecialchars($payment['payment_date']); ?></td>
                                <td><?php echo htmlspecialchars($payment['payment_method']); ?></td>
                                <td><?php echo htmlspecialchars($payment['reference']); ?></td>
                                <td>
                                    <a href="/payments?delete=<?php echo $payment['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this payment?');">Delete</a>
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
include __DIR__ . '/includes/footer.php';
?>
