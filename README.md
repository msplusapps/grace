# EduPay Nexus - Fee Management System

This is a comprehensive school fee management portal built with vanilla PHP. It provides a clean and modern interface for managing students, payments, and school information.

## Project Structure

The project is organized into three main parts:

*   **`index.php`:** The single entry point for the application.
*   **`app/`:** Contains the user-facing parts of the application, such as pages, templates, and assets (CSS, JS).
*   **`core/`:** Contains the core logic of the application, including the database utility class, migration scripts, and library functions.

## Features

*   **Student Management:** Add, view, edit, and delete student records.
*   **Payment Management:** Record and track student payments.
*   **Modern UI:** A sleek and modern user interface built with Tailwind CSS.
*   **Dark Mode:** Switch between a light and dark theme.
*   **Secure:** Uses a centralized `Database` class with PDO and prepared statements to prevent SQL injection.
*   **Migration System:** A simple and effective system for managing database schema changes.

## Installation

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/your-username/edupay-nexus.git
    cd edupay-nexus
    ```

2.  **Configure the database:**
    *   The database connection is handled by the `core/utils/Database.php` class.
    *   It is recommended to use environment variables to set your database credentials (DB_HOST, DB_NAME, DB_USER, DB_PASS).

3.  **Run the database migrations:**
    *   Open your terminal and run the following command from the project's root directory:
        ```bash
        php core/migrate.php
        ```
    *   This will create the necessary tables in your database and apply any pending migrations.

4.  **Run the application:**
    *   Start the PHP built-in web server from the project's root directory:
        ```bash
        php -S localhost:8000
        ```
    *   Open your web browser and navigate to `http://localhost:8000`.

## Default Login

*   **Username:** admin
*   **Password:** password
