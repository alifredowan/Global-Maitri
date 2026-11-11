# 🪷 Global Maitri — Buddhist Matrimony

<p align="center">
  <strong>Kindness first. Companionship for life.</strong><br>
  A modern, mindful Buddhist matrimonial web application designed for seekers and families worldwide.<br>
  Rooted in loving-kindness (<em>Maitri / Metta</em>), Dhamma-based compatibility, family representative guidance, and mutual privacy.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.4">
  <img src="https://img.shields.io/badge/Tailwind_CSS-v4.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS v4">
  <img src="https://img.shields.io/badge/WebSocket-Laravel_Reverb-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel Reverb">
  <img src="https://img.shields.io/badge/Database-PostgreSQL_%7C_MySQL_%7C_SQLite-336791?style=for-the-badge&logo=postgresql&logoColor=white" alt="Database Support">
  <img src="https://img.shields.io/badge/Tests-173%20Passed%20(912%20Assertions)-success?style=for-the-badge" alt="Tests 173 Passed">
</p>

---

## 📖 Table of Contents
1. [Platform Vision & Dhamma Principles](#-platform-vision--dhamma-principles)
2. [Buddhist Color Symbolism Design System](#-buddhist-color-symbolism-design-system)
3. [Key Architecture & Features](#-key-architecture--features)
4. [Quick Demo Credentials](#-quick-demo-credentials)
5. [User Manual & Role Workflows](#-user-manual--role-workflows)
   - [1. Seeker Journey (Grooms & Brides)](#1-seeker-journey-grooms--brides)
   - [2. Family Representative (Kalyāṇa-Mitta) Workflow](#2-family-representative-kalyāṇa-mitta-workflow)
   - [3. Monk / Elder Advisor Role](#3-monk--elder-advisor-role)
   - [4. Super Administrator Suite & Compliance](#4-super-administrator-suite--compliance)
   - [5. Moderation & Safety Center](#5-moderation--safety-center)
6. [Tech Stack](#-tech-stack)
7. [Installation & Quick Start](#-installation--quick-start)
8. [Real-Time WebSockets (Laravel Reverb)](#-real-time-websockets-laravel-reverb)
9. [Email & SMTP Configuration Guide](#-email--smtp-configuration-guide)
10. [Database Switching (PostgreSQL / MySQL / SQLite)](#-database-switching-postgresql--mysql--sqlite)
11. [Testing & Code Quality](#-testing--code-quality)
12. [License & Attribution](#-license--attribution)

---

## 🕊️ Platform Vision & Dhamma Principles

Unlike conventional dating platforms driven by fast, superficial swiping and extractive monthly subscriptions, **Global Maitri** is purpose-built for mindful Buddhists and their families seeking lifelong companionship (*Mangala Vivaha*):

* **Loving-Kindness First (*Metta & Maitri*)**: Respectful, pressure-free connection requests without aggressive timers or manipulative notifications.
* **Universal Buddhist Inclusivity**: Welcomes seekers across all traditions (**Theravada, Mahayana, Vajrayana, Secular/Zen**) and global communities (Sri Lanka, Thailand, Myanmar, Nepal, Bangladesh, India, UK, USA, Canada, Australia) without caste or ethnic prejudice.
* **Dhamma-Weighted Compatibility**: Match resonance is evaluated on spiritual practice, meditation consistency, adherence to the Five Precepts (*Panca Sila*), temple observance (*Uposatha*), and mindful lifestyle.
* **Family Representative (*Kalyāṇa-Mitta*) Support**: Provides parents, elder siblings, or trusted guardians with a dedicated review dashboard to bless suitors and participate with honor.
* **Server-Side Photo Veil**: Candidate portraits remain softly blurred server-side until mutual interest and explicit photo release are confirmed.
* **Single Marriage Pass (Fair Pricing)**: Abolishes recurring monthly subscription traps. The Pro Pass remains active for a one-time fee until your confirmed wedding milestone blessing.

---

## 🎨 Buddhist Color Symbolism Design System

The platform's visual identity is engineered around traditional Buddhist color symbolism through standardized CSS design tokens (no hardcoded ad-hoc hex values):

| Color | Design Token | Hex | Symbolism & Usage |
|---|---|---|---|
| **Maitri Blue** | `--color-primary` | `#1F4E79` | Loving-kindness, compassion, peace. Primary buttons, brand headers, verified badges. |
| **Saffron-Gold** | `--color-accent` | `#C98A1B` | Monastic robes, wisdom, enlightenment. High-contrast CTAs on dark bands, active indicators. |
| **Lotus Pink** | `--color-lotus` | `#D9779A` | Purity of heart, noble spiritual journey. Delicate accents, illustrations, and highlights. |
| **Warm White / Ivory** | `--color-bg` | `#FFFDF8` | Purity and calm clarity. Main page canvas and card surfaces. |
| **Crimson** | `--color-blessing` | `#B3261E` | Auspicious wedding blessings and urgent system alerts. |
| **Deep Monastic Ink** | `--color-ink-dark` | `#0E2A47` | Serene evening reflection. Dark hero sections, closing CTA bands, and footer. |

* **Buddhist Flag Divider**: The public footer is graced with a 3px hairline band reflecting the five-color sequence of the international Buddhist flag.

---

## ✨ Key Architecture & Features

### 🪷 1. Dhamma Compatibility Scoring Algorithm
Candidates are ranked through a weighted spiritual resonance matrix:
* **40% Dhamma & Spiritual Practice**: Tradition alignment (Theravada / Mahayana / Vajrayana), meditation frequency (daily Vipassana, retreats), *Panca Sila* adherence, and temple (*Vihara*) visits.
* **30% Lifestyle & Ethical Values**: Dietary practice (Vegetarian, Vegan, Mindful), alcohol/intoxicant avoidance, and intention to raise children in the Dhamma.
* **30% Demographics & Education**: Country of residence, profession, educational background, and family living arrangements.

### 🛡️ 2. Family Representative (*Kalyāṇa-Mitta*) Workflow
* Seekers can link a parent or trusted family member to their profile.
* When a suitor sends an interest proposal, the Family Representative receives a real-time notification and can inspect the proposal on their **Family Dashboard**.
* The Family Representative can grant initial approval or decline courteously on behalf of the family before direct chat commences.

### 🔒 3. Server-Side Privacy Veil
* Candidate photos are processed server-side (via PHP GD) into obscured representations.
* Raw unblurred media streams are protected behind permission gates and only unlocked when mutual interest and photo exchange consent are explicitly granted.

### 💎 4. Pro Single Marriage Pass & Dynamic Packages
* **Single Marriage Guarantee**: Pay once; the pass remains active until the wedding milestone blessing (*Mangala Vivaha*).
* **Super Admin Package Builder**: Dynamically configure subscription plans, daily limits, incognito mode, profile boost ribbons, and visitor analytics.
* **Targeted Promo Engine**: Percentage or flat discounts with expiry dates and usage limits.

### ⚡ 5. Real-Time WebSockets (Laravel Reverb)
* Low-latency broadcasting across private user channels (`private-user.{id}`) and conversation threads (`private-chat.{id}`).
* Instant notification counter increments, badge refreshes, and real-time chat delivery without page reloading.

### 🍪 6. GDPR & ePrivacy Cookie Consent Suite
* Non-intrusive 360px floating cookie consent card on first visit with 12-month first-party persistence.
* Granular category selection: **Essential** (locked), **Analytics**, and **Marketing** (off by default).
* Accessible "Cookie settings" modal trigger in the public footer and user settings.
* Super Admin compliance console (`/admin/compliance`) for updating policy URLs and regulatory text.

### 📱 7. Mobile-Ready REST API v1
* Full mobile backend endpoints under `/api/v1/` authenticated with **Laravel Sanctum Bearer Tokens** for iOS, Android, and headless integrations.

---

## 🔑 Quick Demo Credentials

Sign in directly or test the application using the pre-seeded accounts:

| Role | Email Address | Password | Capabilities |
|---|---|---|---|
| **👑 Super Admin** | `admin@globalmaitri.com` | `Password123!` | Full admin suite, packages, promo codes, compliance console, audit logs |
| **🧔 Seeker Groom (Male)** | `seeker.groom@globalmaitri.com` | `password` | Pro Single Marriage Pass, verified biodata, daily Vipassana meditator |
| **🧕 Seeker Bride (Female)** | `seeker.bride@globalmaitri.com` | `password` | Free Explorer, linked to family representative, private photo veil |
| **🛡️ Family Representative** | `family.father@globalmaitri.com` | `password` | Review suitor proposals on Family Dashboard, grant family blessings |
| **🧘 Monk Advisor** | `bhante.bodhi@globalmaitri.com` | `password` | Spiritual guidance, temple blessing coordination, Dhamma counseling |
| **⚖️ Safety Moderator** | `moderator@globalmaitri.com` | `password` | Review national ID verifications, handle community safety reports |

*(Legacy fallback accounts such as `admin@nikahconnect.com` / `Password123!` and `seeker.groom@nikahconnect.test` / `password` are retained for historical test suite compatibility).*

---

## 📚 User Manual & Role Workflows

### 1. Seeker Journey (Grooms & Brides)
1. **Registration (`/register`)**: Enforces strict 18+ legal age verification, gender selection, and account initialization.
2. **Dhamma Biodata Setup (`/profile/edit`)**: Declare tradition (Theravada, Mahayana, Vajrayana), meditation frequency, temple visits, Five Precepts practice, dietary preferences, and family values.
3. **Candidate Discovery (`/discover`)**: Filter seekers by spiritual practice, country, tradition, and education with real-time match percentage calculation.
4. **Sending Kind Interests (`/interests`)**: Send an introduction note. If the candidate has a linked Family Representative, the proposal is routed through the family dashboard.
5. **Respectful Messaging (`/messages`)**: Once accepted by both the seeker and family, a private chat channel opens with optional chaperone visibility and safety reminders.
6. **Mangala Vivaha Celebration (`/mangala-vivaha`)**: When a couple agrees to marry, they confirm their union, generate a digital wedding blessing certificate, and archive their search gracefully.

### 2. Family Representative (*Kalyāṇa-Mitta*) Workflow
1. **Account Registration**: A parent, sibling, or guardian registers with their family relationship.
2. **Linking Ward (`/wali/link`)**: Connect to the seeker's profile via their registered email address.
3. **Family Dashboard (`/wali/dashboard`)**:
   - Inspect incoming suitor proposals, verified ID badges, and practice depth.
   - Tap **"Approve"** to grant family blessings and unlock communication, or **"Decline"** with an honorable message.

### 3. Monk / Elder Advisor Role
* Assigned to ordained monks (*Bhikkhus/Bhikkhunis*) or respected community elders.
* Accessible for pre-marital Dhamma guidance, conflict resolution, and coordinating *Mangala Vivaha* temple blessings.

### 4. Super Administrator Suite & Compliance (`/admin`)
* **Package Management (`/admin/packages`)**: Add, modify, or archive Single Marriage Pass tiers and pricing.
* **Promo Code Center (`/admin/promo-codes`)**: Issue discount coupons with expiration dates and usage thresholds.
* **Compliance Console (`/admin/compliance`)**: Manage GDPR/ePrivacy cookie banner text, policy links, and consent categories.
* **Staff Administration (`/admin/staff`)**: Provision moderators with granular permission sets.
* **Immutable Audit Trail (`/admin/audit-logs`)**: Security event log recording authentication, role changes, and account actions.

### 5. Moderation & Safety Center (`/admin/verifications` & `/admin/reports`)
* **ID Verification Queue**: Review submitted national identity cards or passports and issue the blue **"Verified Candidate"** badge.
* **Report Resolution**: Investigate flagged messages or suspicious activity, issue formal warnings, or suspend accounts.

---

## 🛠️ Tech Stack

* **Backend Framework**: [Laravel 12.x / 13.x](https://laravel.com) running on **PHP 8.4**
* **Database**: PostgreSQL 16 (default), fully compatible with MySQL 8.x and SQLite
* **Frontend**: Blade Templating, [Tailwind CSS v4](https://tailwindcss.com), Alpine.js, Vite 8
* **Real-time WebSockets**: [Laravel Reverb](https://reverb.laravel.com) + Laravel Echo + Pusher JS
* **API Authentication**: Laravel Sanctum (Bearer Tokens)
* **Code Standard**: Laravel Pint (PSR-12)
* **Testing Suite**: PHPUnit (173 Feature & Unit tests covering 100% of matrimonial workflows)

---

## 🚀 Installation & Quick Start

### Prerequisites
* **PHP >= 8.4** with extensions: `pdo`, `pdo_pgsql` (or `pdo_mysql` / `pdo_sqlite`), `mbstring`, `openssl`, `gd`, `bcmath`, `curl`
* **Composer >= 2.x**
* **Node.js >= 20.x** & **npm**
* **PostgreSQL**, **MySQL**, or **SQLite**

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/global-maitri.git
cd global-maitri
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment File
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure Database in `.env`
For PostgreSQL (default):
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=global_maitri
DB_USERNAME=postgres
DB_PASSWORD=your_postgres_password
```
*(Or switch to MySQL/SQLite as described below).*

### 5. Run Migrations & Seed Demo Data
```bash
php artisan migrate:fresh --seed
```
*Seeds subscription plans, compliance settings, demo candidates, and all test credentials.*

### 6. Build Frontend Assets
```bash
npm run build
```

### 7. Start the Local Server
```bash
php artisan serve
```
Open **`http://127.0.0.1:8000`** in your browser.

---

## 📡 Real-Time WebSockets (Laravel Reverb)

For instant chat messaging and notification badges without page reloads:

1. Verify the Reverb credentials in `.env`:
```env
BROADCAST_CONNECTION=reverb
REVERB_APP_ID=100101
REVERB_APP_KEY=maitrikey100101
REVERB_APP_SECRET=maitrisecret100101
REVERB_HOST="127.0.0.1"
REVERB_PORT=8080
REVERB_SCHEME="http"
```

2. Start the Reverb WebSocket daemon in a dedicated terminal:
```bash
php artisan reverb:start
```

---

## 📧 Email & SMTP Configuration Guide

Test email delivery locally using the built-in diagnostic command:
```bash
php artisan mail:test recipient@example.com
```

### Option A: Gmail SMTP
1. Enable **2-Step Verification** in your Google Account and generate an **App Password** (16 characters).
2. Configure `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_16_digit_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="no-reply@globalmaitri.com"
MAIL_FROM_NAME="Global Maitri"
```

### Option B: Custom Domain Business Mail
```env
MAIL_MAILER=smtp
MAIL_HOST=mail.globalmaitri.com
MAIL_PORT=465
MAIL_USERNAME=admin@globalmaitri.com
MAIL_PASSWORD=your_secret_password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS="admin@globalmaitri.com"
MAIL_FROM_NAME="Global Maitri"
```

### Option C: Transactional Provider (Resend / Brevo / Mailtrap)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp-relay.brevo.com
MAIL_PORT=587
MAIL_USERNAME=your_account_email
MAIL_PASSWORD=your_smtp_api_key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="contact@globalmaitri.com"
MAIL_FROM_NAME="Global Maitri"
```

---

## 🔄 Database Switching (PostgreSQL / MySQL / SQLite)

The platform is database-agnostic. Change `DB_CONNECTION` in `.env`:

### Switching to MySQL
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=global_maitri
DB_USERNAME=root
DB_PASSWORD=
```
Then run:
```bash
php artisan migrate:fresh --seed
```

### Switching to SQLite (Zero-Configuration Local Development)
```env
DB_CONNECTION=sqlite
```
Create an empty database file and seed:
```bash
touch database/database.sqlite
php artisan migrate:fresh --seed
```

---

## 🧪 Testing & Code Quality

Global Maitri maintains rigorous automated test coverage across all matrimonial constraints, spiritual compatibility algorithms, family representative workflows, and security guardrails:

### Run the Test Suite
```bash
php artisan test
```
*Current test suite results: **173 passed, 912 assertions** (100% pass rate).*

### Key Test Scenarios Covered
* **Age Integrity (18+ Requirement)**: Rejects candidate registrations under 18 years of age.
* **Email Uniqueness & Normalization**: Guarantees case-insensitivity and strips whitespace preventing duplicate accounts.
* **Case-Insensitive Password Reset**: Verifies password recovery works seamlessly across any casing.
* **Family Representative Workflow**: Asserts communication remains locked until family approval is granted when requested.
* **Server-Side Photo Veil**: Verifies raw photo streams are blocked for unauthorized visitors.
* **Single Marriage Pass Billing**: Validates dynamic plan generation, pricing calculation, and promo code redemptions.
* **Cookie Consent & Compliance**: Asserts 12-month consent persistence and restricts compliance management to Super Admins.
* **Real-Time Notification & Messaging**: Tests Reverb WebSocket channel authorization and message delivery.

### Code Formatting (Laravel Pint)
Format code to PSR-12 and Laravel standards:
```bash
vendor/bin/pint --format agent
```

---

## 📄 License & Attribution

This project is licensed under the [MIT License](LICENSE).  
Dedicated with loving-kindness to the global Buddhist community.

> *"Sabbe satta bhavantu sukhitatta — May all beings be happy and well."*
