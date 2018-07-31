<?php

    //DB params
    define('DB_HOST', getenv('DB_HOST'));
    define('DB_USER', getenv('DB_USER'));
    define('DB_PASS', getenv('DB_PASS'));
    define('DB_NAME', getenv('DB_NAME'));

    //App root
    define('APPROOT', dirname(dirname(__FILE__)));

    //URL root
    define('URLROOT', getenv('URLROOT'));

    //Site name
    define('SITENAME', getenv('SITENAME'));

    //Mailer params
    define('MAIL_HOST', getenv('MAIL_HOST'));
    define('MAIL_USER', getenv('MAIL_USER'));
    define('MAIL_PASS', getenv('MAIL_PASS'));
    define('MAIL_SENDER', getenv('MAIL_SENDER'));
    define('MAIL_SENDER_NAME', getenv('MAIL_SENDER_NAME'));

    //S3 params
    define('S3_KEY', getenv('S3_KEY'));
    define('S3_SECRET', getenv('S3_SECRET'));
