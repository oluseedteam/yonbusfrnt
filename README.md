# YONBUS Tax & Accounting Services Inc. 📊

![YONBUS Logo](public/images/logo.png)

> **YONBUS Tax & Accounting Services Inc.** is a multi-tenant, role-based SaaS platform built for professional tax preparation, bookkeeping, accounting, payroll, and business consultation management.

---

## 🚀 Key Features

* **Multi-Role Portal System**:
  * 👑 **Admin Portal**: System oversight, user CRUD, service management, audit activity logs, global billing logs, and configuration.
  * 💼 **Accountant / CPA Portal**: Client directory, consultation scheduling, document vault access, tax return workflow processing, and invoice generation.
  * 👤 **Client Portal**: Online appointment booking, secure document vault uploads, 6-stage Tax Return Tracker timeline, invoice payments, and direct CPA chat messaging.
* **Modern Design System**: Built with Tailwind CSS, Alpine.js, dark mode toggle, Inter & Poppins typography, and custom soft shadows.
* **Security & Access Control**: Role-Based Access Control (RBAC) via custom `EnsureRole` middleware and Laravel Breeze authentication.

---

## 🛠️ Tech Stack

* **Backend**: Laravel 11, PHP 8.3, MySQL / SQLite
* **Frontend**: Laravel Livewire 3, Alpine.js, Tailwind CSS, Blade Templates
* **Data Visualization**: Chart.js
* **Iconography**: Heroicons

---

## 🔑 Pre-Seeded Test Credentials

| Role | Email | Password | Access URI |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin@yonbus.com` | `password` | `/admin/dashboard` |
| **Accountant** | `accountant@yonbus.com` | `password` | `/accountant/dashboard` |
| **Client** | `client@yonbus.com` | `password` | `/client/dashboard` |

---

## ⚙️ Installation & Local Setup

```bash
# 1. Clone or navigate to the project repository
cd frontend

# 2. Install PHP & Node dependencies
composer install
npm install

# 3. Setup environment variables
cp .env.example .env
php artisan key:generate

# 4. Run database migrations & seed demo data
php artisan migrate:fresh --seed

# 5. Build frontend Tailwind CSS assets
npm run build

# 6. Start the Laravel development server
php artisan serve
```

Access the application at **`http://127.0.0.1:8000`**.

---

## 🌐 Complete System Route Reference (All 54 Routes)

| Method | URI | Route Name | Middleware / Protection | Description |
| :--- | :--- | :--- | :--- | :--- |
| `GET` | `/` | — | `web` | Public Landing Page |
| `GET` | `/login` | `login` | `guest` | User Authentication Login View |
| `POST` | `/login` | `login` | `guest` | Process User Login |
| `POST` | `/logout` | `logout` | `auth` | End User Session |
| `GET` | `/register` | `register` | `guest` | Client Registration Page |
| `POST` | `/register` | `register` | `guest` | Process Client Registration |
| `GET` | `/forgot-password` | `password.request` | `guest` | Password Reset Request |
| `POST` | `/forgot-password` | `password.email` | `guest` | Send Reset Password Link |
| `GET` | `/reset-password/{token}` | `password.reset` | `guest` | Reset Password Form |
| `POST` | `/reset-password` | `password.store` | `guest` | Store New Password |
| `GET` | `/dashboard` | `dashboard` | `auth, verified` | Role-Based Post-Login Dispatcher |
| `GET` | `/documents/{document}/download` | `documents.download` | `auth` | Secure File Download Handler |
| **CLIENT PORTAL** | | | `auth, role:client` | |
| `GET` | `/client/dashboard` | `client.dashboard` | `role:client` | Client Portal Main Overview |
| `GET` | `/client/appointments` | `client.appointments` | `role:client` | Book & Manage Consultation Meetings |
| `GET` | `/client/documents` | `client.documents` | `role:client` | Upload & Manage Tax Vault Documents |
| `GET` | `/client/tax-returns` | `client.tax-returns` | `role:client` | Track 6-Stage Tax Return Workflow Timeline |
| `GET` | `/client/invoices` | `client.invoices` | `role:client` | Review Invoices & Online Payment Trigger |
| `GET` | `/client/messages` | `client.messages` | `role:client` | Direct Chat Messaging with CPA |
| `GET` | `/client/reports` | `client.reports` | `role:client` | Financial & Payment History Charts |
| `GET` | `/client/profile` | `client.profile` | `role:client` | Personal & Business Tax Profile |
| `GET` | `/client/settings` | `client.settings` | `role:client` | Account Security & Notifications |
| **ACCOUNTANT PORTAL** | | | `auth, role:accountant` | |
| `GET` | `/accountant/dashboard` | `accountant.dashboard` | `role:accountant` | Accountant Portal Dashboard |
| `GET` | `/accountant/clients` | `accountant.clients` | `role:accountant` | Client Directory & Accounts |
| `GET` | `/accountant/appointments` | `accountant.appointments` | `role:accountant` | Consultation Calendar & Confirmations |
| `GET` | `/accountant/documents` | `accountant.documents` | `role:accountant` | Client Document Vault Review |
| `GET` | `/accountant/tax-returns` | `accountant.tax-returns` | `role:accountant` | Advance Filings Through Workflow |
| `GET` | `/accountant/invoices` | `accountant.invoices` | `role:accountant` | Issue Line-Item Invoices to Clients |
| `GET` | `/accountant/messages` | `accountant.messages` | `role:accountant` | Client Support & Communication Thread |
| `GET` | `/accountant/reports` | `accountant.reports` | `role:accountant` | Practice Revenue & Billing Analytics |
| **ADMIN PORTAL** | | | `auth, role:admin` | |
| `GET` | `/admin/dashboard` | `admin.dashboard` | `role:admin` | Admin Portal System Overview |
| `GET` | `/admin/users` | `admin.users` | `role:admin` | Platform User Accounts & RBAC |
| `GET` | `/admin/services` | `admin.services` | `role:admin` | Service Catalog & Pricing Management |
| `GET` | `/admin/appointments` | `admin.appointments` | `role:admin` | Global Appointment Audit Trail |
| `GET` | `/admin/invoices` | `admin.invoices` | `role:admin` | Global Invoicing Log |
| `GET` | `/admin/activity-logs` | `admin.activity-logs` | `role:admin` | System Activity & Audit Trail |
| `GET` | `/admin/settings` | `admin.settings` | `role:admin` | Platform Configuration & Tax Defaults |

---

## 📱 Mobile Responsiveness

The application is engineered for all device viewports:
* **Desktops & Laptops**: Multi-column grids, fixed sidebars, and persistent top controls.
* **Tablets & Mobile**: Collapsible drawer sidebars triggered via Alpine.js `mobileMenuOpen`, responsive scrollable tables (`overflow-x-auto`), and flexible stacked card grid layouts.
