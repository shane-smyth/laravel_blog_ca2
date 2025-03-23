# GreenThumb Gardening Blog 🌱

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?logo=laravel&logoColor=white)](https://laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com)

A full-featured gardening blog platform built with Laravel, featuring blog posts, comments, likes, and user authentication.

---

## Features ✨

### 📝 Gardening Blog Posts
![Blog Posts Example](screenshots/blog-page.png)
- Create/edit/delete blog posts
- Rich text content with image uploads
- Search and sort functionality

---

### 💬 Social Interaction Features
<div align="center" style="margin: 2rem 0">
  <img src="screenshots/blog-likes.png" alt="Like System" width="45%" style="margin:0.5rem;border-radius:8px;box-shadow:0 4px 6px rgba(0,0,0,0.1)">
  <img src="screenshots/blog-comments.png" alt="Comment System" width="45%" style="margin:0.5rem;border-radius:8px;box-shadow:0 4px 6px rgba(0,0,0,0.1)">
</div>

- Post comments with real-time updates
- Like/unlike posts with instant feedback
- User profiles with customizable avatars

---

### 👤 User Management System
<div align="center" style="margin: 2rem 0">
  <img src="screenshots/account-overview.png" alt="Profile Overview" width="45%" style="margin:0.5rem;border-radius:8px;box-shadow:0 4px 6px rgba(0,0,0,0.1)">
  <img src="screenshots/account-settings.png" alt="Account Settings" width="45%" style="margin:0.5rem;border-radius:8px;box-shadow:0 4px 6px rgba(0,0,0,0.1)">
</div>

- Secure authentication system
- Profile management dashboard
- Password reset functionality

---

### 📱 Responsive Design
<div align="center" style="margin: 2rem 0">
  <img src="screenshots/mobile-view-1.png" alt="Mobile View 1" width="30%" style="margin:0.5rem;border-radius:12px;box-shadow:0 4px 6px rgba(0,0,0,0.1)">
  <img src="screenshots/mobile-view-2.png" alt="Mobile View 2" width="30%" style="margin:0.5rem;border-radius:12px;box-shadow:0 4px 6px rgba(0,0,0,0.1)">
  <img src="screenshots/mobile-view-3.png" alt="Mobile View 3" width="30%" style="margin:0.5rem;border-radius:12px;box-shadow:0 4px 6px rgba(0,0,0,0.1)">
</div>

- Mobile friendly responsive design
- Adaptive layouts for all screen sizes
- Touch-friendly interactive components

---

## Technology Highlights
<div align="center">
  <img src="https://laravel.com/img/logomark.min.svg" width="80" style="margin:1rem" alt="Laravel Logo">
  <img src="https://upload.wikimedia.org/wikipedia/commons/d/d5/Tailwind_CSS_Logo.svg" width="80" style="margin:1rem" alt="Tailwind CSS Logo">
  <img src="https://www.mysql.com/common/logos/logo-mysql-170x115.png" width="80" style="margin:1rem" alt="MySQL Logo">
</div>

---
## Getting Started 🚀

### Prerequisites
- PHP 8.1+
- Composer 2.5+
- Node.js 18+
- npm 9+
- MySQL 8.0+

### Installation
1. Clone the repository
```bash
https://github.com/shane-smyth/laravel_blog_ca2.git
cd laravel_blog_ca2

composer install
npm install

cp .env.example .env
php artisan key:generate
php artisan cache:clear && php artisan config:clear
php artisan serve
```


Create a database and update the .env file
``` 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravelblog
DB_USERNAME={USERNAME}
DB_PASSWORD={PASSWORD}
```

Migrate the tables
```
php artisan migrate
```
