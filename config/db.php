<?php

return [
    'class' => 'yii\db\Connection',
    // 'dsn' => 'pgsql:host=localhost;dbname=decameronhotel',
    'dsn' => 'pgsql:host=localhost;port=5432;dbname=decameronhotel',
    'username' => 'postgres',
    'password' => '1234',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
