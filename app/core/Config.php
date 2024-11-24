<?php

if ($_SERVER['SERVER_NAME'] == 'localhost')
{
    define ('ROOT', 'http://localhost/MVC/Public');
    define ('BASE_URL', 'http://localhost/');

    /*Database Config*/
    define ('DBHOST', 'localhost');
    define ('DBUSER', 'root');
    define ('DBPASS', '');
    define ('DBNAME', 'eventease');


}else
{
    // define ('ROOT', 'https://www.yourwebsite.com');
    define ('ROOT', 'http://eventease/public');
    define ('BASE_URL', 'http://eventease/');
}