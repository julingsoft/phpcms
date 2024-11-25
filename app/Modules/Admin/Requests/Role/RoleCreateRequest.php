<?php

declare(strict_types=1);

namespace App\Modules\Admin\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'RoleCreateRequest',
    required: [
        self::getTenantId,
        self::getName,
        self::getCode,
        self::getDescription,
        self::getSort,
        self::getStatus,
    ],
    properties: [
        new OA\Property(property: self::getTenantId, description: '租户ID', type: 'integer'),
        new OA\Property(property: self::getName, description: '角色名称', type: 'string'),
        new OA\Property(property: self::getCode, description: '角色代码', type: 'string'),
        new OA\Property(property: self::getDescription, description: '角色描述', type: 'string'),
        new OA\Property(property: self::getSort, description: '排序', type: 'integer'),
        new OA\Property(property: self::getStatus, description: '状态:1正常,2禁用', type: 'integer'),
    ]
)]
class RoleCreateRequest extends FormRequest
{
    const string getTenantId = 'tenant_id';

    const string getName = 'name';

    const string getCode = 'code';

    const string getDescription = 'description';

    const string getSort = 'sort';

    const string getStatus = 'status';

    public function rules(): array
    {
        return [
            self::getTenantId => 'require',
            self::getName => 'require',
            self::getCode => 'require',
            self::getDescription => 'require',
            self::getSort => 'require',
            self::getStatus => 'require',
        ];
    }

    public function messages(): array
    {
        return [
            self::getTenantId.'.require' => '请设置租户ID',
            self::getName.'.require' => '请设置角色名称',
            self::getCode.'.require' => '请设置角色代码',
            self::getDescription.'.require' => '请设置角色描述',
            self::getSort.'.require' => '请设置排序',
            self::getStatus.'.require' => '请设置状态',
        ];
    }
}
