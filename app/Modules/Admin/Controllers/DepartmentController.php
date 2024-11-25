<?php

declare(strict_types=1);

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Requests\Department\DepartmentCreateRequest;
use App\Modules\Admin\Requests\Department\DepartmentQueryRequest;
use App\Modules\Admin\Requests\Department\DepartmentUpdateRequest;
use App\Modules\Admin\Responses\Department\DepartmentDestroyResponse;
use App\Modules\Admin\Responses\Department\DepartmentQueryResponse;
use App\Modules\Admin\Responses\Department\DepartmentResponse;
use App\Entities\DepartmentEntity;
use App\Exceptions\CustomException;
use App\Services\DepartmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Juling\Foundation\Enums\BusinessEnum;
use OpenApi\Attributes as OA;
use Throwable;

class DepartmentController extends BaseController
{
    #[OA\Post(path: '/department/query', summary: '查询列表接口', security: [['bearerAuth' => []]], tags: ['部门模块'])]
    #[OA\Parameter(name: 'page', description: '当前页码', in: 'query', required: true, example: 1)]
    #[OA\Parameter(name: 'pageSize', description: '每页分页数', in: 'query', required: false, example: 10)]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: DepartmentQueryRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: DepartmentQueryResponse::class))]
    public function query(DepartmentQueryRequest $queryRequest): JsonResponse
    {
        $page = intval($queryRequest->query('page', 1));
        $pageSize = intval($queryRequest->query('pageSize', 10));
        $request = $queryRequest->validated();

        try {
            $condition = [];

            $departmentService = new DepartmentService;
            $result = $departmentService->page($condition, $page, $pageSize);

            foreach ($result['data'] as $key => $item) {
                $response = new DepartmentResponse($item);
                $result['data'][$key] = $response->toArray();
            }

            return $this->success($result);
        } catch (Throwable $e) {
            if ($e instanceof CustomException) {
                return $this->error($e);
            }

            Log::error($e);

            return $this->error(BusinessEnum::QUERY_ERROR);
        }
    }

    #[OA\Post(path: '/department/store', summary: '新增接口', security: [['bearerAuth' => []]], tags: ['部门模块'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: DepartmentCreateRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: DepartmentResponse::class))]
    public function store(DepartmentCreateRequest $createRequest): JsonResponse
    {
        $request = $createRequest->validated();

        DB::beginTransaction();
        try {
            $input = new DepartmentEntity($request);

            $departmentService = new DepartmentService;
            if ($departmentService->save($input->toArray())) {
                DB::commit();

                return $this->success();
            }

            throw new CustomException(BusinessEnum::CREATE_FAIL);
        } catch (Throwable $e) {
            DB::rollBack();

            if ($e instanceof CustomException) {
                return $this->error($e);
            }

            Log::error($e);

            return $this->error(BusinessEnum::CREATE_ERROR);
        }
    }

    #[OA\Get(path: '/department/show', summary: '获取详情接口', security: [['bearerAuth' => []]], tags: ['部门模块'])]
    #[OA\Parameter(name: 'id', description: 'ID', in: 'query', required: true, example: 1)]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: DepartmentResponse::class))]
    public function show(Request $request): JsonResponse
    {
        $id = intval($request->query('id', 0));

        try {
            $departmentService = new DepartmentService;
            $department = $departmentService->getOneById($id);
            if (empty($department)) {
                throw new CustomException(BusinessEnum::NOT_FOUND);
            }

            $response = new DepartmentResponse($department);

            return $this->success($response->toArray());
        } catch (Throwable $e) {
            if ($e instanceof CustomException) {
                return $this->error($e);
            }

            Log::error($e);

            return $this->error(BusinessEnum::SHOW_ERROR);
        }
    }

    #[OA\Put(path: '/department/update', summary: '更新接口', security: [['bearerAuth' => []]], tags: ['部门模块'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: DepartmentUpdateRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: DepartmentResponse::class))]
    public function update(DepartmentUpdateRequest $updateRequest): JsonResponse
    {
        $request = $updateRequest->validated();
        $id = intval($request->query('id', 0));

        DB::beginTransaction();
        try {
            $departmentService = new DepartmentService;
            $department = $departmentService->getOneById($id);
            if (empty($department)) {
                throw new CustomException(BusinessEnum::NOT_FOUND);
            }

            $input = new DepartmentEntity($request);

            $departmentService->updateById($input->toArray(), $id);

            DB::commit();

            return $this->success();
        } catch (Throwable $e) {
            DB::rollBack();

            if ($e instanceof CustomException) {
                return $this->error($e);
            }

            Log::error($e);

            return $this->error(BusinessEnum::UPDATE_ERROR);
        }
    }

    #[OA\Delete(path: '/department/destroy', summary: '删除接口', security: [['bearerAuth' => []]], tags: ['部门模块'])]
    #[OA\Parameter(name: 'id', description: 'ID', in: 'query', required: true, example: 1)]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: DepartmentDestroyResponse::class))]
    public function destroy(Request $request): JsonResponse
    {
        $id = intval($request->query('id', 0));

        DB::beginTransaction();
        try {
            $departmentService = new DepartmentService;
            $department = $departmentService->getOneById($id);
            if (empty($department)) {
                throw new CustomException(BusinessEnum::NOT_FOUND);
            }

            if ($departmentService->removeById($id)) {
                DB::commit();

                return $this->success();
            }

            throw new CustomException(BusinessEnum::DESTROY_FAIL);
        } catch (Throwable $e) {
            DB::rollBack();

            if ($e instanceof CustomException) {
                return $this->error($e);
            }

            Log::error($e);

            return $this->error(BusinessEnum::DESTROY_ERROR);
        }
    }
}
