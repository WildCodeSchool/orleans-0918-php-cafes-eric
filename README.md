Les cafés d'éric

Bonjour, voici comment installer le projet Les cafés d'éric :

Cloner Wastity sur votre serveur : https://github.com/WildCodeSchool/orleans-0918-php-cafes-eric

Installer Composer, avec la commande :

`composer install`

Installer yarn, avec la commande :

`yarn install`

Créer une base de données, avec la commande :

`php bin/console doctrine:database:create`

Mettre à jour la base de données, avec la commande :

`php bin/console doctrine:migration:migrate`

Exécuter Webpack, avec la commande :

`yarn encore production`

A propos / About

Les cafés d'éric est un projet PHP 7/Symfony 4.
