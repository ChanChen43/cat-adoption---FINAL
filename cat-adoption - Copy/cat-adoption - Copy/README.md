<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# System Overview

## 1. Proposed System

### a. Features
- User authentication and role-based access control (Admin/User).
- Cat adoption management (CRUD operations for cats).
- Application management for adopting cats.
- Admin dashboard with statistics and management tools.
- File upload for cat images.

### b. Purpose
The purpose of this system is to streamline the process of cat adoption by providing an easy-to-use platform for users to browse available cats and submit adoption applications. Admins can manage cats, applications, and monitor system activity.

### c. Functionality
- **Users**: Browse cats, view details, and submit adoption applications.
- **Admins**: Add, edit, delete cats; manage adoption applications; and view system statistics.
- **Database**: Store user, cat, and application data securely.

## 2. Data Dictionary

### MySQL Database Schema

| Field Name       | Data Type   | Field Length | Constraint          | Description                          |
|------------------|-------------|--------------|---------------------|--------------------------------------|
| id               | INT         | 11           | PRIMARY KEY, AUTO_INCREMENT | Unique identifier for each record.  |
| name             | VARCHAR     | 255          | NOT NULL            | Name of the cat.                    |
| age              | INT         | 11           | NOT NULL            | Age of the cat.                     |
| breed            | VARCHAR     | 255          | NOT NULL            | Breed of the cat.                   |
| description      | TEXT        | -            | NULLABLE            | Description of the cat.             |
| image            | VARCHAR     | 255          | NULLABLE            | Path to the cat's image.            |
| created_at       | TIMESTAMP   | -            | NULLABLE            | Record creation timestamp.          |
| updated_at       | TIMESTAMP   | -            | NULLABLE            | Record update timestamp.            |

### Full SQL Query for MySQL Database

```sql
CREATE TABLE cats (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    age INT(11) NOT NULL,
    breed VARCHAR(255) NOT NULL,
    description TEXT NULL,
    image VARCHAR(255) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    is_admin TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE applications (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    cat_id INT(11) NOT NULL,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (cat_id) REFERENCES cats(id) ON DELETE CASCADE
);
```

### Full SQL Query for Oracle SQL Database

```sql
CREATE TABLE cats (
    id NUMBER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    name VARCHAR2(255) NOT NULL,
    age NUMBER NOT NULL,
    breed VARCHAR2(255) NOT NULL,
    description CLOB NULL,
    image VARCHAR2(255) NULL,
    created_at TIMESTAMP DEFAULT NULL,
    updated_at TIMESTAMP DEFAULT NULL
);

CREATE TABLE users (
    id NUMBER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    name VARCHAR2(255) NOT NULL,
    email VARCHAR2(255) UNIQUE NOT NULL,
    password VARCHAR2(255) NOT NULL,
    is_admin NUMBER(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT NULL,
    updated_at TIMESTAMP DEFAULT NULL
);

CREATE TABLE applications (
    id NUMBER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
    user_id NUMBER NOT NULL,
    cat_id NUMBER NOT NULL,
    status VARCHAR2(20) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT NULL,
    updated_at TIMESTAMP DEFAULT NULL,
    CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_cat FOREIGN KEY (cat_id) REFERENCES cats(id) ON DELETE CASCADE
);
```
