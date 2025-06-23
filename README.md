
![Logo](https://seacatering.site/assets/images/logo.png)


# Sea Catering

SEA Catering is a healthy meal subscription platform that allows users to subscribe to one of three available plans: Diet Plan, Protein Plan, and Royal Plan. Users can manage their subscription status by pausing or canceling their plans at any time. The admin dashboard provides visibility into all user data, subscriptions, and statuses but does not handle orders directly.

This application is built using the Laravel framework as the backend.


## 🚀 Main Features

- User registration & login
- Subscribe to meal plans (Diet, Protein, Royal)
- Pause or cancel subscriptions anytime
- View active subscription status and history
- Admin panel to monitor all user subscriptions and statuses

## ⚙️ System Requirements

- PHP >= 8.2
- Composer
- MySQL
- phpMyAdmin
- Node.js and NPM (for frontend build if using Vite)
- Laravel 12.x


## 📦 Installation and Setup

### 1. Clone Repository

```bash
  https://github.com/mcDJIL/COMPFEST-17.git
  cd COMPFEST-17
```

### 2. Install PHP and Frontend Dependencies

```bash
  composer install
  npm install
```

### 3. Copy and Configure .env File

```bash
  cp .env.example .env

  Edit the .env file according to your environment settings:

  APP_NAME=SEA Catering
  APP_ENV=local
  APP_KEY=
  APP_DEBUG=true
  APP_URL=http://localhost:8000
  API_TOKEN=_sea_catering_token

  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=db_sea_catering
  DB_USERNAME=root
  DB_PASSWORD=
```

### 4. Generate Application Key

```bash
  php artisan key:generate
```

### 5. Run Migration and Seeder

```bash
  php artisan migrate --seed
```
This command will run all migrations and seeders, including the default admin account.


## 🔐 Default Admin Account

After seeding, you can log in to the admin dashboard using the following account:

Email: seacatering28@gmail.com   
Password: password
## 🌐 Run Local Server

Start the server

```bash
  php artisan serve
```

```bash
  npm run dev
```


## 👨‍💻 Tech Stack

**Client:** Javascript, Jquery, TailwindCSS

**Server:** Laravel, PHP


## Link Website

[www.seactering.site](https://seacatering.site)