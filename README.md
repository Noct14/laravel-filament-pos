<h1 align="center"> RetailPOS </h1>

![Laravel POS System](screenshots/showcase.png)

<p align="center">
  A modern Point of Sale application built to help small businesses manage sales, inventory, and customers efficiently.
</p>

## Features

*   **Point of Sale (POS)**: Streamlined checkout interface for quick transactions
*   **Inventory Management**:
    *   Manage Items (Products)
    *   Track real-time Stock Levels
*   **Sales Management**:
    *   Complete Sales History
    *   Printable Receipts
*   **Customer Management**: CRM to track customer details and purchase history
*   **User Management**: Role-based access control (Admins & Staff)
*   **Authentication**: Secure login and Two-Factor Authentication (2FA) support

---

## Tech Stack

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Filament](https://img.shields.io/badge/Filament-FAA025?style=for-the-badge&logo=filament&logoColor=white)](https://filamentphp.com)
[![Livewire](https://img.shields.io/badge/Livewire-4E56A6?style=for-the-badge&logo=livewire&logoColor=white)](https://livewire.laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)

---

## Installation & Setup

### 1. Clone Repository

```bash
git clone https://github.com/yourusername/laravel-pos.git
cd laravel-pos
```

### 2. Install Dependencies

**PHP Dependencies:**
```bash
composer install
```

**Node.js Dependencies:**
```bash
npm install
```

### 3. Environment Setup

```bash
cp .env.example .env
```
Update your `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=retail_pos
DB_USERNAME=username
DB_PASSWORD=password
```

### 4. Application Setup

**Generate Key:**
```bash
php artisan key:generate
```

**Run Migrations:**
```bash
php artisan migrate
```

### 5. Start Application

**Build Assets:**
```bash
npm run build
```

**Start Server:**
```bash
php artisan serve
```

---

## License

This project is licensed under the **MIT License**.
