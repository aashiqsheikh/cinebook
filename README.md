<div align="center">

# 🎬 CineBook

### The Ultimate Movie Ticket Booking Platform

A modern, full-featured **Laravel application** for **city-based movie ticket booking**, theatre management, and user engagement. Users select their **city/location** to see relevant shows and theatres only.

[![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=flat&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=flat&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.4+-38BDF8?style=flat&logo=tailwindcss&logoColor=white)](https://tailwindcss.com/)
[![Razorpay](https://img.shields.io/badge/Razorpay-Payments-00BAF2?style=flat&logo=razorpay&logoColor=white)](https://razorpay.com/)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

**Key Highlights:**
- **City Filtering** - Select city → Localized shows/theatres
- **Interactive Seat Selection** - Real-time availability
- **Razorpay Payments** - Secure checkout
- **Admin Dashboard** - Full CRUD
- **Responsive Design** - Mobile-first

Developed by [Aashiq Sheikh](https://github.com/aashiqsheikh)

</div>

---

## 📋 Table of Contents

- [🚀 Quick Start](#quick-start)
- [✨ Features](#features)
- [🛠️ Tech Stack](#tech-stack)
- [📁 Project Structure](#project-structure)
- [📖 Usage Guide](#usage-guide)
- [📸 Screenshots](#screenshots)
- [🔗 API Endpoints](#api-endpoints)
- [📊 Database Schema](#database-schema)
- [🤝 Contributing](#contributing)
- [📄 License](#license)

---

## 🚀 Quick Start

```bash
git clone https://github.com/aashiqsheikh/cinebook.git
cd cinebook
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run build
php artisan serve
```

**Visit:** `http://127.0.0.1:8000` 🎬

---

## ✨ Features

### 🎯 Core Features

#### **Location-Based Booking** *(New)*
- Select city (Mumbai, Delhi, Bangalore, etc.)
- **Movies, theatres, shows filtered by city** - Session-based
- Change city anytime via modal
- **No cross-city confusion** - Localized experience

#### **Movie & Booking**
- Browse/filter/search movies by genre, ratings
- Interactive seat selection (VIP, premium)
- Razorpay payment gateway
- Email confirmations & receipts
- Booking history & downloads

#### **User Features**
- Registration/Login with Google OAuth
- Profile management
- Movie ratings/reviews
- OTP verification

#### **Admin Features**
- **CRUD**: Movies, Theatres, Shows, Bookings
- Revenue dashboard
- City management
- User roles (admin/user)

### 🔐 Security
- CSRF protection
- Role-based access
- Secure payments
- Eloquent ORM protection

---

## 🛠️ Tech Stack

### Backend
| Technology | Purpose |
|------------|---------|
| Laravel 11 | Framework |
| PHP 8.2+ | Server |
| MySQL 8.0 | Database |
| Eloquent | ORM |

### Frontend
| Technology | Purpose |
|------------|---------|
| Blade | Templating |
| Tailwind CSS | Styling |
| JavaScript | Interactivity |
| Vite | Bundling |

### Services
| Service | Purpose |
|---------|---------|
| Razorpay | Payments |
| Laravel Mail | Emails |

---

## 📁 Project Structure

```
cinebook/
├── app/
│   ├── Http/Controllers/     # Controllers
│   ├── Models/               # Eloquent models
│   ├── Mail/                 # Email templates
├── database/                 # Migrations/seeders
├── resources/views/          # Blade views
├── routes/                   # Routes
└── public/posters/           # Movie posters
```

---

## 📖 Usage Guide

### **User Flow**
1. **Home** → Browse movies
2. **Select City** (modal) → e.g., Mumbai
3. **Movie Page** → **City shows only**
4. **Theatre** → **City theatres only**
5. **Seats** → Book
6. **Razorpay** → Paid ✅

### **Admin Flow**
```
Login as admin → Dashboard → 
Movies | Theatres | Cities | Shows | Bookings
```

### **CLI**
```bash
php artisan shows:generate --force  # Generate city shows
php artisan db:seed                # Full data
```

---

## 📸 Screenshots

See [PAGE_EXAMPLES.md](PAGE_EXAMPLES.md) for full gallery:
- Home & City Selection
- Movie + City-filtered shows
- Seat picker
- Razorpay checkout
- Admin dashboard

---

## 🔗 API Endpoints

```
GET /movies/{id} - City-filtered shows
GET /book/show/{id}/seats - Seats
POST /bookings - Create booking
```

---

## 📊 Database Schema

```
cities (1:M) → theatres (1:M) → shows (1:M) → bookings
↑
movies ← ratings
↑
users
```

**Data Scale:**
- **7 Cities**
- **35 Theatres**
- **1044 Shows** (unique)

---

## 🤝 Contributing

1. Fork repo
2. `git checkout -b feature/your-feature`
3. Commit & push
4. Open PR to `main`

Recent: City filtering PR ✅

---

## 📄 License

MIT License

---

<div align="center">
⭐ **Star for more features!** 🎥  
**Live:** `127.0.0.1:8000`
</div>

