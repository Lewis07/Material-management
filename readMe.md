### Requirements
- PHP version 7.3
- Composer

### Dependencies
To install dependance
Run this command
- composer install

### Create database
Run this command
- php bin/console doctrine:database:create or php bin/console d:d:c

### Migrate the migrations to database
Run this command
- php bin/console doctrine:migrations:migrate or php bin/console d:m:m

### Features
There are 5 roles

- ROLE_ADMIN
Gérer utilisateurs
Gérer fonction 
Gérer rôles

- ROLE_DEPOSITAIRE
Faire la suivi des matériels et mobiliers en service

- ROLE_ORDONNATEUR
Gérer catégorie
Gérer source
Gérer matériel
Gérer mobilier
Gérer détenteur
Désigner role dépositaire et ordonnateur

- ROLE_RESPONSABLE
Gérer détention de matériel
Gérer détention de mobilier
Gérer déclaration

- ROLE_COMPTABLE
Gérer approvisionnement de matériel
Gérer approvisionnement de mobilier
Gérer entretien
Evaluer prix de mobilier et de l'entretien

