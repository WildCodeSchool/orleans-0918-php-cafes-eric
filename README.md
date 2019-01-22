Les cafés d'éric

Bonjour, voici comment installer le projet Les cafés d'éric :

Cloner Les cafés d'éric sur votre serveur : https://github.com/WildCodeSchool/orleans-0918-php-cafes-eric

Créer un fichier .env.local à partir du fichier .env et renseigner les données suivantes :

-utilisateur,
-mot de passe,
-nom de la base de donnée
sous ce format, 
 
`DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name`

Installer Composer, avec la commande :

`composer install`

Initialiser et installer yarn, avec la commande :

`sudo apt-get update && sudo apt-get install yarn`

Créer une base de données, avec la commande :

`php bin/console doctrine:database:create`

Mettre à jour la base de données, avec la commande :

`php bin/console doctrine:migration:migrate`

Exécuter Webpack, avec la commande :

`yarn encore production`

A propos / About

Les cafés d'éric est un projet PHP 7/Symfony 4.
