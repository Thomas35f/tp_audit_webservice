# **TP - Audit Webservice - MDS M2DEV**
Projet web lié au cours d'audit du M2 à MyDigitalSchool

# **Technos**
PHP 8
Composer 2
Laravel 9
node 16.17.0

## **I. Setup**

Create new database into phpMyAdmin, call it `tp_audit_webservice`. And create `.env` and fill it:

``` bash
cp .env.example .env
```

In your IDE, fill these informations:

```js
DB_DATABASE= tp_audit_webservice
DB_USERNAME=root
DB_PASSWORD=  
```

>If you use WAMP or XAMPP and you have created database called `tp_audit_webservice`, it's will be like this:
>
>```js
>DB_DATABASE=tp_audit_webservice
>DB_USERNAME=root
>DB_PASSWORD=
>```

---

```bash
# Install Laravel dependencies
composer install
# Generate key
php artisan key:generate

# Migrate and seeding -> Fake users
php artisan migrate:fresh --seed

# Link storage
php artisan storage:link
# Create cache directory
mkdir public/storage/cache
```

## **Infos**
- Package "Laravel Breeze" utilisé pour mettre en place un système d'authentification préfait.
- Comme Laravel met en place le hashage du mot de passe depuis le back, il a fallu changer le fonctionnement pour que cela se fasse côté front via CryptoJS.

En lançant : php artisan migrate:fresh --seed , la BDD est alimentée comme ceci : 
- email : test@example.com
- password : password

- email : test2@example.com
- password : password

etc...