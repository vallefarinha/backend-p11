# 🚀 Laravel Backend API

Welcome to the Laravel Backend API project! This project serves as the backend infrastructure for the Sustainable Accessories E-commerce Platform. Below, you'll find essential information to get started with the backend.

## Project Overview

The backend API is built using the Laravel framework, a powerful PHP framework known for its elegance and simplicity. It incorporates various dependencies and devDependencies to enhance development, including Guzzle HTTP client for making HTTP requests, Laravel Sanctum for API authentication, Twilio SDK for integrating Twilio services, and more.

## Setup Instructions

To set up the backend project locally, follow these instructions:

1. **Clone the repository:** 
   ```
   git clone https://github.com/vallefarinha/backend-p11.git
   ```

2. **Install dependencies:** 
   ```
   composer install
   ```

3. **Set up environment variables:** 
   - Create a copy of the `.env.example` file and rename it to `.env`.
   - Configure the necessary environment variables such as database connection details, Twilio credentials, etc.

4. **Generate application key:**
   ```
   php artisan key:generate
   ```

5. **Run migrations and seeders:**
   ```
   php artisan migrate --seed
   ```

6. **Serve the application:**
   ```
   php artisan serve
   ```

## Project Structure

- **app/:** Contains the application logic.
- **database/:** Contains migrations, seeders, and factories.
- **routes/:** Defines API routes.
- **tests/:** Contains test cases.
- **vendor/:** Contains project dependencies.
- **.env:** Configuration file for environment variables.
- **composer.json:** Defines project metadata and dependencies.
- **README.md:** Provides information about the project.

## Technologies Used

- **Laravel Framework:** A PHP framework for building web applications.
- **Guzzle HTTP:** A PHP HTTP client for making HTTP requests.
- **Laravel Sanctum:** A lightweight authentication system for Laravel.

## Contribution Guidelines

Contributions to the project are welcome! If you have any ideas, suggestions, or find any issues, feel free to open an issue or create a pull request. Please follow the contribution guidelines outlined in the repository.

## License

This project is licensed under the [MIT License](LICENSE).

---

Thank you for choosing the Laravel Backend API project! If you have any questions or need further assistance, feel free to contact us. Happy coding! 🚀
