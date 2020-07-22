<?php

//LOAD .env file
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$APP_BDD_PDW = getenv('APP_BDD_PDW');

// Error reporting
error_reporting(0);
ini_set('display_errors', '0');

// Timezone
date_default_timezone_set('Europe/Paris');

// Settings
$settings = [];

// Path settings
$settings['root'] = dirname(__DIR__);
$settings['temp'] = $settings['root'] . '/tmp';
$settings['public'] = $settings['root'] . '/public';

// Error Handling Middleware settings
$settings['error_handler_middleware'] = [

    // Should be set to false in production
    'display_error_details' => true,

    // Parameter is passed to the default ErrorHandler
    // View in rendered output by enabling the "displayErrorDetails" setting.
    // For the console and unit tests we also disable it
    'log_errors' => true,

    // Display error details in error log
    'log_error_details' => true,
];

// Database settings
$settings['db'] = [
    'driver' => 'mysql',
    'host' => 'localhost',
    'username' => 'root',
    'database' => 'pv_app_core_database',
    'password' => $APP_BDD_PDW, // A changer en fonction de l'environnement
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'flags' => [
        // Turn off persistent connections
        PDO::ATTR_PERSISTENT => false,
        // Enable exceptions
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Emulate prepared statements
        PDO::ATTR_EMULATE_PREPARES => true,
        // Set default fetch mode to array
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Set character set
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
    ],
];

$settings['jwt'] = [

    // The issuer name
    'issuer' => 'www.example.com',

    // Max lifetime in seconds
    'lifetime' => 14400,

    // The private key
    'private_key' => '-----BEGIN RSA PRIVATE KEY-----
MIIEpAIBAAKCAQEAwnuMn/7OEbaYuouvLrdgu1zcyQk6g6g+1KVJbFm76kz+uo+W
s06uT6vooiEow7w6c5qgK2e6SdBznGy05e4yiVFIdUkY0ZYpHfxqNcdNj0pPsUls
qcEvymM9PJ5vhnjw49q1KP3kwE7l7Vt0IUPXXhcD1JQZW+u0yKDY/X1ct0YiIjOY
zbfNWusqJVhSW2EKuyaPaSQJKcmMaro0VEuvkbNFwTXjce/u0oHPIzWES1hAEoM4
2qLonUWk0i2qn/dXdUiHkNajO20UOrq2NtBD7GVn6KLJEgKMAr2f0AVXPlklJIWJ
iLcyIH2LUfOnZpqiNaWK7Ve6H86HX7/MyA7P+wIDAQABAoIBAA4Hy8VfJI6ylaIf
oavFHv1lXahDOi11XdMJeZqPfrcQhu/+m+ijrH+i702DBuXYFn9wkE2RVictGqoW
TZao8IxniMqtU1ULeDvpkd//WOEVg1pO6b/1Z/U545kT9QfGgdpuVNN4PaCCEKRn
DKG5uzfWgTg81veCsbAnqn/fI2k1Td7AaALxrZEy6mtCuu9tGfdSrW2/I9SseSqo
z7A/jf6FijK3U5Oxrvk6bDAlN0vAm1cEd2ef9bG4w82Pm5dRtmDF109yMDyCl3nU
XkKkfMtqmG+wqv/RqDRiGGaHHtVrmkHaOVRGEW5IyqXOQuvO5oCD+I3sCGPsw1Du
RxE4fgECgYEA4XJAmVwoPNuVfhoHBn7BYv76/Kpfx/LRzAbEfKrXKeeWB6sQ1Ij/
bkaQ1DTniEqeeu4v9I4PsY1NYU6dxRp0N34HfUGhcqJxhX/WCEoSt98S/GaigW+X
SYGTzfKjiZu465kcLuzi57SfL+ZIYrGYzY0gq4a7yLy1lc91Bk2OSRsCgYEA3NcG
/YePiWk3lnwYN2LnDUn/Ihl71LeZ3zEsK0JnMG9yGo2dkf6++hutHQMFPjl5tgBi
FG32jgmORcU35uEOS5SyhldbU1I5SMBQ9y7dobcnwuIajqWh1lHS7Y20rjOanHGc
umtY9pXD4jXoTh/mapCPpNI3+S+0fZm8Q7Cr4qECgYEA2taM3lEWvfxooH+jUiq4
jd/0wk6fqveJrwLiuCEduw+SEt969tQFHoZhD5xLI4FLVQjghANiOHdxJYOqoimL
plIv8uZCUYRdrbjpiiJdCR8AzwDRvdMUh8XAM6nUFT+TwR5evS41E7XA0D45BZRf
Pyg/DkE7ByAnI8S9U+D0vQECgYAZTLkMSn9zKo6nuse7cKUvrI6CBZFeKTqDi0qY
Gh9gOSRFTnwCwcB3PrxyWmo7WrJK23hhBsf8NbQK4jEpThcpKXvaUB+yR/UwFHgy
GThi0mzHsseAGBGWUAFuHZHZcyf/TDS8Vpf2h+nM/IgEizsGclFCfKLU9VYkHXyn
9JF8gQKBgQCZRpOsSNAb1qAdNvGoauRzBSRzG8uQOt3sUv2Vu5IZH4Gp4kPASZjh
virKYb+8jG/g/lp29IcJ/CKqIPYn5qfdyEj0GlmW9MjMvz+8KULAIje/BKwhWJ/k
tx/im5H5clphrcjLpwzh/blrVzN4q8PfbmT/Y//QVsM89C27LpdC+g==
-----END RSA PRIVATE KEY-----',

    'public_key' => '-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwnuMn/7OEbaYuouvLrdg
u1zcyQk6g6g+1KVJbFm76kz+uo+Ws06uT6vooiEow7w6c5qgK2e6SdBznGy05e4y
iVFIdUkY0ZYpHfxqNcdNj0pPsUlsqcEvymM9PJ5vhnjw49q1KP3kwE7l7Vt0IUPX
XhcD1JQZW+u0yKDY/X1ct0YiIjOYzbfNWusqJVhSW2EKuyaPaSQJKcmMaro0VEuv
kbNFwTXjce/u0oHPIzWES1hAEoM42qLonUWk0i2qn/dXdUiHkNajO20UOrq2NtBD
7GVn6KLJEgKMAr2f0AVXPlklJIWJiLcyIH2LUfOnZpqiNaWK7Ve6H86HX7/MyA7P
+wIDAQAB
-----END PUBLIC KEY-----',

];

return $settings;
