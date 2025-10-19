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
    $db = Database::getInstance();
    $sql = "SELECT * FROM students";
    $params = [];
    if (!empty($search)) {
        $sql .= " WHERE first_name LIKE ? OR last_name LIKE ?";
        $params[] = "%$search%";
        $params[] = "%$search%";
    }
    return $db->select($sql, $params);
}

/**
 * Get a single student by ID.
 * @param int $id The student ID.
 * @return array|false The student data, or false if not found.
 */
function get_student($id) {
    $db = Database::getInstance();
    $result = $db->select("SELECT * FROM students WHERE id = ?", [$id]);
    return $result ? $result[0] : false;
}

/**
 * Delete a student from the database.
 * @param int $id The student ID.
 * @return bool True on success, false on failure.
 */
function delete_student($id) {
    $db = Database::getInstance();
    return $db->delete('students', "id = :id", ['id' => $id]);
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
    $db = Database::getInstance();
    $data = [
        'first_name' => $first_name,
        'last_name' => $last_name,
        'class' => $class,
        'date_of_birth' => $date_of_birth,
        'address' => $address,
        'parent_phone' => $parent_phone,
    ];
    return $db->insert('students', $data);
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
    $db = Database::getInstance();
    $data = [
        'first_name' => $first_name,
        'last_name' => $last_name,
        'class' => $class,
        'date_of_birth' => $date_of_birth,
        'address' => $address,
        'parent_phone' => $parent_phone,
    ];
    return $db->update('students', $data, "id = :id", ['id' => $id]);
}

/**
 * Get a list of payments, with optional search by student name.
 * @param string $search The search term.
 * @return array An array of payments.
 */
function get_payments($search = '') {
    $db = Database::getInstance();
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
    return $db->select($sql, $params);
}

/**
 * Get all payments for a specific student.
 * @param int $student_id The student ID.
 * @return array An array of payments.
 */
function get_student_payments($student_id) {
    $db = Database::getInstance();
    return $db->select("SELECT * FROM payments WHERE student_id = ? ORDER BY payment_date DESC", [$student_id]);
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
    $db = Database::getInstance();
    $data = [
        'student_id' => $student_id,
        'amount' => $amount,
        'payment_date' => $payment_date,
        'payment_method' => $payment_method,
        'reference' => $reference,
    ];
    return $db->insert('payments', $data);
}

/**
 * Delete a payment from the database.
 * @param int $id The payment ID.
 * @return bool True on success, false on failure.
 */
function delete_payment($id) {
    $db = Database::getInstance();
    return $db->delete('payments', "id = :id", ['id' => $id]);
}

/**
 * Get the total number of students.
 * @return int The total number of students.
 */
function get_student_count() {
    $db = Database::getInstance();
    $result = $db->select("SELECT COUNT(*) as count FROM students");
    return $result ? $result[0]['count'] : 0;
}

/**
 * Get the sum of all payments.
 * @return float The total amount of all payments.
 */
function get_total_payments() {
    $db = Database::getInstance();
    $result = $db->select("SELECT SUM(amount) as total FROM payments");
    return $result ? $result[0]['total'] : 0;
}

/**
 * Get payment data for the last 30 days for charting.
 * @return array An array of payment data.
 */
function get_payment_data_for_chart() {
    $db = Database::getInstance();
    $sql = "
        SELECT DATE(payment_date) as date, SUM(amount) as total
        FROM payments
        WHERE payment_date >= CURDATE() - INTERVAL 30 DAY
        GROUP BY DATE(payment_date)
        ORDER BY DATE(payment_date)
    ";
    return $db->select($sql);
}

/**
 * Get the count of pending payments.
 * @return int The number of pending payments.
 */
function get_pending_payments_count() {
    $db = Database::getInstance();
    // Assuming 'pending' is a status in the payment_method or a separate status column
    // For now, let's count all payments that are not 'Completed'
    $result = $db->select("SELECT COUNT(*) as count FROM payments WHERE payment_method != 'Completed'");
    return $result ? $result[0]['count'] : 0;
}

/**
 * Get the count of overdue payments.
 * @return int The number of overdue payments.
 */
function get_overdue_payments_count() {
    $db = Database::getInstance();
    // Assuming overdue payments are those not 'Completed' and past their due date
    $result = $db->select("SELECT COUNT(*) as count FROM payments WHERE payment_method != 'Completed' AND payment_date < CURDATE()");
    return $result ? $result[0]['count'] : 0;
}

/**
 * Get the most recent payments.
 * @param int $limit The number of recent payments to fetch.
 * @return array An array of recent payments.
 */
function get_recent_payments($limit = 5) {
    $db = Database::getInstance();
    $sql = "
        SELECT p.*, s.first_name, s.last_name
        FROM payments p
        JOIN students s ON p.student_id = s.id
        ORDER BY p.payment_date DESC
        LIMIT ?
    ";
    return $db->select($sql, [$limit]);
}

/**
 * Get a school setting from the database.
 * @param string $key The setting key.
 * @return mixed The setting value, or null if not found.
 */
function get_school_setting($key) {
    $db = Database::getInstance();
    $result = $db->select("SELECT setting_value FROM school_settings WHERE setting_key = ?", [$key]);
    return $result ? $result[0]['setting_value'] : null;
}

/**
 * Update a school setting in the database.
 * @param string $key The setting key.
 * @param mixed $value The new setting value.
 * @return bool True on success, false on failure.
 */
function update_school_setting($key, $value) {
    $db = Database::getInstance();
    $data = ['setting_value' => $value];
    return $db->update('school_settings', $data, "setting_key = :key", ['key' => $key]);
}

/**
 * Generate a CSRF token.
 * @return string The CSRF token.
 */
function generate_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Validate a CSRF token.
 * @param string $token The CSRF token to validate.
 * @return bool True if the token is valid, false otherwise.
 */
function validate_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Get the most recent students.
 * @param int $limit The number of recent students to fetch.
 * @return array An array of recent students.
 */
function get_recent_students($limit = 5) {
    $db = Database::getInstance();
    return $db->select("SELECT * FROM students ORDER BY created_at DESC LIMIT ?", [$limit]);
}
