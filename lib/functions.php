<?php
/**
 * Get a setting from the database.
 * @param string $key The setting key.
 * @return mixed The setting value, or null if not found.
 */
function get_setting($key) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT setting_value FROM settings WHERE setting_key = ?");
    $stmt->execute([$key]);
    return $stmt->fetchColumn();
}

/**
 * Update a setting in the database.
 * @param string $key The setting key.
 * @param mixed $value The new setting value.
 * @return bool True on success, false on failure.
 */
function update_setting($key, $value) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE settings SET setting_value = ? WHERE setting_key = ?");
    return $stmt->execute([$value, $key]);
}

/**
 * Get all available themes from the database.
 * @return array An array of themes.
 */
function get_themes() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM themes");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Get the CSS file for the active theme.
 * @return string The CSS file path.
 */
function get_active_theme_css() {
    $active_theme_id = get_setting('active_theme');
    if (!$active_theme_id) {
        return 'css/themes/default.css'; // Default theme
    }
    global $pdo;
    $stmt = $pdo->prepare("SELECT css_file FROM themes WHERE id = ?");
    $stmt->execute([$active_theme_id]);
    $theme = $stmt->fetch(PDO::FETCH_ASSOC);
    return 'css/themes/' . ($theme ? $theme['css_file'] : 'default.css');
}

/**
 * Get a list of students, with optional search.
 * @param string $search The search term.
 * @return array An array of students.
 */
function get_students($search = '') {
    global $pdo;
    $sql = "SELECT * FROM students";
    $params = [];
    if (!empty($search)) {
        $sql .= " WHERE first_name LIKE ? OR last_name LIKE ?";
        $params[] = "%$search%";
        $params[] = "%$search%";
    }
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Get a single student by ID.
 * @param int $id The student ID.
 * @return array|false The student data, or false if not found.
 */
function get_student($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Delete a student from the database.
 * @param int $id The student ID.
 * @return bool True on success, false on failure.
 */
function delete_student($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
    return $stmt->execute([$id]);
}

/**
 * Add a new student to the database.
 * @param string $first_name
 * @param string $last_name
 * @param string $class
 * @param string $date_of_birth
 * @param string $address
 * @param string $parent_phone
 * @return bool True on success, false on failure.
 */
function add_student($first_name, $last_name, $class, $date_of_birth, $address, $parent_phone) {
    global $pdo;
    $sql = "INSERT INTO students (first_name, last_name, class, date_of_birth, address, parent_phone) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$first_name, $last_name, $class, $date_of_birth, $address, $parent_phone]);
}

/**
 * Update a student's information in the database.
 * @param int $id
 * @param string $first_name
 * @param string $last_name
 * @param string $class
 * @param string $date_of_birth
 * @param string $address
 * @param string $parent_phone
 * @return bool True on success, false on failure.
 */
function update_student($id, $first_name, $last_name, $class, $date_of_birth, $address, $parent_phone) {
    global $pdo;
    $sql = "UPDATE students SET first_name = ?, last_name = ?, class = ?, date_of_birth = ?, address = ?, parent_phone = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$first_name, $last_name, $class, $date_of_birth, $address, $parent_phone, $id]);
}

/**
 * Get a list of payments, with optional search by student name.
 * @param string $search The search term.
 * @return array An array of payments.
 */
function get_payments($search = '') {
    global $pdo;
    $sql = "SELECT p.*, CONCAT(s.first_name, ' ', s.last_name) AS student_name
            FROM payments p
            JOIN students s ON p.student_id = s.id";
    $params = [];
    if (!empty($search)) {
        $sql .= " WHERE s.first_name LIKE ? OR s.last_name LIKE ?";
        $params[] = "%$search%";
        $params[] = "%$search%";
    }
    $sql .= " ORDER BY p.payment_date DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Get all payments for a specific student.
 * @param int $student_id The student ID.
 * @return array An array of payments.
 */
function get_student_payments($student_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM payments WHERE student_id = ? ORDER BY payment_date DESC");
    $stmt->execute([$student_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Add a new payment to the database.
 * @param int $student_id
 * @param float $amount
 * @param string $payment_date
 * @param string $payment_method
 * @param string $reference
 * @return bool True on success, false on failure.
 */
function add_payment($student_id, $amount, $payment_date, $payment_method, $reference) {
    global $pdo;
    $sql = "INSERT INTO payments (student_id, amount, payment_date, payment_method, reference) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$student_id, $amount, $payment_date, $payment_method, $reference]);
}

/**
 * Delete a payment from the database.
 * @param int $id The payment ID.
 * @return bool True on success, false on failure.
 */
function delete_payment($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM payments WHERE id = ?");
    return $stmt->execute([$id]);
}

/**
 * Get the total number of students.
 * @return int The total number of students.
 */
function get_student_count() {
    global $pdo;
    $stmt = $pdo->query("SELECT COUNT(*) FROM students");
    return $stmt->fetchColumn();
}

/**
 * Get the sum of all payments.
 * @return float The total amount of all payments.
 */
function get_total_payments() {
    global $pdo;
    $stmt = $pdo->query("SELECT SUM(amount) FROM payments");
    return $stmt->fetchColumn();
}

/**
 * Get payment data for the last 30 days for charting.
 * @return array An array of payment data.
 */
function get_payment_data_for_chart() {
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT DATE(payment_date) as date, SUM(amount) as total
        FROM payments
        WHERE payment_date >= CURDATE() - INTERVAL 30 DAY
        GROUP BY DATE(payment_date)
        ORDER BY DATE(payment_date)
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
