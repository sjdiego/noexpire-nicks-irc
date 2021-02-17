# IRC Nicks management
An app built with Laravel trying to follow Driven Domain Design to manage a collection of nicknames 
which just connects to configured irc server.

## How to start with Docker :whale:
- Start containers with `docker-compose up -d`
- Create new user with `docker-compose exec php php artisan auth:create-admin your@email.com`
- Go to http://localhost/login and fill the form with the password provided on previous step.
- Seed the database with some settings with `docker-compose exec php php artisan db:seed`
- Configure *server.hostname* variable to provide your favourite IRC server
- Add some nicks to collection on localhost/panel/irc/nicks
- Run `docker-compose exec php php artisan irc:connectnick`
- You should see IRC raw traffic on console and a nick connected to configured IRC network
