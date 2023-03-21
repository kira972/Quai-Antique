# Quai-Antique


Installation de scoop avec la commande : Set-ExecutionPolicy RemoteSigned -Scope CurrentUser puis irm get.scoop.sh | iex

Installation de symfony cli  commande :  scoop install symfony-cli

Installation d'une application Symfony 6 commande :  symfony new my_project_directory --version="6.2.*" --webapp

cloner le projet avec git commande git clone
Lancer le serveur symfony commande : symfony server:start

créer une base de donnée commande :composer require symfony/orm-pack puis composer require --dev symfony/maker-bundle et php bin/console doctrine:database:create par la suite créer un fichier .env.local et y mettre les données concernant votre base de donnée url, nom, version du serveur et mettre tous ce qui est dans votre fichier .env en commentaire.

Création des fixtures avec la commande : composer require --dev orm-fixtures une fois la page fixture renseigné faites php bin/console doctrine:fixtures:load

Pour finir installer  composer require doctrine/doctrine-migrations-bundle pour faire la migration des données vers la base de donnée commande : php bin/console make:migration et  php bin/console doctrine:migrations:migrate.
