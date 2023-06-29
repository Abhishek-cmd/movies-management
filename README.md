<!-- First check composer install or update -->
# composer install OR composer update

<!-- install laravel 8 version for this project -->

# composer create-project laravel/laravel:^8.0 your-project-name

<!-- install the passport package via composer manager for php 7 support-->

# composer require laravel/passport  --with-all-dependencies

<!-- After installation of the package, We are required to get default migration to create new passport tables in our database -->

# php artisan migrate

<!-- We will install the passport using the passport:install command. which will create token keys for security. -->

# php artisan passport:install

<!-- Now We have to configure the model, service provider, and auth config file. -->

<!-- After Add Table and Model for Movies -->

# php artisan make:migration create_movies_table

<!-- Create controller files command -->

# php artisan make:controller API/RegisterController
# php artisan make:controller API/MovieController

<!-- Create models files command -->

# php artisan make:model Movie
# php artisan make:model User

<!-- Fake database added need to seeder command -->
# php artisan make:seeder MovieSeeder
# php artisan db:seed --class=MovieSeeder

<!-- Alternatively, you can use the db:seed command without specifying a specific seeder class to run all seeders in the database/seeders directory. -->

# php artisan db:seed

<!-- After needed package required basis -->

<!-- Then run command in Laravel is used to start a development server that allows you to run your Laravel application locally.  -->

# php artisan serve


<!-- Checking postman endpoints APIs details below -->

# Register API
<!-- POST - http://127.0.0.1:8000/api/register -->

# Login API
<!-- GET - http://127.0.0.1:8000/api/login --> 
<!-- Output Response -: token value -->

<!-- This token value used in below API as a headers with Bearer authorization -->

# Retrieve a list of all movies.
<!-- GET  http://127.0.0.1:8000/api/movies  -->

# Retrieve movie data with pagination or filter based on genre or director
<!-- GET http://127.0.0.1:8000/api/movies?per_page=5&page=2&genre=action&director=Rakesh -->

# Retrive individual movie data
<!-- GET http://127.0.0.1:8000/api/movies/4 -->

# Create a new movie.
<!-- POST http://127.0.0.1:8000/api/movies -->

# Update an existing movie.
<!-- PUT/PATCH http://127.0.0.1:8000/api/movies/7 -->

# Delete a movie.
<!-- DELETE http://127.0.0.1:8000/api/movies/3 -->