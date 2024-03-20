## Feedback Management System
This project is a web application designed to facilitate the submission, listing, and commenting on feedback items. It includes user authentication, a user-friendly feedback submission form, feedback listing with pagination, and a commenting system with basic formatting options. Additionally, users can mention each other in comments using the "@" symbol. The project ensures a responsive design for seamless usability across both desktop and mobile devices.

## Features

1 - User Authentication
- Implement user authentication using Sanctum or Passport.
- Users can register, log in, and log out.

## Feedback Submission
- User-friendly form for submitting feedback.
- Feedback includes a title, description, and category (e.g., bug report, feature request, improvement).
- Validation to ensure required fields are filled out.

## Feedback Listing
- Display feedback items in a paginated list.
- Each feedback item displays its title, category, and the user who submitted it.

## Commenting System
- Users can leave comments on feedback items.
- Comments include the user's name, date, and content.
- Basic formatting options for comments (e.g., bold, italic, code blocks).
- Users can mention other users in comments using the "@" symbol.

## About Laravel
Laravel Version: 11

## Installation and Usage
To run this project locally, follow these steps:

Clone the repository to your local machine.
- Run composer install or composer update to install or update PHP dependencies.
- Run php artisan migrate to migrate the database.
- Run npm install to install Vue.js dependencies.
- Run php artisan serve to start the PHP development server.
- Run npm run dev to compile front-end assets.

Now, you can access the application in your web browser by visiting http://localhost:8000.

Technologies Used
Laravel (PHP framework)
Vue.js or React.js (for front-end)
MySQL (or any other preferred database)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
