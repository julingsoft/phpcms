<?php

declare(strict_types=1);

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Requests\Permission\PermissionCreateRequest;
use App\Modules\Admin\Requests\Permission\PermissionQueryRequest;
use App\Modules\Admin\Requests\Permission\PermissionUpdateRequest;
use App\Modules\Admin\Responses\Permission\PermissionDestroyResponse;
use App\Modules\Admin\Responses\Permission\PermissionQueryResponse;
use App\Modules\Admin\Responses\Permission\PermissionResponse;
use App\Entities\PermissionEntity;
use App\Exceptions\CustomException;
use App\Services\PermissionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Juling\Foundation\Enums\BusinessEnum;
use OpenApi\Attributes as OA;
use Throwable;

class PermissionController extends BaseController
{
    #[OA\Post(path: '/permission/query', summary: '查询列表接口', security: [['bearerAuth' => []]], tags: ['资源权限模块'])]
    #[OA\Parameter(name: 'page', description: '当前页码', in: 'query', required: true, example: 1)]
    #[OA\Parameter(name: 'pageSize', description: '每页分页数', in: 'query', required: false, example: 10)]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: PermissionQueryRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: PermissionQueryResponse::class))]
    public function query(PermissionQueryRequest $queryRequest): JsonResponse
    {
        $page = intval($queryRequest->query('page', 1));
        $pageSize = intval($queryRequest->query('pageSize', 10));
        $request = $queryRequest->validated();

        try {
            $condition = [];

            $permissionService = new PermissionService;
            $result = $permissionService->page($condition, $page, $pageSize);

            foreach ($result['data'] as $key => $item) {
                $response = new PermissionResponse($item);
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

    #[OA\Post(path: '/permission/store', summary: '新增接口', security: [['bearerAuth' => []]], tags: ['资源权限模块'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: PermissionCreateRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: PermissionResponse::class))]
    public function store(PermissionCreateRequest $createRequest): JsonResponse
    {
        $request = $createRequest->validated();

        DB::beginTransaction();
        try {
            $input = new PermissionEntity($request);

            $permissionService = new PermissionService;
            if ($permissionService->save($input->toArray())) {
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

    #[OA\Get(path: '/permission/show', summary: '获取详情接口', security: [['bearerAuth' => []]], tags: ['资源权限模块'])]
    #[OA\Parameter(name: 'id', description: 'ID', in: 'query', required: true, example: 1)]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: PermissionResponse::class))]
    public function show(Request $request): JsonResponse
    {
        $id = intval($request->query('id', 0));

        try {
            $permissionService = new PermissionService;
            $permission = $permissionService->getOneById($id);
            if (empty($permission)) {
                throw new CustomException(BusinessEnum::NOT_FOUND);
            }

            $response = new PermissionResponse($permission);

            return $this->success($response->toArray());
        } catch (Throwable $e) {
            if ($e instanceof CustomException) {
                return $this->error($e);
            }

            Log::error($e);

            return $this->error(BusinessEnum::SHOW_ERROR);
        }
    }

    #[OA\Put(path: '/permission/update', summary: '更新接口', security: [['bearerAuth' => []]], tags: ['资源权限模块'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: PermissionUpdateRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: PermissionResponse::class))]
    public function update(PermissionUpdateRequest $updateRequest): JsonResponse
    {
        $request = $updateRequest->validated();
        $id = intval($request->query('id', 0));

        DB::beginTransaction();
        try {
            $permissionService = new PermissionService;
            $permission = $permissionService->getOneById($id);
            if (empty($permission)) {
                throw new CustomException(BusinessEnum::NOT_FOUND);
            }

            $input = new PermissionEntity($request);

            $permissionService->updateById($input->toArray(), $id);

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

    #[OA\Delete(path: '/permission/destroy', summary: '删除接口', security: [['bearerAuth' => []]], tags: ['资源权限模块'])]
    #[OA\Parameter(name: 'id', description: 'ID', in: 'query', required: true, example: 1)]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: PermissionDestroyResponse::class))]
    public function destroy(Request $request): JsonResponse
    {
        $id = intval($request->query('id', 0));

        DB::beginTransaction();
        try {
            $permissionService = new PermissionService;
            $permission = $permissionService->getOneById($id);
            if (empty($permission)) {
                throw new CustomException(BusinessEnum::NOT_FOUND);
            }

            if ($permissionService->removeById($id)) {
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
