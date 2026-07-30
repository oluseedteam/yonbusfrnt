# YONBUS Tax & Accounting Services Inc. 📊

![YONBUS Logo](public/images/logo.png)

> **YONBUS Tax & Accounting Services Inc.** is a production-ready, multi-tenant, role-based SaaS platform engineered for tax preparation, bookkeeping, accounting, payroll, and financial consultation management.

---

## 🔑 Pre-Seeded System Credentials & Access Portals

All administrative and client accounts are pre-seeded in `database/seeders/DatabaseSeeder.php`:

| Role | Email | Password | Access URI | Dashboard Capabilities |
| :--- | :--- | :--- | :--- | :--- |
| 👑 **Super Admin** | `admin@yonbus.com` | `password` | `/admin/dashboard` | Full system control, user CRUD, pricing, global audit logs & settings |
| 💼 **Accountant / CPA** | `accountant@yonbus.com` | `password` | `/accountant/dashboard` | Client directory, appointment calendar, document vault & tax returns |
| 👤 **Client** | `client@yonbus.com` | `password` | `/client/dashboard` | Consultation booking, document uploads, 6-stage tax tracker & invoices |

---

## 🏛️ Admin Logic & Core Business Workflow Architecture

### 1. Centralized Authorization & Role Redirection (`/dashboard`)
* Upon login, `RegisteredUserController` and `AuthenticatedSessionController` route users to `/dashboard`.
* The `/dashboard` route invokes role-based dispatching in `routes/web.php` and `EnsureRole` middleware:
  * **Admin / Super Admin** $\rightarrow$ Redirected to `/admin/dashboard`
  * **Accountant** $\rightarrow$ Redirected to `/accountant/dashboard`
  * **Client** $\rightarrow$ Redirected to `/client/dashboard`

### 2. Admin Portal Modules & Functionality
* **User Management (`/admin/users` & `AddUserForm`)**:
  * Full user lifecycle CRUD with support for `first_name`, `last_name`, `email`, `phone`, `role` (`admin`, `accountant`, `client`), and `is_active` status toggles.
  * Real-time search and filter logic with defensive null handling across Eloquent models.
* **Services & Catalog Management (`/admin/services`)**:
  * Manage tax preparation tiers, accounting packages, hourly consultation rates, and active/inactive status.
* **Global Appointment Audit Trail (`/admin/appointments`)**:
  * Real-time oversight of all scheduled client consultations, assigned CPAs, status updates (`pending`, `confirmed`, `completed`, `cancelled`), and date/time slot validation.
* **Global Invoicing Log (`/admin/invoices`)**:
  * Centralized billing administration, payment status monitoring (`unpaid`, `paid`, `overdue`), line-item breakdowns, and payment gateway logs.
* **System Activity & Audit Log (`/admin/activity-logs`)**:
  * Automated system audit trail powered by `AuditService` tracking logins, document uploads, user modifications, and role updates.
* **Platform Settings (`/admin/settings`)**:
  * Global corporate configurations, default tax year parameters, notification webhooks, and company contact metadata.

---

## 🚀 Deployment Guides (Vercel, Netlify, cPanel)

### 1. 🔺 Deploying to Vercel

Vercel support is pre-configured via `vercel.json` and the serverless front-controller entry point `api/index.php`.

#### Deployment Steps:
1. **Connect Repository to Vercel**:
   * Push your project to GitHub/GitLab.
   * Import the repository in your [Vercel Dashboard](https://vercel.com).
   * Set Root Directory to `frontend`.
2. **Configure Environment Variables**:
   Add the following environment variables in Vercel settings:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_KEY=base64:T8+ihHiiRMoaNtyr5UIOgaG5l46HtWOaxjN30/tqti0=
   APP_URL=https://your-app.vercel.app
   DB_CONNECTION=sqlite
   DB_DATABASE=/tmp/database.sqlite
   SESSION_DRIVER=array
   CACHE_STORE=array
   ```
3. **Deploy**:
   * Click **Deploy**. Vercel will process the build and serve the application using `vercel-php`.

---

### 2. 🩵 Deploying to Netlify

Netlify support is pre-configured via `netlify.toml` for static asset compilation and serverless proxy routing.

#### Deployment Steps:
1. **Connect Repository to Netlify**:
   * Log into [Netlify](https://netlify.com) and select **Add new site** > **Import an existing project**.
   * Link your repository and set Base directory to `frontend`.
2. **Build Settings**:
   * **Build Command**: `npm run build`
   * **Publish Directory**: `public`
3. **Environment Variables**:
   Set `PHP_VERSION=8.3`, `NODE_VERSION=20`, `APP_ENV=production`, `APP_KEY=...` in **Site Configuration > Environment Variables**.
4. **Deploy**:
   * Trigger deployment. Netlify will build Tailwind CSS assets and enforce redirect rules (`/*` to `/index.php`).

---

### 3. 🌐 Deploying to cPanel (Traditional Web Hosting)

Full cPanel compatibility is enforced via `frontend/.htaccess` and `frontend/public/.htaccess`.

#### Deployment Steps:
1. **Upload Project Files**:
   * Compress the `frontend` folder into a `.zip` archive.
   * Log into cPanel File Manager and upload the archive to your domain root (e.g., `public_html`).
   * Extract the files.
2. **Configure MySQL Database**:
   * Navigate to **cPanel > MySQL Database Wizard**.
   * Create a database (e.g., `yonbus_db`) and database user with full privileges.
3. **Update Environment File (`.env`)**:
   Edit `.env` inside your project folder:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://yourdomain.com
   
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=cpaneluser_yonbus_db
   DB_USERNAME=cpaneluser_dbuser
   DB_PASSWORD=your_secure_password
   ```
4. **Run Migrations & Seed Data via Terminal/SSH**:
   ```bash
   cd /path/to/public_html
   composer install --optimize-autoloader --no-dev
   php artisan migrate:fresh --seed --force
   php artisan storage:link
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
5. **Set File Permissions**:
   * Ensure `storage` and `bootstrap/cache` directories have `775` permissions.
   * Confirm domain document root points to `public_html/public` (or use the included root `.htaccess`).

---

## 🛠️ Complete System Route Reference (All 54 Routes)

| Method | URI | Route Name | Middleware / Protection | Description |
| :--- | :--- | :--- | :--- | :--- |
| `GET` | `/` | — | `web` | Public Landing Page |
| `GET` | `/login` | `login` | `guest` | User Authentication Login View |
| `POST` | `/login` | `login` | `guest` | Process User Login |
| `POST` | `/logout` | `logout` | `auth` | End User Session |
| `GET` | `/register` | `register` | `guest` | Client Registration Page |
| `POST` | `/register` | `register` | `guest` | Process Client Registration |
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

## 📱 Mobile Responsiveness & UI Excellence

The platform is designed with high-end financial SaaS standards:
* **Dark Mode & Modern Aesthetics**: Harmonious Slate/Indigo palette, custom soft shadows, glassmorphic UI elements, and responsive typography.
* **Cross-Device Viewports**: Mobile drawer navigation powered by Alpine.js (`mobileMenuOpen`), scrollable tables (`overflow-x-auto`), and dynamic card layouts for all device sizes.
