master-laravel

pass user ketua
username : ketua
password : password

**Panduan Error**

**Error autoload setelah clone github**
1.	Masuk direktori project laravel 
`cd /e/xampp/htdocs/simasjid/sistemlaravel/simasjid`
2.	Install composer di folder laravel 
`composer install`
3.	Copy .env.example dan rename ke .env
`cp .env.example .env`
4.	Generate application key
`php artisan key:generate`

**Tidak bisa login hasil clone github, tidak ada failed response login**
1.	Buka file `AuthenticateUsers.php` di direktori
`simasjid/vendor/laravel/framework/src/Illuminate/Foundation/Auth/AuthenticateUsers.php`
2.	Ubah line 147 
`return 'email';`
jadi 
`return 'username';`

**Error DB SQLSTATE[HY000] [1045] Access denied for user**

**Import DB**
1.	Import DB, db simasjid.sql. Buka di browser localhost/phpmyadmin
2.	New Database name: simasjid
3.	Import choose file db simasjid.sql

**Setting File env**
1.	Buka file `.env` di direktori project laravel
2.	Ubah line 12-14 sesuaikan dengan database mysql
    
    ```
    DB_DATABASE=simasjid
    DB_USERNAME=root
    DB_PASSWORD=
    
**Reset Password Via Email Error**
1.	Buka file .env di direktori project laravel
2.	Ubah line 26-31 jadi seperti berikut
    ```
    MAIL_DRIVER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=465
    MAIL_USERNAME=simasjid.ibnusina@gmail.com
    MAIL_PASSWORD=emzbwvjgjstdyuqx
    MAIL_ENCRYPTION=ssl

