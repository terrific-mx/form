# AGENTS.md

## Build, Lint, and Test Commands
- Install dependencies: `composer install` & `npm install`
- Build frontend assets: `npm run build`
- Start dev server: `npm run dev`
- Lint PHP: `vendor/bin/pint`
- Run all PHP tests: `./vendor/bin/pest` or `composer test`
- Run a single PHP test: `./vendor/bin/pest --filter [TestName]`

## Code Style Guidelines
- **PHP:**
  - PSR-12 formatting (`vendor/bin/pint`)
  - PSR-4 autoloading
  - StudlyCase for classes, camelCase for methods/variables
  - Group `use` imports
  - Use PHP 8+ types
  - Prefer promoted public readonly properties for value objects, DTOs, and notification constructors (PHP 8.3+)
  - Handle errors with exceptions or Laravel validation
- **JavaScript:**
  - ES6+ syntax, Vite/Tailwind, Prettier if present
  - Clear, descriptive naming
- **General:**
  - Write clear, maintainable code
  - Comment complex logic

## UI & Volt Conventions
- Use short Blade/Volt link syntax, e.g. `:href="route('forms.create')"`
- Always add `wire:navigate` to navigation links/buttons for SPA behavior
- To create Volt page components:
  - Generate: `php artisan make:volt pages/forms/create`
  - Register: `Volt::route('forms/create', 'pages.forms.create')->name('forms.create');` in `routes/web.php` (add to correct middleware group)
