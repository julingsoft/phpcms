<?php

declare(strict_types=1);

use app\support\MysqlClient;

if (! function_exists('table')) {
    /**
     * 获取表名
     */
    function table(string $tableName): string
    {
        return config('database.connections.'.config('database.default').'.prefix').$tableName;
    }
}

if (! function_exists('db')) {
    /**
     * 获取数据库连接
     */
    function db(): MysqlClient
    {
        static $mysqlClient = null;
        if ($mysqlClient === null) {
            $mysqlClient = new MysqlClient;
        }

        return $mysqlClient;
    }
}
