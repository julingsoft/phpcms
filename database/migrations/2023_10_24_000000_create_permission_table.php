<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permission', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('tenant_id')->default(0)->comment('租户ID');
            $table->unsignedInteger('parent_id')->default(0)->comment('父级ID');
            $table->string('module')->default('')->comment('模块名');
            $table->string('name')->default('')->comment('名称');
            $table->string('description')->default('')->comment('描述');
            $table->string('path')->unique()->comment('标识');
            $table->string('icon')->default('')->comment('菜单图标');
            $table->boolean('type')->default(2)->comment('类型：1菜单,2页面,3接口');
            $table->unsignedTinyInteger('menu')->default(0)->comment('是否为菜单项:1是,0否');
            $table->unsignedInteger('sort')->default(0)->comment('排序');
            $table->unsignedTinyInteger('status')->comment('状态:1正常,2禁用');
            $table->timestamps();
            $table->softDeletes();
            $table->comment('资源权限表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission');
    }
};
