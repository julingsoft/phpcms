<?php

declare(strict_types=1);

namespace App\Modules\Admin\Requests\RolePermission;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'RolePermissionUpdateRequest',
    required: [
        self::getId,
        self::getTenantId,
        self::getRoleId,
        self::getPermissionId,
    ],
    properties: [
        new OA\Property(property: self::getId, description: 'ID', type: 'integer'),
        new OA\Property(property: self::getTenantId, description: '租户ID', type: 'integer'),
        new OA\Property(property: self::getRoleId, description: '角色ID', type: 'integer'),
        new OA\Property(property: self::getPermissionId, description: '权限资源ID', type: 'integer'),
    ]
)]
class RolePermissionUpdateRequest extends FormRequest
{
    const string getId = 'id';

    const string getTenantId = 'tenant_id';

    const string getRoleId = 'role_id';

    const string getPermissionId = 'permission_id';

    public function rules(): array
    {
        return [
            self::getId => 'require',
            self::getTenantId => 'require',
            self::getRoleId => 'require',
            self::getPermissionId => 'require',
        ];
    }

    public function messages(): array
    {
        return [
            self::getId.'.require' => '请设置ID',
            self::getTenantId.'.require' => '请设置租户ID',
            self::getRoleId.'.require' => '请设置角色ID',
            self::getPermissionId.'.require' => '请设置权限资源ID',
        ];
    }
}
