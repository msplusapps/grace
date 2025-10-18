<?php
// Handle deleting a student
if (isset($_GET['delete'])) {
    $student_id = (int)$_GET['delete'];
    delete_student($student_id);
    header('Location: index.php?page=students&deleted=1');
    exit;
}

// Get search term
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Get the list of students
$students = get_students($search);
?>

<h2>Manage Students</h2>

<div class="page-header">
    <a href="index.php?page=add_student" class="btn btn-primary">Add New Student</a>
    <form action="index.php" method="get" class="search-form">
        <input type="hidden" name="page" value="students">
        <input type="text" name="search" placeholder="Search students..." value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Search</button>
    </form>
</div>

<?php if (isset($_GET['added'])): ?>
    <div class="alert alert-success">Student added successfully!</div>
<?php endif; ?>

<?php if (isset($_GET['updated'])): ?>
    <div class="alert alert-success">Student updated successfully!</div>
<?php endif; ?>

<?php if (isset($_GET['deleted'])): ?>
    <div class="alert alert-success">Student deleted successfully!</div>
<?php endif; ?>

<table class="data-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Class</th>
            <th>Parent's Phone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($students)): ?>
            <tr>
                <td colspan="4">No students found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($student['class']); ?></td>
                    <td><?php echo htmlspecialchars($student['parent_phone']); ?></td>
                    <td>
                        <a href="index.php?page=edit_student&id=<?php echo $student['id']; ?>" class="btn btn-sm">Edit</a>
                        <a href="index.php?page=students&delete=<?php echo $student['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
