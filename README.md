# MSPlus Fee Management Portal

This is a comprehensive school fee management portal built with vanilla PHP. It provides a clean and modern interface for managing students, payments, and themes.

## Features

*   **Student Management:** Add, view, edit, and delete student records.
*   **Payment Management:** Record and track student payments.
*   **Theme Switcher:** Choose between a light and dark theme.
*   **Secure:** Uses PDO with prepared statements to prevent SQL injection.
*   **Migration System:** A simple and effective system for managing database schema changes.

## Installation

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/your-username/msplus-fee-management.git
    cd msplus-fee-management
    ```

2.  **Configure the database:**
    *   Open the `config/db.php` file.
    *   It is recommended to use environment variables to set your database credentials.
    *   Alternatively, you can replace the placeholder values with your database host, name, username, and password.

3.  **Run the database migrations:**
    *   Open your terminal and run the following command from the project's root directory:
        ```bash
        php migrate.php
        ```
    *   This will create the necessary tables in your database and apply any pending migrations.

4.  **Run the application:**
    *   Start the PHP built-in web server:
        ```bash
        php -S localhost:8000
        ```
    *   Open your web browser and navigate to `http://localhost:8000`.

## Default Login

*   **Username:** admin
*   **Password:** password
