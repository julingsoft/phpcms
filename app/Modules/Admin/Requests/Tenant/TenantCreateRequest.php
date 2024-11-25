<?php

declare(strict_types=1);

namespace App\Modules\Admin\Requests\Tenant;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'TenantCreateRequest',
    required: [
        self::getName,
        self::getUserId,
        self::getDescription,
        self::getSort,
        self::getStatus,
    ],
    properties: [
        new OA\Property(property: self::getName, description: '租户名称', type: 'string'),
        new OA\Property(property: self::getUserId, description: '租户负责人', type: 'integer'),
        new OA\Property(property: self::getDescription, description: '描述', type: 'string'),
        new OA\Property(property: self::getSort, description: '排序', type: 'integer'),
        new OA\Property(property: self::getStatus, description: '状态:1正常,2禁用', type: 'integer'),
    ]
)]
class TenantCreateRequest extends FormRequest
{
    const string getName = 'name';

    const string getUserId = 'user_id';

    const string getDescription = 'description';

    const string getSort = 'sort';

    const string getStatus = 'status';

    public function rules(): array
    {
        return [
            self::getName => 'require',
            self::getUserId => 'require',
            self::getDescription => 'require',
            self::getSort => 'require',
            self::getStatus => 'require',
        ];
    }

    public function messages(): array
    {
        return [
            self::getName.'.require' => '请设置租户名称',
            self::getUserId.'.require' => '请设置租户负责人',
            self::getDescription.'.require' => '请设置描述',
            self::getSort.'.require' => '请设置排序',
            self::getStatus.'.require' => '请设置状态',
        ];
    }
}
