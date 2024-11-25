<?php

declare(strict_types=1);

namespace App\Modules\Admin\Responses\Tenant;

use Juling\Foundation\Support\DTOHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'TenantResponse')]
class TenantResponse
{
    use DTOHelper;

    #[OA\Property(property: 'id', description: 'ID', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'name', description: '租户名称', type: 'string')]
    private string $name;

    #[OA\Property(property: 'userId', description: '租户负责人', type: 'integer')]
    private int $userId;

    #[OA\Property(property: 'description', description: '描述', type: 'string')]
    private string $description;

    #[OA\Property(property: 'sort', description: '排序', type: 'integer')]
    private int $sort;

    #[OA\Property(property: 'status', description: '状态:1正常,2禁用', type: 'integer')]
    private int $status;

    #[OA\Property(property: 'createdAt', description: '', type: 'string')]
    private string $createdAt;

    #[OA\Property(property: 'updatedAt', description: '', type: 'string')]
    private string $updatedAt;

    #[OA\Property(property: 'deletedAt', description: '', type: 'string')]
    private string $deletedAt;

    /**
     * 获取
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * 设置
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * 获取租户名称
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * 设置租户名称
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * 获取租户负责人
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * 设置租户负责人
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * 获取描述
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * 设置描述
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * 获取排序
     */
    public function getSort(): int
    {
        return $this->sort;
    }

    /**
     * 设置排序
     */
    public function setSort(int $sort): void
    {
        $this->sort = $sort;
    }

    /**
     * 获取状态:1正常,2禁用
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * 设置状态:1正常,2禁用
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * 获取
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * 设置
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * 获取
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * 设置
     */
    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * 获取
     */
    public function getDeletedAt(): string
    {
        return $this->deletedAt;
    }

    /**
     * 设置
     */
    public function setDeletedAt(string $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }
}
