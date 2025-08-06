# Terrific Form

Terrific Form is a Laravel application that allows you to generate form endpoints for use on static sites or platforms without backend access. With Terrific Form, you can easily create endpoints to accept form submissions from any website—no need to switch your preferred site platform or set up a custom backend. Simply use the generated endpoint in your HTML form's `action` attribute, and submissions will be handled by Terrific Form.

## Features

- **Generate form endpoints** for any site or platform
- **Accept form submissions** from static sites, JAMstack, WordPress, Webflow, or any HTML form
- **No backend required** on your site—just use the endpoint
- **Easy integration**: copy-paste the endpoint into your form's `action` attribute
- **Secure and reliable** Laravel backend

---

## Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/terrific-mx/form.git
   cd form
   ```

2. **Install dependencies:**
   ```bash
   composer install
   npm install && npm run build
   ```

3. **Configure environment:**
   - Copy `.env.example` to `.env` and update settings as needed:
     ```bash
     cp .env.example .env
     ```
   - Generate application key:
     ```bash
     php artisan key:generate
     ```

4. **Run migrations:**
   ```bash
   php artisan migrate
   ```

5. **Start the development server:**
   ```bash
   php artisan serve
   ```

---

## Usage

1. **Create a form endpoint:**
   - Log in to Terrific Form and create a new form endpoint.
   - Configure the fields and settings for your form.

2. **Integrate with your site:**
   - Copy the generated endpoint URL.
   - Use it in your HTML form:
     ```html
     <form action="https://your-terrific-form-app.com/forms/your-endpoint" method="POST">
       <!-- your form fields -->
     </form>
     ```
   - Deploy your site as usual—no backend changes required!

3. **View submissions:**
   - Log in to Terrific Form to view and manage submissions.

---

## Contributing

Contributions are welcome! Please open issues or submit pull requests for improvements or bug fixes.

---

## License

This project is open-source and available under the [MIT License](LICENSE).

---

## Contact

For questions or support, please open an issue on [GitHub](https://github.com/terrific-mx/form/issues) or contact the maintainer.

---

Enjoy effortless form handling for any site with Terrific Form!
