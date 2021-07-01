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
2.  Connect to SQL Server \&nbsp;
![Image](https://drive.google.com/uc?export=view&id=1vCqy3qBQoVmD7x1jm1jQxsrRFjCh2Ibu)
3.  Click Connect Button
4.  Create a New Database with the name "lumen_api" \&nbsp;
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


Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

## Contributing

Thank you for considering contributing to Lumen! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
