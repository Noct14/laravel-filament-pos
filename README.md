# Laravel POS System

A modern Point of Sale (POS) application built with **Laravel 12** and **Livewire**. This application is designed to help small to medium businesses manage sales, inventory, and customers efficiently.

## 🚀 Features

*   **Point of Sale (POS)**: Streamlined checkout interface for quick transactions.
*   **Inventory Management**:
    *   Manage Items (Products)
    *   Track Stock Levels (Inventories)
*   **Sales Management**:
    *   View Sales History
    *   Print Receipts (PDF)
*   **Customer Management**: CRM features to track customer data.
*   **User Management**: Role-based access for Admins and Staff.
*   **Settings**:
    *   Profile & Password Management
    *   Two-Factor Authentication (2FA)
    *   Payment Method Configuration

## 🛠️ Tech Stack

*   **Framework**: [Laravel 12](https://laravel.com)
*   **Frontend**: [Livewire](https://livewire.laravel.com)
*   **UI Components**: [Filament](https://filamentphp.com) (Forms, Tables, Actions)
*   **Database**: MySQL / SQLite (Configurable)

## 📦 Installation

1.  **Clone the repository**
    ```bash
    git clone https://github.com/yourusername/laravel-pos.git
    cd laravel-pos
    ```

2.  **Install PHP dependencies**
    ```bash
    composer install
    ```

3.  **Install Node.js dependencies**
    ```bash
    npm install
    ```

4.  **Environment Setup**
    Copy the example environment file and configure your database settings.
    ```bash
    cp .env.example .env
    ```
    Edit `.env` file to match your database credentials.

5.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

6.  **Run Migrations**
    Set up the database tables.
    ```bash
    php artisan migrate
    ```
    *(Optional: Run seeders if available)*
    ```bash
    php artisan db:seed
    ```

7.  **Build Assets & Run**
    ```bash
    npm run build
    php artisan serve
    ```

## 📄 License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
