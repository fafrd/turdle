#[turdle.net](http://turdle.net)#

Turdle is a fun little webapp I made with Shon Shabari (sshabari@ucmerced.edu) as our project for CSE 111 Databse Systems. Currently hosted at [turdle.net](http://turdle.net).

##how it works##

Making a simple webapp like this is really easy. I set up an Ubuntu server and installed and configured nginx, mysql, php5-fpm, and phpmyadmin. I logged into phpmyadmin and created the database with the tables, and set my password to reflect the one contained in my php files.

In the php files, connecting to the database 'turdle' as user 'root' with password 'password' is a simple

`$link = mysqli_connect('localhost', 'root', 'password', 'turdle');`

(alternatively, you can pass these arguments as environment variables:)

`$link = mysqli_connect($_ENV['db_host'], $_ENV['db_user'], $_ENV['db_password'], $_ENV['db_name']);`

Performing a query is done as 

`$result = mysqli_fetch_array(mysqli_query($link, "SELECT MAX(d_dumpid) FROM dump WHERE d_userid='$userid'"));`

##bugs##
- Persistent login does not work. didn't get around to using cookies
- Exploitable because new dump insertion checks if `$_SESSION['userid']` is set, but does not use `$_SESSION['hashedpassword']` to verify user
