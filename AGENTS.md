# AGENTS.md

## Build, Lint, and Test Commands
- **Install dependencies:** `composer install` and `npm install`
- **Build frontend assets:** `npm run build`
- **Start frontend dev server:** `npm run dev`
- **Lint PHP code:** `vendor/bin/pint`
- **Run all PHP tests:** `./vendor/bin/pest` or `composer test`
- **Run a single PHP test:** `./vendor/bin/pest --filter [TestName]`

## Code Style Guidelines
- **PHP:**
  - Use PSR-12 formatting (`vendor/bin/pint`)
  - Autoloading via PSR-4 (see composer.json)
  - Class names: StudlyCase; method/variable names: camelCase
  - Group `use` imports at the top
  - Use PHP 8+ type hints and return types
  - Handle errors with exceptions and Laravel validation
- **JavaScript:**
  - Use ES6+ syntax, Vite/Tailwind conventions
  - Prefer Prettier defaults if configured
  - Use clear, descriptive names
- **General:**
  - Write clear, maintainable code
  - Add comments for complex logic
   - No Cursor or Copilot rules present

## Creating Volt Page Components

- To create a new Volt page component, use the following artisan command:
  ```
  php artisan make:volt pages/forms/create
  ```
  - This will generate a Volt component at `resources/views/livewire/pages/forms/create.blade.php`.
  - Use the `pages/forms/` folder for form-related pages, matching the structure for index/create/etc.
- Register the new page in `routes/web.php` using:
  ```php
  Volt::route('forms/create', 'pages.forms.create')->name('forms.create');
  ```
  - Place the route in the appropriate middleware group (e.g., `auth`, `verified`) as needed.
