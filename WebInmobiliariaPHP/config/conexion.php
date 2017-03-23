<?php
$config = require_once 'config.php';
$db     = $config['db'];

try {
    $pdo = new PDO(
        "mysql:host={$db['host']};
        dbname={$db['dbname']};
        charset={$db['charset']}",
        $db['user'],
        $db['password']
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() ."<br/>";
    die();
}