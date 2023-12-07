## Freshly Install

1. git clone git@github.com:farahnini/fgv-inventory.git
2. composer install
3. cp .env.example .env
4. php artisan key:generate
5. create database using HeidiSQL
6. update .env - (update database & update smtp)
7. php artisan migrate
8. npm install
9. npm run build (vite) npm run dev (mix)