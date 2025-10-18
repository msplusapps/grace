<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $class = trim($_POST['class']);
    $date_of_birth = trim($_POST['date_of_birth']);
    $address = trim($_POST['address']);
    $parent_phone = trim($_POST['parent_phone']);

    // Basic validation
    if (empty($first_name) || empty($last_name) || empty($class)) {
        $error = "Please fill in all required fields.";
    } else {
        // Add the student to the database
        add_student($first_name, $last_name, $class, $date_of_birth, $address, $parent_phone);
        // Redirect to the students page
        header('Location: index.php?page=students&added=1');
        exit;
    }
}
?>

<h2>Add New Student</h2>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<form action="index.php?page=add_student" method="post">
    <div class="form-group">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="class">Class:</label>
        <input type="text" name="class" id="class" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control">
    </div>
    <div class="form-group">
        <label for="address">Address:</label>
        <textarea name="address" id="address" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="parent_phone">Parent's Phone:</label>
        <input type="text" name="parent_phone" id="parent_phone" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Add Student</button>
    <a href="index.php?page=students" class="btn">Cancel</a>
</form>
