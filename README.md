# User Address API

## Table Structure

The following tables are used in this application:

### Users Table

| Column Name | Data Type | Description |
|-------------|-----------|-------------|
| id          | int       | Unique user ID |
| name        | string    | User name     |
| email       | string    | User email    |
| name        | string    | User name     |
| email       | string    | User email    |
| email_verified_at | timestamp | Timestamp when the email was verified |
| password    | string    | User password |
| remember_token | string | Token for "remember me" functionality |
| created_at  | timestamp | Timestamp when the user was created |
| updated_at  | timestamp | Timestamp when the user was last updated |


### Addresses Table

| Column Name | Data Type | Description |
|-------------|-----------|-------------|
| id          | int       | Unique address ID |
| user_id     | int       | Foreign key referencing the Users table |
| address     | string    | User address    |
| Column Name | Data Type | Description |
|-------------|-----------|-------------|
| label       | string    | Address label |
| recipient_name | string    | Recipient name |
| phone_number | string    | Phone number    |
| address_line | string    | Address line    |
| postal_code | string    | Postal code     |
| city         | string    | City            |
| province     | string    | Province        |
| country      | string    | Country         |
| is_default   | boolean   | Is default address |
| created_at  | timestamp | Timestamp when the address was created |
| updated_at  | timestamp | Timestamp when the address was last updated |



## Endpoints

The following endpoints are available in this application:

### User Endpoints

* `GET /users` - Retrieve all users
* `POST /users` - Create a new user
* `GET /users/{id}` - Retrieve a user by ID
* `PUT /users/{id}` - Update a user
* `DELETE /users/{id}` - Delete a user


### Address Endpoints


* `GET /users/{userId}/addresses` - Retrieve all addresses of a user
* `GET /users/{userId}/addresses/{addressId}` - Retrieve an address of a user by ID
* `POST /users/{userId}/addresses` - Create a new address for a user

### RUN TEST 
* `php artisan test`


## Setup Docker

To set up the application using Docker, follow these steps:

1. Navigate to the project directory: `cd user-address-api`
2. Build the Docker image: `docker-compose build`
3. Start the Docker containers: `docker-compose up -d`
4. Open container : `docker-compose exec -it <containerid> bash`
4. Run migration in container: `php artisan migrate`
5. Access the application: `http://localhost:8083`

### OPEN API DOCS SWAGER
* open file `openapi.json` in root directory