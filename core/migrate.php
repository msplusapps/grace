<?php
// MIGRATION SCRIPT
// This script is intended to be run from the command line.

// --- Configuration ---
// Set the timezone
date_default_timezone_set('UTC');
// Show all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// --- Database Connection ---
// Include the database configuration
require_once __DIR__ . '/config/db.php';

// --- Migration Logic ---
try {
    // 1. Create migrations table if it doesn't exist
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `migrations` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `migration_name` varchar(255) NOT NULL,
          `applied_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          PRIMARY KEY (`id`),
          UNIQUE KEY `migration_name` (`migration_name`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    echo "Migrations table is ready.\n";

    // 2. Get all applied migrations
    $applied_migrations = $pdo->query("SELECT migration_name FROM migrations")->fetchAll(PDO::FETCH_COLUMN);

    // 3. Scan the migrations directory
    $migration_files = glob(__DIR__ . '/migrations/*.sql');
    sort($migration_files);

    // 4. Execute new migrations
    foreach ($migration_files as $file) {
        $migration_name = basename($file);

        if (!in_array($migration_name, $applied_migrations)) {
            echo "Applying migration: $migration_name...\n";

            // Execute the SQL file
            $sql = file_get_contents($file);
            $pdo->exec($sql);

            // Record the migration
            $stmt = $pdo->prepare("INSERT INTO migrations (migration_name) VALUES (?)");
            $stmt->execute([$migration_name]);

            echo "  ...applied successfully.\n";
        }
    }

    echo "All migrations have been applied.\n";

} catch (PDOException $e) {
    die("Migration failed: " . $e->getMessage() . "\n");
}
