<?php

declare(strict_types=1);

namespace app\modules\admin\controller;

use app\bundles\system\service\SystemPermissionBundleService;
use app\entity\SystemPermissionEntity;
use app\modules\admin\request\systemPermission\SystemPermissionCreateRequest;
use app\modules\admin\request\systemPermission\SystemPermissionQueryRequest;
use app\modules\admin\request\systemPermission\SystemPermissionUpdateRequest;
use app\modules\admin\response\systemPermission\SystemPermissionQueryResponse;
use app\modules\admin\response\systemPermission\SystemPermissionResponse;
use Juling\Foundation\Exception\CustomException;
use OpenApi\Attributes as OA;
use think\facade\Db as DB;
use think\facade\Log;
use think\Response;
use Throwable;

class SystemPermissionController extends BaseController
{
    #[OA\Post(path: '/systemPermission/query', summary: '查询列表接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\Parameter(name: 'page', description: '当前页码', in: 'query', required: true, example: 1)]
    #[OA\Parameter(name: 'pageSize', description: '每页分页数', in: 'query', required: false, example: 10)]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: SystemPermissionQueryRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: SystemPermissionQueryResponse::class))]
    public function query(): Response
    {
        try {
            $request = $this->request->get();
            $page = intval($this->request->param('page', 1));
            $pageSize = intval($this->request->param('pageSize', 10));

            $v = new SystemPermissionQueryRequest();
            if (! $v->check($request)) {
                throw new CustomException($v->getError());
            }

            $condition = [
                //
            ];

            $systemPermissionBundleService = new SystemPermissionBundleService();
            $result = $systemPermissionBundleService->page($condition, $page, $pageSize);

            foreach ($result['data'] as $key => $item) {
                $response = new SystemPermissionResponse();
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

    #[OA\Post(path: '/systemPermission/create', summary: '新增接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: SystemPermissionCreateRequest::class))]
    #[OA\Response(response: 200, description: 'OK')]
    public function create(): Response
    {
        DB::startTrans();
        try {
            $request = $this->request->get();

            $v = new SystemPermissionCreateRequest();
            if (! $v->check($request)) {
                throw new CustomException($v->getError());
            }

            $systemPermissionEntity = new SystemPermissionEntity();
            $systemPermissionEntity->setData($request);

            $systemPermissionBundleService = new SystemPermissionBundleService();
            $insertId = $systemPermissionBundleService->save($systemPermissionEntity->toArray());
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

    #[OA\Get(path: '/systemPermission/show', summary: '获取详情接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\Parameter(name: 'id', description: 'ID', in: 'query', required: true, example: 1)]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: SystemPermissionResponse::class))]
    public function show(): Response
    {
        try {
            $id = intval($this->request->param('id', 0));

            $condition = [
                ['id', '=', $id],
            ];

            $systemPermissionBundleService = new SystemPermissionBundleService();
            $systemPermission = $systemPermissionBundleService->getOne($condition);

            if (empty($systemPermission)) {
                throw new CustomException('数据不存在或状态异常');
            }

            $response = new SystemPermissionResponse();
            $response->setData($systemPermission);

            return $this->success($response->toArray());
        } catch (Throwable $e) {
            if ($e instanceof CustomException) {
                return $this->error($e->getMessage());
            }

            Log::error($e);

            return $this->error('获取详情错误');
        }
    }

    #[OA\Put(path: '/systemPermission/update', summary: '更新接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: SystemPermissionUpdateRequest::class))]
    #[OA\Response(response: 200, description: 'OK')]
    public function update(): Response
    {
        DB::startTrans();
        try {
            $request = $this->request->get();

            $v = new SystemPermissionUpdateRequest();
            if (! $v->check($request)) {
                throw new CustomException($v->getError());
            }

            $systemPermissionBundleService = new SystemPermissionBundleService();
            $systemPermission = $systemPermissionBundleService->getById($request['id']);
            if (empty($systemPermission)) {
                throw new CustomException('数据不存在或状态异常');
            }

            $systemPermissionEntity = new SystemPermissionEntity();
            $systemPermissionEntity->setData($request);

            $systemPermissionBundleService->update($systemPermissionEntity->toArray(), [
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

    #[OA\Delete(path: '/systemPermission/destroy', summary: '删除接口', security: [['bearerAuth' => []]], tags: ['模块'])]
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

            $systemPermissionBundleService = new SystemPermissionBundleService();
            if ($systemPermissionBundleService->remove($condition)) {
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
