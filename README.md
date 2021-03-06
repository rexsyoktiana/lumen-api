# LUMEN API PHP FRAMEWORK WITH SQL SERVER 2019

## Requirement
    1. PHP 7.4
    2. Laragon 4.0
    3. Microsoft SQL Server 2019
    4. Microsoft SQL Server Management Studio 18
   
## Install PHP Extension Driver for SQL Server
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

## Install Laravel
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
1. Auth
    - Register
        ![Image](https://drive.google.com/uc?export=view&id=1yQ9E1qyG0j7yKd-_HawXX53GGpRPKd0a)
    - Login
        ![image](https://drive.google.com/uc?export=view&id=1aAPOd3iOTh1fKQqek6Re12PYzBq70Irf)
    - Logout<br>
        Fill Authorization (Bearer Token) with token from login
        ![image](https://drive.google.com/uc?export=view&id=1X3sFwG3Ke7vre5oEBjkVpNXWP_q2AiCf)
2. Foods
    - Create<br>
        Fill Params<br>
        Fill Authorization (Bearer Token) with token from login<br>
        ![image](https://drive.google.com/uc?export?=view&id=1pgeQHsFS4Bd9ANTxScF515_nkSx2f3aR)
    - Get<br>
        Fill Authorization (Bearer Token) with token from login<br>
        ![image](https://drive.google.com/uc?export=view&id=1SO1FXtGii0Q9lEDa-C7qVfl-SGfkJ8hr)
    - Update<br>
        Fill Params<br>
        Fill Authorization (Bearer Token) with token from login<br>
        ![image](https://drive.google.com/uc?export=view&id=1R_jFnBV3p5hN2d_mjey_Do3eiXrsh6DM)
    - Delete<br>
        Fill Authorization (Bearer Token) with token from login<br>
        ![image](https://drive.google.com/uc?export=view&id=1Qusu806x_HRM4VBgoajNutqHTpWpKqLj)
3. Orders
    - Create<br>
        Fill Params
        Fill Authorization (Bearer Token) with token from login
        ![image](https://drive.google.com/uc?export=view&id=1KU6-BY_it1bDUzNzykcLukFJqIjZgRCV)
    - Get Active Status
        Fill Authorization (Bearer Token) with token from login
        ![image](https://drive.google.com/uc?export=view&id=1O7N-tN_i32shdvLX5cpi1zZSEhFs9-U8)
    - Payment
        Fill Params
        Fill Authorization (Bearer Token) with token from login
        ![image](https://drive.google.com/uc?export=view&id=1HI5oJFkCpad-IJSJscZOI6id-YLSmFnN)
    - Get Orders ID
        Fill Params
        Fill Authorization (Bearer Token) with token from login
        ![image](https://drive.google.com/uc?export?=view&id=19acfZqVInIXNj2Uaur7ZPb4-dYFbmPIA)
4. Order Details
   - Create<br>
        Fill Params<br>
        Fill Authorization (Bearer Token) with token from login
        ![image](https://drive.google.com/uc?export=view&id=1V65c6FcTJWcasgScvEXvHD5-9Cx64XUJ)
   - Update <br>
        Fill Params<br>
        Fill Authorization (Bearer Token) with token from login
        ![image](https://drive.google.com/uc?export=view&id=1KVfqowOUVhNXrJD-siAqx5RE5axrwYih)
   - Delete<br>
        Fill Params<br>
        Fill Authorization (Bearer Token) with token from login
        ![image](https://drive.google.com/uc?export=view&id=1rXrxJyMsOgJoonQS0KBtLaE2jrzQN3y5)

## MORE OTHER
Github: https://github.com/rexsyoktiana<br>
LinkedIn: https://linkedin.com/in/rexsyoktiana <br>
Youtube: https://www.youtube.com/channel/UCpDIYPeC6o1WuUAl_IegSnA
