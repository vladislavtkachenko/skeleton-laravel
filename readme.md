<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Deploy

php artisan deploy

Смотри файл config/deploy.php ! секцию hosts. Если указан stage, то 

php artisan deploy {stage}

## Install back

*copy .env

composer install

php artisan key:generate

php artisan migrate  ||  php artisan migrate:fresh --seed (run 'composer du'  - if some errors)


## Help

php artisan ide-helper:meta && php artisan ide-helper:generate && php artisan sleepingowl:ide:generate