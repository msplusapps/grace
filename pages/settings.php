<?php
// Handle theme change
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['theme'])) {
    $selected_theme_id = (int)$_POST['theme'];
    // Update the active_theme setting in the database
    update_setting('active_theme', $selected_theme_id);
    // Redirect back to the settings page
    header('Location: index.php?page=settings&success=1');
    exit;
}

// Get available themes from the database
$themes = get_themes();
// Get the active theme
$active_theme_id = get_setting('active_theme');
?>

<h2>Settings</h2>

<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">Settings saved successfully!</div>
<?php endif; ?>

<form action="index.php?page=settings" method="post">
    <div class="form-group">
        <label for="theme">Select Theme:</label>
        <select name="theme" id="theme" class="form-control">
            <?php foreach ($themes as $theme): ?>
                <option value="<?php echo $theme['id']; ?>" <?php echo ($theme['id'] == $active_theme_id) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($theme['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Save Settings</button>
</form>
