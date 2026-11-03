# Touche pas au klaxon

## Présentation du projet

**Touche pas au klaxon** est une application intranet de covoiturage inter-sites destinée aux employés d'une entreprise.

Elle permet de consulter les trajets disponibles, de proposer un trajet et de gérer les déplacements entre les différentes agences.

## Technologies utilisées

- PHP 8.2+
- MySQL / MariaDB
- PDO
- Bootstrap 5
- Sass
- PHPUnit
- PHPStan
- Architecture MVC avec routeur PHP interne

## Installation

### Prérequis

- XAMPP (Apache, MySQL et PHP)
- Composer
- Node.js et npm

### Étapes d'installation

1. Créer une base de données nommée `touche_pas_au_klaxon`.
2. Importer `database/schema.sql` dans phpMyAdmin.
3. Importer `database/seed.sql` pour ajouter les données de démonstration.
4. Copier `.env.example` en `.env`.
5. Vérifier les paramètres de connexion à la base de données.
6. Installer les dépendances PHP :

```bash
composer install
```

7. Installer les dépendances front-end :

```bash
npm install
```

8. Compiler les fichiers Sass :

```bash
npm run build
```

9. Lancer le serveur local :

```bash
php -S localhost:8000 -t public
```

10. Ouvrir l'application à l'adresse : http://localhost:8000

## Comptes de test

**Utilisateur**

- Email : `alexandre.martin@email.fr`
- Mot de passe : `Password123!`

**Administrateur**

- Email : `admin@cenef.local`
- Mot de passe : `Admin123!`

Les autres employés du jeu de données utilisent également le mot de passe `Password123!`.

## Fonctionnalités

### Visiteur
- Consulter les trajets futurs disposant de places disponibles.
- Se connecter à l'application.

### Utilisateur connecté
- Consulter les détails des trajets.
- Créer un trajet.
- Modifier ses propres trajets.
- Supprimer ses propres trajets.

### Administrateur
- Consulter les utilisateurs.
- Consulter les trajets.
- Supprimer des trajets.
- Ajouter, modifier et supprimer des agences.

## Architecture

Le projet suit le modèle MVC :

- `app/Models` : accès aux données.
- `app/Controllers` : logique applicative.
- `app/Views` : affichage des pages.
- `app/Core` : routeur, authentification, sessions, messages flash et connexion PDO.
- `public` : point d'entrée de l'application et ressources publiques.

## Tests et qualité du code

Les commandes prévues pour les contrôles sont :

```bash
composer test
composer stan
```

Les accès à la base de données utilisent PDO et des requêtes préparées.

## Livrables

- Code source de l'application.
- `database/schema.sql` : structure de la base de données.
- `database/seed.sql` : données de démonstration.
- `docs/` : documents de conception comprenant le MCD et le MLD.
- Présent README : instructions d'installation et d'utilisation.

## Dépôt GitHub

Après création du dépôt GitHub :

```bash
git init
git add .
git commit -m "Initialisation du projet Touche pas au klaxon"
git branch -M main
git remote add origin URL_DU_DEPOT_GITHUB
git push -u origin main
```