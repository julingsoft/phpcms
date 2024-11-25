<?php

declare(strict_types=1);

namespace App\Modules\Admin\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'RoleQueryRequest',
    required: [

    ],
    properties: [

    ]
)]
class RoleQueryRequest extends FormRequest
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
