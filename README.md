composer require laravel/breeze --dev
php artisan breeze:install blade
php artisan migrate
php artisan make:migration add_columns_to_users_table
php artisan make:model Categorie -a
php artisan make:model Depense -a
php artisan make:model Paiement -a
php artisan make:model Colocation -a
php artisan make:model Invitation -a