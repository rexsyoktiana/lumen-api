# LUMEN API PHP FRAMEWORK WITH SQL SERVER 2019

## Requirement
    1. PHP 7.4
    2. Laragon 4.0
    3. Microsoft SQL Server 2019
    4. Microsoft SQL Server Management Studio 18
   
## Installasi Driver PHP Extension for SQL Server
    Install Driver PHP Extension pada folder php 7.4 di laragon
    1. sqlsrv : https://pecl.php.net/package/sqlsrv/5.9.0/windows
    2. pdo_sqlsrv : https://pecl.php.net/package/pdo_sqlsrv/5.9.0/windows

## Database Preparation
1.  Open Microsoft SQL Server Management Studio 18
2.  Connect to SQL Server <br>
![Image](https://drive.google.com/uc?export=view&id=1vCqy3qBQoVmD7x1jm1jQxsrRFjCh2Ibu)
3.  Click Connect Button
4.  Create a New Database with the name "lumen_api" <br>
![Image](https://drive.google.com/uc?export=view&id=1RyifEM3K2HafIWJAb7GQJ8QXVUB3HGMJ)
5.  Done

## Installasi Laravel
    1.  git clone https://github.com/rexsyoktiana/lumen-api.git
    2.  cd lumen-api
    3.  composer install
    4.  cp .env.example .env
    5.  open .env file and change the connection database to
        DB_CONNECTION=sqlsrv
        DB_HOST=LAPTOP-QP4RE45B
        DB_PORT=null
        DB_DATABASE=lumen_api
        DB_USERNAME=null
        DB_PASSWORD=null
    6.  php artisan key:generate
    7.  php artisan jwt:secret
    8.  php artisan migrate
    9.  php -S localhost:8000 -t public
    10. Done

## TEST API WITH POSTMAN
![Image](https://drive.google.com/uc?export=view&id=1X1fQfPG_1emKan0RyiKmFqmKkg-zm-wz)<br>
1. Auth
    - Register
    - Login
    - Logout
2. Foods
3. Orders
4. Order Details

## MORE OTHER
    Github: https://github.com/rexsyoktiana<br>
    LinkedIn: https://linkedin.com/in/rexsyoktiana <br>
    Youtube: https://www.youtube.com/channel/UCpDIYPeC6o1WuUAl_IegSnA
