# SnowTricks
[![SymfonyInsight](https://insight.symfony.com/projects/0a217885-2167-411f-b1ea-6027f1c46df2/big.svg)](https://insight.symfony.com/projects/0a217885-2167-411f-b1ea-6027f1c46df2)

Sixth project of the OpenClassrooms PHP application developer path.

This project consists of developing a collaborative platform to make snowboarding known to the public and to help the learning of figures. 
The application must be made in PHP using the Symfony framework.

## Installation

Before you can download the project you must first have a PHP version at least 7.3X and a recent version of Composer.

To set up the project, follow the steps below :

1. Clone the repository
2. Move your current directory to the root of the project
3. Perform the command :

        composer install
4. Create a new file ``.env.local`` and add the line below by changing the user's name and password as well as the name of the database.

        DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
5. Finally, all you have to do is set up the database, associated tables and fixtures with the following commands :

        php bin/console doctrine:database:create
        php bin/console doctrine:migrations:migrate
        php bin/console doctrine:fixtures:load
6. Two choices are available to you to start the project locally. You can first go through the Apache server but you will need to download a dependency beforehand :

        composer require apache-pack

   Or you can go directly to the pre-installed symfony server and go to the localhost address it has indicated :

        php bin/console server:run

**And it's done !**

## Additional docs

-   [Kanban (Trello)](https://trello.com/b/UZ6AFII2/snowtricks)
-   [UML diagrams](diagrams)
