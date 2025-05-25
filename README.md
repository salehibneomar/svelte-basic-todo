# Svelte Basic Todo App

A full-stack Todo application with a Svelte frontend and a Laravel backend, using MySQL as the database. This project is organized into two main parts:

---

## Usage

### Backend

- Install dependencies: `cd backend && composer install`
- Configure `.env` for MySQL
- Run migrations: `php artisan migrate --seed`
- Start server: `php artisan serve`

### Frontend

- Install dependencies: `cd frontend && pnpm install`
- Start dev server: `pnpm run fire`

---

## Project Structure

```
svelte-basic-todo/
│
├── backend/   # Laravel API backend
│   ├── app/           # Application core (models, services, controllers, traits, enums etc.)
│   ├── config/        # Configuration files
│   ├── database/      # Migrations, seeders, factories
│   ├── public/        # Public entry (index.php)
│   ├── resources/     # Blade views, JS, CSS
│   ├── routes/        # Route definitions (api.php, web.php)
│   └── tests/         # Unit and feature tests
│
├── frontend/  # Svelte frontend
│   ├── src/           # Svelte app source code
│   │   ├── lib/           # Shared components, stores, types, services
│   │   └── routes/        # SvelteKit routes (pages)
│   ├── static/        # Static assets (favicon, etc.)
│   ├── app.css        # Global styles
│   ├── svelte.config.js  # Svelte config
│   └── vite.config.ts    # Vite config
│
└── README.md   # Project documentation
```

---

## Backend (Laravel)

- **Purpose:** Provides a RESTful API for managing todos.
- **Key Folders:**
  - `app/Models/` - Eloquent models (e.g., Todo, User)
  - `app/Http/Controllers/` - API controllers
  - `app/Services/` - Business logic
  - `database/migrations/` - Database schema
  - `routes/api.php` - API routes

## Frontend (Svelte)

- **Purpose:** User interface for managing todos.
- **Key Folders:**
  - `src/routes/` - Main pages (e.g., todo list)
  - `src/lib/components/` - Reusable UI components
  - `src/lib/stores/` - Svelte stores for state management
  - `src/lib/types/` - TypeScript types

---

## Database

- **MySQL** is used for persistent storage of todos

---

## Features

- CRUD
- Pagination support
- Modern UI with Svelte, Flowbite, and Svelte Toasts
- RESTful API with Laravel

---

Feel free to use this as a reference!
