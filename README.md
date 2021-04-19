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
- The environment file contains variables used throughout the requests to make testing dynamic. For example, 'heroku-domain', which contains the URL for the Heroku app, and 'local-domain, which contains the URL for the local Laravel server.
- The collection file contains a set of requests for testing most of the API endpoints.

## Authentication and Authorization

Auth is done via JWT: start by registering a user through the given endpoint, then log-in this user, get the "access_token" string from the response, and use it as a bearer token to auth every request. Using the provided environment variables and collection allows automated retrieval and usage of the JWT.


## API endpoints

### Guests (no authentication required)

`POST /register`
Create a new user entry. All fields are mandatory.
Role can be either: 'user' or 'admin'.
```
{
    "email":"user@email.com",
    "password":"password",
    "password_confirmation":"password",
    "name":"User",
    "role":"user"
}
```

`POST /login`
Authenticate a user. All fields are mandatory.
```
{
    "email":"user@email.com",
    "password":"password"
}
```

`GET /movies`
Get a list of all available movies. Admins get unavailable movies also.

`GET /movies/{movie_id}`
Get information on a specific movie.


### Users (authentication required)

`GET /user-profile`
Get information on the authenticated user.

`POST /refresh`
Request a fresh new JWT for the authenticated user.

`POST /logout`
Log out the authenticated user.

`POST /buy/{movie_id}`
Request to buy a movie. Body is optional.
```
{
    "quantity": 1
}
```

`POST /rent/{movie_id}`
Request to rent a movie.

`PUT /return/{rental_id}`
Request to return a movie.


### Admins (authentication + authorization required)

`POST /movies`
Create a new movie. All fields are mandatory.
```
{
    "title": "mr. nobody",
    "description": "guy goes back and forth between his different possibilities of lives",
    "stock": 5,
    "rental_price": 9.99,
    "sale_price": 19.99,
    "available": true
}
```

`PUT /movies/{movie_id}`
Update the information of a movie. All fields are optional.
```
{
    "stock": 20,
    "available": true
}
```

`DELETE /movies/{movie_id}`
Remove a movie.

`GET /rentals`
Get a list of all rentals.

`GET /rentals/pending`
Get a list of all pending rentals.

`GET /rentals/movie/{movie_id}`
Get a list of all rentals for a specific movie.

`GET /rentals/user/{user_id}`
Get a list of all the rentals for a specific user.

`GET /sales`
Get a list of all sales.