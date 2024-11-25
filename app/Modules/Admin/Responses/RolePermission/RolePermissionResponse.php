<?php

declare(strict_types=1);

namespace App\Modules\Admin\Responses\RolePermission;

use Juling\Foundation\Support\DTOHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'RolePermissionResponse')]
class RolePermissionResponse
{
    use DTOHelper;

    #[OA\Property(property: 'id', description: 'ID', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'tenantId', description: '租户ID', type: 'integer')]
    private int $tenantId;

    #[OA\Property(property: 'roleId', description: '角色ID', type: 'integer')]
    private int $roleId;

    #[OA\Property(property: 'permissionId', description: '权限资源ID', type: 'integer')]
    private int $permissionId;

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
     * 获取租户ID
     */
    public function getTenantId(): int
    {
        return $this->tenantId;
    }

    /**
     * 设置租户ID
     */
    public function setTenantId(int $tenantId): void
    {
        $this->tenantId = $tenantId;
    }

    /**
     * 获取角色ID
     */
    public function getRoleId(): int
    {
        return $this->roleId;
    }

    /**
     * 设置角色ID
     */
    public function setRoleId(int $roleId): void
    {
        $this->roleId = $roleId;
    }

    /**
     * 获取权限资源ID
     */
    public function getPermissionId(): int
    {
        return $this->permissionId;
    }

    /**
     * 设置权限资源ID
     */
    public function setPermissionId(int $permissionId): void
    {
        $this->permissionId = $permissionId;
    }
}
