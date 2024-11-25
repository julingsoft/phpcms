<?php

declare(strict_types=1);

namespace App\Modules\Admin\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'DepartmentQueryRequest',
    required: [

    ],
    properties: [

    ]
)]
class DepartmentQueryRequest extends FormRequest
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
