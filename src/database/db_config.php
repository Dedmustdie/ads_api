<?php
try {
    $host = MYSQL_HOST;
    $dbname = MYSQL_DATABASE;
    $username = MYSQL_USER;
    $pass = MYSQL_PASSWORD;
    $charset = MYSQL_CHARSET;

    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    $pdo = new PDO($dsn, $username, $pass, $opt);
} catch (Exception $exception) {
    NetUtil::sendError(INTERNAL_SERVER_ERROR_CODE, 'Internal server error');
}