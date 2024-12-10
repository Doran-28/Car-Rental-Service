<?php
    $dsn = 'mysql:host=192.168.0.221;port=3306;dbname=DatabaseProject';
    $username = 'web_server';
    $password = 'web_server_password';

    try {
        // Enable exception handling and disable emulated prepares for stored procedures
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('/var/www/html/errors/database_connection_error.php');
        exit();
    }

    function display_db_error($error_message) {
        include('/var/www/html/errors/database_error.php');
        exit();
    }
?>