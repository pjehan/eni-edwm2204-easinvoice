# Easinvoice Symfony

## Création du projet

```shell
composer create-project symfony/skeleton easinvoice
```

OU

```shell
symfony new easinvoice
```

### Webapp (version full)

Installation de l'ensemble des packages (Doctrine, Twig, Form...)

```shell
composer require webapp
```

### Doctrine

```shell
composer require symfony/orm-pack
```

Créer le fichier .env.local et ajouter la ligne `DATABASE_URL`

Créer la base de données

```shell
php bin/console doctrine:database:create
```

Créer une entité (c'est la partie qui demande de la concentration donc on éteind la TV, on coupe la musique et on ferme la porte à clé !)

```shell
php bin/console make:entity
```

Générer les migrations

```shell
php bin/console make:migration
```

Exécuter les migrations

```shell
php bin/console doctrine:migration:migrate
```

En cas de problème dans l'exécution des migrations (problème de synchronisation entre les fichiers PHP et la base de données) :

Supprimer les fichiers PHP de migration puis :

```shell
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console make:migration # Cette commande va générer 1 seul fichier de migration contenant l'ensemble des requêtes SQL pour créer la base de données
php bin/console doctrine:migration:migrate
```

### Doctrine fixtures

```shell
composer require --dev orm-fixtures
```

Générer un fichier de fixtures

```shell
php bin/console make:fixture
```

Exécuter les fixtures

```shell
php bin/console doctrine:fixtures:load
```

### Installation de WebPack Encore

```shell
composer require symfony/webpack-encore-bundle
npm install
```

#### Activation de SASS

Décommenter la ligne suivante dans le fichier webpack.config.js :

```shell
.enableSassLoader()
```

Installer les dépendances NPM :

```shell
npm install sass-loader@^12.0.0 sass --save-dev
```

Renommer le fichier `assets/styles/app.css` en `assets/styles/app.scss`
et modifier la ligne appelant le fichier CSS dans le `assets/app.js`.

### Installation de Twig

```shell
composer require twig
```

### Création d'un controller pour la page d'accueil

Exécuter la commande suivante avant de créer le fichier Twig (la commande va le créer pour vous).

```shell
php bin/console make:controller
```

Saisir le nom du controller `DefaultController` puis modifier le fichier.

Pour utiliser Doctrine dans une méthode du Controller on va utiliser l'injection de dépendance :

```php
public function index(ManagerRegistry $doctrine): Response
```

### Utiliser le package symfony/asset pour gérer les URLs vers les assets

```shell
composer require symfony/asset
```

Exemple pour charger une image :

```html
<img src="{{ asset('uploads/doctor-1.jpg') }}" alt="Jack Smith">
```

### Installation du Profiler

```shell
composer require --dev symfony/profiler-pack
```

### Gestion de l'authentification

#### Création du formulaire de login

```shell
php bin/console make:controller Login
```

```php
// src/Controller/LoginController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('login/index.html.twig', [
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'last_username' => $authenticationUtils->getLastUsername()
        ]);
    }
}
```

```html
{% extends 'base.html.twig' %}

{% block title %}Connexion{% endblock %}

{% block body %}
    <div class="container">
        {% if error %}
            <div>{{ error.messageKey|trans(error.messageData, 'security') }}</div>
        {% endif %}

        <form action="{{ path('login') }}" method="post">
            <label for="username">Email:</label>
            <input type="email" id="username" name="_username" value="{{ last_username }}"/>

            <label for="password">Password:</label>
            <input type="password" id="password" name="_password"/>

            {# If you want to control the URL the user is redirected to on success
            <input type="hidden" name="_target_path" value="/account"/> #}


            <input type="hidden" name="_csrf_token" value="{{ csrf_token('authenticate') }}">

            <button type="submit">login</button>
        </form>
    </div>
{% endblock %}

```

```yaml
# config/packages/security.yaml
security:
    # ...

    firewalls:
        main:
            # ...
            form_login:
                # "login" is the name of the route created previously
                login_path: login
                check_path: login
                enable_csrf: true
```

#### Création de la route logout

```yaml
# config/packages/security.yaml
security:
    # ...

    firewalls:
        main:
            # ...
            logout:
                path: app_logout
```

## Démarrage du projet

### Mettre en place l'environnement (une seule fois, après avoir récupéré le projet)

Créer le fichier .env.local

```shell
composer install
npm install
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:migration:migrate
php bin/console doctrine:fixtures:load
```

### Démarrer le serveur PHP

```shell
php -S localhost:8000 -t public
```

OU

```shell
symfony serve
```

### Démarrer la compilation des assets

```shell
npm run watch
```