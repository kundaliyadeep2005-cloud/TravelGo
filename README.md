<div align="center">

# ✈️ TravelGo

### *Explore India. Book Smart. Travel More.*

A **full-stack travel booking web application** built for India —  
featuring destination packages, real-time booking, user reviews, and a complete admin control panel.

---

![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-MariaDB-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![PHPMailer](https://img.shields.io/badge/PHPMailer-SMTP-orange?style=for-the-badge)
![License](https://img.shields.io/badge/License-Academic-green?style=for-the-badge)

</div>

---

## 📌 Table of Contents

- [About the Project](#-about-the-project)
- [Key Features](#-key-features)
- [Tech Stack](#-tech-stack)
- [Project Structure](#-project-structure)
- [Database Schema](#-database-schema)
- [Installation & Setup](#-installation--setup)
- [How It Works — User Flow](#-how-it-works--user-flow)
- [Admin Panel](#-admin-panel)
- [Security Implementations](#-security-implementations)
- [Screenshots](#-screenshots)
- [Known Limitations](#-known-limitations)
- [Developer](#-developer)

---

## 📖 About the Project

**TravelGo** is a full-stack travel booking platform that lets users browse curated travel packages across India, book trips, write reviews, and manage their profiles — all in one place.

The platform features a **CMS-driven homepage** (carousel, best places, about section all pulled from the database), a **package listing page with star ratings**, a **booking form with front-end validation**, and a **complete admin dashboard** for managing packages, users, bookings, and reviews.

This project was developed as a **Semester 6 academic project** at **RK University, Rajkot** — built from scratch using PHP, MySQL, Bootstrap 5, and JavaScript.

---

## ✨ Key Features

### 👤 User Side
- **User Registration** — sign up with name, email, password, and optional profile photo
- **User Login / Logout** — session-based authentication with bcrypt password verification
- **Forgot Password** — secure token-based password reset via email (PHPMailer + Gmail SMTP)
- **Browse Packages** — view all travel destinations with descriptions and pricing
- **Star Ratings & Reviews** — users can submit star ratings and text reviews on packages
- **Book a Trip** — fill a booking form with name, email, phone, package, guests, and travel dates
- **One Booking Per User** — email-level check prevents duplicate bookings
- **Past Bookings** — view previously booked trips in a card layout
- **User Profile** — view name, email, and profile photo
- **Update Profile** — change name, profile photo, and password
- **Our Story Page** — dynamic about page loaded from database
- **Responsive Navbar** — active link highlighting, shows/hides links based on login state

### 🛡️ Admin Side
- **Dashboard** — total user count, total bookings, recent booking activity
- **Manage Packages** — view all packages in a table, delete existing ones
- **Add New Package** — upload package name, price, description, and image
- **Manage Bookings** — view all bookings with customer info, dates, and guest count; delete bookings
- **Manage Users** — view all registered users
- **Payment Transactions** — simulated payment history based on booking records
- **User Reviews** — view and delete customer reviews per package
- **Settings** — admin site settings panel

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| **Backend** | PHP 8.2 |
| **Database** | MySQL / MariaDB 10.4 (via MySQLi) |
| **Frontend** | Bootstrap 5.3, custom CSS per page |
| **JavaScript** | Vanilla ES6 (form validation, booking logic) |
| **Email** | PHPMailer with Gmail SMTP |
| **Server** | Apache with XAMPP / Laragon |
| **Local Dev** | XAMPP (Windows) |

---

## 📁 Project Structure

```
travelgo/  (sem-6/)
│
├── php/                          # All user-facing pages
│   ├── home.php                  # Homepage (carousel, best places, about section)
│   ├── package.php               # Package listing with reviews and star ratings
│   ├── booking.php               # Booking form — submit and confirm trip
│   ├── past_booking.php          # View user's past bookings
│   ├── our-story.php             # About/Our Story page (DB-driven)
│   ├── profile.php               # User profile view
│   ├── update_profile.php        # Update name, photo, password
│   ├── sign-in.php               # Login page
│   ├── sign-up.php               # Registration with optional photo upload
│   ├── logout.php                # Session destroy
│   ├── forgot-password.php       # Forgot password request form
│   ├── forget.php                # Sends reset email via PHPMailer
│   ├── reset-password.php        # Token verification
│   ├── new-password.php          # Set new password
│   ├── update-password.php       # Password update handler
│   ├── process_booking.php       # Booking form processor
│   └── db.php                    # MySQLi database connection
│
├── admin/                        # Admin panel (protected)
│   ├── dashboard.php             # Stats: users, bookings, recent activity
│   ├── login.php                 # Admin login page
│   ├── logout.php                # Admin session destroy
│   ├── manage_packages.php       # View and delete packages
│   ├── add_package.php           # Add new travel package with image
│   ├── manage_bookings.php       # View and delete all bookings
│   ├── manage_users.php          # View all registered users
│   ├── payments.php              # Simulated payment transactions
│   ├── reviews.php               # View and delete user reviews
│   ├── settings.php              # Admin settings panel
│   ├── database.php              # Admin DB connection
│   └── includes/
│       ├── header.php            # Admin HTML head + Bootstrap imports
│       ├── sidebar.php           # Admin navigation sidebar
│       └── footer.php            # Admin footer
│
├── includes/                     # Shared user-side components
│   ├── header.php                # Navbar, Bootstrap, dynamic page title & CSS
│   └── footer.php                # Footer with contact info
│
├── css/                          # Page-specific stylesheets
│   ├── home.css                  # Homepage styles
│   ├── package.css               # Package listing page
│   ├── booking.css               # Booking form page
│   ├── sign-in.css               # Login page
│   ├── sign-up.css               # Registration page
│   ├── profile.css               # User profile page
│   ├── update_profile.css        # Profile update page
│   ├── our-story.css             # Our Story page
│   └── forget.css                # Forgot password page
│
├── js/                           # Frontend JavaScript
│   ├── booking.js                # Booking form validation (name, email, phone, dates, guests)
│   ├── sign-in.js                # Login form validation
│   ├── sign-up.js                # Registration form validation
│   ├── profile.js                # Profile page logic
│   ├── forget.js                 # Forgot password validation
│   └── reset.js                  # Reset password validation
│
├── Database/                     # SQL files — one per table
│   ├── users.sql                 # Users table schema + seed data
│   ├── packages.sql              # 20 Indian travel destinations
│   ├── bookings.sql              # Bookings table schema
│   ├── reviews.sql               # Reviews table schema + sample reviews
│   ├── carousel.sql              # Homepage carousel images
│   ├── best_places.sql           # Homepage featured places cards
│   ├── about_section.sql         # Homepage about/goals section
│   ├── our_story.sql             # Our Story page sections
│   ├── contact_info.sql          # Footer contact info
│   └── contact_details.sql       # Contact page details
│
├── images/                       # All static images
│   ├── index/                    # Homepage carousel & card images
│   ├── packages/                 # Package images (package1.jpg – package20.jpg)
│   ├── profile/                  # Default profile photo
│   ├── about-us/                 # About page background
│   └── sign-up/                  # Sign-up page background
│
└── uploads/
    └── profile_pictures/         # Uploaded user profile photos (timestamped filenames)
```

---

## 🗄️ Database Schema

The database `travelgo_db` has **10 tables**:

| Table | Purpose |
|---|---|
| `users` | Registered users — stores credentials, profile image path |
| `bookings` | All trip bookings — customer info, package, dates, guests |
| `packages` | Travel destinations — name, price, description, image |
| `reviews` | User-submitted star ratings and text reviews per package |
| `carousel` | Homepage slider images and captions |
| `best_places` | Homepage featured destination cards |
| `about_section` | Homepage "Our Goals" about card |
| `our_story` | Our Story page sections (loaded dynamically) |
| `contact_info` | Footer contact details |
| `contact_details` | Contact page info |

### `users` table:
```sql
id              INT AUTO_INCREMENT PRIMARY KEY
fullname        VARCHAR(255) NOT NULL
email           VARCHAR(255) NOT NULL UNIQUE
password        VARCHAR(255) NOT NULL          -- bcrypt hashed
profile_image   VARCHAR(255)                   -- relative path to uploaded photo
reset_token     VARCHAR(64)                    -- for password reset flow
reset_expiry    DATETIME                       -- token expires after 1 hour
created_at      TIMESTAMP DEFAULT current_timestamp()
```

### `bookings` table:
```sql
id               INT AUTO_INCREMENT PRIMARY KEY
name             VARCHAR(255)
email            VARCHAR(255)
phone            VARCHAR(15)
package_name     VARCHAR(255)
package_duration INT
guests           INT
start_date       DATE
end_date         DATE
```

### `packages` table:
```sql
id           INT AUTO_INCREMENT PRIMARY KEY
name         VARCHAR(100)
price        DECIMAL(10,2)
description  TEXT
image        VARCHAR(255)
```

### `reviews` table:
```sql
id           INT AUTO_INCREMENT PRIMARY KEY
package_name VARCHAR(255)
user_name    VARCHAR(255)
rating       INT                             -- 1 to 5 stars
review_text  TEXT
```

---

## ⚙️ Installation & Setup

### Prerequisites
- PHP 8.0 or higher
- MySQL / MariaDB
- Apache server
- **Recommended:** [XAMPP](https://www.apachefriends.org/) or [Laragon](https://laragon.org/) on Windows

---

### Step 1 — Clone the Repository
```bash
git clone https://github.com/YOUR_USERNAME/travelgo.git
cd travelgo
```

### Step 2 — Set Up the Database

1. Open **phpMyAdmin**.
2. Create the database:
   ```sql
   CREATE DATABASE travelgo_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
   ```
3. Select the `travelgo_db` database, go to the **Import** tab, and import each file from the `Database/` folder — import all 10 SQL files one by one.

   Or via CLI:
   ```bash
   mysql -u root -p travelgo_db < Database/users.sql
   mysql -u root -p travelgo_db < Database/packages.sql
   mysql -u root -p travelgo_db < Database/bookings.sql
   mysql -u root -p travelgo_db < Database/reviews.sql
   mysql -u root -p travelgo_db < Database/carousel.sql
   mysql -u root -p travelgo_db < Database/best_places.sql
   mysql -u root -p travelgo_db < Database/about_section.sql
   mysql -u root -p travelgo_db < Database/our_story.sql
   mysql -u root -p travelgo_db < Database/contact_info.sql
   mysql -u root -p travelgo_db < Database/contact_details.sql
   ```

### Step 3 — Configure Database Connection

Open **both** `php/db.php` and `admin/database.php` and update:

```php
$servername = "localhost";
$username   = "root";       // Your MySQL username
$password   = "";           // Empty for XAMPP default
$dbname     = "travelgo_db";
$port       = 3306;
```

> ⚠️ **Security Note:** Never commit real credentials to GitHub. Use environment variables for production.

### Step 4 — Configure Email (for Password Reset)

Open `php/forget.php` and update the SMTP settings:

```php
$mail->Host     = 'smtp.gmail.com';
$mail->Username = 'your_email@gmail.com';
$mail->Password = 'your_app_password';   // Gmail App Password
$mail->Port     = 587;
$mail->setFrom('your_email@gmail.com', 'TravelGo');
```

> **Tip:** Generate a Gmail App Password at [myaccount.google.com/apppasswords](https://myaccount.google.com/apppasswords) — 2FA must be enabled on your Gmail account.

### Step 5 — Place the Project in Server Root

For **XAMPP**: Place inside `C:/xampp/htdocs/`  
For **Laragon**: Place inside `C:/laragon/www/`

### Step 6 — Access the Application

| URL | Page |
|---|---|
| `http://localhost/travelgo/php/home.php` | Homepage |
| `http://localhost/travelgo/php/sign-up.php` | Register |
| `http://localhost/travelgo/php/sign-in.php` | Login |
| `http://localhost/travelgo/php/package.php` | Browse Packages |
| `http://localhost/travelgo/php/booking.php` | Book a Trip |
| `http://localhost/travelgo/admin/login.php` | Admin Panel |

---

## 🔄 How It Works — User Flow

```
[New User]
     │
     ▼
Sign Up → Full Name + Email + Password + optional Profile Photo
     │
     ├─► Check duplicate email (prepared statement)
     ├─► bcrypt hash the password
     └─► Upload profile photo → /uploads/profile_pictures/
     │
     ▼
Sign In → Email + Password
     │
     └── password_verify() → Session started (user_id, fullname, email)
     │
     ▼
[Home Page] — Carousel + Best Places cards + Goals section (all from DB)
     │
     ▼
[Packages Page] — Login Required
     │
     ├── Browse 20 Indian destinations with price & description
     ├── See average star rating per package
     ├── Read up to 3 latest user reviews per package
     └── Submit your own star rating + review text
     │
     ▼
[Booking Page] — Login Required
     │
     ├── Fill: Name, Email, Phone, Package, Duration, Guests, Dates
     ├── JS Validation: email regex, 10-digit phone, guests 1–7, date logic
     ├── Server-side: check if email already has a booking → block duplicate
     └── On success → INSERT into bookings table
     │
     ▼
[Past Bookings] → View trip history cards
     │
     ▼
[Profile] → Name, email, profile photo
     │
     └── Update Profile → name / photo / password change
     │
[Forgot Password Flow]
     │
     ├── Submit email → token generated (random_bytes 32) → saved in DB with 1hr expiry
     ├── Reset link sent via PHPMailer (Gmail SMTP)
     ├── Click link → token verified against DB + expiry check
     └── Enter new password → bcrypt hashed → saved to DB
```

---

## 🖥️ Admin Panel

The admin panel (`/admin/`) requires an active admin session. All pages check for login before rendering.

| Page | File | Feature |
|---|---|---|
| Dashboard | `dashboard.php` | Total users, total bookings, latest 5 booking records |
| Add Package | `add_package.php` | Add destination: name, price, description, image upload |
| Manage Packages | `manage_packages.php` | Table of all packages with delete action |
| Manage Bookings | `manage_bookings.php` | All bookings with customer info, dates, guests — delete any |
| Manage Users | `manage_users.php` | Table of all registered users |
| Payments | `payments.php` | Simulated transaction log (TXN ID, customer, package, amount) |
| Reviews | `reviews.php` | All user reviews per package — delete any |
| Settings | `settings.php` | Admin configuration panel |

---

## 🔐 Security Implementations

| Feature | Implementation |
|---|---|
| **Password Hashing** | `password_hash()` with `PASSWORD_DEFAULT` (bcrypt) on registration |
| **Password Verification** | `password_verify()` on login — plain text never stored |
| **SQL Injection Prevention** | MySQLi prepared statements with `bind_param()` throughout |
| **XSS Prevention** | `htmlspecialchars()` on all user-generated output |
| **Session Management** | `session_start()` / `session_destroy()` for auth state |
| **Duplicate Email Check** | Prepared statement check before registration and booking |
| **File Upload Validation** | Allowed extension whitelist: `jpg`, `jpeg`, `png`, `gif` |
| **Forgot Password Token** | `bin2hex(random_bytes(32))` — cryptographically secure |
| **Token Expiry** | Reset tokens expire after 1 hour (`reset_expiry` in DB) |
| **Email Validation** | `filter_var($email, FILTER_VALIDATE_EMAIL)` before sending reset |
| **Auth Guards** | All protected pages redirect to login if session not set |


---

## ⚠️ Known Limitations

- **Database credentials** are hardcoded in `php/db.php` and `admin/database.php` — move to environment variables for production.
- **Past Bookings page** currently shows static hardcoded demo cards rather than fetching dynamically from the `bookings` table per user.
- **Payments page** simulates amounts using `rand()` — no actual payment gateway (Razorpay, PayPal, etc.) is integrated.
- **Admin panel** has no separate admin users table — extend this for proper role-based access control in production.
- **CSRF protection** is not yet implemented on forms — add CSRF tokens before deploying publicly.
- **One booking per email** can be bypassed using a different email address — not a true per-user booking limit.
- **No booking cancellation** — users cannot cancel a confirmed booking from the frontend.
- Built for **academic/educational purposes** — not production-ready without additional security hardening.

---

## 👨‍💻 Developer

**Deep Kundaliya**  
Student — RK University, Rajkot, Gujarat 🇮🇳  
Semester 6 — Web Development Project

> *"TravelGo was built to combine everything learned in web development — PHP backend, dynamic database-driven pages, form validation, admin management, and real email integration — all into one complete, real-world application."*

---

## 📄 License

This project was created for academic purposes at **RK University**.  
Feel free to fork, learn from, and build upon it.  
Please give credit if you use it as a reference. 🙏

---

<div align="center">

**Happy Travels! ✈️🇮🇳**

*Made with ❤️ for Explorers of India*

</div>
