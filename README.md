# OnlyStages

Un outil de recherche d'entreprises et de gestion de stages pour les étudiants, en PHP et MySQL. Projet d'équipe de BUT Informatique ; ce dépôt est mon fork personnel.

Recherche d'entreprises par l'API de l'annuaire des entreprises :

![Recherche d'entreprises](docs/entreprises.png)

Liste des stages, vue par un administrateur :

![Liste des stages](docs/liste-stages.png)

<details>
<summary>Formulaire d'ajout d'un stage</summary>

![Formulaire d'ajout d'un stage](docs/formulaire-stage.png)

</details>

Les données affichées sont fictives.

## Fonctionnalités

- Recherche d'entreprises françaises par nom, activité ou département, via l'API publique de l'annuaire des entreprises.
- Liste des stages, avec ajout, modification et suppression réservés aux administrateurs.
- Comptes étudiant, enseignant et administrateur.
- Import de stages depuis un fichier CSV par un administrateur.

## Lancer en local

Il faut un serveur Apache, PHP et MySQL ; le plus simple est [XAMPP](https://www.apachefriends.org/).

1. Démarrer Apache et MySQL depuis le panneau de contrôle de XAMPP.
2. Dans phpMyAdmin (`http://localhost/phpmyadmin/`), créer une base `onlystages_bd` et y importer le fichier [onlystages_bd.sql](onlystages_bd.sql).
3. Copier le dossier du projet dans `C:\xampp\htdocs\`.
4. Ouvrir `http://localhost/OnlyStages/` (adapter au nom du dossier).

Le projet se connecte avec l'utilisateur MySQL `root` sans mot de passe, comme XAMPP par défaut. Pour d'autres identifiants, copier `app/core/config.local.example.php` en `app/core/config.local.php` et les y renseigner ; ce fichier n'est pas versionné.

Comptes de test inclus, pour une démo locale uniquement :

| Rôle | E-mail | Mot de passe |
|---|---|---|
| Administrateur | `ADMIN@ADMIN` | `ADMIN` |
| Enseignant | `ENS@ENS` | `ENS` |
| Étudiant | `jean.dupont@etu.unicaen.fr` | `etudiant` |

## Équipe et ma contribution

Projet réalisé en cours de développement web par Clément Esnault, Mohamed Kahlouche, Lylian Montals, Antoine Pelletier et Milo Sorel.

J'ai travaillé sur la partie PHP avec Mohamed et je me suis occupé de toute la partie import :

- l'import CSV des stages par un administrateur : lecture du fichier, conversion des dates, insertion en une seule transaction ;
- l'import des entreprises dans la base.

Depuis le rendu, ce fork a aussi reçu des correctifs de sécurité : mots de passe hachés à l'inscription, imports réservés aux administrateurs et jetons CSRF sur les formulaires.
