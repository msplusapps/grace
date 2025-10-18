<?php
// Get all students for the dropdown
$students = get_students();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = (int)$_POST['student_id'];
    $amount = (float)$_POST['amount'];
    $payment_date = trim($_POST['payment_date']);
    $payment_method = trim($_POST['payment_method']);
    $reference = trim($_POST['reference']);

    // Basic validation
    if (empty($student_id) || empty($amount) || empty($payment_date) || empty($payment_method)) {
        $error = "Please fill in all required fields.";
    } else {
        // Add the payment to the database
        add_payment($student_id, $amount, $payment_date, $payment_method, $reference);
        // Redirect to the payments page
        header('Location: index.php?page=payments&added=1');
        exit;
    }
}
?>

<h2>Add New Payment</h2>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<form action="index.php?page=add_payment" method="post">
    <div class="form-group">
        <label for="student_id">Select Student:</label>
        <select name="student_id" id="student_id" class="form-control" required>
            <option value="">-- Select Student --</option>
            <?php foreach ($students as $student): ?>
                <option value="<?php echo $student['id']; ?>">
                    <?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="amount">Amount:</label>
        <input type="number" step="0.01" name="amount" id="amount" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="payment_date">Payment Date:</label>
        <input type="date" name="payment_date" id="payment_date" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="payment_method">Payment Method:</label>
        <select name="payment_method" id="payment_method" class="form-control" required>
            <option value="Cash">Cash</option>
            <option value="Bank Transfer">Bank Transfer</option>
            <option value="Online">Online</option>
        </select>
    </div>
    <div class="form-group">
        <label for="reference">Reference:</label>
        <input type="text" name="reference" id="reference" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Add Payment</button>
    <a href="index.php?page=payments" class="btn">Cancel</a>
</form>
