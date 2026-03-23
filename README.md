# 🚀 FREE_CRM
**The Ultimate Open-Source, Glassmorphism-based CRM for Modern Professionals.**

[![Laravel 13](https://img.shields.io/badge/Laravel-13-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.4-38B2AC?style=for-the-badge&logo=tailwind-css)](https://tailwindcss.com)
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)](https://opensource.org/licenses/MIT)

FREE_CRM is a high-performance, aesthetically driven relationship management tool built with the **TALL stack** (Laravel 13, Tailwind, Alpine.js). It features an "Ultra Pro" glassmorphism dashboard designed for speed, clarity, and a premium user experience—completely free and open-source.

---

## ✨ Pro Features (100% Free)

### 🎨 Visual Experience
* **Ultra Pro Glassmorphism:** A cutting-edge interface with frosted-glass sidebars, refined typography, and smooth micro-interactions.
* **Dynamic Dark Mode:** Seamless, persistent theme switching (Auto/Light/Dark) using Tailwind CSS and LocalStorage.
* **Responsive Architecture:** Fully optimized for mobile, tablet, and ultra-wide desktop monitors.

### 📈 Sales & Lead Management
* **Visual Kanban Pipeline:** Drag-and-drop leads across different stages (Prospect, Negotiation, Closed) for better workflow visualization.
* **360° Customer View:** Detailed profiles including contact history, linked tasks, and personal notes.
* **Activity Timeline:** A chronological audit trail of every interaction with a client.

### ⚙️ Powerful Automations
* **Smart Task Pipeline:** Automated overdue alerts, status badges, and priority-based sorting.
* **Bulk Data Tools:** Import and export your leads/customers via CSV or Excel using `maatwebsite/excel`.
* **Automated Notifications:** Built-in system for email alerts and browser-based notifications for upcoming deadlines.

### 🔐 Security & Infrastructure
* **Role-Based Access Control (RBAC):** Fine-grained permissions (Admin, Manager, Sales) powered by **Spatie**.
* **Activity Logs:** Full audit trails to track which user modified which record and when.
* **RESTful API:** Ready-to-use API endpoints for mobile app integration or third-party tools.

---

## 🛠️ Tech Stack

| Component | Technology |
| :--- | :--- |
| **Backend** | [Laravel 13](https://laravel.com/) (PHP 8.2+) |
| **Frontend** | [Tailwind CSS](https://tailwindcss.com/) & [Alpine.js](https://alpinejs.dev/) |
| **Icons** | [FontAwesome 6.6](https://fontawesome.com/) & [Heroicons](https://heroicons.com/) |
| **Permissions** | [Spatie Laravel-Permission](https://spatie.be/docs/laravel-permission) |
| **Charts** | [Chart.js](https://www.chartjs.org/) (for Dashboard Analytics) |
| **Database** | MySQL / PostgreSQL / SQLite |

---

## 🚀 Quick Start Guide

### 1. Prerequisites
Ensure you have **PHP 8.2+**, **Composer**, and **Node.js/NPM** installed on your system.

### 2. Installation
```bash
# Clone the repository
git clone git@github.com:imranbru99/FREE_CRM.git
cd FREE_CRM

# Install PHP dependencies
composer install

# Install JS dependencies & Compile assets
npm install
npm run build

# Setup Environment
cp .env.example .env
php artisan key:generate
