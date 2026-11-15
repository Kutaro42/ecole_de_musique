Stack de développement PHP
==========================

# École de musique – Stack Symfony / Docker

Site web d'une **école de musique fictive**, développé en **équipe de 5 personnes** dans le cadre du BUT Informatique (IUT de La Rochelle), en suivant des **méthodes de conception et de développement agiles**.

Le projet repose sur une stack **Symfony** conteneurisée avec **Docker**, pour que chaque membre de l'équipe travaille dans le même environnement.

## Technologies

- **Symfony** (PHP) – application web
- **Docker / Docker Compose** – environnement de développement reproductible
- **MariaDB** – base de données
- **phpMyAdmin** – administration de la base en développement
- **Git / GitLab** – travail collaboratif

## Ma contribution

- **Conception de l'architecture de la base de données** (modélisation des données de l'école).
- **Implémentation du formulaire d'inscription** des nouveaux élèves.
- **Définition d'une grande partie des règles de nommage des commits**, pour garder un historique lisible en équipe.

## Lancer le projet

Prérequis : Docker et Docker Compose installés.

```bash
git clone https://github.com/Kutaro42/ecole_de_musique.git
cd ecole_de_musique
docker compose up -d --build
```

Les dépendances PHP sont installées au démarrage du conteneur `php` (`composer install`).

| Service | Adresse |
|---|---|
| Site web | http://localhost:8888 |
| phpMyAdmin | http://localhost:8886 |
| Base de données (MariaDB) | `localhost:3307` |

> Pour arrêter les conteneurs : `docker compose down`

## Configuration et sécurité

Les identifiants présents dans `.env` et `docker-compose.yml` sont des **valeurs de développement** destinées à l'environnement Docker local. Ils ne protègent aucune donnée réelle.

Pour un déploiement en dehors d'une machine personnelle, il faudrait notamment :
- définir de vrais secrets (`APP_SECRET`, mots de passe de la base) via des variables d'environnement ;
- ne plus publier les ports de la base et de phpMyAdmin sur toutes les interfaces (par exemple `127.0.0.1:3307:3306`).

## Contexte

Projet universitaire réalisé en équipe. Les données et le sujet sont fictifs.

Installation des dépendance php et lancement de la BD
----------------
Ouvrir un shell interactif
`docker exec -it iut-php bash`

Se déplacer dans le répertoire projet 
`cd /var/www/html/projet`

Installer les dépendances
`composer install`

Mettre à jour les dépendances du Bundle de symfony
`composer update symfony/console --with-dependencies`

Installer le bundle Doctrine dev
`composer require --dev doctrine/doctrine-fixtures-bundle --prefer-source`

Initialiser la base de données
`php bin/console doctrine:migrations:migrate`

-----------------------------

**Pour utiliser la base de données depuis le container php :**  
_Adresse du serveur_ : `db` (c'est le nom du service dans le fichier `docker-compose.yml`)  
_Port_ : 3306 (le port MySQL par défaut)

**Pour utiliser la bdd avec un client MySQL _hors docker_** (par exemple celui de PHPStorm) :  
_Adresse du serveur_ : `localhost`  
_Port_ : 3307 (plutôt que 3306 pour éviter un conflit si MySQL tourne déjà sur la machine hôte)  

Mot de passe root : `iut`.  
Par ailleurs, un utilisateur "standard" nommé `iut` a les droits d'accès sur une base de données nommée `iut`
avec le mot de passe `iut`.

Un second schéma de base de données nommé `iut_ ` est automatiquement créé au premier démarrage du container de base de données, avec les mêmes droits pour l'utilisateur `iut`.

Démarrer un projet Symfony
--------------------------

Le serveur web est en plus configuré pour qu'un projet symfony soit hébergé dans le répertoire `/projet`  
La ligne de commande Symfony (plus d'infos : https://symfony.com/download) est incluse dans le container `iut-php`

Pour initialiser le projet, le générateur décrit ci-dessous nécessaire que l'on configure git, exécutez les deux commandes suivantes, n'oubliez pas de les personnaliser : 


Initialiser le projet revient ensuite à faire (dans le container) :  
```
composer create-project symfony/skeleton:"8.1.x" projet
cd projet
composer require webapp
```

Apres cela il faut faire passer les différentes migrations

```
docker exec -it iut-php bash
cd projet
php bin/console d:m:m -n
```

**Attention :** On utilise `webapp` pour avoir une appli web complète, l'argument `projet` de l'appel est le nom du répertoire dans lequel on veut créer notre projet. 
Il _DOIT_ s'appeler `projet`, et vous _DEVEZ_ lancer la commande dans le répertoire racine du dépôt.

A un moment, l'install va vous demander si vous souhaitez modifier la stack docker : vous ne le souhaitez PAS.

Nettoyage post-installation 
---------------------------

Étant donné que nous allons nous occuper par ailleurs de la problématique de versioning, supprimez le dossier `projet/.git`. 
Supprimez également les fichiers `projet/docker-compose.yml` et `projet/docker-compose.override.yml` qui ne nous seront pas utile. 


Composition de la stack
-----------------------

La stack comporte 3 containers :
- PHP (8.5.10)
- Apache (2.4.62) : http://localhost:8888 (pour votre future install de Symfony) et http://localhost:8887 (pour faire des tests avec PHP)
- MariaDB (12.3)
- PHPMyAdmin (5.2.2) : http://localhost:8886 (utilisateur : `iut`, mot de passe : `iut`, deux bases disponibles : `iut_symfony`)

Règles de nommage du dépôt
--------------------------
Préfixer le message de commit par l'un des identificateur suivant
- << CONFLICT >> : Les fichiers poussé sous ce commit ne sont pas fonctionnels (feature en cours non achevé mais nécéssitant d'être poussé en cas de force majeur).
- << FEATURE >>  : Ajout d'une fonctionnalité qui tourne sans erreur (ne provoque aucun conflit).
- << MODIFY >>   : Modification d'une méthode ou d'un fonctionnement spécifique.
- << MERGE >>    : Merge d'une branche avec une autre.
- << FIX >>      : Résolution d'un défaut/d'un bug ou d'un dysfonctionnement spécifique.
- << MAINTAIN >> : Nettoyage du code, reprise des syntaxe & normes de nommage/typage, ou application d'un correctif d'optimisation sur une feature déjà fonctionnelle mais fragile.
- << COMMENTS >> : Documentation et ajout de commentaires de précision sur le code source.

Commentaire explicité clairement EN FRANÇAIS, avec titrage de chaque grande modifications venant avec le commit.
**Exemple : `<<MAINTAIN>> : Reprise de la feature X avec une méthode Y pour une robustesse de saisie supplémentaire`**

Comportement de push.

- Sur branche personnelle : aucune vérification tierce, vous êtes responsable de ce que vous y faite
- Sur branche commune (dev): merge request uniquement lorsque votre branche est FONCTIONNELLE (=tourne et ne freine pas le développement des autres), peut être refusé par l'équipe en cas contraire.
- Sur branche principale (main) : Merge request uniquement depuis la branche commune (dev), nécéssite impérativement l'accord oral ou écrit de tout les membres de l'équipe avant le push. 
**Note : (L'Équipe se réserve le droit de vous refuser l'accès au dépot dans le cas ou vous ne respecter pas ces règles.)**
=======

Pour effectuer les test il faut creer une base de test :`php bin/console doctrine:database:create --env=test`

Effectuer les migrations : `php bin/console doctrine:migrations:migrate --env=test`

Effectuer les fixtures : `php bin/console doctrine:fixtures:load --env=test --no-interaction`

