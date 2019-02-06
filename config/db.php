<?php

return [
    'class' => 'yii\db\Connection',
    //'dsn' => 'pgsql:host=localhost;port=5432;dbname=decameronhotel', //para postgress
    'dsn' => 'mysql:host=127.0.0.1;dbname=decameronhotel',
    //'username' => 'postgres',
    'username' => 'root',
    //'password' => '1234',
    'password' => '',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
