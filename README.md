<div align="center">

# 🎬 CineBook

### The Ultimate Movie Ticket Booking Platform

A modern, full-featured Laravel application for seamless movie ticket booking, theatre management, and user engagement.

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=white)](https://www.php.net/)
[![Vue.js](https://img.shields.io/badge/Vue.js-35495E?style=flat&logo=vue.js&logoColor=4FC08D)](https://vuejs.org/)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

**Crafted with ❤️ by [Aashiq Sheikh](https://github.com/aashiqsheikh)

</div>

---

## 📋 Table of Contents

- [Features](#features)
- [Tech Stack](#tech-stack)
- [Project Structure](#project-structure)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage Guide](#usage-guide)
- [Screenshots](#screenshots)
- [API Endpoints](#api-endpoints)
- [Database Schema](#database-schema)
- [Contributing](#contributing)
- [License](#license)

---

## ✨ Features

### 🎯 Core Features
- **Movie Management** - Browse, filter, and search movies by genre and ratings
- **Theatre & Show Management** - Manage multiple theatres, cities, and showtimes
- **Seat Selection** - Interactive seat selection with real-time availability
- **Booking System** - Secure booking with multiple payment options
- **Payment Integration** - Razorpay payment gateway for secure transactions
- **User Authentication** - Secure user registration and login
- **Email Notifications** - Automated booking confirmations and OTP emails
- **Admin Dashboard** - Comprehensive admin panel for managing content

### 👥 User Features
- Profile management and booking history
- Movie ratings and reviews
- Multi-city show availability
- Receipt and ticket generation
- Account security with OTP verification

### 🛠️ Admin Features
- Movie CRUD operations
- Theatre and showtime management
- Booking management
- User management with admin roles
- Database seeding and migrations
- Revenue analytics

### 🔐 Security
- Password encryption with Laravel's hashing
- CSRF protection on all forms
- SQL injection prevention via Eloquent ORM
- Secure payment handling with Razorpay
- User role-based access control

---

## 🛠️ Tech Stack

### Backend
| Technology | Purpose |
|-----------|---------|
| **Laravel 11** | PHP Web Framework |
| **PHP 8.2+** | Server-side language |
| **MySQL 8.0** | Relational Database |
| **Eloquent ORM** | Database ORM |

### Frontend
| Technology | Purpose |
|-----------|---------|
| **Blade Templates** | Server-side templating |
| **Tailwind CSS** | Utility-first CSS framework |
| **JavaScript** | Client-side interactivity |
| **Axios** | HTTP client |

### Additional Services
| Technology | Purpose |
|-----------|---------|
| **Razorpay API** | Payment processing |
| **Laravel Mail** | Email notifications |
| **Vite** | Asset bundling |

---

## 📁 Project Structure

```
cinebook/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Application controllers
│   │   └── Requests/           # Form request validation
│   ├── Models/                 # Eloquent models
│   ├── Mail/                   # Mailable classes
│   └── Providers/              # Service providers
├── database/
│   ├── migrations/             # Database migrations
│   ├── seeders/                # Database seeders
│   └── factories/              # Model factories
├── resources/
│   ├── views/                  # Blade templates
│   ├── css/                    # Stylesheets
│   └── js/                     # JavaScript files
├── routes/
│   ├── web.php                 # Web routes
│   ├── auth.php                # Authentication routes
│   └── console.php             # Console commands
├── config/                     # Configuration files
├── storage/                    # Application storage
├── tests/                      # Test files
└── public/                     # Publicly accessible files
    └── posters/                # Movie posters storage
```

---

## 🚀 Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & npm
- MySQL 8.0
- Git

### Step 1: Clone the Repository
```bash
git clone https://github.com/aashiqsheikh/cinebook.git
cd cinebook
```

### Step 2: Install PHP Dependencies
```bash
composer install
```

### Step 3: Install Node Dependencies
```bash
npm install
```

### Step 4: Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

### Step 5: Configure Database
Update your `.env` file with database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=cinebook
DB_USERNAME=root
DB_PASSWORD=
```

### Step 6: Run Migrations & Seeders
```bash
php artisan migrate
php artisan db:seed
```

### Step 7: Build Frontend Assets
```bash
npm run build
# Or for development with watch mode
npm run dev
```

### Step 8: Configure Mail (Optional)
Update `.env` with your mail configuration for sending emails:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS=noreply@cinebook.com
```

### Step 9: Configure Razorpay (Optional)
Add your Razorpay credentials to `.env`:
```env
RAZORPAY_PUBLIC_KEY=your_public_key
RAZORPAY_SECRET_KEY=your_secret_key
```

### Step 10: Start Development Server
```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

---

## ⚙️ Configuration

### Database Configuration
- Migrations are located in `database/migrations/`
- Seeders for test data are in `database/seeders/`
- Models are defined in `app/Models/`

### Mail Configuration
- Configure SMTP settings in `.env`
- Mail templates are in `app/Mail/`

### Payment Gateway
- Razorpay API keys must be set in `.env`
- Payment processing happens in the booking controller

---

## 📖 Usage Guide

### For Users

#### 1. **Browse Movies**
   - Navigate to the home page to see available movies
   - Filter movies by genre and sort by ratings

#### 2. **Select Show**
   - Click on a movie to view available shows
   - Select a show based on theatre, date, and time

#### 3. **Choose Seats**
   - Interactive seat map shows available and booked seats
   - Select your preferred seats
   - Green seats are available, red seats are booked

#### 4. **Book Tickets**
   - Review booking details
   - Proceed to payment with Razorpay
   - Receive confirmation email with ticket details

#### 5. **Manage Bookings**
   - View booking history in user profile
   - Download tickets from past bookings

### For Administrators

#### 1. **Manage Movies**
   - Add new movies with title, duration, genre, rating
   - Upload movie posters
   - Update and delete movie information

#### 2. **Manage Theatres**
   - Add theatres with location and seat configuration
   - Manage different cities
   - Configure seat availability

#### 3. **Create Shows**
   - Link movies to theatres
   - Set showtimes and ticket prices
   - Define seat availability per show

#### 4. **View Analytics**
   - Monitor bookings and revenue
   - Track user registrations
   - Analyze popular movies

---

## 📸 Screenshots

### 🏠 Home Page
*Movie listing with filters and search functionality*

### 🎬 Movie Details
*Movie information with available shows and ratings*

### 🎭 Seat Selection
*Interactive seat selection interface with real-time availability*

### 💳 Payment Page
*Secure Razorpay payment integration*

### 📊 Admin Dashboard
*Comprehensive admin panel for managing content*

### 👤 User Profile
*Booking history and account management*

---

## 🔗 API Endpoints

### Movies
- `GET /api/movies` - List all movies
- `POST /api/movies` - Create new movie (Admin)
- `GET /api/movies/{id}` - Get movie details
- `PUT /api/movies/{id}` - Update movie (Admin)
- `DELETE /api/movies/{id}` - Delete movie (Admin)

### Shows
- `GET /api/shows` - List all shows
- `GET /api/shows/{id}/seats` - Get seat availability
- `POST /api/shows/{id}/book` - Create booking

### Bookings
- `GET /api/bookings` - User's bookings
- `POST /api/bookings` - Create booking
- `GET /api/bookings/{id}` - Booking details

### Users
- `POST /api/auth/register` - Register new user
- `POST /api/auth/login` - User login
- `GET /api/user` - Get user profile

---

## 📊 Database Schema

### Key Tables
- **users** - User accounts and authentication
- **movies** - Movie information and metadata
- **theatres** - Theatre locations and details
- **cities** - City information
- **shows** - Movie showtimes and availability
- **bookings** - User bookings and payment info
- **ratings** - User movie ratings and reviews

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📄 License

This project is licensed under the MIT License - see the LICENSE file for details.

---

<div align="center">

### Developed by Aashiq Sheikh

**[GitHub](https://github.com) • [Email](mailto:your-email@example.com)**

If you found this project helpful, please consider giving it a ⭐

</div>

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
