<?php

declare(strict_types=1);

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Requests\Role\RoleCreateRequest;
use App\Modules\Admin\Requests\Role\RoleQueryRequest;
use App\Modules\Admin\Requests\Role\RoleUpdateRequest;
use App\Modules\Admin\Responses\Role\RoleDestroyResponse;
use App\Modules\Admin\Responses\Role\RoleQueryResponse;
use App\Modules\Admin\Responses\Role\RoleResponse;
use App\Entities\RoleEntity;
use App\Exceptions\CustomException;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Juling\Foundation\Enums\BusinessEnum;
use OpenApi\Attributes as OA;
use Throwable;

class RoleController extends BaseController
{
    #[OA\Post(path: '/role/query', summary: '查询列表接口', security: [['bearerAuth' => []]], tags: ['角色模块'])]
    #[OA\Parameter(name: 'page', description: '当前页码', in: 'query', required: true, example: 1)]
    #[OA\Parameter(name: 'pageSize', description: '每页分页数', in: 'query', required: false, example: 10)]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: RoleQueryRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: RoleQueryResponse::class))]
    public function query(RoleQueryRequest $queryRequest): JsonResponse
    {
        $page = intval($queryRequest->query('page', 1));
        $pageSize = intval($queryRequest->query('pageSize', 10));
        $request = $queryRequest->validated();

        try {
            $condition = [];

            $roleService = new RoleService;
            $result = $roleService->page($condition, $page, $pageSize);

            foreach ($result['data'] as $key => $item) {
                $response = new RoleResponse($item);
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

    #[OA\Post(path: '/role/store', summary: '新增接口', security: [['bearerAuth' => []]], tags: ['角色模块'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: RoleCreateRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: RoleResponse::class))]
    public function store(RoleCreateRequest $createRequest): JsonResponse
    {
        $request = $createRequest->validated();

        DB::beginTransaction();
        try {
            $input = new RoleEntity($request);

            $roleService = new RoleService;
            if ($roleService->save($input->toArray())) {
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

    #[OA\Get(path: '/role/show', summary: '获取详情接口', security: [['bearerAuth' => []]], tags: ['角色模块'])]
    #[OA\Parameter(name: 'id', description: 'ID', in: 'query', required: true, example: 1)]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: RoleResponse::class))]
    public function show(Request $request): JsonResponse
    {
        $id = intval($request->query('id', 0));

        try {
            $roleService = new RoleService;
            $role = $roleService->getOneById($id);
            if (empty($role)) {
                throw new CustomException(BusinessEnum::NOT_FOUND);
            }

            $response = new RoleResponse($role);

            return $this->success($response->toArray());
        } catch (Throwable $e) {
            if ($e instanceof CustomException) {
                return $this->error($e);
            }

            Log::error($e);

            return $this->error(BusinessEnum::SHOW_ERROR);
        }
    }

    #[OA\Put(path: '/role/update', summary: '更新接口', security: [['bearerAuth' => []]], tags: ['角色模块'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: RoleUpdateRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: RoleResponse::class))]
    public function update(RoleUpdateRequest $updateRequest): JsonResponse
    {
        $request = $updateRequest->validated();
        $id = intval($request->query('id', 0));

        DB::beginTransaction();
        try {
            $roleService = new RoleService;
            $role = $roleService->getOneById($id);
            if (empty($role)) {
                throw new CustomException(BusinessEnum::NOT_FOUND);
            }

            $input = new RoleEntity($request);

            $roleService->updateById($input->toArray(), $id);

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

    #[OA\Delete(path: '/role/destroy', summary: '删除接口', security: [['bearerAuth' => []]], tags: ['角色模块'])]
    #[OA\Parameter(name: 'id', description: 'ID', in: 'query', required: true, example: 1)]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: RoleDestroyResponse::class))]
    public function destroy(Request $request): JsonResponse
    {
        $id = intval($request->query('id', 0));

        DB::beginTransaction();
        try {
            $roleService = new RoleService;
            $role = $roleService->getOneById($id);
            if (empty($role)) {
                throw new CustomException(BusinessEnum::NOT_FOUND);
            }

            if ($roleService->removeById($id)) {
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
