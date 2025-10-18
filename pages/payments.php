<?php
// Handle deleting a payment
if (isset($_GET['delete'])) {
    $payment_id = (int)$_GET['delete'];
    delete_payment($payment_id);
    header('Location: index.php?page=payments&deleted=1');
    exit;
}

// Get search term
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Get the list of payments
$payments = get_payments($search);
?>

<h2>Manage Payments</h2>

<div class="page-header">
    <a href="index.php?page=add_payment" class="btn btn-primary">Add New Payment</a>
    <form action="index.php" method="get" class="search-form">
        <input type="hidden" name="page" value="payments">
        <input type="text" name="search" placeholder="Search by student name..." value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Search</button>
    </form>
</div>

<?php if (isset($_GET['added'])): ?>
    <div class="alert alert-success">Payment added successfully!</div>
<?php endif; ?>

<?php if (isset($_GET['deleted'])): ?>
    <div class="alert alert-success">Payment deleted successfully!</div>
<?php endif; ?>

<table class="data-table">
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
        <?php if (empty($payments)): ?>
            <tr>
                <td colspan="6">No payments found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($payments as $payment): ?>
                <tr>
                    <td>
                        <a href="index.php?page=student_payments&student_id=<?php echo $payment['student_id']; ?>">
                            <?php echo htmlspecialchars($payment['student_name']); ?>
                        </a>
                    </td>
                    <td><?php echo htmlspecialchars($payment['amount']); ?></td>
                    <td><?php echo htmlspecialchars($payment['payment_date']); ?></td>
                    <td><?php echo htmlspecialchars($payment['payment_method']); ?></td>
                    <td><?php echo htmlspecialchars($payment['reference']); ?></td>
                    <td>
                        <a href="index.php?page=payments&delete=<?php echo $payment['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this payment?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
