# SnowTricks
[![SymfonyInsight](https://insight.symfony.com/projects/0a217885-2167-411f-b1ea-6027f1c46df2/mini.svg)](https://insight.symfony.com/projects/0a217885-2167-411f-b1ea-6027f1c46df2)
[![Maintainability](https://api.codeclimate.com/v1/badges/ac7276acc03fa0bc83be/maintainability)](https://codeclimate.com/github/Eredost/SnowTricks/maintainability)

Sixth project of the OpenClassrooms PHP application developer path.

This project consists of developing a collaborative platform to make snowboarding known to the public and to help the learning of figures. 
The application must be made in PHP using the Symfony framework.

## Installation

Before you can download the project you must first have a PHP version at least ^7.2.5, a recent version of Composer and the [Symfony CLI](https://symfony.com/download).

To set up the project, follow the steps below:

1. Clone the repository
2. Move your current directory to the root of the project
3. Perform the command:

        composer install
4. Create a new file ``.env.local`` in order to configure the DSN for the database as well as the mailing server. Gmail has been used, but you are free to use another [third-party service](https://symfony.com/doc/current/mailer.html#using-built-in-transports).

        DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
        MAILER_DSN=gmail+smtp://USERNAME:PASSWORD@default
5. Then you have to set up the database, associated tables and fixtures with the following commands:

        php bin/console doctrine:database:create
        php bin/console doctrine:migrations:migrate
        php bin/console doctrine:fixtures:load
6. And finally you can launch the Symfony server with the following command:

        symfony serve

**And it's done !**

## Additional docs

-   [UML diagrams](diagrams)
