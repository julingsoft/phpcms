<?php

declare(strict_types=1);

namespace App\Modules\Admin\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'PermissionQueryRequest',
    required: [

    ],
    properties: [

    ]
)]
class PermissionQueryRequest extends FormRequest
{
    public function rules(): array
    {
        return [

        ];
    }

    public function messages(): array
    {
        return [

        ];
    }
}
