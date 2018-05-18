**#Framework:**
<pre>
* Laravel 5.6
Ref: https://laravel.com/docs/5.6/installation
</pre>

**#Requirements:**
<pre>
* PHP >= 7.1.3
* mysql
* apache/nginx
* composer
* node
* npm
* git
</pre>

**# Installation:**
<pre>
* Clone or download this repo

skip these 3 steps if you don't want to change existing built files
* run - composer update
* run - npm update
* run - npm run dev

* give 755 permission to storage folder
* create database and configure it in .env file
* run - php artisan migrate( To create tables )
* run - php artisan db:seed( To insert sample data ) 
* run - php artisan serve ( To start server )
</pre>

**# Credentials:**
<pre>
http://127.0.0.1:8000/admin/login
username - admin@busservice.com
password - password

http://127.0.0.1:8000/
username - user1@busservice.com
password - password
</pre>
