# Pizza Tracker Test

1. Clone the repository and navigate to the project directory.
2. Install dependencies: `composer install` and `npm install`.
3. Configure the .env file with your database settings.
4. Run migrations: `php artisan migrate`.
5. Run the seeder: `php artisan db:seed`
6. Start the server: `php artisan serve`.
7. finally in another terminal tab, run `npm run dev`

I've completed all points requested for this test (I think).
Caveats: i did not implement any login authenitcation for the front end of this applucation as the test didn't require it, and it is boiler plate stuff that can be implemeneted very easily by Laravel.  in a real world scenario, of course this would have been added in.

I've added the ability for user to mark pizzas as 
- started
- in the oven
- ready
- and delivered (although this was not a requirement of the test)

I added the ability for an order to to include many pizzas, and the status of the whole order is calculated from the statuses of the pizzas within the order.

When the user updated the status of a pizza, teh UI updates in real time so you can see the status of all pizzas and orders.

If I had more time, I would have made the UI fully responsive.  It does an OK job already, but I would have polished this up to make it completel mobile friendly.

I have also written tests.  These can be seen by running the command `php artisan test` in the terminal.
