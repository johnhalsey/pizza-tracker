# Pizza Tracker

To run this application locally, follow these steps;

1. Clone the repository and navigate to the project directory.
2. Install dependencies: `composer install` and `npm install`.
3. Configure the .env file with your database settings.
4. Run migrations: `php artisan migrate`.
5. Run the seeder: `php artisan db:seed`
6. Start the server: `php artisan serve`.
7. finally in another terminal tab, run `npm run dev`

I've added the ability for users to be able mark pizzas as 
- Started
- In the oven
- Ready
- Delivered

I also added the ability for an order to to include many pizzas, and the status of the whole order is calculated from the statuses of the pizzas within the order.

When the user updates the status of a pizza, the UI updates in real time so you can see the status of all pizzas and orders.

Feature and unit tests for this can be run in the termianl `php artisan test`.
