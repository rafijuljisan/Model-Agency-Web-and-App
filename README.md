<p align="center">
  <h1 align="center">Dhaka Model Agency (DMA)</h1>
  <p align="center"><strong>Bangladesh’s Premier Verified Talent Platform</strong></p>
</p>

<p align="center">
<a href="#"><img src="https://img.shields.io/badge/Laravel-11.x-FF2D20.svg?style=flat&logo=laravel" alt="Laravel Version"></a>
<a href="#"><img src="https://img.shields.io/badge/Livewire-3.x-fb70a9.svg?style=flat" alt="Livewire"></a>
<a href="#"><img src="https://img.shields.io/badge/Filament-3.x-FBBF24.svg?style=flat" alt="Filament Admin"></a>
<a href="#"><img src="https://img.shields.io/badge/License-Proprietary-blue.svg?style=flat" alt="License"></a>
</p>

## About Dhaka Model Agency

Dhaka Model Agency (DMA) is a luxury, editorial-style web application designed to connect aspiring and professional models, actors, photographers, and content creators with brands and production houses across Bangladesh. 

Built with an emphasis on **Trust, Quality, and Aesthetics**, the platform takes the pain out of talent discovery by automating verification, enforcing profile completeness, and providing a seamless dark/light mode experience.

### Core Features

- **Automated Member ID Generation:** Sequentially auto-generates unique IDs (e.g., `DMA-261001`) upon user creation, ensuring systematic roster management.
- **Smart "Featured Talent" Algorithm:** A custom, weighted sorting engine that ranks talent based on:
  - **Quality Control:** Enforces strict 100% profile completeness (NID, Bio, Avatar, 3+ Portfolio photos).
  - **Freshness (Daily Seed):** Gives new talent a 15-day front-page boost and randomly rotates active users daily while pushing inactive accounts to the bottom.
  - **Tiered Subscriptions:** Automatically prioritizes Pro/Elite tier members over standard verified members.
- **Robust Admin Panel:** Powered by Filament v3 to manage users, approve/reject private NID and Academic verification documents, and configure dynamic site settings.
- **Immersive Artist Dashboard:** A multi-step Livewire wizard guiding talents through subscription payments, secure document uploads, and comprehensive portfolio management (with auto image-cropping).
- **Dynamic SEO & Settings:** Fully controllable Meta tags, GA4, Meta Pixel, and dynamic footer/contact pages driven directly from the database.

## Technology Stack

This application leverages a modern TALL-stack inspired architecture:
- **Framework:** [Laravel](https://laravel.com)
- **Frontend/Reactivity:** [Livewire v3](https://livewire.laravel.com)
- **Admin Panel:** [Filament v5.4](https://filamentphp.com)
- **Styling:** Custom CSS with CSS Variables for seamless Light/Dark mode toggling ("Editorial Luxury" aesthetic).
- **Media Management:** Spatie Media Library (for avatars and portfolio grid management).

## Local Development Setup

To get the Dhaka Model Agency application running locally, follow these standard Laravel setup guidelines:

1. **Clone the repository:**
   bash
   ```
   git clone <repository-url>
   cd agency-app
   ```

## Install PHP dependencies:

Bash
```
composer install
```
## Install NPM dependencies & compile assets:

Bash
```
npm install
npm run build
```
## Environment Configuration:
Copy the .env.example file to .env and configure your database and mail credentials:

Bash
```
cp .env.example .env
php artisan key:generate
Run Migrations and Seeders:
```
Bash
```
php artisan migrate --seed
Link Storage (Crucial for Images):
```
Bash
```
php artisan storage:link
```

## Serve the Application:
Bash
```
php artisan serve
```
## Security & Verification Protocols
- Given the sensitive nature of talent data, DMA enforces strict access control:
- Private Disk Storage: NID cards and academic certificates are stored on Laravel's private disk.
- Signed Routing: Admin access to these documents is guarded by role-based middleware (Super-Admin) and served via secure file responses.
- If you discover a security vulnerability within the application, please immediately notify the lead developer or agency management. All security vulnerabilities will be promptly addressed.

## Server Requirements
Ensure your server meets the following requirements before deployment:

PHP >= 8.2
- MySQL >= 8.0 / MariaDB
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## License
This software is a proprietary application developed specifically for Dhaka Model Agency. Unauthorized copying, modification, or distribution of this software, via any medium, is strictly prohibited.