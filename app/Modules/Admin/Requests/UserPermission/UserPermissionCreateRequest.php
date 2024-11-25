<?php

declare(strict_types=1);

namespace App\Modules\Admin\Requests\UserPermission;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'UserPermissionCreateRequest',
    required: [
        self::getTenantId,
        self::getUserId,
        self::getPermissionId,
    ],
    properties: [
        new OA\Property(property: self::getTenantId, description: '租户ID', type: 'integer'),
        new OA\Property(property: self::getUserId, description: '用户ID', type: 'integer'),
        new OA\Property(property: self::getPermissionId, description: '权限资源ID', type: 'integer'),
    ]
)]
class UserPermissionCreateRequest extends FormRequest
{
    const string getTenantId = 'tenant_id';

    const string getUserId = 'user_id';

    const string getPermissionId = 'permission_id';

    public function rules(): array
    {
        return [
            self::getTenantId => 'require',
            self::getUserId => 'require',
            self::getPermissionId => 'require',
        ];
    }

    public function messages(): array
    {
        return [
            self::getTenantId.'.require' => '请设置租户ID',
            self::getUserId.'.require' => '请设置用户ID',
            self::getPermissionId.'.require' => '请设置权限资源ID',
        ];
    }
}
