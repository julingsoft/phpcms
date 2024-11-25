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
        Schema::create('user_permission', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('tenant_id')->default(0)->comment('租户ID');
            $table->unsignedInteger('user_id')->nullable(false)->comment('用户ID');
            $table->unsignedInteger('permission_id')->nullable(false)->comment('权限资源ID');
            $table->unique(['user_id', 'permission_id'], 'user_permission_unique');
            $table->comment('用户权限资源表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_permission');
    }
};
