<?php

declare(strict_types=1);

namespace app\modules\admin\controller;

use app\bundles\system\service\SystemRoleBundleService;
use app\entity\SystemRoleEntity;
use app\modules\admin\request\systemRole\SystemRoleCreateRequest;
use app\modules\admin\request\systemRole\SystemRoleQueryRequest;
use app\modules\admin\request\systemRole\SystemRoleUpdateRequest;
use app\modules\admin\response\systemRole\SystemRoleQueryResponse;
use app\modules\admin\response\systemRole\SystemRoleResponse;
use Juling\Foundation\Exception\CustomException;
use OpenApi\Attributes as OA;
use think\facade\Db as DB;
use think\facade\Log;
use think\Response;
use Throwable;

class SystemRoleController extends BaseController
{
    #[OA\Post(path: '/systemRole/query', summary: '查询列表接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\Parameter(name: 'page', description: '当前页码', in: 'query', required: true, example: 1)]
    #[OA\Parameter(name: 'pageSize', description: '每页分页数', in: 'query', required: false, example: 10)]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: SystemRoleQueryRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: SystemRoleQueryResponse::class))]
    public function query(): Response
    {
        try {
            $request = $this->request->get();
            $page = intval($this->request->param('page', 1));
            $pageSize = intval($this->request->param('pageSize', 10));

            $v = new SystemRoleQueryRequest();
            if (! $v->check($request)) {
                throw new CustomException($v->getError());
            }

            $condition = [
                //
            ];

            $systemRoleBundleService = new SystemRoleBundleService();
            $result = $systemRoleBundleService->page($condition, $page, $pageSize);

            foreach ($result['data'] as $key => $item) {
                $response = new SystemRoleResponse();
                $response->setData($item);
                $result['data'][$key] = $response->toArray();
            }

            return $this->success($result);
        } catch (Throwable $e) {
            if ($e instanceof CustomException) {
                return $this->error($e->getMessage());
            }

            Log::error($e);

            return $this->error('查询列表错误');
        }
    }

    #[OA\Post(path: '/systemRole/create', summary: '新增接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: SystemRoleCreateRequest::class))]
    #[OA\Response(response: 200, description: 'OK')]
    public function create(): Response
    {
        DB::startTrans();
        try {
            $request = $this->request->get();

            $v = new SystemRoleCreateRequest();
            if (! $v->check($request)) {
                throw new CustomException($v->getError());
            }

            $systemRoleEntity = new SystemRoleEntity();
            $systemRoleEntity->setData($request);

            $systemRoleBundleService = new SystemRoleBundleService();
            $insertId = $systemRoleBundleService->save($systemRoleEntity->toArray());
            if ($insertId > 0) {
                DB::commit();

                return $this->success('新增数据成功');
            }

            throw new CustomException('新增数据失败');
        } catch (Throwable $e) {
            DB::rollback();

            if ($e instanceof CustomException) {
                return $this->error($e->getMessage());
            }

            Log::error($e);

            return $this->error('新增数据错误');
        }
    }

    #[OA\Get(path: '/systemRole/show', summary: '获取详情接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\Parameter(name: 'id', description: 'ID', in: 'query', required: true, example: 1)]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: SystemRoleResponse::class))]
    public function show(): Response
    {
        try {
            $id = intval($this->request->param('id', 0));

            $condition = [
                ['id', '=', $id],
            ];

            $systemRoleBundleService = new SystemRoleBundleService();
            $systemRole = $systemRoleBundleService->getOne($condition);

            if (empty($systemRole)) {
                throw new CustomException('数据不存在或状态异常');
            }

            $response = new SystemRoleResponse();
            $response->setData($systemRole);

            return $this->success($response->toArray());
        } catch (Throwable $e) {
            if ($e instanceof CustomException) {
                return $this->error($e->getMessage());
            }

            Log::error($e);

            return $this->error('获取详情错误');
        }
    }

    #[OA\Put(path: '/systemRole/update', summary: '更新接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: SystemRoleUpdateRequest::class))]
    #[OA\Response(response: 200, description: 'OK')]
    public function update(): Response
    {
        DB::startTrans();
        try {
            $request = $this->request->get();

            $v = new SystemRoleUpdateRequest();
            if (! $v->check($request)) {
                throw new CustomException($v->getError());
            }

            $systemRoleBundleService = new SystemRoleBundleService();
            $systemRole = $systemRoleBundleService->getById($request['id']);
            if (empty($systemRole)) {
                throw new CustomException('数据不存在或状态异常');
            }

            $systemRoleEntity = new SystemRoleEntity();
            $systemRoleEntity->setData($request);

            $systemRoleBundleService->update($systemRoleEntity->toArray(), [
                ['id', '=', $request['id']],
            ]);

            DB::commit();

            return $this->success('更新数据成功');
        } catch (Throwable $e) {
            DB::rollback();

            if ($e instanceof CustomException) {
                return $this->error($e->getMessage());
            }

            Log::error($e);

            return $this->error('更新数据错误');
        }
    }

    #[OA\Delete(path: '/systemRole/destroy', summary: '删除接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\Parameter(name: 'id', description: 'ID', in: 'query', required: true, example: 1)]
    #[OA\Response(response: 200, description: 'OK')]
    public function destroy(): Response
    {
        DB::startTrans();
        try {
            $id = intval($this->request->param('id', 0));

            $condition = [
                ['id', '=', $id],
            ];

            $systemRoleBundleService = new SystemRoleBundleService();
            if ($systemRoleBundleService->remove($condition)) {
                DB::commit();

                return $this->success('删除数据成功');
            }

            throw new CustomException('删除数据失败');
        } catch (Throwable $e) {
            DB::rollback();

            if ($e instanceof CustomException) {
                return $this->error($e->getMessage());
            }

            Log::error($e);

            return $this->error('删除数据错误');
        }
    }
}
