Stack de développement PHP
==========================

Prérequis
---------

Sur votre machine Mac, Windows ou Linux :

- Docker 29.7 au moins, ou un moyen de faire tourner des containers et une stack docker compose
  (Installer Docker Desktop 4.87 satisfait ce pré-requis - vous chercherez plus tard comment faire autrement)
- Un éditeur de texte ou un IDE
- L'accès à un terminal

De manière optionnelle, mais fortement recommandée :

- Une [clé SSH](https://forge.iut-larochelle.fr/help/ssh/index#generate-an-ssh-key-pair) active sur votre machine
  (si c'est une machine perso) et [ajoutée dans votre compte gitlab](https://forge.iut-larochelle.fr/help/ssh/index#add-an-ssh-key-to-your-gitlab-account) :  
  elle vous permettra de ne pas taper votre mot de passe en permanence.
- PHPStorm  
  _Votre email étudiant vous permet de bénéficier d'une licence complète de 12 mois pour tous les produits JetBrains_ : https://www.jetbrains.com/shop/eform/students  
  ... Mais vous pouvez bien sûr utiliser l'IDE de votre choix (... tant que c'est PHPStorm ;-) 

Démarrage rapide
----------------

On récupère une archive zip du contenu de la branche main, à l'adresse  
https://forge.iut-larochelle.fr/qual3/stack-php/-/archive/main/stack-php-main.zip  
et on se positionne dans le dossier en question.

Dans un terminal :  
`docker compose up --build -d`

Une fois les containers démarrés, vous pouvez vérifier que php fonctionne :  
`docker exec -it iut-php php -v`

Pour exécuter un script php contenu dans un fichier (par exemple index.php) :  
`docker exec -it iut-php php index.php`

Un shell interactif php est disponible en faisant :  
`docker exec -it iut-php php -a`  
(plus d'infos ici : https://www.php.net/manual/fr/features.commandline.interactive.php)

Attention, **si vous êtes sous Linux**, regardez dans le fichier .env.dist

**Si vous installez une 2e fois la stack sur une machine**, vous allez avoir des conflits de noms de containers :
la variable CONTAINER_PREFIX dans .env.dist, à enregistrer en .env est là pour ça.

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

