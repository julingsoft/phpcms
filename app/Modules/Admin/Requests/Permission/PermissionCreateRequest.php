<?php

declare(strict_types=1);

namespace App\Modules\Admin\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'PermissionCreateRequest',
    required: [
        self::getTenantId,
        self::getParentId,
        self::getModule,
        self::getIcon,
        self::getName,
        self::getResource,
        self::getMenu,
        self::getSort,
        self::getStatus,
    ],
    properties: [
        new OA\Property(property: self::getTenantId, description: '租户ID', type: 'integer'),
        new OA\Property(property: self::getParentId, description: '父级ID', type: 'integer'),
        new OA\Property(property: self::getModule, description: '模块名:如manager,merchant', type: 'string'),
        new OA\Property(property: self::getIcon, description: '菜单图标', type: 'string'),
        new OA\Property(property: self::getName, description: '资源名称', type: 'string'),
        new OA\Property(property: self::getResource, description: '资源标识', type: 'string'),
        new OA\Property(property: self::getMenu, description: '是否为菜单项:1是,0否', type: 'integer'),
        new OA\Property(property: self::getSort, description: '排序', type: 'integer'),
        new OA\Property(property: self::getStatus, description: '状态:1正常,2禁用', type: 'integer'),
    ]
)]
class PermissionCreateRequest extends FormRequest
{
    const string getTenantId = 'tenant_id';

    const string getParentId = 'parent_id';

    const string getModule = 'module';

    const string getIcon = 'icon';

    const string getName = 'name';

    const string getResource = 'resource';

    const string getMenu = 'menu';

    const string getSort = 'sort';

    const string getStatus = 'status';

    public function rules(): array
    {
        return [
            self::getTenantId => 'require',
            self::getParentId => 'require',
            self::getModule => 'require',
            self::getIcon => 'require',
            self::getName => 'require',
            self::getResource => 'require',
            self::getMenu => 'require',
            self::getSort => 'require',
            self::getStatus => 'require',
        ];
    }

    public function messages(): array
    {
        return [
            self::getTenantId.'.require' => '请设置租户ID',
            self::getParentId.'.require' => '请设置父级ID',
            self::getModule.'.require' => '请设置模块名',
            self::getIcon.'.require' => '请设置菜单图标',
            self::getName.'.require' => '请设置资源名称',
            self::getResource.'.require' => '请设置资源标识',
            self::getMenu.'.require' => '请设置是否为菜单项',
            self::getSort.'.require' => '请设置排序',
            self::getStatus.'.require' => '请设置状态',
        ];
    }
}
