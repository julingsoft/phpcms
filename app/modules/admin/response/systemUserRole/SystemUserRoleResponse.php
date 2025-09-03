<?php

declare(strict_types=1);

namespace app\modules\admin\response\systemUserRole;

use Juling\Foundation\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'SystemUserRoleResponse')]
class SystemUserRoleResponse
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: 'ID', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'create_time', description: '', type: 'string')]
    private string $createTime;

    #[OA\Property(property: 'update_time', description: '', type: 'string')]
    private string $updateTime;

    #[OA\Property(property: 'delete_time', description: '', type: 'string')]
    private string $deleteTime;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCreateTime(): string
    {
        return $this->createTime;
    }

    public function setCreateTime(string $createTime): void
    {
        $this->createTime = $createTime;
    }

    public function getUpdateTime(): string
    {
        return $this->updateTime;
    }

    public function setUpdateTime(string $updateTime): void
    {
        $this->updateTime = $updateTime;
    }

    public function getDeleteTime(): string
    {
        return $this->deleteTime;
    }

    public function setDeleteTime(string $deleteTime): void
    {
        $this->deleteTime = $deleteTime;
    }
}
