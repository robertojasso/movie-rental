# Movie Rental (Laravel app)

RESTful API to manage a small movie rental.

- [Go to Heroku app](https://movie-rental-roberto-jasso.herokuapp.com).


## Local installation

Follow next steps using a command-line tool:

1. Download and install the latest versions of `php`, `mysql` and `composer` in your local machine.
2. Clone [the repo](https://gitlab.com/applaudostudios/php-test/roberto-jasso) into a local directory.
3. Run `composer install` from inside the project's directory to get all of its dependencies.
4. Create a local MySQL database and get its name, host, port, username, and password.
5. Copy the `.env.example` file into a new `.env` file and put the database info into the 'DB_'-prefixed placeholders.
6. Run `php artisan key:generate` to get a new app key automatically installed to `.env` file.
7. Run `php artisan jwt:secret` to get a new JWT secret automatically installed to `.env` file.
8. Run `php artisan migrate` from inside the project's directory to set up the database for the project.
9. Run `php artisan serve` from inside the project's directory to start a server running the project.
10. Use any HTTP client (such as Postman) to make requests to the API.


## Using Postman for testing the API

Provided in the root of the project are a couple of files which can be useful for testing this API: a Postman environment JSON file and a Postman collection JSON file.
- The environment file contains variables used throughout the requests to make testing dynamic.
- The collection file contains a set of requests for testing all of the API endpoints.

## Authentication and Authorization

Auth is done via JWT: start by registering a user through the given endpoint, then log-in this user, get the "access_token" string from the response, and use it as a bearer token to auth every request.


## API endpoints

### Guests (no authentication required)

POST /login
POST /register
GET /movies
GET /movies/{movie_id}


### Users (authentication required)

POST /logout
POST /refresh
GET /user-profile
POST /rent/{movie_id}
PUT /return/{rental_id}
POST /buy/{movie_id}


### Admins (authentication + authorization required)

POST /movies
PUT /movies/{movie}
DELETE /movies/{movie}
GET /rentals
GET /rentals/pending
GET /rentals/movie/{movie}
GET /rentals/user/{user}
GET /sales