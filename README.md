# Yoodle Library Management System API

This is an API for a library management system, where different libraries can create their records and each record is only available to the members of that library. A super admin can see all libraries and their records while library members can only see the library they belong to and its records.

## Features

- User authentication and authorization using Laravel Passport
- Multi-tenancy using subdomains
- Roles and permissions using Laravel-permission package
- Books and Users management
- API documentation using Postman
- Testing using PHPUnit

## Installation

1. Clone the repository
```bash
git clone https://github.com/Jayes23/yoodle.git

2. Install dependencies
composer install

3. Copy the .env.example file and rename it to .env
cp .env.example .env

4. Generate an application key
php artisan key:generate

5. Create a database and set the database connection details in the .env file

6. Run the migrations
php artisan migrate

7. Run the seeders
php artisan db:seed

8. Run the server
php artisan serve

```
## Usage

1. Register a user by making a POST request to /api/register with the following JSON body:
```c
    {
        "name": "John Doe",
        "email": "johndoe@example.com",
        "password": "password",
        "password_confirmation": "password"
    }

```
2. Login with the registered user by making a POST request to /api/login with the following JSON body:
```c
    {
        "email": "johndoe@example.com",
        "password": "password"
    }
```

3. You will receive a JSON object containing the access token.
```c
    {
        "access_token": "your_access_token",
        "token_type": "Bearer",
        "expires_in": 31536000
    }

```
4. Include the access token in the Authorization header of the requests that require authentication.

5. To access records of a library, use the subdomain of that library in the URL.

6. The API documentation can be found in the postman folder.

7. Run the test cases using the command:
    ```c
        phpunit
    ```

