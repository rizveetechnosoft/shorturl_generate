# Short URL Generator Project

This project provides a service to generate short URLs from longer, original URLs. The service accepts a long URL as input, generates a unique 6-character short URL, and stores the mapping between the short and long URL in a database. When the short URL is accessed, the user is redirected to the corresponding original long URL. The system ensures that each short URL is unique, handles invalid URLs, and addresses potential conflicts in short URL generation.

## Key Features:
1. **Long URL to Short URL**: A unique 6-character short URL is generated for each long URL.
2. **Redirection**: The short URL redirects the user to the original long URL.
3. **Short URL Uniqueness**: Ensures that generated short URLs are unique by checking the database and regenerating them if a conflict is found.
4. **Error Handling**: The service handles invalid URLs and ensures proper redirection.

## Technical Considerations:
- **Data Structure**: The short and long URL mapping is stored in a database table, which ensures persistence.
- **Unique URL Generation**: The service uses a retry mechanism to ensure that the generated short URL does not conflict with an existing one.
- **Error Handling**: The service validates the input URL format and ensures only valid URLs are accepted.

## Unit Test Scenarios:
1. **Valid URL Creation**: Ensure that when a valid long URL is provided, a corresponding short URL is generated and stored.
2. **Unique Short URL Generation**: Test that the generated short URL is unique and does not conflict with any existing short URL.
3. **Redirection**: Verify that accessing the short URL redirects to the correct long URL.
4. **Invalid URL Handling**: Check that the service returns an error message if the input URL is invalid.
5. **Short URL Duplication**: Test that the system correctly regenerates a unique short URL when a conflict occurs.

## Requirements

Before running the project, make sure you have the following installed:
- PHP >= 8.0
- Composer
- MySQL or SQLite for database
- Laravel 9.x or later
- Node.js (for frontend assets, if applicable)

## Installation

Follow these steps to set up and run the project:

1. **Clone the repository**:

    ```bash
    git clone https://github.com/rizveetechnosoft/shorturl_generate.git
    cd shorturl_generate
    ```

2. **Set up the `.env` file**:

    Copy the `.env.example` file and rename it to `.env`. Update the database credentials and other configuration settings.

    ```bash
    cp .env.example .env
    ```

3. **Install PHP dependencies**:

    ```bash
    composer update
    ```

4. **Generate the application key**:

    ```bash
    php artisan key:generate
    ```

5. **Run database migrations**:

    ```bash
    php artisan migrate
    ```

    This will create the necessary tables in the database for storing the long and short URLs.

6. **Start the local development server**:

    ```bash
    php artisan serve
    ```

    By default, the project will be available at `http://localhost:8000`.

## Running Tests

To ensure everything is working correctly, you can run the unit tests:

```bash
php artisan test
