# API Bookstore

This is an API to manage a book and store registry.

## Versions
Php: 8.0\
Laravel: 8\
Mysql: 5.7

## About
This project uses some DDD concepts, adapted to the scope of the project, I made a point of configuring a docker-compose to facilitate execution, I think it is important to make it clear that some measures, such as using files and relational DBs to save cache and sessions, do not they are the most appropriate form for production applications, and this project is just a sample of concepts and techniques. So, as unit tests and more robust documentation are also important in larger projects, in this case, I didn't think it was necessary, I opted for agility and quality of delivery. I did this project in approximately 1h40min.

## Installation
### With Docker
```
# Run in root of project

docker compose up -d
```
### Without Docker
```
# Run in root of project

composer install

php artisan migrate

php artisan serve
```

I left the .env versioned just to make the project easier to run. If you don't use Docker, check the credentials.

## Requirements

To access this API, you need to include the following headers in each request:

- Accept: application/json
- Authorization: Bearer {token}

## Endpoints

### User

- **POST** `/api/users/register`

    Creates a new user.

    Example payload:
    ```json
    {
        "name": "Pedro",
        "email": "pedro.lucas.mrb@gmail.com",
        "password": "teste123",
        "password_confirmation": "teste123"
    }
    ```
### Auth
- **POST** `/api/auth/login`

    Authenticates a user and returns an access token.

    Example payload:
    ```json
    {
        "email": "pedro.lucas.mrb@gmail.com",
        "password": "teste123"
    }
    ```

- **POST** `/api/auth/logout`

    Invalidates the access token and logs out the user.

### Books

- **POST** `/api/books/create`

    Creates a new book.

    Example payload:
    ```json
    {
        "name": "Another Book Title",
        "isbn": "9781234523531",
        "value": 12
    }
    ```

- **GET** `/api/books/`

    Lists all books.

- **GET** `/api/books/{id}`

    Gets details of a book by ID.

- **PUT** `/api/books/update/{id}`

    Updates an existing book by ID.

    Example payload:
    ```json
    {
        "name": "Updated Book Title",
        "isbn": "9781234567890",
        "value": 59.99
    }
    ```

- **DELETE** `/api/books/delete/{id}`

    Deletes a book by ID.

### Stores

- **GET** `/api/stores/`

    Lists all stores.

- **GET** `/api/stores/{id}`

    Gets details of a store by ID.

- **POST** `/api/stores/create`

    Creates a new store.

    Example payload:
    ```json
    {
        "name": "Bookstore Name",
        "address": "123 Main St, City",
        "active": true
    }
    ```

- **PUT** `/api/stores/update/{id}`

    Updates an existing store by ID.

  Example payload:
    ```json
    {
        "name": "Bookstore Name 2",
        "address": "123 Main St, City",
        "active": false
    }
    ```

- **DELETE** `/api/stores/delete/{id}`

    Deletes a store by ID.

- **POST** `/api/stores/{storeId}/add-book/{bookId}`

    Associates a book to a store.

- **DELETE** `/api/stores/{storeId}/remove-book/{bookId}`

    Removes a book from a store.

The example payloads and headers are provided as reference for API requests. Make sure to include the correct headers in each request to ensure the API functions correctly.
