
# 🌐 idab-tech Virtual Card System

The **idab-tech Virtual Card System** is a Laravel 12-based web platform that allows users and admins to manage and share virtual contact cards (`.vcf` files). This fully responsive system includes a modern front-end with a powerful admin panel to manage dynamic content such as projects, services, products, teams, and more — including a **referral system** and **site view counter**.

---

## 🚀 Tech Stack

- **Framework**: Laravel 12 (latest)
- **Frontend**: Blade, Tailwind CSS, Bootstrap 5
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **File Upload**: Laravel Public Disk (`storage`)
- **Pagination**: Laravel built-in
- **Tooltips**: Custom HTML/CSS
- **Icons**: SVG, Font Awesome
- **View Tracking**: Laravel Counter
- **Mobile**: Fully Responsive Layout

---

## ✨ Key Features

### 🔹 General
- Clean and minimal UI
- Fully responsive and mobile-friendly
- Download `.vcf` contact card
- Site-wide view counter
- Easy sharing via referral links

### 🔹 Admin Panel Modules

All modules support:
- Full **CRUD** functionality
- **Image upload** (where applicable)
- **Search**, **pagination**, and **status toggle**

#### 📍 About Us
- Location, total members, opening date
- Phone, email, and social media links
- Title & Description section
- Expandable dropdowns for Vision/Mission with icon + description

#### 🗂️ Projects
- Title, image, and description
- Displayed as public project cards

#### 🛠️ Services
- Title, price, image, and tooltip
- Single-line horizontal style card layout
- Active/Inactive toggle

#### 👥 Our Team
- Name, surname, designation, experience
- Profile photo and status

#### 🧾 Categories & Products
- Categories with multiple products
- Products: title, image, price, tooltip, description
- Grouped view by category

#### 📬 Contact Us
- Contact form: name, email, country code + phone, query
- Social media icons: LinkedIn, Twitter, Instagram, Facebook, YouTube

#### 🎁 Referral System
- Dashboard with referral stats
- Share referral via WhatsApp, email, and more

#### 📊 Site View Counter
- Tracks and displays unique visits

---

## 📁 Folder Structure

```
├── app/Models             # Eloquent models
├── app/Http/Controllers   # All controller logic
├── resources/views        # Blade templates (frontend + admin)
├── routes/web.php         # Routes definition
├── database/migrations    # DB schemas
├── public/storage         # Uploaded images (linked)
```

---

## ⚙️ Installation Guide

### 📦 Step 1: Clone the Repository

```bash
git clone https://github.com/perfectgj/idab-tech.git
cd idab-tech
```

### 💻 Step 2: Install Backend & Frontend Dependencies

```bash
composer install
npm install
npm run dev
```

### ⚙️ Step 3: Setup Environment Variables

```bash
cp .env.example .env
php artisan key:generate
```

Update your `.env` file with database credentials:

```env
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 🧱 Step 4: Run Migrations & Seeder

```bash
php artisan migrate --seed
```

### 🔗 Step 5: Link Storage for Public Uploads

```bash
php artisan storage:link
```

### ▶️ Step 6: Serve the Application

```bash
php artisan serve
```

Visit: [http://localhost:8000](http://localhost:8000)

---

## 🔐 Admin Access

> **To access the admin panel:**

1. Register a user via frontend
2. Open your database and update the `users` table → set `is_admin = 1`
3. Login and visit `/admin/dashboard`

---

## 📄 License

This project is licensed under the [MIT License](LICENSE).

---

## 💬 Contact

> Developed by the **Girish Jadeja**  
> For support, feedback, or collaboration, reach out through the Contact Us page or open an issue.

---

## 🌟 Final Words

- Made with ❤️ using **Laravel 12**
- Lightweight, dynamic, and customizable
- Easily extend with new features like blog, testimonials, QR card generator, etc.
