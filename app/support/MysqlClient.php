<?php

declare(strict_types=1);

namespace app\support;

use think\facade\Db;

class MysqlClient
{
    /**
     * 执行SQL查询操作，返回查询结果数据集（数组）
     */
    public function query(string $sql)
    {
        return Db::query($sql);
    }

    /**
     * 执行SQL更新操作，返回受影响的行数
     */
    public function execute(string $sql): bool|int
    {
        return Db::execute($sql);
    }

    /**
     * 获取单行数据
     */
    public function getRow(string $sql): array
    {
        $result = Db::query($sql);

        return $result[0] ?? [];
    }

    /**
     * 获取单列数据
     */
    public function getCol(string $sql): array
    {
        $result = Db::query($sql);

        return array_column($result, 0);
    }

    /**
     * 获取单行数据中的单一列数据
     */
    public function getOne(string $sql): mixed
    {
        $result = Db::query($sql);

        return $result[0][0] ?? null;
    }

    /**
     * 获取所有行数据
     */
    public function getAll(string $sql): array
    {
        return Db::query($sql);
    }
}
