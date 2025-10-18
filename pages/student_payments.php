<?php
// Get the student ID from the URL
$student_id = isset($_GET['student_id']) ? (int)$_GET['student_id'] : 0;

// Get the student's data
$student = get_student($student_id);

// If the student doesn't exist, redirect to the students page
if (!$student) {
    header('Location: index.php?page=students');
    exit;
}

// Get the payments for this student
$payments = get_student_payments($student_id);
?>

<h2>Payments for <?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?></h2>

<table class="data-table">
    <thead>
        <tr>
            <th>Amount</th>
            <th>Payment Date</th>
            <th>Method</th>
            <th>Reference</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($payments)): ?>
            <tr>
                <td colspan="4">No payments found for this student.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($payments as $payment): ?>
                <tr>
                    <td><?php echo htmlspecialchars($payment['amount']); ?></td>
                    <td><?php echo htmlspecialchars($payment['payment_date']); ?></td>
                    <td><?php echo htmlspecialchars($payment['payment_method']); ?></td>
                    <td><?php echo htmlspecialchars($payment['reference']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<a href="index.php?page=payments" class="btn">Back to All Payments</a>
