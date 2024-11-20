#ZooArcadia

**ZooArcadia** est une application web conçue pour gérer efficacement
toutes les activités du zoo Arcadia. Elle centralise la gestion des habitats,
des animaux, des services et des avis des visiteurs,
offrant ainsi une solution intégrée et polyvalente.

## Fonctionnalités

**Gestion des habitats** : Ajouter, supprimer et mettre à jour les informations
relatives aux différents habitats du zoo.

**Gestion des animaux** : Ajouter, supprimer et mettre à jour les données des animaux,
incluant leur état de santé, leur régime alimentaire et leur habitat.

**Gestion des services** : Configurer et administrer les divers services proposés par le zoo.

**Gestion des avis** : Permettre aux visiteurs de soumettre des avis sur leur expérience,
avec une modération assurée par le personnel du zoo.

**Statistiques de consultation** : Suivre les interactions des visiteurs
avec les animaux grâce à un système de "J'aime", enregistré dans MongoDB.

## Technologies utilisées

### Frontend

-**HTML : Langage de balisage pour la structure de la page web. -**CSS : Langage de style pour la mise en forme des éléments HTML. -**JavaScript : Langage de programmation pour les interactions dynamiques avec l'utilisateur. -**Bootstrap : Framework CSS pour la conception de l'interface utilisateur.

-**Backend -**PHP\*\* : Langage côté serveur pour la logique applicative et les interactions avec la base de données.

-**MySQL** : Système de gestion de base de données relationnelle
pour stocker les données des animaux, avis, contacts, services et utilisateurs.

-**MongoDB**: Base de données non relationnelle utilisée
pour enregistrer les statistiques de consultation des animaux.

ArcadiaZoo/
│
├── actions/ # Scripts PHP pour les actions (ajout, suppression, modification)
├── config/ # Configuration du projet (base de données, paramètres)
├── node_modules/ # Dépendances Node.js pour la gestion des statistiques
├── public/ # Fichiers publics accessibles (Pages PHP, CSS, JS, images)
├── includes/ # Fichiers communs (header, footer)
├── mongodb_connexion.php # Script de connexion à MongoDB
├── package.json # Dépendances Node.js
├── package-lock.json # Fichier de verrouillage des dépendances Node.js
├── Alwaysdata # Dossier contenant les fichiers de configuration pour le déploiement sur Alwaysdata
├── README.md # Ce fichier
├── server.js # Serveur Node.js pour la gestion des statistiques
└── structure.txt # Structure de la base de données
Mise en place de l'environnement de travail :

Installation de XAMPP pour la gestion d'Apache et PHP localement, simplifiant ainsi les tests et le débogage avant le déploiement.
Configuration Mysql Apache
XAMPP a été utilisé pour sa simplicité d'installation et sa capacité à fournir un environnement de développement complet

## Backend

## MySQL

La base de données relationnelle MySQL est utilisée pour stocker et gérer les données structurées :

Table admin : Contient les informations des utilisateurs (administrateurs, employés, vétérinaires).

Table animal : Contient les informations sur les animaux.

Table contact : Stocke les informations de contact.

Table employee : Stocke les informations des employés.

Table food : Stocke les informations sur la nourriture disponible.

Table soins: Stocke les informations sur la santé des animaux.

Table avis: Stocke les avis des visiteurs.

Table services : Stocke les informations sur les services proposés par le zoo.

Table veterinaire : Contient les informations veterinaire sur la santé des animaux.

## MongoDB

Installation et configuration de MongoDB pour gérer efficacement les données sous forme de documents JSON, répondant aux besoins de flexibilité et de scalabilité du projet.
La base de données non relationnelle MongoDB est utilisée pour les statistiques de consultation des animaux :

Collection animalviews : Enregistre les comptages de "J'aime" pour chaque animal.
Les données sont mises à jour en temps réel lorsque les visiteurs interagissent avec les boutons "J'aime".

## Installation et utilisation du projet - Cloner le dépôt GitHub : git clone
