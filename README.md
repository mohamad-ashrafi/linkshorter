<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Welcome to LinkShorter With Laravel 11
## Installation

please run below commands:

```bash
composer install
```
```bash
cp .env.example .env
```
<p>please config env file for support database name and redis</p>

```bash
composer php artisan key:generate
```
```bash
composer php artisan migrate:fresh --seed
```
```bash
npm install
```
```bash
npm run dev OR npm run dev
```

## Login Access
<p align="center">username:</p>
<p align="center"><strong>mohamadashrafi46@gmail.com</strong></p>
<p align="center">Password:</p>
<p align="center"><strong>123456</strong></p>

## notice
<p>To transfer data from Redis to the database, set this command as a border job on the server so that it transfers information to the database every 2 hours.</p>

```bash
php artisan app:sync-redis-clicks
```

<p>please add this in env: </p>

```bash
REDIS_PREFIX=redis_ 
``` 
