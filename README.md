# Yogacharya Deepashree Gaur — Yoga & Holistic Wellness Monolith

A professional, dynamic, database-driven web application built with **Laravel 13**, **Livewire**, **Alpine.js**, and **Tailwind CSS**.

## 🛠️ Technology Stack
* **Backend:** PHP 8.3+, Laravel 13
* **Frontend Reactivity:** Livewire & Alpine.js
* **Styling & Theme:** Tailwind CSS (Sage Green `#82977B`, Forest Green `#294B3C`, Ivory `#FAF8F2`)
* **Database Engine:** MySQL 8+ (Strict InnoDB)
* **Asynchronous Queue:** Database Driver

## 🏗️ Sprint 1 Core Objectives (Day 1 - Day 5)
- [x] Initial framework scaffolding and `.env` setup.
- [x] Strict Role-Based Access Control (RBAC) migration schema.
- [x] Multi-role authentication (Owner vs. Staff).
- [x] Eloquent models for Profiles, Program Categories, and Classes.
- [x] Feature testing suite for authorization layers.

## 🚀 Local Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com
   cd yoga-website
   ```

2. **Install core dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Configure your `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` inside the `.env` file.*

4. **Run Migrations & Seeders:**
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Start Dev Servers:**
   ```bash
   composer run dev
   ```
