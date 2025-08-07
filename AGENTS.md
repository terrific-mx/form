# AGENTS.md

## Build, Lint, and Test Commands
- Install dependencies: `composer install` & `npm install`
- Build frontend: `npm run build`
- Start dev server: `npm run dev`
- Lint PHP: `vendor/bin/pint`
- Run all PHP tests: `./vendor/bin/pest` or `composer test`
- Run a single PHP test: `./vendor/bin/pest --filter [TestName]`

## Code Style Guidelines
- **PHP:** PSR-12 (`vendor/bin/pint`), PSR-4 autoloading, StudlyCase for classes, camelCase for methods/vars, group `use` imports, PHP 8+ types, handle errors with exceptions/Laravel validation.
- **JavaScript:** ES6+, Vite/Tailwind, Prettier if present, clear naming.
- **General:** Write clear, maintainable code. Comment complex logic. No Cursor or Copilot rules present.

## UI Conventions
- Use short Blade/Volt link syntax, e.g. `:href="route('forms.create')"`.
- Always add `wire:navigate` to navigation links/buttons for SPA behavior.

## Creating Volt Page Components
- Generate: `php artisan make:volt pages/forms/create`
- Register: `Volt::route('forms/create', 'pages.forms.create')->name('forms.create');` in `routes/web.php` (add to correct middleware group).
