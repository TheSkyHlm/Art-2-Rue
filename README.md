# Art-2-Rue

Application de gestion de l'archive du Street Art (projet BTS SIO), réalisée avec Symfony.
La base de données reprend le modèle **ArtDeRue** (artistes, lieux, œuvres, techniques, bénévoles, photos).

## Avancement

- [x] Entités (Artiste, Lieu, Œuvre, Technique, Bénévole, Photo)
- [x] Gestion des **artistes** (liste, ajouter, modifier, supprimer)
- [x] Gestion des **lieux** (liste, ajouter, modifier, supprimer)
- [ ] Authentification des bénévoles (**en cours** : page de connexion présente, pas encore fonctionnelle)
- [ ] Gestion des œuvres, techniques, photos
- [ ] Protection : consultation libre, gestion réservée aux bénévoles connectés

## Installation

```bash
composer install
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
symfony server:start
```

## Base de données

La connexion est configurée dans `.env` (MariaDB, base `art2rue`).
